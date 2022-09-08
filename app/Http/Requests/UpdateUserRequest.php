<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:30',
            'email' => 'required|email:rfc',
            'password' => 'required|min:8|max:90|confirmed',
            'description' => 'required|min:30|max:750',
            'current_password' => 'required'
        ];
    }
}
