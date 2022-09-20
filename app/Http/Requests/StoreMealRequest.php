<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
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
            // 'vendor_id' => 'required',
            'meal_name' => 'required',
            'meal_details' => 'required',
            'meal_price' => 'required',
            'meal_avatar' => 'required'
        ];
    }
}
