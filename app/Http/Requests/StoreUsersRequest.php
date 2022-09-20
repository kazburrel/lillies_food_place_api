<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUsersRequest extends FormRequest
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
            'name' => 'required',
            'email'=> ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['confirmed',Password::min(8)->letters()->mixedCase()->symbols()->numbers()],
            'password_confirmation' => 'required',
            'user_avatar' => 'required'
        ];
    }
}
