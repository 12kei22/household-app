<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'spending_name'  => 'required|max:100|string',
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function attributes()
    {
        return [
            'spending_name' => '支出名',
            'due_date' => '支出日',

        ];
    }

    public function messages()
    {
        return [
            'due_date.after_or_equal' => ':attributeには今日以降の日付を指定してください。',
        ];
    }
}
