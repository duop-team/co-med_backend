<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 4) {
            return response(null, 403);
        }

        return User::where('role_id', 2)->where('role_id', 3)->orderBy('name');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id == 4) {
            return response(null, 403);
        }

        $input = $request->all();
        if (isset($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }

        if (isset($input['doctor'])) {
            $input['role_id'] = 3;
            unset($input['doctor']);
        } else {
            $input['role_id'] = 2;
        }

        $user = User::create($input);

        return response($user, 201);
    }

    public function destroy(User $user)
    {
        if (Auth::user()->role_id == 4) {
            return response(null, 403);
        }

        if ($user->delete()) {
            return response(null, 204);
        }
    }
}
