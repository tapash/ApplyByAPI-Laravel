<?php

namespace App\Traits;

trait Userable 
{
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get the jobs for the user.
     */
    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }

    /**
     * Add a job of the user.
     *
     * @param  array $job
     * @return Model
     */
    public function addJob($job)
    {
        $job = $this->jobs()->create($job);

        return $job;
    }

    /**
     * Fetch the last published job for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastJob()
    {
        return $this->hasOne(Job::class)->latest();
    }

    /**
     * Get all of the applications for the user.
     */
    public function applications()
    {
        return $this->hasManyThrough('App\Models\Application', 'App\Models\Job');
    }
}