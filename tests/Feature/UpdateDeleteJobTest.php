<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateDeleteJobTest extends TestCase
{
    use RefreshDatabase;

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

    /** @test */
    function unauthorized_users_may_not_update_jobs()
    {
        $job = Job::factory()->create();

        $this->putJson(route('jobs.update', $job->id), [])->assertStatus(403);
    }
}
