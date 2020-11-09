<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetTokenTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_applicant_can_get_token_of_a_job_id()
    {
        $job = Job::factory()->create();

        $response = $this->postJson(route('generate.token'), ['job_id' => $job->id]);

        $response
            ->assertStatus(201)
            ->assertJsonCount(2);
    }

    /** @test */
    public function an_error_will_be_given_without_job_id()
    {
        $job = Job::factory()->create();

        $response = $this->postJson(route('generate.token'), []);

        $response
            ->assertStatus(422);
    }
}
