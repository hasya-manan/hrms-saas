<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class TenantController extends Controller
{
    public function create()
    {
        return Inertia::render('Tenants/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8',
        ]);

        // Wrap everything in a transaction
        DB::transaction(function () use ($validated) {
            // 1. Create the Company (Tenant)
            $tenant = Tenant::create([
                'name' => $validated['name'],
                'registration_number' => $validated['registration_number'],
            ]);

            // 2. Create the Admin User for that Company
            $user = User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'],
                'password' => Hash::make($validated['admin_password']),
                'tenant_id' => $tenant->id,
            ]);

            
            $companyAdminRole = Role::where('name', 'company_admin')                                
                                    ->first();
            //dd($companyAdminRole);
            // 4. Assign the role to the user within the new tenant's context
            $user->assignRole($companyAdminRole, $tenant->id);
        });

        return redirect()->back()->with('success', 'Company and Admin created successfully!');
    }
}
