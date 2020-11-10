<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\Token;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ApplyApplicationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function application_can_not_be_submitted_without_resume()
    {
        $token = Token::factory()->create();

        $response = $this->postJson(route('apply.job'), [
            'token' => $token->token,
            'name' => 'Some name',
            'email' => 'some@email.com',
            'resume' => 1,
            'phone' => '017214587454',
            'comments' => 'a nice way to prescreen candidate'
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function application_can_not_be_submitted_without_token()
    {
        $token = Token::factory()->create();

        $response = $this->postJson(route('apply.job'), [
            'token' => 1,
            'name' => 'Some name',
            'email' => 'some@email.com',
            'resume' => 1,
            'phone' => '017214587454',
            'comments' => 'a nice way to prescreen candidate'
        ]);

        $response->assertStatus(422);
    }
}
