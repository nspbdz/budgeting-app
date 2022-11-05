<?php


use Illuminate\Database\Seeder;


class InternalOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('internalorder')->insert([

            'name' => "pembuatan Jalan",
            "projectid" => 1,
            "isactive" => 1,
        ]);
    }
}
