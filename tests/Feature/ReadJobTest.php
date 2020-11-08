<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadJobTest extends TestCase
{
    use RefreshDatabase;

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
}
