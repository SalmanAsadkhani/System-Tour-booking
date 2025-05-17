<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['title_en' => 'manage_tours',     'title_fa' => 'مدیریت تورها',     'group' => 'tour'],
            ['title_en' => 'view_bookings',    'title_fa' => 'مشاهده رزروها',    'group' => 'booking'],
            ['title_en' => 'manage_users',     'title_fa' => 'مدیریت کاربران',   'group' => 'user'],
            ['title_en' => 'view_dashboard',   'title_fa' => 'مشاهده داشبورد',   'group' => 'admin'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['title_en' => $perm['title_en']],
                [
                    'title_fa' => $perm['title_fa'],
                    'group' => $perm['group'],
                    'status' => 'active'
                ]
            );
        }
    }
}

