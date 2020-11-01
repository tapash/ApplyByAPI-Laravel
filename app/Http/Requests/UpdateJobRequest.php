<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'job_title' => ['required', 'string', 'min:5', 'max:100'],
            'is_remote' => ['required', 'boolean'],
            'job_location' => ['nullable', 'string', 'min:5', 'max:100'],
            'job_type' => ['required', 'integer', Rule::in([1, 2, 3])],
            'job_description' => ['required', 'string', 'min:10', 'max:1000'],
            'required_skills' => ['nullable', 'string', 'min:2', 'max:100']
        ];
    }
}
