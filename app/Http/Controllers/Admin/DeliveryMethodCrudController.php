<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rating;

class DeliveryMethodCrudController extends BaseCrudController
{
    protected bool $hasReorderOperation = true;

    protected function setupListOperation()
    {
        parent::setupListOperation(); // TODO: Change the autogenerated stub
    }

    protected function setupCreateOperation()
    {
        parent::setupCreateOperation(); // TODO: Change the autogenerated stub
        $this->crud->addField([
            'name'      => 'markets',
            'type'      => 'select2_multiple',
            'attribute' => 'name',
            'label'     => trans('admin.market.plural'),
            'allows_null' => false,
        ]);
    }
}