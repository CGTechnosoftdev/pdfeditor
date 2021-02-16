<?php

use Illuminate\Database\Seeder;

class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timezones')->delete();

        $timezones = array(
            array('id' => '1', 'value' => 'Etc/GMT+12', 'caption' => '(GMT-12:00) International Date Line West', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:36:00', 'updated_at' => '2020-12-11 00:36:37', 'deleted_at' => '2020-12-11 00:36:37', 'status' => '1'),
            array('id' => '2', 'value' => 'Pacific/Midway', 'caption' => '(GMT-11:00) Midway Island, Samoa', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:36:00', 'updated_at' => '2020-12-11 00:36:37', 'deleted_at' => '2020-12-11 00:36:37', 'status' => '1'),
            array('id' => '3', 'value' => 'Pacific/Honolulu', 'caption' => '(GMT-10:00) Hawaii', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:37:00', 'updated_at' => '2020-12-11 00:36:38', 'deleted_at' => '2020-12-11 00:36:38', 'status' => '1'),
            array('id' => '4', 'value' => 'US/Alaska', 'caption' => '(GMT-09:00) Alaska', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:37:00', 'updated_at' => '2020-12-11 00:36:38', 'deleted_at' => '2020-12-11 00:36:38', 'status' => '1'),
            array('id' => '5', 'value' => 'America/Los_Angeles', 'caption' => '(GMT-08:00) Pacific Time (US &amp Canada)', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:38:00', 'updated_at' => '2020-12-11 00:36:39', 'deleted_at' => '2020-12-11 00:36:39', 'status' => '1'),
            array('id' => '6', 'value' => 'America/Tijuana', 'caption' => '(GMT-08:00) Tijuana, Baja California', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:38:00', 'updated_at' => '2020-12-11 00:36:39', 'deleted_at' => '2020-12-11 00:36:39', 'status' => '1'),
            array('id' => '7', 'value' => 'US/Arizona', 'caption' => '(GMT-07:00) Arizona', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:39:00', 'updated_at' => '2020-12-11 00:36:40', 'deleted_at' => '2020-12-11 00:36:40', 'status' => '1'),
            array('id' => '8', 'value' => 'America/Chihuahua', 'caption' => '(GMT-07:00) Chihuahua, La Paz, Mazatlan', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:39:00', 'updated_at' => '2020-12-11 00:36:40', 'deleted_at' => '2020-12-11 00:36:40', 'status' => '1'),
            array('id' => '9', 'value' => 'US/Mountain', 'caption' => '(GMT-07:00) Mountain Time (US &amp Canada)', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:40:00', 'updated_at' => '2020-12-11 00:36:41', 'deleted_at' => '2020-12-11 00:36:41', 'status' => '1'),
            array('id' => '10', 'value' => 'America/Managua', 'caption' => '(GMT-06:00) Central America', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:40:00', 'updated_at' => '2020-12-11 00:36:41', 'deleted_at' => '2020-12-11 00:36:41', 'status' => '1'),
            array('id' => '11', 'value' => 'US/Central', 'caption' => '(GMT-06:00) Central Time (US &amp Canada)', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:41:00', 'updated_at' => '2020-12-11 00:36:42', 'deleted_at' => '2020-12-11 00:36:42', 'status' => '1'),
            array('id' => '12', 'value' => 'America/Mexico_City', 'caption' => '(GMT-06:00) Guadalajara, Mexico City, Monterrey', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:41:00', 'updated_at' => '2020-12-11 00:36:42', 'deleted_at' => '2020-12-11 00:36:42', 'status' => '1'),
            array('id' => '13', 'value' => 'Canada/Saskatchewan', 'caption' => '(GMT-06:00) Saskatchewan', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:42:00', 'updated_at' => '2020-12-11 00:36:43', 'deleted_at' => '2020-12-11 00:36:43', 'status' => '1'),
            array('id' => '14', 'value' => 'America/Bogota', 'caption' => '(GMT-05:00) Bogota, Lima, Quito, Rio Branco', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:42:00', 'updated_at' => '2020-12-11 00:36:43', 'deleted_at' => '2020-12-11 00:36:43', 'status' => '1'),
            array('id' => '15', 'value' => 'US/Eastern', 'caption' => '(GMT-05:00) Eastern Time (US &amp Canada)', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:43:00', 'updated_at' => '2020-12-11 00:36:44', 'deleted_at' => '2020-12-11 00:36:44', 'status' => '1'),
            array('id' => '16', 'value' => 'US/East-Indiana', 'caption' => '(GMT-05:00) Indiana (East)', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:43:00', 'updated_at' => '2020-12-11 00:36:44', 'deleted_at' => '2020-12-11 00:36:44', 'status' => '1'),
            array('id' => '17', 'value' => 'Canada/Atlantic', 'caption' => '(GMT-04:00) Atlantic Time (Canada)', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:44:00', 'updated_at' => '2020-12-11 00:36:45', 'deleted_at' => '2020-12-11 00:36:45', 'status' => '1'),
            array('id' => '18', 'value' => 'America/Caracas', 'caption' => '(GMT-04:00) Caracas, La Paz', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:44:00', 'updated_at' => '2020-12-11 00:36:45', 'deleted_at' => '2020-12-11 00:36:45', 'status' => '1'),
            array('id' => '19', 'value' => 'America/Manaus', 'caption' => '(GMT-04:00) Manaus', 'created_by' => '1', 'updated_by' => '1', 'created_at' => '2011-12-20 00:45:00', 'updated_at' => '2020-12-11 00:36:46', 'deleted_at' => '2020-12-11 00:36:46', 'status' => '1')
        );

        DB::table('timezones')->insert($timezones);
    }
}
