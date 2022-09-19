<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('ja_JP');

        \DB::table('users')->insert([
            [
                'name' => 'admin',
                'name_japanese' => '管理者？',
                'sex' => 1,
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456789'),
                'last_login' => now(),
                'remarks' => '',
                'is_stop' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'yamada',
                'name_japanese' => '山田太郎',
                'sex' => 1,
                'email' => 'yamada@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456789'),
                'last_login' => now(),
                'remarks' => '',
                'is_stop' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'tanaka',
                'name_japanese' => '田中花子',
                'sex' => 2,
                'email' => 'tanaka@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456789'),
                'last_login' => now(),
                'remarks' => '',
                'is_stop' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        $dummy_data_list = [];
        for($i = 0; $i < 50; $i++){
            $dummy_data_list[$i]['name'] = $faker->randomLetter() . $faker->randomLetter() . $faker->randomLetter() . $faker->randomLetter() . $faker->randomLetter();
            $dummy_data_list[$i]['name_japanese'] = $faker->name();
            $dummy_data_list[$i]['sex'] = $faker->numberBetween(1, 2);
            $dummy_data_list[$i]['email'] = $faker->unique()->safeEmail();
            $dummy_data_list[$i]['email_verified_at'] = $faker->dateTimeBetween('-1year', '-1day');
            $dummy_data_list[$i]['password'] = $faker->password();
            $dummy_data_list[$i]['last_login'] = $faker->dateTimeBetween('-1year', '-1day');
            $dummy_data_list[$i]['remarks'] = $faker->realText(200,2);
            $dummy_data_list[$i]['is_stop'] = $faker->numberBetween(0, 1);
            $dummy_data_list[$i]['created_at'] = $faker->dateTimeBetween('-1year', '-1day');
            $dummy_data_list[$i]['updated_at'] = $faker->dateTimeBetween('-1year', '-1day');
        }
        \DB::table('users')->insert($dummy_data_list);
    }
}
