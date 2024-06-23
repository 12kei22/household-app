<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Spending;

class UpdateSpendingRequest extends FormRequest
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
            'spending_name' => 'required|max:100|string',
            'spending_amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'spending_category' => 'required|integer|between:0,4',
        ];
    }

    public function attributes()
    {
       return [
        'spending_name' => '支出名',
        'spending_amount' => '金額',
        'due_date' => '支出日',
        'spending_category' => '支出カテゴリー',
       ];

    }

    public function messages()
    {
        $statuses = implode('、', array_values(Spending::SPENDING_STATUS_STRING));

        return [
            'spending_name.required' => ':attributeは必須項目です。',
            'spending_name.max' => ':attributeは:max文字以内で入力してください。',
            'due_date.required' => ':attributeは必須項目です。',
            'due_date.date' => ':attributeは有効な日付でなければなりません。',
            'due_date.after_or_equal' => ':attributeには今日以降の日付を指定してください。',
            'spending_amount.required' => ':attributeは必須項目です。',
            'spending_amount.numeric' => ':attributeは数値でなければなりません。',
            'spending_amount.min' => ':attributeは0以上でなければなりません。',
            'spending_category.required' => ':attributeは必須項目です。',
            'spending_category.integer' => ':attributeは整数でなければなりません。',
            'spending_category.between' => ':attributeは0から4の間でなければなりません。',
        ];
    }
}
