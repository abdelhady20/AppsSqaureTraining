<?php

namespace App\Http\Requests\Api\Admin\Banners;

use Illuminate\Foundation\Http\FormRequest;

class BannerUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return false;
    }


    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'boolean',
        ];
    }
}
