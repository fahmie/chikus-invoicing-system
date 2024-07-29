<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolehasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission= Permission::select('id')->get();
        $superadmin = Role::where('slug','superadmin')->first();
        $superadmin->permissions()->attach($permission);

        $permission_admin_company= Permission::select('id')->whereNotIn('id',[1,2,3,4,52,54])->get();
        $admin_company = Role::where('slug','admin_company')->first();
        $admin_company->permissions()->attach($permission_admin_company);

        $permission_admin= Permission::select('id')->whereNotIn('id',[1,2,3,4,51,52,53,54,56,58])->get();
        $admin = Role::where('slug','admin')->first();
        $admin->permissions()->attach($permission_admin);

        $permission_staff= Permission::select('id')->whereNotIn('id',[1,2,3,4,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70])->get();
        $staff = Role::where('slug','staff')->first();
        $staff->permissions()->attach($permission_staff);

        $permission_client= Permission::select('id')->whereIn('id',[39,40,41,42,43,44,45,46,47,49])->get();
        $client = Role::where('slug','client')->first();
        $client->permissions()->attach($permission_client);
    }
}
