<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInaccuracyReportUnitDailyViewNew extends Migration
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
                CREATE VIEW inaccuracy_report_unit_daily_view_new AS
                SELECT `sites_id`,MONTH(created_at) AS month,YEAR(created_at) AS year,
                sum(if((DAY(created_at) = 1),total_unit_inaccurate,0)) AS '1',
                sum(if((DAY(created_at) = 2),total_unit_inaccurate,0)) AS '2',
                sum(if((DAY(created_at) = 3),total_unit_inaccurate,0)) AS '3',
                sum(if((DAY(created_at) = 4),total_unit_inaccurate,0)) AS '4',
                sum(if((DAY(created_at) = 5),total_unit_inaccurate,0)) AS '5',
                sum(if((DAY(created_at) = 6),total_unit_inaccurate,0)) AS '6',
                sum(if((DAY(created_at) = 7),total_unit_inaccurate,0)) AS '7',
                sum(if((DAY(created_at) = 8),total_unit_inaccurate,0)) AS '8',
                sum(if((DAY(created_at) = 9),total_unit_inaccurate,0)) AS '9',
                sum(if((DAY(created_at) = 10),total_unit_inaccurate,0)) AS '10',
                sum(if((DAY(created_at) = 11),total_unit_inaccurate,0)) AS '11',
                sum(if((DAY(created_at) = 12),total_unit_inaccurate,0)) AS '12',
                sum(if((DAY(created_at) = 13),total_unit_inaccurate,0)) AS '13',
                sum(if((DAY(created_at) = 14),total_unit_inaccurate,0)) AS '14',
                sum(if((DAY(created_at) = 15),total_unit_inaccurate,0)) AS '15',
                sum(if((DAY(created_at) = 16),total_unit_inaccurate,0)) AS '16',
                sum(if((DAY(created_at) = 17),total_unit_inaccurate,0)) AS '17',
                sum(if((DAY(created_at) = 18),total_unit_inaccurate,0)) AS '18',
                sum(if((DAY(created_at) = 19),total_unit_inaccurate,0)) AS '19',
                sum(if((DAY(created_at) = 20),total_unit_inaccurate,0)) AS '20',
                sum(if((DAY(created_at) = 21),total_unit_inaccurate,0)) AS '21',
                sum(if((DAY(created_at) = 22),total_unit_inaccurate,0)) AS '22',
                sum(if((DAY(created_at) = 23),total_unit_inaccurate,0)) AS '23',
                sum(if((DAY(created_at) = 24),total_unit_inaccurate,0)) AS '24',
                sum(if((DAY(created_at) = 25),total_unit_inaccurate,0)) AS '25',
                sum(if((DAY(created_at) = 26),total_unit_inaccurate,0)) AS '26',
                sum(if((DAY(created_at) = 27),total_unit_inaccurate,0)) AS '27',
                sum(if((DAY(created_at) = 28),total_unit_inaccurate,0)) AS '28',
                sum(if((DAY(created_at) = 29),total_unit_inaccurate,0)) AS '29',
                sum(if((DAY(created_at) = 30),total_unit_inaccurate,0)) AS '30',
                sum(if((DAY(created_at) = 31),total_unit_inaccurate,0)) AS '31'
                FROM inaccuracy_report_allprice_view_new
                WHERE YEAR(CURDATE())
                AND MONTH(CURDATE())
                AND accurate = 'Inaccurate Quantity'
                GROUP BY `sites_id`,month,year
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
            DROP VIEW IF EXISTS `inaccuracy_report_unit_daily_view_new`;
            SQL;
    }
}
