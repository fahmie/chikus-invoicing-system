<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesReportDailyUnitViewNew extends Migration
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
                CREATE VIEW sales_report_daily_unit_view_new AS
                SELECT `sites_id`,MONTH(created_at) AS month,YEAR(created_at) AS year,
                sum(if((DAY(created_at) = 1),Total_quantity,0)) AS '1',
                sum(if((DAY(created_at) = 2),Total_quantity,0)) AS '2',
                sum(if((DAY(created_at) = 3),Total_quantity,0)) AS '3',
                sum(if((DAY(created_at) = 4),Total_quantity,0)) AS '4',
                sum(if((DAY(created_at) = 5),Total_quantity,0)) AS '5',
                sum(if((DAY(created_at) = 6),Total_quantity,0)) AS '6',
                sum(if((DAY(created_at) = 7),Total_quantity,0)) AS '7',
                sum(if((DAY(created_at) = 8),Total_quantity,0)) AS '8',
                sum(if((DAY(created_at) = 9),Total_quantity,0)) AS '9',
                sum(if((DAY(created_at) = 10),Total_quantity,0)) AS '10',
                sum(if((DAY(created_at) = 11),Total_quantity,0)) AS '11',
                sum(if((DAY(created_at) = 12),Total_quantity,0)) AS '12',
                sum(if((DAY(created_at) = 13),Total_quantity,0)) AS '13',
                sum(if((DAY(created_at) = 14),Total_quantity,0)) AS '14',
                sum(if((DAY(created_at) = 15),Total_quantity,0)) AS '15',
                sum(if((DAY(created_at) = 16),Total_quantity,0)) AS '16',
                sum(if((DAY(created_at) = 17),Total_quantity,0)) AS '17',
                sum(if((DAY(created_at) = 18),Total_quantity,0)) AS '18',
                sum(if((DAY(created_at) = 19),Total_quantity,0)) AS '19',
                sum(if((DAY(created_at) = 20),Total_quantity,0)) AS '20',
                sum(if((DAY(created_at) = 21),Total_quantity,0)) AS '21',
                sum(if((DAY(created_at) = 22),Total_quantity,0)) AS '22',
                sum(if((DAY(created_at) = 23),Total_quantity,0)) AS '23',
                sum(if((DAY(created_at) = 24),Total_quantity,0)) AS '24',
                sum(if((DAY(created_at) = 25),Total_quantity,0)) AS '25',
                sum(if((DAY(created_at) = 26),Total_quantity,0)) AS '26',
                sum(if((DAY(created_at) = 27),Total_quantity,0)) AS '27',
                sum(if((DAY(created_at) = 28),Total_quantity,0)) AS '28',
                sum(if((DAY(created_at) = 29),Total_quantity,0)) AS '29',
                sum(if((DAY(created_at) = 30),Total_quantity,0)) AS '30',
                sum(if((DAY(created_at) = 31),Total_quantity,0)) AS '31'
                FROM view_all_data_new
                WHERE YEAR(CURDATE())
                AND MONTH(CURDATE())
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
            DROP VIEW IF EXISTS `sales_report_daily_unit_view_new`;
            SQL;
    }
}
