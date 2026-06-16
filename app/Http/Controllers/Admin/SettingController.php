<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $products = \App\Models\Product::active()->get();
        return view('admin.settings.index', compact('settings', 'products'));
    }

    public function update(Request $request)
    {
        $keys = [
            'home_show_deal',
            'home_deal_product_id',
            'home_deal_end_time',
            'home_show_brands',
            'home_show_recommended',
            'home_show_newsletter',
            'home_show_faq',
            'home_show_track_order',
        ];

        foreach ($keys as $key) {
            $value = $request->has($key) ? $request->input($key) : ($request->has('submitted') ? '0' : null);
            if ($value !== null) {
                Setting::set($key, $value);
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
