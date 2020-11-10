<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            'applicant_name' => $this->name,
            'applicant_email' => $this->email,
            'applicant_resume' => $this->resume,
            'applicant_phone' => $this->phone,
            'comments' => $this->comments,
            'submitted_time' => $this->created_at
        ];
    }
}
