<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2025-01-18 23:30:24',
                'first_name'         => '',
                'last_name'          => '',
                'street'             => '',
                'city'               => '',
                'zip_code'           => '',
                'verification_token' => '',
                'two_factor_code'    => '',
            ],
        ];

        User::insert($users);
    }
}
