<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RolehasPermissionSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(CompanySettingSeeder::class);
        $this->call(ProductUnitSeeder::class);
        $this->call(TaxTypeSeeder::class);
        $this->call(LorryTypeSeeder::class);
        
    }
}
