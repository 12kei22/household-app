<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Task;

class UpdateTaskRequest extends FormRequest
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
        $myTaskStatusRule = Rule::in(array_keys(Task::TASK_STATUS_STRING));

        return [
            'spending_name' => 'required|max:100|string',
            'spending_amount' => ['required', $myTaskStatusRule],
            'due_date' => 'required|date',
        ];
    }

    public function attributes()
    {
       return [
        'spending_name' => '支出名',
        'spending_amount' => '金額',
        'due_date' => '支出日',
       ];

    }

    public function messages()
    {
        $statuses = implode('、', array_values(Task::TASK_STATUS_STRING));

        return [
            'task_status.in' => ':attributeには'.$statuses.'のいずれかを選択してください。',
        ];
    }
}
