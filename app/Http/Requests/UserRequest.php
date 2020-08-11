<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
					'names' => 'required|string|min:3|max:100',
					'last_names' => 'required|string|min:3|max:100',
					'password' => 'required|string|min:8|max:100|confirmed',
					'email' => 'required|email|min:6|max:100|unique:users',
					'rol' => 'string|in:ADMIN,USER'
        ];
    }
}
