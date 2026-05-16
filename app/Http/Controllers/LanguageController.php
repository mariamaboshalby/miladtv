<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Switch the application locale and redirect back.
     */
    public function switch(Request $request, string $locale)
    {
        $supported = ['en', 'ar'];

        if (!in_array($locale, $supported)) {
            abort(400);
        }

        session()->put('locale', $locale);

        return redirect()->back();
    }
}
