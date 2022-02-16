<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Str;

abstract class BaseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    protected $attributes;
    protected $modelNameLower;
    protected bool $showTimestamps = false;
    protected bool $hasReorderOperation = false;

    public function setup()
    {
        $class = str_replace('CrudController', '', class_basename($this));
        $model = "App\\Models\\$class";
        $this->crud->setModel($model);
        $this->modelNameLower = $class = strtolower(Str::snake($class));
        $this->crud->setRoute(config('backpack.base.route_prefix')."/$class");
        $this->crud->setEntityNameStrings(trans('admin.'.$class.".singular"), trans('admin.'.$class.".plural"));
        $this->attributes = \DB::getSchemaBuilder()->getColumnListing($this->crud->model->getTable());

        if (! $this->hasReorderOperation) {
            $this->crud->denyAccess('reorder');
        }
    }

    protected function setupReorderOperation($field = 'name')
    {
        $this->crud->set('reorder.label', $field);
        $this->crud->set('reorder.max_level', 1);
    }

    protected function setupListOperation() {
        $modelAttributes = trans("admin.".$this->modelNameLower.".fields");

        foreach (array_keys($modelAttributes) as $attribute) {
            $this->crud->addColumn([
                'name'  => $attribute,
                'label' => $modelAttributes[$attribute]
            ]);
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
    }

    protected function setupCreateOperation() {
        $this->setValidation();
        $modelAttributes = trans("admin.".$this->modelNameLower.".fields");

        foreach (array_keys($modelAttributes) as $attribute) {
            $this->crud->addField([
                'name'  => $attribute,
                'label' => $modelAttributes[$attribute]
            ]);
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
            'type'      => 'relationship',
            'label'     => trans("admin.". Str::singular($relatedModel) .".singular"),
            'attribute' => $attribute
        ]);
    }

    protected function addRelatedField($relatedModel, $attribute, $callable = null) {
        $relatedModel = strtolower($relatedModel);

        $this->crud->addField([
            'name'      => $relatedModel,
            'type'      => 'relationship',
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
}
