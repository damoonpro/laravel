<?php

namespace App\Module\Blog\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->is_admin)
            return $next($request);
        // when we say page not found, attacker will go somewhere else
        throw new NotFoundHttpException('صفحه یافت نشد');
    }
}
