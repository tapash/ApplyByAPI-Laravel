<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'job_id' => $this->id,
            'company' => new CompanyResource($this->whenLoaded('user')),
            'remote_position' => $this->is_remote,
            'job_location' => $this->job_location,
            'job_type' => $this->job_type,
            'job_description' => $this->job_description,
            'required_skills' => $this->required_skills,
            'posted_at' => $this->created_at
        ];
    }
}
