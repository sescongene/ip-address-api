<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function user(Request $request)
    {
        $user = Auth::user();
        return new UserResource($user);
    }
    
    public function login(AuthRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!Hash::check($request->input('password'), $user->password)) {
            return $this->respondWithError('INVALID_CREDENTIALS', 401, 'Invalid credentials');
        }
        $newAccessToken = $user->createToken($request->header('user-agent', config('app.name')));

        return $this->respondWithToken($newAccessToken->plainTextToken, new UserResource($user));
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->respondWithEmptyData();
    }
}
