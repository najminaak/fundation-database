<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;

class CheckScope
{
    public function handle(Request $request, Closure $next, ...$scopes)
    {
        $user = $request->user();

        if (!$user || !$user->token()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Cek apakah token memiliki salah satu scope yang diizinkan
        foreach ($scopes as $scope) {
            if ($user->tokenCan($scope)) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Forbidden - Insufficient scope'], 403);
    }
}
