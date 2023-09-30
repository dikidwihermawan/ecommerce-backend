<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:3', 'max:20'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'confirmed'],
            ]
        );

        $request['password'] = bcrypt($request['password']);

        if ($request) {
            User::create($request->all());
        } else {
            return response()->json(['error' => 'Something is wrong!']);
        }

        return response()->json(['success' => 'You are registered now!']);
    }
}
