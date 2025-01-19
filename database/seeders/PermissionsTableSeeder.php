<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'pet_create',
            ],
            [
                'id'    => 18,
                'title' => 'pet_edit',
            ],
            [
                'id'    => 19,
                'title' => 'pet_show',
            ],
            [
                'id'    => 20,
                'title' => 'pet_delete',
            ],
            [
                'id'    => 21,
                'title' => 'pet_access',
            ],
            [
                'id'    => 22,
                'title' => 'member_review_create',
            ],
            [
                'id'    => 23,
                'title' => 'member_review_edit',
            ],
            [
                'id'    => 24,
                'title' => 'member_review_show',
            ],
            [
                'id'    => 25,
                'title' => 'member_review_delete',
            ],
            [
                'id'    => 26,
                'title' => 'member_review_access',
            ],
            [
                'id'    => 27,
                'title' => 'pet_review_create',
            ],
            [
                'id'    => 28,
                'title' => 'pet_review_edit',
            ],
            [
                'id'    => 29,
                'title' => 'pet_review_show',
            ],
            [
                'id'    => 30,
                'title' => 'pet_review_delete',
            ],
            [
                'id'    => 31,
                'title' => 'pet_review_access',
            ],
            [
                'id'    => 32,
                'title' => 'payment_create',
            ],
            [
                'id'    => 33,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 34,
                'title' => 'payment_show',
            ],
            [
                'id'    => 35,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 36,
                'title' => 'payment_access',
            ],
            [
                'id'    => 37,
                'title' => 'credit_create',
            ],
            [
                'id'    => 38,
                'title' => 'credit_edit',
            ],
            [
                'id'    => 39,
                'title' => 'credit_show',
            ],
            [
                'id'    => 40,
                'title' => 'credit_delete',
            ],
            [
                'id'    => 41,
                'title' => 'credit_access',
            ],
            [
                'id'    => 42,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 43,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 44,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 45,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 46,
                'title' => 'new_request_create',
            ],
            [
                'id'    => 47,
                'title' => 'new_request_edit',
            ],
            [
                'id'    => 48,
                'title' => 'new_request_show',
            ],
            [
                'id'    => 49,
                'title' => 'new_request_delete',
            ],
            [
                'id'    => 50,
                'title' => 'new_request_access',
            ],
            [
                'id'    => 51,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
