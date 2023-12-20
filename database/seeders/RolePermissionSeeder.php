<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'admin']);
        $admin = Role::create(['name' => 'responsabile sede']);
        $doctor = Role::create(['name' => 'medico']);
        $teacher = Role::create(['name' => 'insegnante']);
        $instructor = Role::create(['name' => 'istruttore']);
        $secretary = Role::create(['name' => 'segretaria']);

        $permissions = [
            // section medical visits
            'show_visit',
            'create_visit',
            'update_visit',
            'delete_visit',
            // section registry customer
            'show_registry',
            'create_registry',
            'update_registry',
            'delete_registry',
            // section guides
            'show_guides',
            'create_guides',
            'update_guides',
            'delete_guides',
            // section theory
            'show_theory',
            'create_theory',
            'update_theory',
            'delete_theory',
            // section service
            'show_service',
            'create_service',
            'update_service',
            'delete_service',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $superAdmin->givePermissionTo($permissions);
        $admin->givePermissionTo($permissions);

        $doctor->givePermissionTo([
            'show_visit',
            'create_visit',
            'update_visit',
            'delete_visit',
        ]);

        $teacher->givePermissionTo([
            'show_theory',
            'create_theory',
            'update_theory',
            'delete_theory',
        ]);

        $instructor->givePermissionTo([
            'show_guides',
            'create_guides',
            'update_guides',
            'delete_guides',
        ]);

        $secretary->givePermissionTo([
            'show_registry',
            'create_registry',
            'update_registry',
            'delete_registry',
            'show_guides',
            'create_guides',
            'update_guides',
            'delete_guides',
            'show_visit',
            'create_visit',
            'update_visit',
            'delete_visit',
        ]);
    }
}
