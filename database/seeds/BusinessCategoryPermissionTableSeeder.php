<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class BusinessCategoryPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'business-category-list',
 
            'business-category-create',
 
            'business-category-edit',
 
            'business-category-delete',
 

 
         ];
 
    
 
         foreach ($permissions as $permission) {
 
              Permission::create(['name' => $permission]);
 
         }
    }
}
