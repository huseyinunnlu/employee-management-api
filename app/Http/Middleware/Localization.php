<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
{
    public function handle(Request $request, Closure $next)
    {
        $current_lang = App::getLocale();
        $handled_lang = null;
        if ($request->hasHeader('X-localization')) {
            $handled_lang = $request->header('X-localization');
            $current_lang != $handled_lang ? App::setLocale($handled_lang) : '';
        }

        return $next($request);
    }
}
