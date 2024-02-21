<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => ['required', 'date', 'after_inclusive:today'],
            'time' => ['required', 'date_format:H:i', 'after_inclusive:17:00', 'before_inclusive:22:00'],
            'number' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => '日付を選択してください',
            'date.date' => '有効な日付形式で入力してください',
            'date.after' => '過去の日付は選択できません',
            'time.required' => '時間を選択してください',
            'time.date_format' => '有効な時間形式で入力してください',
            'time.after' => '17:00以降の時間を選択してください',
            'time.before' => '22:00までの時間を選択してください',
            'number.required' => '人数を選択してください',
            'number.min' => '1人以上で選択してください',
            'number.max' => '10人以下で選択してください',
            'number.integer' => '人数は整数で入力してください',
        ];
    }
}
