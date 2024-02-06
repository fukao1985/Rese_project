<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopCreateRequest extends FormRequest
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
            'area_id' => ['required', 'integer', 'exists:areas,id'],
            'genre_id' => ['required', 'integer', 'exists:areas,id'],
            'comment' => ['required', 'string'],
            'url' => ['required', 'string'],
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2084'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '店名を必ず入力してください',
            'name.string' => '有効な文字形式で入力してください',
            'name.max' => '191文字以内で入力してください',
            'area_id.required' => '必ず選択してください',
            'area_id.integer' => '有効な整数で入力してください',
            'area_id.exists' => '登録されていないエリアです',
            'genre_id.required' => '必ず選択してください',
            'genre_id.integer' => '有効な整数で入力してください',
            'genre_id.exists' => '登録されていないジャンルです',
            'comment.required' => 'コメントを必ず入力してください',
            'comment.string' => '有効な文字形式で入力してください',
            'url.required' => 'urlを必ず入力してください',
            'url.string' => '有効な文字形式で入力してください',
            'file.required' => 'urlを必ず入力してください',
            'file.image' => '有効な画像形式で指定してください',
            'file.mimes' => '有効な拡張子で指定してください',
            'file.max' => 'サイズが大きすぎます',
        ];
    }
}
