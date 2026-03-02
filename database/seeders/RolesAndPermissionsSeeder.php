<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Create Global Roles (team_id is NULL)
        Role::firstOrCreate(['name' => 'superadmin', 'team_id' => null, 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'company_admin', 'team_id' => null, 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'staff', 'team_id' => null, 'guard_name' => 'web']);

        // 2. Create Permissions 
        Permission::firstOrCreate([
            'name' => 'manage employees', 
            'guard_name' => 'web' 
        ]);
        
        // 3. Assign Permissions to Roles (Optional)
        $companyAdminRole = Role::where('name', 'company_admin')
                                ->whereNull('team_id')
                                ->where('guard_name', 'web') 
                                ->first();
                                
        $companyAdminRole->givePermissionTo('manage employees');

        //TODO assign permissions from pov superadmin
        
       
    }
}