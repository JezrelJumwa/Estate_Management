<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LocaleController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {
        if (! in_array($locale, ['en', 'sw'], true)) {
            return back();
        }

        session(['locale' => $locale]);

        return back();
    }
}
