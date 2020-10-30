<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function store_users()
    {
        $user =  User::factory()->count(10)->create();

        $this->assertDatabaseCount('users', 10);
    }

    /**
     * @test
     *
     * @return void
     */
    public function database_has_email()
    {
        $user =  User::factory()->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);
    }
}
