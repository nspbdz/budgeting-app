<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'name' => "pm-dh",
            'position' => "leader",
            'isactive' => "1",
        ]); 
        DB::table('role')->insert([
            'name' => "pm-tl",
            'position' => "leader",
            'isactive' => "1",
        ]);

        DB::table('role')->insert([
            'name' => "pnp-tl",
            'position' => "leader",
            'isactive' => "1",
        ]);
        DB::table('role')->insert([
            'name' => "admin",
            'position' => "admin",
            'isactive' => "1",
        ]);
    }
}
