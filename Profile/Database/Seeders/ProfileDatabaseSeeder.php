<?php

namespace Modules\Profile\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ProfileDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
//        $sql = file_get_contents(base_path() . '/Modules/Profile/Database/Seeders/countries.sql');
//        DB::statement($sql);

        DB::table('profiles_countries_phone_code')->delete();
        DB::table('profiles_countries_phone_code')->insert([
            ['country_id' => 1 , 'phone_code' => '7', 'iso_country_code' => 'RU'],
            ['country_id' => 2, 'phone_code' => '380', 'iso_country_code' => 'UA'],
            ['country_id' => 22, 'phone_code' => '375', 'iso_country_code' =>  'BY'],
        ]);

        DB::table('profiles_type_privacy_users')->delete();
        DB::table('profiles_type_privacy_users')->insert([
            'id' => 1,
            'type_privacy' => 'basic_profile_information',
            'description_type' => 'View all basic data and statistics of the current profile'
        ]);

        DB::table('profiles_status_type_privacy')->delete();
        DB::table('profiles_status_type_privacy')->insert([[
            'id' => 1,
            'type_privacy_id' =>  1,
            'status_privacy' => 'all_users',
            'description_status' => 'All users can view profile'],
            ['id' => 2,
             'type_privacy_id' =>  1,
             'status_privacy' => 'only_friend',
             'description_status' => 'Only friends can view profile'],
            ['id' => 3,
             'type_privacy_id' => 1,
             'status_privacy' => 'only_me',
             'description_status' => 'Only user can view his page']]);

        DB::table('profile_types_integration')->delete();
        DB::table('profile_types_integration')->insert([
            ['id' => 1, 'type' => 'vkontakte', 'description' => ''],
            ['id' => 2, 'type' => 'twitch', 'description' => ''],
            ['id' => 3, 'type' => 'youtube', 'description' => ''],
            ['id' => 4, 'type' => 'twitter', 'description' => ''],
            ['id' => 5, 'type' => 'facebook', 'description' => ''],
            ['id' => 6, 'type' => 'steam', 'description' => ''],
        ]);
    }
}