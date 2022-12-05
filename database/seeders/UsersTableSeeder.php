<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<15;$i++){
            $input = ['user','admin','bank','cabang','pusat'];
            $rand_keys = array_rand($input);

            $data[$i]=[
                'name'=>fake()->name,
                'email'=>fake()->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => $input[$rand_keys],
            ];
        }
        DB::table('users')->insert($data);
    }
}
