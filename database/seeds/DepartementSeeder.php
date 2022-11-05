<?php

use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departement')->insert([

            'departementcode' => "tech",
            'name' => "teknologi",
            'departmenthead' => 1,
            'isactive' => 1,
        ]);
    }
}
