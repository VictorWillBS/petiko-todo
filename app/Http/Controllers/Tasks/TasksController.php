<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\StoreTasksRequest;
use App\Modules\Tasks\Repositories\Tasks;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TasksController extends Controller
{
    public function __construct(protected Tasks $tasks) {}

    public function index()
    {
        $tasks = $this->tasks->allBySigneeId(Auth::id());

        // return Inertia::render('tasks.index', compact('tasks'));
        return $tasks;
    }

    public function store(StoreTasksRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        $task = $this->tasks->create($data);

        // return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        return $task;
    }

    public function show(int $id)
    {
        $task = $this->tasks->findOrFail($id);

        return $task;

        return Inertia::render('tasks.show', compact('task'));
    }

    public function edit(array $data)
    {
        $task = $this->tasks->update($data);

        return $task;

        return Inertia::render('tasks.edit', compact('task'));
    }
    public function update(StoreTasksRequest $request, int $id)
    {
        $data = $request->validated();
        $data['id'] = $id; // Include the ID for the update

        $task = $this->tasks->update($data);

        return $task;

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    public function destroy(int $id)
    {
        $task = $this->tasks->findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
