<?php

namespace App\Http\Middleware;

use App\Helpers\Lang;
use Closure;
use Illuminate\Http\Request;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next) {
        $user = $request->user();

        if ($user) {
            app()->setLocale($user->lang ?? Lang::RU);
        }

        return $next($request);
    }
}
