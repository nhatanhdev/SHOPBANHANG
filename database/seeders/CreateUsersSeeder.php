<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Nhật Anh',
            'email' => 'admin',
            'password' => bcrypt('123456'),
        ]);

        // Additional seed data can be added here
    }
}
