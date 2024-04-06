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
            'comment' => ['required', 'string', 'max:400'],
            'review_image' =>['nullable', 'image', 'mimes:jpeg,png', 'max:2048']
        ];
    }

    public function messages(): array
    {
        return [
            'user_name.required' => 'ユーザー名を必ず入力してください',
            'user_name.string' => '有効な文字形式で入力してください',
            'user_name.max' => '191文字以内で入力してください',
            'ranting.required' => '必ず点数を選択してください',
            'ranting.integer' => '有効な整数を選択してください',
            'ranting.min' => '1以上の整数を選択してください',
            'ranting.max' => '5以下の整数を選択してください',
            'comment.required' => 'コメントを必ず入力してください',
            'comment.string' => '有効な文字形式で入力してください',
            'comment.max' => '400文字以内で入力してください',
            'review_image.mimes' => '有効な画像形式 (JPEG, PNG) を選択してください',
            'review_image.max' => 'ファイルサイズは最大2MBまでです',
        ];
    }
}
