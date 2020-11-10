<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'id' => $this->id,
            'company_name' => $this->company_name,
            'company_logo' => $this->company_logo,
            'company_website' => $this->company_website,
            'company_description' => $this->company_description,
            'company_address' => $this->company_address
        ];
    }
}
