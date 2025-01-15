<?php
namespace Database\Seeders;

use App\Enums\Permissions\AccountEnum;
use App\Enums\Permissions\CategoryEnum;
use App\Enums\Permissions\OrderEnum;
use App\Enums\Permissions\ProductEnum;
use App\Enums\Permissions\UserEnum;
use App\Enums\RoleEnum;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsAndRolesSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            ...AccountEnum::values(),
            ...CategoryEnum::values(),
            ...OrderEnum::values(),
            ...ProductEnum::values(),
            ...UserEnum::values(),
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        Role::firstOrCreate(['name' => RoleEnum::CUSTOMER->value])
            ->givePermissionTo(AccountEnum::values());

        Role::firstOrCreate(['name' => RoleEnum::MODERATOR->value])
            ->givePermissionTo([
                ...CategoryEnum::values(),
                ...ProductEnum::values(),
            ]);

        Role::firstOrCreate(['name' => RoleEnum::ADMIN->value])
            ->givePermissionTo(Permission::all());

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
