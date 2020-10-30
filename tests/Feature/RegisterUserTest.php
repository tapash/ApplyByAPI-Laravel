<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function anyone_can_register()
    {
        $response = $this->postJson('/api/auth/register', [
            'email' => 'test@email.com',
            'password' => 'password',
            "password_confirmation" => "password",
            'name' => 'Test name',
            'company_name' => 'Test Company',
            'company_logo' => '',
            'company_website' => 'https://test.com',
            'company_description' => 'This is company description',
            'company_address' => 'South lane, East wood'
        ]);

        $response->assertStatus(201);
    }


    /**
     * @test
     *
     * @return void
     */
    public function anyone_can_register_without_optional_fields()
    {
        $response = $this->postJson('/api/auth/register', [
            'email' => 'test@email.com',
            'password' => 'password',
            "password_confirmation" => "password",
            'name' => 'Test name',
            'company_name' => 'Test Company'
        ]);

        $response->assertStatus(201);
    }

    /**
     * @test
     *
     * @return void
     */
    public function anyone_cannot_register_without_required_fields()
    {
        $response = $this->postJson('/api/auth/register', [

        ]);

        $response->assertStatus(422);
    }

    /**
     * @test
     *
     * @return void
     */
    public function get_error_if_the_email_is_wrong()
    {
        $response = $this->postJson('/api/auth/register', [
            'email' => 'test',
            'password' => 'password',
            "password_confirmation" => "password",
            'name' => 'Test name',
            'company_name' => 'Test Company',
            'company_logo' => '',
            'company_website' => 'https://test.com',
            'company_description' => 'This is company description',
            'company_address' => 'South lane, East wood'
        ]);

        $response->assertStatus(422);
    }

    /**
     * @test
     *
     * @return void
     */
    public function get_error_if_password_does_not_match()
    {
        $response = $this->postJson('/api/auth/register', [
            'email' => 'test@gmail.com',
            'password' => 'password',
            "password_confirmation" => "password4",
            'name' => 'Test name',
            'company_name' => 'Test Company',
            'company_logo' => '',
            'company_website' => 'https://test.com',
            'company_description' => 'This is company description',
            'company_address' => 'South lane, East wood'
        ]);

        $response->assertStatus(422);
    }
}
