<?php

use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_settings')->delete();
        $initialData=[
            [
                'site_title'=>config('app.name'),
                'date_format'=>'d-m-Y',
                'time_format'=>'h:i A',
                'paging_limit'=> '10',
                'currency'=> 'USD',
                
            ]
        ];
        DB::table('general_settings')->insert($initialData);
    }
}
