<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Workspace;

/**
 * @property \App\Models\Workspace $workspace
 */
trait Workspaced
{
    protected $workspace;

    public function withWorkspace(Workspace $workspace): self
    {
        $this->workspace = $workspace;

        return $this;
    }

    public function withWorkspaceOfId($workspaceId): self
    {
        $this->workspace = Workspace::findOrFail(session('wsId', $workspaceId));

        return $this;
    }
}
