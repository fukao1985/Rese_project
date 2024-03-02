<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:191'],
            'area_id' => ['nullable', 'integer', 'exists:areas,id'],
            'genre_id' => ['nullable', 'integer', 'exists:genres,id'],
            'comment' => ['nullable', 'string'],
            'url' => ['nullable', 'string'],
            'file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2084'],
        ];
    }
}
