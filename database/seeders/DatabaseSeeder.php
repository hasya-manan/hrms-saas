<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // 1. Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Create Permissions
        $pManageAll = Permission::firstOrCreate(['name' => 'manage all', 'guard_name' => 'web']);
        $pManageEmployees = Permission::firstOrCreate(['name' => 'manage employees', 'guard_name' => 'web']);

        // 3. Create Global Roles (team_id is NULL)
        $superAdminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $companyAdminRole = Role::firstOrCreate(['name' => 'company_admin',  'guard_name' => 'web']);
        $staffRole = Role::firstOrCreate(['name' => 'staff',  'guard_name' => 'web']);

        // 4. Assign Permissions to Roles
        $superAdminRole->givePermissionTo($pManageAll);
        $companyAdminRole->givePermissionTo($pManageEmployees);

        // 5. Create a dummy tenant for the superadmin
        $tenant = Tenant::create([
            'name' => 'Superadmin Company',                
            'registration_number' => 'SUPER-001'
        ]);

        // 6. Create the Superadmin User
        $superAdminUser = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'tenant_id' => $tenant->id,
        ]);

         // set team/tenant context
        app(PermissionRegistrar::class)->setPermissionsTeamId($tenant->id);
        // 7. Assign the Role
       
        $superAdminUser->assignRole($superAdminRole, $tenant->id);
    }
}
