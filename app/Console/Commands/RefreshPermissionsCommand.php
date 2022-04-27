<?php

namespace App\Console\Commands;

use App\Helpers\AdminMenuGenerator;
use App\Helpers\RolePermission;
use App\Models\Permission;
use Illuminate\Console\Command;

class RefreshPermissionsCommand extends Command
{
    protected $signature = 'permissions:refresh';

    public function handle() {
        $guard      = 'web';
        $operations = [
            RolePermission::CRUD_DESTROY,
            RolePermission::CRUD_UPDATE,
            RolePermission::CRUD_CREATE
        ];
        $items = collect(AdminMenuGenerator::items())->pluck('items')->flatten(1)->whereNotNull('uri');
        foreach ($items as $item) {
            Permission::query()->updateOrCreate([
                'name' => RolePermission::CRUD_VIEW."_".$item['uri'],
                'guard_name' => $guard,
            ], [
                'model'     => $item['uri']
            ]);

            if ($item['require_permission']) {
                foreach ($operations as $operation) {
                    Permission::query()->updateOrCreate([
                        'name' => $operation."_".$item['uri'],
                        'guard_name' => $guard,
                    ], [
                        'model'     => $item['uri']
                    ]);
                }
            }

        }
        $this->info("Successfully refreshed");
    }
}
