<?php

namespace App\Http\Controllers\Tasks;

use App\Enum\TaskStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\StoreTasksRequest;
use App\Models\User;
use App\Modules\Tasks\Repositories\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TasksController extends Controller
{
    public function __construct(protected Tasks $tasks) {}

    public function index(Request $request, int $wsId)
    {
        $tasks = $this->tasks->withWorkspaceOfId($wsId)->allBySigneeId(Auth::id());
        $tasks = [
            ...$tasks->toArray(),
            'total_pending' => $this->tasks->countPendingBySigneeId(Auth::id()),
        ];
        $colaborators = User::limit(10)->get();

        return Inertia::render('tasks/index', compact('tasks', 'colaborators', 'wsId'));
    }

    public function store(StoreTasksRequest $request, int $wsId)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        $this->tasks->withWorkspaceOfId($wsId)->create($data);

        return redirect()->route('tasks.index', ['wsId' => session('wsId')])->with('success', 'Task created successfully.');
    }

    public function show(int $wsId, int $id)
    {
        $task = $this->tasks->withWorkspaceOfId($wsId)->findOrFail($id);

        return $task;

        return Inertia::render('tasks.show', compact('task'));
    }

    public function edit(int $wsId, int $id)
    {
        $task = $this->tasks->withWorkspaceOfId($wsId)->findOrFail($id);

        return Inertia::render('tasks/edit', compact('task'));
    }

    public function update(StoreTasksRequest $request, int $wsId, int $id)
    {
        $data = $request->validated();
        $data['id'] = $id; // Include the ID for the update

        $this->tasks->withWorkspaceOfId($wsId)->update($data);


        return to_route('tasks.index', ['wsId' => session('wsId')])->with('success', 'Task updated successfully.');
    }

    public function destroy(int $wsId, int $id)
    {
        $this->tasks->withWorkspaceOfId($wsId)->destroy($id);


        return to_route('tasks.index', ['wsId' => session('wsId')])->with('success', 'Task deleted successfully.');
    }

    public function updateStatus(Request $request, int $wsId, int $id)
    {
        $this->tasks->withWorkspaceOfId($wsId)->updateStatus([
            'id' => $id,
            'status' => $request->input('status'),
        ]);

        return to_route('tasks.index', ['wsId' => session('wsId')])->with('success', 'Task updated successfully.');
    }
}
