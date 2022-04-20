<?php

namespace App\Console\Commands;

use App\Helpers\AdminMenuGenerator;
use App\Helpers\RolePermission;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class RefreshPermissionsCommand extends Command
{
    protected $signature = 'permissions:refresh';

    public function handle() {
        $guard      = 'web';
        $operations = [
            RolePermission::OPERATION_DESTROY,
            RolePermission::OPERATION_UPDATE,
            RolePermission::OPERATION_CREATE
        ];
        $items = collect(AdminMenuGenerator::items())->whereNotNull('uri');
        foreach ($items as $item) {
            Permission::query()->updateOrCreate([
                'name' => RolePermission::OPERATION_VIEW."_".$item['uri'],
                'guard_name' => $guard,
            ]);

            if ($item['require_permission']) {
                foreach ($operations as $operation) {
                    Permission::query()->updateOrCreate([
                        'name' => $operation."_".$item['uri'],
                        'guard_name' => $guard
                    ]);
                }
            }

        }
        $this->info("Successfully refreshed");
    }
}
