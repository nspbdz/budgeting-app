<?php

use Illuminate\Database\Seeder;

class DepartmentHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departmenthead')->insert([
            'userid' => 1,
            'departmentheadid' => 2,
            'isactive' => 1,
        ]);
    }
}
