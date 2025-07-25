<?php

declare(strict_types=1);

namespace App\Modules\Tasks\Repositories;

use App\Enum\TaskStatus;
use App\Models\Task;
use App\Models\Workspace;
use App\Traits\Workspaced;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Tasks
{
    use Workspaced;

    public function __construct(private Task $task)
    {
        if (!$this->workspace) {
            $this->workspace = session('wsId') ? Workspace::findOrFail(session('wsId')) : null;
        }
    }

    public function create(array $data): Task
    {
        $task = $this->task->newInstance();
        $task->fill([...$data, 'workspace_id' => $this->workspace->id]);
        $task->created_by = Auth::id();
        $task->save();

        $task->syncSignees($data['signees']);

        return $task;
    }

    public function all(): Collection
    {
        return $this->task->newQuery()->fromWorkspace($this->workspace->id)->all();
    }

    public function findOrFail(int $id): Task
    {
        return $this->task->newQuery()->where('workspace_id', $this->workspace->id)->find($id);
    }

    public function firstOrFailBySigneeId(int $signeeId): Task
    {
        return $this->task->newQuery()
            ->fromWorkspace($this->workspace->id)
            ->where('signee_id', $signeeId)
            ->firstOrFail();
    }

    public function allBySigneeId(int $signeeId): LengthAwarePaginator
    {
        $completed = TaskStatus::COMPLETED; // ajuste se for enum/string

        return $this->task->newQuery()
            ->fromWorkspace($this->workspace->id)
            ->whereHas('signees', fn(Builder $q) => $q->where('user_id', $signeeId))
            ->with('signees')
            ->orderByRaw('CASE WHEN status = ? THEN 1 ELSE 0 END', [$completed])
            ->orderByDesc('created_at')
            ->paginate(5)
            ->withQueryString();
    }

    public function countPendingBySigneeId(int $signeeId): int
    {
        return $this->task->newQuery()
            ->fromWorkspace($this->workspace->id)
            ->whereStatus(TaskStatus::PENDING)
            ->whereHas('signees', fn(Builder $q) => $q->where('user_id', $signeeId))
            ->with('signees')
            ->count();
    }

    public function update(array $data): Task
    {
        $task = $this->findOrFail($data['id']);
        $task->fill(Arr::except($data, ['created_by', 'id']));
        $task->save();

        if (isset($data['signee_id'])) {
            $task->signees()->sync($data['signee_id']);
        }

        return $task;
    }

    public function destroy(int $id)
    {
        $task = $this->findOrFail($id);
        $task->delete();

        return $task;
    }

    public function updateStatus(array $data): Task
    {
        $task = $this->findOrFail($data['id']);
        $task->status = $data['status'];
        $task->save();

        return $task;
    }
}
