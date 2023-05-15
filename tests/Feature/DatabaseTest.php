<?php

namespace Tests\Feature;

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
    }

    public function test_if_categories_can_be_created()
    {
        $this->seed(CategorySeeder::class);
    }

    public function test_if_tags_can_be_created()
    {
        $this->seed(TagSeeder::class);
    }

    public function test_if_todos_can_be_created()
    {
        $this->seed(TodoSeeder::class);
    }
}
