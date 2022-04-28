<?php

namespace App\Http\Controllers\Admin;

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
    use ListOperation;
    use ShowOperation;
    use CreateOperation;
    use UpdateOperation {
        edit as parentEdit;
    }
    use DeleteOperation;
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
                'name'      => 'images',
                'type'      => 'images_relationship',
                'attribute' => 'full_url',
                'disk'      => 's3'
            ]);
            if ($this->crud->getCurrentOperation() == 'update') {
                $entry = $this->crud->getCurrentEntry();
                \Session::put('imageable_id', $entry->id);
                \Session::put('imageable_type', get_class($entry));
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
