<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team')->insert([
            'departementcode' => 1,
            'name' => "teknologi",
            'teamleader' => 1,
            'isactive' => 1,
        ]);
    }
}
