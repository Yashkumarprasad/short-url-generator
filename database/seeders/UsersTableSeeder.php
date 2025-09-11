<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'superadmin@sembark.com'],
            [
                'name' => 'Super Admin',
                'user_type' => 'super_admin',
                'email' => 'superadmin@sembark.com',
                'password' => Hash::make('#sembark@superadmin1234')
            ]
        );
    }
}
