<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = Validator::make($request->all(), [
            "name" => "required|string|min:5",
            "email" => "required|email",
            "password" => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9]{2,}(?: [a-zA-Z0-9]+){0,2}$/'
            ],
        ]);
        if ($user->fails()) {
            return redirect('')->withErrors($user)->withInput();
        } else {
            User::create(['name' => $request->name, 'email' => $request->email, 'password' => $request->password]);
            return redirect('/login');
        }
    }
    public function login(Request $request)
    {
        $userCheck = User::where('email', $request->email)->exists();
        if ($userCheck) {
            $user = User::where('email', $request->email)->first();
            if (Hash::check($request->password, $user['password'])) {
                Auth::login($user);
                return redirect('/tasks/' . $user['id'])->with('user', $user);
            } else {
                return redirect('/login')->withErrors('password not correct');
            }
        } else {
            return redirect('/login')->withErrors('email not correct');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
