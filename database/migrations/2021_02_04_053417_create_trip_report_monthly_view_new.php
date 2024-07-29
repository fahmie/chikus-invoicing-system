<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripReportMonthlyViewNew extends Migration
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
                CREATE VIEW trip_report_monthly_view_new AS
                SELECT `sites_id`,YEAR(created_at) AS year,
                SUM(CASE WHEN month(created_at) = 1 THEN 1 ELSE 0 END) AS Jan,
                SUM(CASE WHEN month(created_at) = 2 THEN 1 ELSE 0 END) AS Feb,
                SUM(CASE WHEN month(created_at) = 3 THEN 1 ELSE 0 END) AS Mar,
                SUM(CASE WHEN month(created_at) = 4 THEN 1 ELSE 0 END) AS Apr,
                SUM(CASE WHEN month(created_at) = 5 THEN 1 ELSE 0 END) AS May,
                SUM(CASE WHEN month(created_at) = 6 THEN 1 ELSE 0 END) AS Jun,
                SUM(CASE WHEN month(created_at) = 7 THEN 1 ELSE 0 END) AS Jul,
                SUM(CASE WHEN month(created_at) = 8 THEN 1 ELSE 0 END) AS Aug,
                SUM(CASE WHEN month(created_at) = 9 THEN 1 ELSE 0 END) AS Sep,
                SUM(CASE WHEN month(created_at) = 10 THEN 1 ELSE 0 END) AS Oct,
                SUM(CASE WHEN month(created_at) = 11 THEN 1 ELSE 0 END) AS Nov,
                SUM(CASE WHEN month(created_at) = 12 THEN 1 ELSE 0 END) AS 'Dec'
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
            DROP VIEW IF EXISTS `trip_report_monthly_view_new`;
            SQL;
    }
}
