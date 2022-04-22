<?php

namespace App\Helpers;

class RolePermission
{
    const ROLE_ADMIN            = 'admin';
    const ROLE_SUPER_ADMIN      = 'super-admin';
    const ROLE_CONTENT_MANAGER  = 'content-manager';

    const PERMISSION_VIEW       = 'view';
    const PERMISSION_CREATE     = 'create';
    const PERMISSION_DESTROY    = 'destroy';
    const PERMISSION_UPDATE     = 'update';
}
