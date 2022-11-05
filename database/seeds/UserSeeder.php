<?php

use Illuminate\Database\Seeder;
// use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'username' => "admindh",
            'email' => "admindh@gmail.com",
            'jabatan' => "pmDh",
            'nip' => 12321,
            // 'position' => "pmDh",
            'namadepan' => "abdul",
            'namabelakang' => "maman",
            'isactive' => 1,
            'accessid' => 1,
            'departementid' => 1,
            'teamid' => 1,
            'password' => Hash::make('12345678'),
        ]);
        DB::table('users')->insert([
            'username' => "adminpmtl",
            'email' => "adminpmtl@gmail.com",
            'jabatan' => "pm-tl",
            'nip' => 12321,
            // 'position' => "pmTl",
            'namadepan' => "pmTl",
            'namabelakang' => "udin",
            'isactive' => 1,
            'accessid' => 2,
            'departementid' => 1,
            'teamid' => 1,
            'password' => Hash::make('12345678'),
        ]);
        DB::table('users')->insert([
            'username' => "adminpnptl",
            'email' => "adminpnptl@gmail.com" ,
            'jabatan' => "pnp-tl",
            'nip' => 12321,
            // 'position' => "pnptl",
            'namadepan' => "pnptl",
            'namabelakang' => "zain",
            'isactive' => 1,
            'accessid' => 3,
            'departementid' => 1,
            'teamid' => 1,
            'password' => Hash::make('12345678'),
        ]);
        DB::table('users')->insert([
            'email' => "admin@gmail.com" ,
            'username' => "admin",
            // 'position' => "admin",
            'namadepan' => "admin",
            'jabatan' => "admin",
            'nip' => 12321,
            'namabelakang' => "fajar",
            'departementid' => 1,
            'teamid' => 1,
            'isactive' => 1,
            'accessid' => 4,
            'password' => Hash::make('12345678'),
        ]);
    }
}
