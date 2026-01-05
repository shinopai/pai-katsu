<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'detail' => ['required', 'max:1000'],
            // タグは文字列
            'tags'   => ['nullable', 'string', 'max:255']
        ];
    }

    public function attributes(): array
    {
        return [
            'detail' => '朝活内容',
            'wakeup_time' => '起床時間',
            'tags' => 'タグ',
        ];
    }

    public function messages()
    {
        return [
            'after_or_equal' => ':attributeは:date以降の時刻を指定してください。',
            'before_or_equal' => ':attributeは:date以前の時刻を指定してください。'
        ];
    }
}
