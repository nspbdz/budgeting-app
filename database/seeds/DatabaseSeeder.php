<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            DepartementSeeder::class,
            InternalOrderSeeder::class,
            ProjectSeeder::class,
            ProjectDetailSeeder::class,
            AccessSeeder::class,
            AssetSeeder::class,
            TeamSeeder::class,
            TeamLeaderSeeder::class,
            DepartmentHeadSeeder::class,
            projectinternalorderSeeder::class,

        ]);
    }
}
