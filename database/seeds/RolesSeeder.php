<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $initialData=[
        	[
        		'name'=>'Admin',
                'guard_name'=>'web',
                'is_deletable'=>'0',
                'created_by'=>'0',
        		'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
        	],
        	[
        		'name'=>'User',
                'guard_name'=>'web',
                'is_deletable'=>'0',
                'created_by'=>'0',
        		'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
        	]
        ];
        DB::table('roles')->insert($initialData);
    }
}
