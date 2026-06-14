<?php

namespace App\Http\Controllers;

use App\Models\Download;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads  = Download::active()->latest()->get();
        $categories = $downloads->pluck('category')->unique()->values()->toArray();
        $brands     = $downloads->pluck('brand')->unique()->filter()->values()->toArray();

        return view('downloads.index', compact('downloads', 'categories', 'brands'));
    }
}
