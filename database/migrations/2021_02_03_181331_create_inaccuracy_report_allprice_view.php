<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInaccuracyReportAllpriceView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return <<<SQL
                CREATE VIEW inaccuracy_report_allprice_view_new AS
                SELECT A.*,B.price,B.quantity,B.quantity-A.accurate_remark AS total_unit_inaccurate,B.price*(B.quantity-A.accurate_remark) as total_rm_inaccurate
                FROM invoice_items as B
                INNER JOIN invoices as A ON A.id = B.invoice_id
            SQL;
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `inaccuracy_report_allprice_view_new`;
            SQL;
    }
}
