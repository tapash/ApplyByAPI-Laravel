<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateJobTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_job_post()
    {
        $user =  User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson(route('jobs.store'), [
            'job_title' => 'Senior Software Developer',
            "is_remote" => 0,
            'job_location' => '2B Park Aveneu',
            'job_type' => 1,
            'job_description' => 'Hello dolly',
            'required_skills' => 'php, mysql, laravel'
        ]);

        $response->assertStatus(201);
    }
}
