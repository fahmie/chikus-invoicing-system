<?php

use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('company_settings')->delete();

        CompanySetting::create(['company_id' => 1, 'option' => 'currency_id', 'value' => 20]);
        CompanySetting::create(['company_id' => 1, 'option' => 'langugage', 'value' => 'en']);
        CompanySetting::create(['company_id' => 1, 'option' => 'timezone', 'value' => 'Asia/Kuala_Lumpur']);
        CompanySetting::create(['company_id' => 1, 'option' => 'date_format', 'value' => 'd/m/Y']);
        CompanySetting::create(['company_id' => 1, 'option' => 'financial_month_starts', 'value' => 1]);
        CompanySetting::create(['company_id' => 1, 'option' => 'financial_month_ends', 'value' => 12]);
        CompanySetting::create(['company_id' => 1, 'option' => 'invoice_prefix', 'value' => 'INV']);
        CompanySetting::create(['company_id' => 1, 'option' => 'invoice_color', 'value' => '#4cbb71']);
        CompanySetting::create(['company_id' => 1, 'option' => 'invoice_footer', 'value' => '']);
        CompanySetting::create(['company_id' => 1, 'option' => 'invoice_auto_archive', 'value' => 0]);
        CompanySetting::create(['company_id' => 1, 'option' => 'invoice_note', 'value' => '']);
    }
}
