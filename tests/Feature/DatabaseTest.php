<?php

namespace Tests\Feature;

use Database\Seeders\CategorySeeder;
use Database\Seeders\TodoSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\TagSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_users_can_be_created()
    {
        $this->seed(UserSeeder::class);

        $this->assertDatabaseCount('users', 2);
    }

    public function test_if_categories_can_be_created()
    {
        $this->seed(CategorySeeder::class);

        $this->assertDatabaseCount('Categories', 4);
    }

    public function test_if_tags_can_be_created()
    {
        $this->seed(TagSeeder::class);

        $this->assertDatabaseCount('Tags', 4);
    }

    public function test_if_todos_can_be_created()
    {
        $this->seed([
            CategorySeeder::class,
            TodoSeeder::class
        ]);

        $this->assertDatabaseCount('Todos', 25);
    }
}
