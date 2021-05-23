<?php

namespace App\Http\Middleware;

use Closure;

class checkIfUserHasEnoughData
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth()->user();
        if (isset($user->skills, $user->about)) {
            $request->attributes->add(['needInfo' => false]);
            return $next($request);
        }
        $request->attributes->add(['needInfo' => true]);
        return $next($request);
    }
}
