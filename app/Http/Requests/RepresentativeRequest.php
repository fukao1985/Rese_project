<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepresentativeRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'shop_id' => ['required', 'integer', 'exists:shops,id'],
            'role' => ['required', 'string', 'max:191'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'ユーザーアカウントを必ず選択してください',
            'user_id.integer' => 'ユーザーアカウントを整数で選択してください',
            'user_id.exists' => '存在しないユーザーアカウントです',
            'shop_id.required' => '店舗名を必ず選択してください',
            'shop_id.integer' => '店舗名を整数で選択してください',
            'shop_id.exists' => '存在しない店舗名です',
            'role.required' => '役割を必ず選択してください',
            'role.string' => '役割を文字列で選択してください',
            'role.max' => '役割を191文字以下で選択してください',
        ];
    }
}
