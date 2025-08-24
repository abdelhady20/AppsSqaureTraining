<?php

namespace App\Http\Requests\Api\Front\Auth;

use App\Http\Requests\ApiRequest;
class LoginRequest extends ApiRequest
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
            'phone' => ['required','string','regex:/^((\+|00|)9665|0?5)([013-9][0-9]{7})$/'], // saudi arabia format
            'password' => 'required|min:8|max:150'
        ];
    }
}