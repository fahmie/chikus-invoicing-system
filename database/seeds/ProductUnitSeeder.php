<?php

use Illuminate\Database\Seeder;

class ProductUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('product_units')->delete();
        ProductUnit::create(['company_id' => 1, 'name' => 'Tan']);
    }
}
