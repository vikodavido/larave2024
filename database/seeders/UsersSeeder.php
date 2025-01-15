<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        User::factory()->admin()->create();
        User::factory(5)->create();
        User::factory()->moderator()->create();

    }
}
