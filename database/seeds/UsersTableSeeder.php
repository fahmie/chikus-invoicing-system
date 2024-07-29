<?php

use App\Models\Company;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Setting;
use App\Models\Address;
use App\Models\CompanySetting;
use App\Models\ProductUnit;
use App\Models\TaxType;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Fahmie',
            'last_name' => 'Amzar',
            'username' => 'superadmin',
            'email'  => 'superadmin@cara.com.my',
            'sites_id' => 1,
            'roles' => "superadmin",
            'password' => Hash::make("Cara1q2w3e"),
        ]);

        $company = Company::create([
            'name' => 'Modkha Marine',
            'owner_id' => $user->id,
        ]);

        $permission= Permission::select('id')->get();
        // $superadmin = Role::where('slug','superadmin')->first();
        // $superadmin->permissions()->attach($permission);
        $user->roles()->attach(1);
        $user->permissions()->attach($permission);

        // Attach User to Company
        $user->attachCompany($company);


        $address = Address::create([
            'model_type' => 'App\Models\Company',
            'model_id' => 1,
            'role' => 'main',
            'name' => 'Modkha Marine',
            'address_1' => '18,Star Sentral,Cyberjaya,Selangor',
            'country_id' => 132,
            'city' => 'Cyberjaya',
            'state' => 'Selangor',
            'zip' => '43200',
            'phone' => '0132035637',

        ]);

    }
}
