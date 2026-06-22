<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin StyleByU',
            'email' => 'admin@stylebyu.com',
            'password' => 'password123',
            'role' => 'admin'
        ]);
    }
}