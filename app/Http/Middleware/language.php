<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class language
{
    public function handle($request, Closure $next)
    {
        $raw_locale = $request->session()->get('locale');
        if (in_array($raw_locale, Config::get('app.locales'))) {
            $locale = $raw_locale;
        }
        else $locale = Config::get('app.locale');
        App::setLocale($locale);
        return $next($request);
    }
}