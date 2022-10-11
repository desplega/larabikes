<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (null !== $request->user()) {
            $birth_date = $request->user()->birth_date;
            $age = today()->diffInYears($birth_date);
            if ($age < 18)
                abort('403', 'Acceso denegado, debes ser mayor de 18 años para realizar esta acción');
        }

        return $next($request);
    }
}
