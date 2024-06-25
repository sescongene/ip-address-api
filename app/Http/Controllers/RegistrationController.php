<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\UserResource;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function __invoke(RegistrationRequest $request)
    {
        $user = DB::transaction(function () use ($request) {
            $user = User::create($request->validated());
            $user->save();
            return $user;
        });

        $newAccessToken = $user->createToken($request->header('user-agent', config('app.name')));
        
        return $this->respondWithToken($newAccessToken->plainTextToken, new UserResource($user));
    }
}
