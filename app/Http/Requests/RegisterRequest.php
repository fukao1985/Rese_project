<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'string', 'max:191', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:8', 'max:191'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'ユーザー名を必ず入力してください',
            'name.string' => '有効な文字形式で入力してください',
            'name.max' => '191文字以内で入力してください',
            'email.required' => 'メールアドレスを必ず入力してください',
            'email.email' => '有効なメールアドレス形式で入力してください',
            'email.unique' => '既に登録されているメールアドレスです',
            'email.string' => '有効な文字形式で入力してください',
            'email.max' => '191文字以内で入力してください',
            'password.required' => 'パスワードを必ず入力してください',
            'password.string' => '有効な文字形式で入力してください',
            'password.min' => '8文字以上で入力してください',
            'password.max' => '191文字以内で入力してください',
        ]
    }
}
