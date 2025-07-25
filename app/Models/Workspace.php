<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $fillable = [
        'name',
        'owner_id',
        'slug',
    ];

    /**
     * Get the owner of the workspace.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the tasks associated with the workspace.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
