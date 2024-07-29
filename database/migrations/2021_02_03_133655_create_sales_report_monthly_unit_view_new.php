<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesReportMonthlyUnitViewNew extends Migration
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
                CREATE VIEW sales_report_monthly_unit_view_new AS
                SELECT `sites_id`,YEAR(created_at) AS year,
                sum(if(month(created_at) = 1,  Total_quantity, 0))  AS Jan,
                sum(if(month(created_at) = 2,  Total_quantity, 0))  AS Feb,
                sum(if(month(created_at) = 3,  Total_quantity, 0))  AS Mar,
                sum(if(month(created_at) = 4,  Total_quantity, 0))  AS Apr,
                sum(if(month(created_at) = 5,  Total_quantity, 0))  AS May,
                sum(if(month(created_at) = 6,  Total_quantity, 0))  AS Jun,
                sum(if(month(created_at) = 7,  Total_quantity, 0))  AS Jul,
                sum(if(month(created_at) = 8,  Total_quantity, 0))  AS Aug,
                sum(if(month(created_at) = 9,  Total_quantity, 0))  AS Sep,
                sum(if(month(created_at) = 10, Total_quantity, 0)) AS Oct,
                sum(if(month(created_at) = 11, Total_quantity, 0)) AS Nov,
                sum(if(month(created_at) = 12, Total_quantity, 0)) AS 'Dec'
                FROM view_all_data_new
                WHERE YEAR(CURDATE())
                GROUP BY `sites_id`,year
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
            DROP VIEW IF EXISTS `sales_report_monthly_unit_view_new`;
            SQL;
    }
}
