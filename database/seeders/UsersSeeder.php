<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;//--Dush 2022.05.02 --//
use Illuminate\Support\Facades\Hash;//--Dush 2022.05.02 --//

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'PMS',
            'last_name' => 'Admin',
            'username' => 'pms_admin',
            'password' => md5('123456'),
            'confirmation_code' => '',
            'user_type' => 'ADMIN',
            'status' => '0',
            'added_by' => '1'

        ]);
    }
}
