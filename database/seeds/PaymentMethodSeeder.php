<?php

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create(['name' => 'Cash', 'company_id' => 1]);
        PaymentMethod::create(['name' => 'Cheque', 'company_id' => 1]);
        PaymentMethod::create(['name' => 'Credit Card', 'company_id' => 1]);
        PaymentMethod::create(['name' => 'Bank Transfer', 'company_id' => 1]);

        PaymentStatus::create(['name' => 'Complete', 'code' => 'Paid']);
        PaymentStatus::create(['name' => 'Incomplete/Partial (for split payment)', 'code' => 'Partially Paid']);
        PaymentStatus::create(['name' => 'Discount (for inaccurate delivery/dispute issues)', 'code' => 'Paid with Discount']);

    }
}
