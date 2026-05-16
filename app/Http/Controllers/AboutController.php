<?php

namespace App\Http\Controllers;

use App\Models\AboutStat;
use App\Models\AboutTeam;
use App\Models\AboutValue;

class AboutController extends Controller
{
    public function index()
    {
        $stats  = AboutStat::active()->get();
        $team   = AboutTeam::active()->get();
        $values = AboutValue::active()->get();

        return view('about.index', compact('stats', 'team', 'values'));
    }
}
