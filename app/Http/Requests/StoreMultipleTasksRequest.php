<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMultipleTasksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // auth check kora optional, change as needed
    }

    public function rules(): array
    {
        return [
            'tasks' => ['required', 'array', 'min:1'], // must have at least 1 task
            'tasks.*.title' => ['required', 'string', 'max:255'], // each task must have a title
            'tasks.*.description' => ['nullable', 'string'],
            'tasks.*.due_date' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'tasks.required' => 'You must provide at least one task.',
            'tasks.array' => 'Tasks must be an array.',
            'tasks.*.title.required' => 'Each task must have a title.',
            'tasks.*.title.string' => 'Task title must be a string.',
            'tasks.*.title.max' => 'Task title must not exceed 255 characters.',
            'tasks.*.due_date.date' => 'Due date must be a valid date.',
        ];
    }
}
