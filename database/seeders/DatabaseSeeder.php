<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $groupId = DB::table('groups')->insertGetId([
            'name' => 'Administrator',
            'user_id' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:')
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        if ($groupId > 0) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'Nguyễn Xuân Thủy',
                'email'  => 'xuanthuy01012001@gmail.com',
                'password' => Hash::make(123456),
                'group_id' => $groupId,
                'user_id' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:')
            ]);
            if ($userId > 0) {
                for ($i = 1; $i <= 5; $i++) {
                    DB::table('posts')->insert([
                        'title' => 'What is Lorem Ipsum?',
                        'content' =>  'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',

                        'user_id' => $userId,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:')
                    ]);
                }
            }
        }
    }
}