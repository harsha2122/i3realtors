<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions grouped by resource
        $permissions = [
            // Properties
            'view properties', 'create properties', 'edit properties', 'delete properties', 'publish properties',

            // Blogs
            'view blogs', 'create blogs', 'edit blogs', 'delete blogs', 'publish blogs',
            'moderate comments',

            // Leads
            'view leads', 'manage leads', 'export leads', 'delete leads',

            // Team
            'view team', 'manage team',

            // Services
            'view services', 'manage services',

            // Settings
            'view settings', 'manage settings', 'manage branding', 'manage analytics',

            // Users
            'view users', 'create users', 'edit users', 'delete users', 'manage roles',

            // Audit
            'view audit logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->syncPermissions(Permission::all()); // All permissions

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions([
            'view properties', 'create properties', 'edit properties', 'delete properties', 'publish properties',
            'view blogs', 'create blogs', 'edit blogs', 'delete blogs', 'publish blogs', 'moderate comments',
            'view leads', 'manage leads', 'export leads',
            'view team', 'manage team',
            'view services', 'manage services',
            'view settings', 'manage settings', 'manage branding', 'manage analytics',
            'view users', 'create users', 'edit users',
            'view audit logs',
        ]);

        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->syncPermissions([
            'view properties', 'create properties', 'edit properties', 'publish properties',
            'view blogs', 'create blogs', 'edit blogs', 'publish blogs', 'moderate comments',
            'view leads',
            'view team', 'manage team',
            'view services', 'manage services',
        ]);

        $moderator = Role::firstOrCreate(['name' => 'moderator']);
        $moderator->syncPermissions([
            'view properties',
            'view blogs', 'moderate comments',
            'view leads', 'manage leads',
        ]);

        $viewer = Role::firstOrCreate(['name' => 'viewer']);
        $viewer->syncPermissions([
            'view properties',
            'view blogs',
            'view leads',
            'view team',
            'view services',
        ]);
    }
}
