<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'superadmin',
            'slug' => 'superadmin'
            ]);
        Role::create([
            'name' => 'admin_company',
            'slug' => 'admin_company'
            ]);
        Role::create([
            'name' => 'admin',
            'slug' => 'admin'
            ]);
        Role::create([
            'name' => 'staff',
            'slug' => 'staff'
            ]);
        Role::create([
            'name' => 'client',
            'slug' => 'client'
            ]);
    }
}
