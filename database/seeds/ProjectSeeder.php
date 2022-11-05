<?php


use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("project")->insert([
            "projectcode" => 1231,
            "subprojectcode" => 1231,
            "projectname" => "pembuatanJalan",
            "initiativename" => "JalanBandung",
            "pic"=> 1,
            // "subprojectcode"=> 1232,
            // "fsyear"=>,
            // "targetlive"=>,
            // "budgetallocationyear"=>,
            // "targetalokasiangaran"=>,
            "paymentmethode"=>"cash",
            "budgetallocation" =>1000,
            // "iocode" => 1,
            "isactive" => 1,
        ]);
        DB::table("project")->insert([
            "projectcode" => 111,
            "subprojectcode" => 111,
            "projectname" => "pembuatanJalan",
            "initiativename" => "JalanBandung",
            "pic"=> 1,
            // "subprojectcode"=> 1232,
            // "fsyear"=>,
            // "targetlive"=>,
            // "budgetallocationyear"=>,
            // "targetalokasiangaran"=>,
            "paymentmethode"=>"cash",
            "budgetallocation" =>1000,
            // "iocode" => 1,
            "isactive" => 1,
        ]);
    }
}
