<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
     * Get the user that owns the job.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
