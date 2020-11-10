<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Token;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Token::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'job_id' => Job::factory(),
            'token' => Str::random(10),
            'expired_at' => now()->addMinutes(5)
        ];
    }
}
