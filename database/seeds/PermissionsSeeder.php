<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        $initialData=[
			[
        		'name'=>'role-list',
                'guard_name'=>'web',
        		'module'=>'Roles and Rights',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
        	],
        	[
        		'name'=>'role-create',
                'guard_name'=>'web',
        		'module'=>'Roles and Rights',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
        	],
			[
        		'name'=>'role-edit',
                'guard_name'=>'web',
        		'module'=>'Roles and Rights',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
        	],
			[
        		'name'=>'role-delete',
                'guard_name'=>'web',
        		'module'=>'Roles and Rights',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
        	],
            [
                'name'=>'sub-admin-list',
                'guard_name'=>'web',
                'module'=>'Sub Admin',
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
                'name'=>'sub-admin-create',
                'guard_name'=>'web',
                'module'=>'Sub Admin',
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
                'name'=>'sub-admin-edit',
                'guard_name'=>'web',
                'module'=>'Sub Admin',
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
                'name'=>'sub-admin-delete',
                'guard_name'=>'web',
                'module'=>'Sub Admin',
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
                'name'=>'business-category-list',
                'guard_name'=>'web',
                'module'=>'Business Category',
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
                'name'=>'business-category-create',
                'guard_name'=>'web',
                'module'=>'Business Category',
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
                'name'=>'business-category-edit',
                'guard_name'=>'web',
                'module'=>'Business Category',
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
                'name'=>'business-category-delete',
                'guard_name'=>'web',
                'module'=>'Business Category',
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
            ],           
            [
        		'name'=>'top-100-form-list',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-create',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-edit',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-delete',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-version-list',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-version-create',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-version-edit',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-version-delete',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-faq-list',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-faq-create',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-faq-edit',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],
            [
        		'name'=>'top-100-form-faq-delete',
                'guard_name'=>'web',
        		'module'=>'Top 100 Form',
        		'created_at'=>date("Y-m-d H:i:s"),
        		'updated_at'=>date("Y-m-d H:i:s"),
            ],


        ];
        DB::table('permissions')->insert($initialData);
    }
}
