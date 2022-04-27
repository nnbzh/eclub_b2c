<?php

namespace App\Helpers;

class RolePermission
{
    const ROLE_ADMIN            = 'admin';
    const ROLE_SUPER_ADMIN      = 'super-admin';
    const ROLE_CONTENT_MANAGER  = 'content-manager';

    const CRUD_VIEW       = 'view';
    const CRUD_CREATE     = 'create';
    const CRUD_DESTROY    = 'destroy';
    const CRUD_UPDATE     = 'update';

    public static function getLocaleRoleNames($role = null) {
        $roles = [
            self::ROLE_ADMIN            => trans('role.admin'),
            self::ROLE_SUPER_ADMIN      => trans('role.super-admin'),
            self::ROLE_CONTENT_MANAGER  => trans('role.content-manager'),
        ];

        if ($role) {
            return $roles[$role];
        }

        return $roles;
    }
}
