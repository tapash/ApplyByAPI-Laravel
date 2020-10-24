<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function a_user_can_login()
    {
        $user =  User::factory()->create();

        $response = $this->postJson('/api/auth/login', ['email' => $user->email, 'password' => 'password']);

        $response->assertStatus(200);
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_user_cannot_login_with_wrong_credentials()
    {
        $user =  User::factory()->create();

        $response = $this->postJson('/api/auth/login', ['email' => $user->email, 'password' => 'secret52']);

        $response->assertStatus(401);
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_user_can_login_and_get_access_token()
    {
        $user =  User::factory()->create();

        $response = $this->postJson('/api/auth/login', ['email' => $user->email, 'password' => 'password']);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_user_gets_login_failed_response_for_wrong_credentials()
    {
        $user =  User::factory()->create();

        $response = $this->postJson('/api/auth/login', ['email' => 'email@gmail.com', 'password' => 'password']);

        $response->assertStatus(401)
        ->assertJson([
            'success' => false,
            'message' => 'Incorrect email or password',
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_user_gets_email_and_password_fields_are_required()
    {
        $user =  User::factory()->create();

        $response = $this->postJson('/api/auth/login', []);

        $response->assertStatus(422)
        ->assertJson([
            'errors' => [
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_user_gets_email_and_password_fields_must_be_string_response()
    {
        $user =  User::factory()->create();

        $response = $this->postJson('/api/auth/login', ['email' => 34343, 'password' => 43534]);

        $response->assertStatus(422)
        ->assertJson([
            'errors' => [
                'email' => ['The email must be a string.'],
                'password' => ['The password must be a string.'],
            ]
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_user_can_log_out()
    {
        $user =  User::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson('/api/auth/logout');

        $response->assertStatus(200)->assertJson([
            'success' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_user_can_refresh_token()
    {
        $user =  User::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson('/api/auth/refresh');

        $response->assertStatus(200)->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_user_can_get_his_own_data()
    {
        $user =  User::factory()->create();

        $this->actingAs($user);

        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(200)->assertSee($user->name);
    }
}
