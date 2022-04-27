<?php

namespace App\Http\Controllers\Admin;

use App\Events\ImageUploadedEvent;
use App\Helpers\RolePermission;
use App\Traits\Imageable;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Illuminate\Support\Str;

abstract class BaseCrudController extends CrudController
{
    use CreateOperation {
        store as parentStore;
    }

    use UpdateOperation {
        update as parentUpdate;
        edit as parentEdit;
    }

    use ListOperation;
    use DeleteOperation;
    use ShowOperation;
    use ReorderOperation;

    protected $attributes;
    protected $modelName;
    protected bool $showTimestamps = false;
    protected bool $hasReorderOperation = false;
    protected bool $hasImage = false;

    public function setup()
    {
        [$model, $class] = $this->getModelAndClassName();
        $this->modelName = $class = strtolower(Str::snake($class));
        $this->attributes = \DB::getSchemaBuilder()->getColumnListing((new $model)->getTable());
        $this->setBackpackConfigs($model, $class);
        $this->setupAccess();
        $this->setHasImage($this->crud->model);
    }

    private function getModelAndClassName() {
        $class = str_replace('CrudController', '', class_basename($this));
        $model = "App\\Models\\$class";

        return [$model, $class];
    }

    private function setBackpackConfigs($model, $class) {
        $this->crud->setModel($model);
        $this->crud->setRoute(config('backpack.base.route_prefix')."/$class");
        $this->crud->setEntityNameStrings(trans('admin.'.$class.".singular"), trans('admin.'.$class.".plural"));
    }

    private function setupAccess() {
        $user           = backpack_user();
        $permissions    = [
            'list'      => RolePermission::CRUD_VIEW,
            'show'      => RolePermission::CRUD_VIEW,
            'create'    => RolePermission::CRUD_CREATE,
            'update'    => RolePermission::CRUD_UPDATE,
            'delete'    => RolePermission::CRUD_DESTROY,
        ];
        foreach ($permissions as $operation => $permission) {
            $action = $permission."_".$this->modelName;
            if ($user->can($action)) {
                continue;
            }
            $this->crud->denyAccess($operation);
        }

        if (! $this->hasReorderOperation) {
            $this->crud->denyAccess('reorder');
        }
    }

    protected function setupReorderOperation($field = 'name')
    {
        $this->crud->set('reorder.label', $field);
        $this->crud->set('reorder.max_level', 10);
    }

    protected function setupListOperation() {
        $modelAttributes = trans("admin.".$this->modelName.".fields");

        if (is_array($modelAttributes)) {
            foreach (array_keys($modelAttributes) as $attribute) {
                $this->crud->addColumn([
                    'name'  => $attribute,
                    'label' => $modelAttributes[$attribute]
                ]);
            }
        }

        if ($this->showTimestamps) {
            $commonAttributes = trans('admin.common');

            foreach (array_keys($commonAttributes) as $attribute) {
                $this->crud->addColumn([
                    'name'  => $attribute,
                    'label' => $commonAttributes[$attribute]
                ]);
            }
        }

        if ($this->hasImage) {
            $this->crud->addColumn([
                'name' => 'imgSrc',
                'label' => trans('admin.image.singular'),
                'type' => 'image',
                'disk' => 's3',
                'width' => '150px',
                'height' => '150px',
            ]);
        }
    }

    public function store()
    {
        if (! $this->hasImage) {
            return $this->parentStore();
        }

        $this->crud->hasAccessOrFail('create');
        $request = $this->crud->validateRequest();
        $image   = $request->get('img_src');
        $request->request->remove('img_src');
        $this->crud->registerFieldEvents();
        $item = $this->crud->create($this->crud->getStrippedSaveRequest($request));
        $this->data['entry'] = $this->crud->entry = $item;
        \Alert::success(trans('backpack::crud.insert_success'))->flash();
        $this->crud->setSaveAction();

        if ($image) {
            event(new ImageUploadedEvent($item, $image, RolePermission::CRUD_CREATE));
        }

        return $this->crud->performSaveAction($item->getKey());
    }

    public function update()
    {
        if (! $this->hasImage) {
            return $this->parentUpdate();
        }

        $this->crud->hasAccessOrFail('update');
        $request = $this->crud->validateRequest();
        $image   = $request->get('img_src');
        $request->request->remove('img_src');
        $this->crud->registerFieldEvents();
        $item = $this->crud->update(
            $request->get($this->crud->model->getKeyName()),
            $this->crud->getStrippedSaveRequest($request)
        );
        $this->data['entry'] = $this->crud->entry = $item;
        \Alert::success(trans('backpack::crud.update_success'))->flash();
        $this->crud->setSaveAction();

        event(new ImageUploadedEvent($item, $image, RolePermission::CRUD_UPDATE, $request->get('_locale') ?? 'ru'));

        return $this->crud->performSaveAction($item->getKey());
    }

    public function edit($id)
    {
        app()->setLocale(request('_locale', 'ru'));

        if (! $this->hasImage) {
            return $this->parentEdit($id);
        }

        return $this->parentEdit($id);
    }

    protected function setupCreateOperation() {
        $this->setValidation();
        $modelAttributes = trans("admin.".$this->modelName.".fields");

        if (is_array($modelAttributes)) {
            foreach (array_keys($modelAttributes) as $attribute) {
                $field = [
                    'name'  => $attribute,
                    'label' => $modelAttributes[$attribute]
                ];
                if ($attribute == 'id') {
                    $field['attributes']['readonly'] = 'readonly';
                }
                $this->crud->addField($field);
            }
        }


        if ($this->showTimestamps) {
            $commonAttributes = trans('admin.common');

            foreach (array_keys($commonAttributes) as $attribute) {
                $this->crud->addField([
                    'name'  => $attribute,
                    'label' => $commonAttributes[$attribute]
                ]);
            }
        }

        if ($this->hasImage) {
            $this->crud->addField([
                'name' => 'img_src',
                'label' => trans('admin.image.singular'),
                'type' => 'image',
                'disk' => 's3',
                'width' => '150px',
                'height' => '150px',
            ]);
            if ($this->crud->getCurrentOperation() == 'update') {
                $entry = $this->crud->getCurrentEntry();
                \Session::put('imageable_id', $entry->id);
                \Session::put('imageable_type', get_class($entry));
                $html = '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'. route('image.index') .'" target="_blank" class="btn btn-dark btn-sm" role="button" aria-pressed="true">Все картины</a>
                    </div>';
                $this->crud->addField([   // CustomHTML
                    'name'  => 'seperator',
                    'type'  => 'custom_html',
                    'value' => $html
                ]);
            }
        }
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation() {
        $this->setupListOperation();
    }

    protected function addRelatedColumn($relatedModel, $attribute) {
        $relatedModel = strtolower($relatedModel);

        $this->crud->addColumn([
            'name'      => $relatedModel,
            'type'      => 'select2',
            'label'     => trans("admin.". Str::singular($relatedModel) .".singular"),
            'attribute' => $attribute
        ]);
    }

    protected function addRelatedField($relatedModel, $attribute, $callable = null) {
        $relatedModel = strtolower($relatedModel);

        $this->crud->addField([
            'name'      => $relatedModel,
            'type'      => 'select2',
            'label'     => trans("admin.". Str::singular($relatedModel) .".singular"),
            'attribute' => $attribute,
            'options'   => ($callable)
        ]);
    }

    protected function setValidation() {
        $requestClass = class_basename($this->crud->getModel()).'Request';
        $path = "App\\Http\\Requests\\$requestClass";

        if (class_exists($path)) {
            $this->crud->setValidation($path);
        }
    }

    private function setHasImage($model) {
        $this->hasImage = in_array(Imageable::class, class_uses($model::class));
    }
}
