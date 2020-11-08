<?php

namespace Tests\Unit;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function store_job()
    {
        $jobs =  Job::factory()->count(10)->create();

        $this->assertDatabaseCount('jobs', 10);
    }

    /** @test */
    public function a_user_can_fetch_their_most_recent_job()
    {
        $user = User::factory()->create();

        $job = Job::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertEquals($job->id, $user->lastJob->id);
    }

    /** @test */
    function a_job_has_a_user()
    {
        $job = Job::factory()->create();

        $this->assertInstanceOf('App\Models\User', $job->user);
    }
}
