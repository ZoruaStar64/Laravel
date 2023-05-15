<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'TestUser',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
           'name' => 'TestUser2',
           'email' => 'test2@example.com',
       ]);
    }
}
