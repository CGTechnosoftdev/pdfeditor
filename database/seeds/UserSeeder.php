    <?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $initialData=[
        	[
        		'first_name'=>'PDFWriter',
                'last_name'=>'Admin',
        		'email'=>'pdfw-admin@mailinator.com',
                'country_id'=>'226',
                'contact_number'=>'9999999999',
                'password'=>'$2y$10$g3.VUyzp/1FnmYfx0Clw/uj5iNfgPXzXosu33B7t6nLV7PY5pXYd2',//123456789
                'gender'=>'1',
                'created_by'=>'0',
        		'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
        	]
        ];
        DB::table('users')->insert($initialData);
    }
}
