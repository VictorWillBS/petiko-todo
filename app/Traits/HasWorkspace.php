<?php

namespace App\Traits;

use App\Models\Workspace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasWorkspace
{
    public function authorizeWorkspace(int $workspaceId): void
    {
        $workspace = Workspace::where('id', $workspaceId)
            ->where('owner_id', Auth::id())
            ->first();

        abort_unless($workspace, 403, 'Workspace não pertence a este usuário.');
    }

    public function scopeFromWorkspace(Builder $query, int $workspaceId): Builder
    {
        $this->authorizeWorkspace($workspaceId);

        return $query->where('workspace_id', $workspaceId);
    }
}
