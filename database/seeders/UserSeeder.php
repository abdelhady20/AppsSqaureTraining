<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        $data['email'] = 'admin@outlet.com';
        $data['name'] = 'Super Admin';
        $data['phone'] = '123456789';
        $data['password'] = bcrypt('123456');
        User::firstOrCreate(['email' => $data['email']], $data);
    }
}