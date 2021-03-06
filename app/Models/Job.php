<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_title',
        'is_remote',
        'job_location',
        'job_type',
        'job_description',
        'required_skills'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user'];

    /**
     * Get the user that owns the job.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the tokens for the job.
     */
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    /**
     * Get the applications for the job.
     */
    public function applications()
    {
        return $this->hasMany('App\Models\Application');
    }

    /**
     * generatate a token for the job.
     *
     * @return Model
     */
    public function generateToken()
    {
        $job = $this->tokens()->create([
            'token' => Str::random(10),
            'expired_at' => now()->addMinutes(5)
        ]);

        return $job;
    }

    /**
     * Add a application of the job.
     *
     * @param  array $application
     * @return Model
     */
    public function applyJob($application)
    {
        return $this
            ->applications()
            ->create($application);
    }
}
