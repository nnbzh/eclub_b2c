<?php

namespace App\Helpers;

class RolePermission
{
    const ROLE_ADMIN            = 'admin';
    const ROLE_SUPER_ADMIN      = 'super-admin';
    const ROLE_CONTENT_MANAGER  = 'content-manager';

    const OPERATION_VIEW        = 'view';
    const OPERATION_CREATE      = 'create';
    const OPERATION_DESTROY     = 'destroy';
    const OPERATION_UPDATE      = 'update';
}
