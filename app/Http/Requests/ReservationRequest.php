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
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'number' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => '日付を選択してください',
            'date.date' => '有効な日付形式で入力してください',
            'time.required' => '時間を選択してください',
            'time.date_format' => '有効な時間形式で入力してください',
            'number.required' => '人数を選択してください',
            'number.integer' => '人数は整数で入力してください',
        ];
    }
}