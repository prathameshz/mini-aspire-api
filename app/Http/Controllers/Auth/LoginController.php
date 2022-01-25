<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Resources\User as UserResource;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $input = $request->only('email', 'password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        if (auth()->attempt(request()->only(['email', 'password']))) {
            $user = auth()->user();
            return response()->json(['success' => true, 'message' => 'Login Successfull', 'user' => UserResource::make($user)]);
        }
        return response()->json(['success' => false, 'message' => 'Invalid Credentials']);
    }
}
