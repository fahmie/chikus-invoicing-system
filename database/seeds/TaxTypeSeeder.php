<?php

use Illuminate\Database\Seeder;

class TaxTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tax_types')->delete();
        TaxType::create(['company_id' => 1, 'name' => 'GST', 'percent' => '6.00', 'description' => '']);
    }
}
