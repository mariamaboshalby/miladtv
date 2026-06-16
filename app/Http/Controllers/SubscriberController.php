<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email|unique:subscribers,email']);
        \App\Models\Subscriber::create(['email' => $request->email]);
        return response()->json(['success' => true, 'message' => app()->getLocale() === 'ar' ? 'تم الاشتراك بنجاح' : 'Subscribed successfully']);
    }
}
