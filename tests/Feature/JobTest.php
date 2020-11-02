<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobTest extends TestCase
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

    /** @test */
    public function a_user_can_list_all_jobs()
    {
        $user = User::factory()
            ->has(Job::factory()->count(10))
            ->create();

        $this->actingAs($user);

        $response = $this->getJson(route('jobs.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount(10)
            ->assertJson($user->jobs->toArray());
    }

    /** @test */
    public function a_user_can_list_a_single_job()
    {
        $job = Job::factory()->create();

        $this->actingAs($job->user);

        $response = $this->getJson(route('jobs.show', $job->id));

        $response
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_update_job()
    {
        $job = Job::factory()->create();

        $this->actingAs($job->user);

        $response = $this->putJson(route('jobs.update', $job->id), [
            'title' => "Data Engineer"
        ]);

        $response
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_delete_job()
    {
        $job = Job::factory()->create();

        $this->actingAs($job->user);

        $response = $this->deleteJson(route('jobs.destroy', $job->id));

        $response
            ->assertStatus(200);
    }
}
