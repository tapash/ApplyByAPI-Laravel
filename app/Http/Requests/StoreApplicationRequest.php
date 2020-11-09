<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => ['required'],
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'resume' => ['required', 'file', 'mimes:pdf'],
            'phone' => ['required', 'string', 'max:20', 'min:5'],
            'comments' => ['nullable', 'string', 'max:100', 'min:5'],
        ];
    }
}
