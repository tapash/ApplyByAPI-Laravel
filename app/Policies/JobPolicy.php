<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Job  $job
     * @return mixed
     */
    public function view(User $user, Job $job)
    {
        return $user->id === $job->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Job  $job
     * @return mixed
     */
    public function update(User $user, Job $job)
    {
        return $user->id === $job->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Job  $job
     * @return mixed
     */
    public function delete(User $user, Job $job)
    {
        return $user->id === $job->user_id;
    }
}
