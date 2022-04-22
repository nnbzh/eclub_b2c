<?php

namespace App\Models;

use App\Helpers\RolePermission;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use CrudTrait;

    public function getRuNameAttribute() {
        return RolePermission::getLocaleRoleNames($this->name);
    }
}
