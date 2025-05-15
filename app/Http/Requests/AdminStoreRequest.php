<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'mobile' => 'required|string | min:10 | max:10 | unique:users,mobile',
            'password' => 'required|string | min:8 | max:26',
            'national_code' => 'required|string | min:10 | max:10 | unique:users,national_code',

        ];
    }
}
