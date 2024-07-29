<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransporterDetailView extends Migration
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
                CREATE VIEW transporter_detail_view AS
                SELECT A.id,driver_id,transporter_id,location_id,plate_number_id,plate_number,invoice_number,do_number,receipt_number,status,receipt_tran_number,transporter_paid_status,transporter_reference_number,paid_status,total,blance,discount,SUM(`quantity`) AS total_quantity ,SUM(A.price) AS total_price, A.accurate_remark AS total_inaccurate, B.price As price_transporter,  B.name As transporter_location,A.created_at,A.updated_at
                FROM `transporter_view` as A
                INNER JOIN transporter_locations as B ON A.location_id = B.id
                GROUP BY A.`id`
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
            DROP VIEW IF EXISTS `transporter_detail_view`;
            SQL;
    }

}
