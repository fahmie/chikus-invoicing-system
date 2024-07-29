<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripReportDailyTypeViewNew extends Migration
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
                CREATE VIEW trip_report_daily_type_view_new AS
                SELECT `type`,`sites_id`,MONTH(created_at) AS month,YEAR(created_at) AS year,
                SUM(CASE WHEN DAY(created_at) = 1 THEN 1 ELSE 0 END) AS '1',
                SUM(CASE WHEN DAY(created_at) = 2 THEN 1 ELSE 0 END) AS '2',
                SUM(CASE WHEN DAY(created_at) = 3 THEN 1 ELSE 0 END) AS '3',
                SUM(CASE WHEN DAY(created_at) = 4 THEN 1 ELSE 0 END) AS '4',
                SUM(CASE WHEN DAY(created_at) = 5 THEN 1 ELSE 0 END) AS '5',
                SUM(CASE WHEN DAY(created_at) = 6 THEN 1 ELSE 0 END) AS '6',
                SUM(CASE WHEN DAY(created_at) = 7 THEN 1 ELSE 0 END) AS '7',
                SUM(CASE WHEN DAY(created_at) = 8 THEN 1 ELSE 0 END) AS '8',
                SUM(CASE WHEN DAY(created_at) = 9 THEN 1 ELSE 0 END) AS '9',
                SUM(CASE WHEN DAY(created_at) = 10 THEN 1 ELSE 0 END) AS '10',
                SUM(CASE WHEN DAY(created_at) = 11 THEN 1 ELSE 0 END) AS '11',
                SUM(CASE WHEN DAY(created_at) = 12 THEN 1 ELSE 0 END) AS '12',
                SUM(CASE WHEN DAY(created_at) = 13 THEN 1 ELSE 0 END) AS '13',
                SUM(CASE WHEN DAY(created_at) = 14 THEN 1 ELSE 0 END) AS '14',
                SUM(CASE WHEN DAY(created_at) = 15 THEN 1 ELSE 0 END) AS '15',
                SUM(CASE WHEN DAY(created_at) = 16 THEN 1 ELSE 0 END) AS '16',
                SUM(CASE WHEN DAY(created_at) = 17 THEN 1 ELSE 0 END) AS '17',
                SUM(CASE WHEN DAY(created_at) = 18 THEN 1 ELSE 0 END) AS '18',
                SUM(CASE WHEN DAY(created_at) = 19 THEN 1 ELSE 0 END) AS '19',
                SUM(CASE WHEN DAY(created_at) = 20 THEN 1 ELSE 0 END) AS '20',
                SUM(CASE WHEN DAY(created_at) = 21 THEN 1 ELSE 0 END) AS '21',
                SUM(CASE WHEN DAY(created_at) = 22 THEN 1 ELSE 0 END) AS '22',
                SUM(CASE WHEN DAY(created_at) = 23 THEN 1 ELSE 0 END) AS '23',
                SUM(CASE WHEN DAY(created_at) = 24 THEN 1 ELSE 0 END) AS '24',
                SUM(CASE WHEN DAY(created_at) = 25 THEN 1 ELSE 0 END) AS '25',
                SUM(CASE WHEN DAY(created_at) = 26 THEN 1 ELSE 0 END) AS '26',
                SUM(CASE WHEN DAY(created_at) = 27 THEN 1 ELSE 0 END) AS '27',
                SUM(CASE WHEN DAY(created_at) = 28 THEN 1 ELSE 0 END) AS '28',
                SUM(CASE WHEN DAY(created_at) = 29 THEN 1 ELSE 0 END) AS '29',
                SUM(CASE WHEN DAY(created_at) = 30 THEN 1 ELSE 0 END) AS '30',
                SUM(CASE WHEN DAY(created_at) = 31 THEN 1 ELSE 0 END) AS '31'
                FROM view_all_data_new
                WHERE YEAR(CURDATE())
                AND MONTH(CURDATE())
                GROUP BY `type`,`sites_id`,month,year
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
            DROP VIEW IF EXISTS `trip_report_daily_type_view_new`;
            SQL;
    }
}
