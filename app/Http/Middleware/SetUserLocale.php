<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetUserLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }
        elseif (auth()->check()) {
            $locale = auth()->user()->getSetting('language', config('app.locale'));
            app()->setLocale($locale);
            session()->put('locale', $locale); 
        }

        return $next($request);
    }
}
