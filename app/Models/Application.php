<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'resume',
        'phone',
        'comments'
    ];

    /**
     * Get the job that owns the application.
     */
    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    /**
     * Get the applications for the job.
     */
    public function applications()
    {
        return $this->hasMany('App\Models\Application');
    }

    /**
     * Get the job's owner.
     */
    public function jobOwner()
    {
        return $this->hasOneThrough('App\Models\User', 'App\Models\Job');
    }
}
