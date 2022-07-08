<?php

namespace App\Http\Traits\Models;

use Illuminate\Support\Facades\App;

trait GlobalFunctions
{
    public function getCurrentTitleAttribute()
    {
        $localize = App::currentLocale();
        $current_title = $this->titles->where('lang_code', $localize)->first();
        return $current_title->title ?? null;
    }
}
