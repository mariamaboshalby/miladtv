<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutStat;
use App\Models\AboutTeam;
use App\Models\AboutValue;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $stats  = AboutStat::orderBy('sort_order')->get();
        $team   = AboutTeam::orderBy('sort_order')->get();
        $values = AboutValue::orderBy('sort_order')->get();

        return view('admin.about.index', compact('stats', 'team', 'values'));
    }

    /* ── Stats ── */
    public function storeStat(Request $request)
    {
        $request->validate([
            'number'   => 'required|string|max:20',
            'label'    => 'required|string|max:100',
            'label_ar' => 'nullable|string|max:100',
            'icon'     => 'nullable|string|max:50',
        ]);

        AboutStat::create([
            'number'      => $request->number,
            'label'       => $request->label,
            'label_ar'    => $request->label_ar,
            'icon'        => $request->icon ?: 'fa-star',
            'sort_order'  => AboutStat::max('sort_order') + 1,
            'is_active'   => true,
        ]);

        return back()->with('success', 'تم إضافة الإحصائية بنجاح');
    }

    public function updateStat(Request $request, AboutStat $stat)
    {
        $request->validate([
            'number'   => 'required|string|max:20',
            'label'    => 'required|string|max:100',
            'label_ar' => 'nullable|string|max:100',
            'icon'     => 'nullable|string|max:50',
        ]);

        $stat->update([
            'number'    => $request->number,
            'label'     => $request->label,
            'label_ar'  => $request->label_ar,
            'icon'      => $request->icon ?: 'fa-star',
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'تم تحديث الإحصائية بنجاح');
    }

    public function destroyStat(AboutStat $stat)
    {
        $stat->delete();
        return back()->with('success', 'تم حذف الإحصائية');
    }

    /* ── Team ── */
    public function storeTeam(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'role'    => 'required|string|max:100',
            'role_ar' => 'nullable|string|max:100',
            'bio'     => 'nullable|string',
            'bio_ar'  => 'nullable|string',
        ]);

        AboutTeam::create([
            'name'       => $request->name,
            'role'       => $request->role,
            'role_ar'    => $request->role_ar,
            'bio'        => $request->bio,
            'bio_ar'     => $request->bio_ar,
            'sort_order' => AboutTeam::max('sort_order') + 1,
            'is_active'  => true,
        ]);

        return back()->with('success', 'تم إضافة عضو الفريق بنجاح');
    }

    public function updateTeam(Request $request, AboutTeam $team)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'role'    => 'required|string|max:100',
            'role_ar' => 'nullable|string|max:100',
            'bio'     => 'nullable|string',
            'bio_ar'  => 'nullable|string',
        ]);

        $team->update([
            'name'      => $request->name,
            'role'      => $request->role,
            'role_ar'   => $request->role_ar,
            'bio'       => $request->bio,
            'bio_ar'    => $request->bio_ar,
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'تم تحديث عضو الفريق بنجاح');
    }

    public function destroyTeam(AboutTeam $team)
    {
        $team->delete();
        return back()->with('success', 'تم حذف عضو الفريق');
    }

    /* ── Values ── */
    public function storeValue(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:100',
            'title_ar'       => 'nullable|string|max:100',
            'description'    => 'required|string',
            'description_ar' => 'nullable|string',
            'icon'           => 'nullable|string|max:50',
        ]);

        AboutValue::create([
            'title'          => $request->title,
            'title_ar'       => $request->title_ar,
            'description'    => $request->description,
            'description_ar' => $request->description_ar,
            'icon'           => $request->icon ?: 'fa-star',
            'sort_order'     => AboutValue::max('sort_order') + 1,
            'is_active'      => true,
        ]);

        return back()->with('success', 'تم إضافة القيمة بنجاح');
    }

    public function updateValue(Request $request, AboutValue $value)
    {
        $request->validate([
            'title'          => 'required|string|max:100',
            'title_ar'       => 'nullable|string|max:100',
            'description'    => 'required|string',
            'description_ar' => 'nullable|string',
            'icon'           => 'nullable|string|max:50',
        ]);

        $value->update([
            'title'          => $request->title,
            'title_ar'       => $request->title_ar,
            'description'    => $request->description,
            'description_ar' => $request->description_ar,
            'icon'           => $request->icon ?: 'fa-star',
            'is_active'      => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'تم تحديث القيمة بنجاح');
    }

    public function destroyValue(AboutValue $value)
    {
        $value->delete();
        return back()->with('success', 'تم حذف القيمة');
    }
}
