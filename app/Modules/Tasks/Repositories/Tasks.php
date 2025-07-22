<?php

declare(strict_types=1);

namespace App\Modules\Tasks\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class Tasks
{
    public function __construct(private Task $task) {}

    public function create(array $data): Task
    {
        $task = $this->task->newInstance();
        $task->fill($data);
        $task->save();

        $task->signees()->sync($data['signee_id']);

        return $task;
    }

    public function all(): Collection
    {
        return $this->task->newQuery()->all();
    }

    public function findOrFail(int $id): Task
    {
        return $this->task->newQuery()->findOrFail($id);
    }

    public function firstOrFailBySigneeId(int $signeeId): Task
    {
        return $this->task->newQuery()->where('signee_id', $signeeId)->firstOrFail();
    }

    public function allBySigneeId(int $signeeId)
    {
        return $this->task->whereHas(
            'signees',
            fn(Builder $query) =>
            $query->where('user_id', $signeeId)
        )->get();
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
}
