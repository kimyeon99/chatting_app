<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'users' => $users,
        ], 201);
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        // $profile = $user->profileImagePath();
        // return [$user, $profile];

        return $user;
    }
}
