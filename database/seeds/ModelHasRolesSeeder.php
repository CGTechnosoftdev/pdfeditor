<?php

use Illuminate\Database\Seeder;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('model_has_roles')->delete();
         $initialData=[
        	[
        		'role_id'=>'1',
        		'model_type'=>'App\Models\User',
        		'model_id'=>'1',
        	]
        ];
        DB::table('model_has_roles')->insert($initialData);
    }
}
