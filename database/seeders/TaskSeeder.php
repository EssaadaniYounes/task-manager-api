<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\TaskFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Get all users and foreach user create 5 tasks using the task factory
        User::all()->each(function ($user) {
            $user->tasks()->createMany(TaskFactory::new()->count(5)->make()->toArray());

        });
    }
}
