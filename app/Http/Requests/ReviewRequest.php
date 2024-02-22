<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'user_name' => ['required', 'string', 'max:191'],
            'ranting' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_name.required' => 'ユーザー名を必ず入力してください',
            'user_name.string' => '有効な文字形式で入力してください',
            'user_name.max' => '191文字以内で入力してください',
            'ranting.required' => '必ず選択してください',
            'ranting.integer' => '有効な整数を選択してください',
            'ranting.min' => '1以上の整数を選択してください',
            'ranting.max' => '5以下の整数を選択してください',
            'comment.required' => 'コメントを必ず入力してください',
            'comment.string' => '有効な文字形式で入力してください',
        ];
    }
}
