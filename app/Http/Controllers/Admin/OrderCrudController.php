<?php

namespace App\Http\Controllers\Admin;

class OrderCrudController extends BaseCrudController
{
    protected bool $hasReorderOperation = false;

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name'      => 'user',
            'type'      => 'select',
            'attribute' => 'name_or_phone',
            'label'     => 'Заказчик',
        ]);
        $this->crud->addColumn([
            'name'      => 'status',
            'type'      => 'select_from_array',
            'options'   => trans('order_statuses'),
            'label'     => 'Статус',
        ]);
        parent::setupListOperation(); // TODO: Change the autogenerated stub
        $this->crud->addColumn([
            'name'      => 'paymentMethod',
            'type'      => 'select',
            'attribute' => 'name',
            'label'     => 'Способ оплаты',
        ]);
        $this->crud->addColumn([
            'name'      => 'deliveryMethod',
            'type'      => 'select',
            'attribute' => 'name',
            'label'     => 'Способ доставки',
        ]);
    }
}