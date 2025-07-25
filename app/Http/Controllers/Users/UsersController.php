<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct(protected User $user) {}

    public function changeRole(Request $request)
    {
        $user = $this->user->findOrFail(Auth::id());
        $user->is_admin = $request->input('is_admin');
        $user->save();

        return to_route('tasks.index', ['wsId' => session('wsId')])->with('success', 'Role updated successfully.');
    }
}
