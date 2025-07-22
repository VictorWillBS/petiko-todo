<?php

declare(strict_types=1);

namespace App\Modules\Tasks\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class Tasks
{
    public function __construct(private Task $task) {}

    public function create(array $data): Task
    {
        $task = $this->task->newInstance();
        $task->fill($data);
        $task->save();

        return $task;
    }

    public function all(): Collection
    {
        return $this->task->all();
    }

    public function findOrFail(int $id): Task
    {
        return $this->task->findOrFail($id);
    }

    public function findBySigneeId(int $signeeId): Collection
    {
        return $this->task->where('signee_id', $signeeId)->get();
    }

    public function update(array $data): Task
    {
        $task = $this->findOrFail($data['id']);
        $task->fill($data);
        $task->save();

        return $task;
    }
}
