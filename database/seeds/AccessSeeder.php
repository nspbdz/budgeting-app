<?php


use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{

    public function run()
    {
            DB::table('access')->insert([
            'roleid' => 1,
            'page' => "approval,dashboard,master role,master user,", // you can easily assign an actual integer array here
            // 'status_id' => 1
        ]);

        DB::table('access')->insert([
            'roleid' => 2,
            'page' => "approval,dashboard,master role,master user,", // you can easily assign an actual integer array here
            // 'status_id' => 1
        ]);
        DB::table('access')->insert([
            'roleid' => 3,
            'page' => "approval,dashboard,master role,master user,", // you can easily assign an actual integer array here
            // 'status_id' => 1
        ]);
        DB::table('access')->insert([
            'roleid' => 4,
            'page' =>"dashboard,master user,master role,master project,master departement,master team,master internal order,master asset,input project,cross check data,approval,reporting,verifikasi upload,re class"
        ]);



    }
}
