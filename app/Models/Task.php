<?php

namespace App\Models;

use App\Enum\TaskStatus;
use App\Traits\FormatsDates;
use App\Traits\HasWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes, FormatsDates, HasWorkspace;

    public $attributes = [
        'status' => TaskStatus::PENDING, // Default status
    ];

    public $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'due_date' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'description',
        'status',
        'created_by',
        'due_date',
        'workspace_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function signees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tasks_users');
    }

    public function workspace(): BelongsToMany
    {
        return $this->belongsToMany(Workspace::class);
    }

    public function syncSignees(array $data): self
    {
        $idList = array_column($data, 'id');
        $emailList = array_column($data, 'email');
        $users = User::whereIn('id', $idList)->orWhereIn('email', $emailList)->get();
        $this->signees()->sync($users);

        return $this;
    }
}
