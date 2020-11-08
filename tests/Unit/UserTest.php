<?php

namespace Tests\Unit;

use App\Models\Job;
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

    /** @test */
    public function a_user_can_add_a_job()
    {
        $user = User::factory()->create();

        $user->addJob([
            'job_title' => 'Senior Software Developer',
            "is_remote" => 0,
            'job_location' => '2B Park Aveneu',
            'job_type' => 1,
            'job_description' => 'Hello dolly',
            'required_skills' => 'php, mysql, laravel'
        ]);

        $this->assertCount(1, $user->jobs);
    }

    /** @test */
    function a_user_has_jobs()
    {
        $jobs =  Job::factory()->count(10)->create();

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $jobs
        );
    }
}
