<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $roles = [
            'admin', 'staff', 'viewer',
        ];

        $permissions = [
            'products-view', 'products-create', 'products-update', 'products-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach ($roles as $role) {
            $employee = Role::findOrCreate($role, 'web');
            switch ($employee->name) {
                case 'admin':
                    $employee->givePermissionTo($permissions);
                    break;
                case 'staff':
                    $employee->givePermissionTo(['products-view', 'products-create', 'products-update']);
                    break;
                case 'viewer':
                    $employee->givePermissionTo(['products-view']);
                    break;
                default:
            }
        }

        User::factory()->count(3)->state(new Sequence(
            [
                'email' => 'admin@product.com',
                'name' => 'Admin',
            ],
            [
                'email' => 'staff@product.com',
                'name' => 'Staff',
            ],
            [
                'email' => 'viewer@product.com',
                'name' => 'Viewer',
            ])
        )->create()->each(function ($user) {
            switch ($user->email) {
                case 'admin@product.com':
                    $user->assignRole('admin');
                    break;
                case 'staff@product.com':
                    $user->assignRole('staff');
                    break;
                case 'viewer@product.com':
                    $user->assignRole('viewer');
                default:
            }
        });
    }
}
