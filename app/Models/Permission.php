<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->mergeFillable([
            'name',
            'guard_name',
            'model'
        ]);
    }

    public function getTranslatedNameAttribute() {
        $permissionModel        = explode('_', $this->name);
        $permission             = $permissionModel[0];
        $model                  = implode('_', array_slice($permissionModel, 1));
        $translatedPermission   = trans("permission.$permission");
        $translatedModel        = trans("admin.$model.plural");

        return $translatedPermission .' '. mb_strtolower($translatedModel);
    }
}
