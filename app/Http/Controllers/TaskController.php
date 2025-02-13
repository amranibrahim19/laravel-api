<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        return response()->json([
            'tasks' => $tasks
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user =  auth('sanctum')->user();
        $task = Task::create([
            'user_id' => auth()->id() ?? 1,
            'title' => $request->title,
            'content' => $request->content,
            'status' => false
        ]);

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task = Task::find($task->id);

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task, Request $request) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        logger($request->all());

        $task = Task::find($id)
            ->update([
                'isDone' => $request->status
            ]);

        return response()->json([
            'message' => 'Task updated successfully',
            // 'task' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task = Task::find($task->id)
            ->delete();

        return response()->json([
            'message' => 'Task deleted successfully',
            'task' => $task
        ]);
    }
}
