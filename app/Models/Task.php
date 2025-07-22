<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'created_by',
        'until_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function signees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tasks_users');
    }
}
