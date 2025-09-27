<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMultipleTasksRequest;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Throwable;

class TaskController extends Controller
{
    /**
     * Store multiple tasks
     */
    public function store(StoreMultipleTasksRequest $request)
    {
        $tasks = $request->input('tasks', []);
        $now = now();

        $payload = array_map(function($t) use ($now) {
            return [
                'title' => $t['title'],
                'description' => $t['description'] ?? null,
                'due_date' => $t['due_date'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $tasks);

        $chunkSize = 500; 

        try {
            DB::transaction(function() use ($payload, $chunkSize) {
                if(count($payload) <= $chunkSize) {
                    Task::insert($payload);
                } else {
                    foreach(array_chunk($payload, $chunkSize) as $chunk) {
                        Task::insert($chunk);
                    }
                }
            }, 5);  

            return response()->json([
                'status' => 'success',
                'message' => count($payload).' tasks created successfully'
            ], 201);

        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Server error while inserting tasks.',
                'error' => $e->getMessage()  
            ], 500);
        }
    }
}
