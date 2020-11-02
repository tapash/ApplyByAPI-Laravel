<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'job_title' => $this->faker->jobTitle,
            'is_remote' => $this->faker->boolean(),
            'job_location' => $this->faker->streetAddress,
            'job_type' => $this->faker->numberBetween(1, 3),
            'job_description' => $this->faker->realText(1000),
            'required_skills' => 'php,laravel,mysql'
        ];
    }
}
