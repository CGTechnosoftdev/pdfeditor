<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $middleware = request()->route()->gatherMiddleware();
        $guard = config('auth.defaults.guard');
        foreach($middleware as $m) {
            if(preg_match("/auth:/",$m)) {
                list($mid, $guard) = explode(":",$m);
            }
        }
        return route($guard == 'web' ? 'login' : 'front.login');
    }
}
