<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['title_en' => 'admin', 'title_fa' => 'مدیر کل'],
            ['title_en' => 'staff', 'title_fa' => 'کارمند'],
            ['title_en' => 'user',  'title_fa' => 'کاربر عادی'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['title_en' => $role['title_en']],
                ['title_fa' => $role['title_fa'], 'status' => 'active']
            );
        }
    }
}
