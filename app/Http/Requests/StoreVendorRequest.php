<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as RulesPassword;

class StoreVendorRequest extends FormRequest
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
            // 'vendor_id'=> 'required',
            'name' => 'required',
            'company_name' => 'required',
            'email' => ['required', 'email', Rule::unique('vendors', 'email'), 'unique:users,email'],
            'password' => ['confirmed',RulesPassword::min(8)->letters()->mixedCase()->symbols()->numbers()],
            'password_confirmation' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'vendor_avatar' => 'required'
        ];
    }
}
