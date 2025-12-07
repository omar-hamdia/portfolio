<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
{
    // استثناء الروتات التي تبدأ بـ /admin
    if ($request->is('admin/*')) {
        return $next($request);
    }

    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    }
    
    $locale = $request->segment(1);
    $supportedLocales = ['en', 'ar'];
    
    if (in_array($locale, $supportedLocales)) {
        App::setLocale($locale);
        Session::put('locale', $locale);
    } else {
        if (!in_array($request->path(), $supportedLocales) && !empty($request->path())) {
            $currentLocale = Session::get('locale', config('app.locale'));
            return redirect('/' . $currentLocale . '/' . $request->path());
        }
    }
    
    return $next($request);
}

}