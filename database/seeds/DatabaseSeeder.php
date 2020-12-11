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
    	$this->call(CountriesTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(ModelHasRolesSeeder::class);
        $this->call(GeneralSettingSeeder::class);
        $this->call(EmailTemplatesSeeder::class);
    }
}
