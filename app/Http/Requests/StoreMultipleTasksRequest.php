<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMultipleTasksRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tasks' => 'required|array|min:1',
            'tasks.*.title' => 'required|string|max:255',
            'tasks.*.description' => 'required|string|max:1000',
            'tasks.*.due_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'tasks.*.title.required' => 'Each task must have a title.',
            'tasks.*.title.max' => 'Title may not exceed 255 characters.',
            'tasks.*.description.required' => 'Each task must have a description.',
            'tasks.*.description.max' => 'Description may not exceed 1000 characters.',
            'tasks.*.due_date.required' => 'Each task must have a due date.',
            'tasks.*.due_date.date' => 'Due date must be a valid date.',
            'tasks.*.due_date.after_or_equal' => 'Due date cannot be in the past.',
        ];
    }
}
