<?php

namespace Database\Seeders;

use App\Helpers\RolePermission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = 'web';
        $roles = [
            RolePermission::ROLE_SUPER_ADMIN, RolePermission::ROLE_ADMIN, RolePermission::ROLE_CONTENT_MANAGER
        ];

        foreach ($roles as $role) {
            Role::query()->updateOrCreate(['name' => $role, 'guard_name' => $guard]);
        }
    }
}
