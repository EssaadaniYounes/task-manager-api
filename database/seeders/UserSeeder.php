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
        User::create([
            'name' => 'Essaadani Younes',
            'email' => 'essaadani.yo@gmail.com',
            'password' =>  bcrypt('tasks_password')
        ]);

        User::create([
            'name' => 'Mourabit Anas',
            'email' => 'mourabit.a@gmail.com',
            'password' =>  bcrypt('password')
        ]);
    }
}
