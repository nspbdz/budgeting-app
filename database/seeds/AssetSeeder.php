<?php

use Illuminate\Database\Seeder;


class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asset')->insert([
            'projectcode' => 1,
            'projectname' => "tech",
            "jobname"=>"teknologi",
            "contractnumber"=> 2020,
            "contractvalue"=> 19011,
            "masterasset"=> 111,
            'isactive' => 1,

        ]);

        DB::table('asset')->insert([
            'projectcode' => 2,
            'projectname' => "tech",
            "jobname"=>"teknologi",
            "contractnumber"=> 2020,
            "contractvalue"=> 19011,
            "masterasset"=> 111,
            'isactive' => 1,

        ]);
        DB::table('asset')->insert([
            'projectcode' => 3,
            'projectname' => "tech",
            "jobname"=>"teknologi",
            "contractnumber"=> 2020,
            "contractvalue"=> 19011,
            "masterasset"=> 111,
            'isactive' => 1,

        ]);

    }
}
