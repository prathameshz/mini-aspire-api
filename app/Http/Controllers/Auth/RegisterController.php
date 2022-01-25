<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'unique:users|required',
            'password' => 'required|min:6',
        ];

        $input = $request->only('name', 'email', 'password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'api_token' => Str::random(60)]);
        if ($user) {
            return response()->json(['success' => true, 'message' => 'Account Successfully created']);
        }
    }
}
