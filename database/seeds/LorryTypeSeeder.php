<?php

use Illuminate\Database\Seeder;

class LorryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('lorries')->delete();
        
        \DB::table('lorries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Lori Tayar 6',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Lori Tayar 10',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Lori Tayar 12',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Lori Tayar 22',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Lori Tayar 26',
            ),
        ));
    }
}
