<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendNotificationFormRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:191'],
            'body' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => '件名を必ず入力してください',
            'title.string' => '有効な文字形式で入力してください',
            'title.max' => '191文字以内で入力してください',
            'body.required' => '必ずメッセージを入力してください',
            'body.string' => '有効な文字形式で入力してください',
        ];
    }
}
