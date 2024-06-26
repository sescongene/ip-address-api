<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{

    protected function respondWithError(string $errorCode, int $statusCode = 400, ?string $message = null, array $metadata = []): JsonResponse
    {
        $payload = [
            'message' => $message,
            'error_code' => $errorCode,
        ];

        if (filled($metadata)) {
            $payload = array_merge($payload, ['meta' => $metadata]);
        }

        return response()->json($payload, $statusCode);
    }

    protected function respondWithEmptyData(int $statusCode = 200): JsonResponse
    {
        return response()->json([], $statusCode);
    }

    protected function respondWithToken(string $token, $user, $statusCode = 200): JsonResponse
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => now()->addMinutes(config('jwt.ttl')),
            'user' => $user,
        ], $statusCode)->header('Authorization', $token);
    }
}
