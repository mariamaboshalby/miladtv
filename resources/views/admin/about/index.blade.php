@extends('admin.layouts.app')
@section('title', __('app.manage_about'))
@section('page-title', __('app.about'))
@section('breadcrumb') / <span>{{ __('app.about') }}</span> @endsection

@section('content')

{{-- ══════════════════════════════════════
     STATS
══════════════════════════════════════ --}}
<div class="card mb-4">
    <div class="card-header">
        <h2><i class="fas fa-chart-bar" style="color:var(--primary-blue);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.about_stats') }}</h2>
        <button class="btn btn-primary btn-sm" onclick="toggleForm('statForm')">
            <i class="fas fa-plus me-1"></i> {{ __('app.add') }}
        </button>
    </div>

    {{-- Add form --}}
    <div id="statForm" class="card-body border-bottom" style="display:none;background:#f8fafc;">
        <form method="POST" action="{{ route('admin.about.stats.store') }}">
            @csrf
            <div class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label class="form-label fw-semibold">{{ __('app.number') }}</label>
                    <input type="text" name="number" class="form-control" placeholder="500+" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">{{ __('app.label_en') }}</label>
                    <input type="text" name="label" class="form-control" placeholder="Products Available" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">{{ __('app.label_ar') }}</label>
                    <input type="text" name="label_ar" class="form-control" placeholder="منتج متاح" dir="rtl">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">{{ __('app.icon') }}</label>
                    <input type="text" name="icon" class="form-control" placeholder="fa-box" value="fa-star">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button>
                </div>
            </div>
        </form>
    </div>

    <div class="table-container">
        @if($stats->count())
        <table class="data-table">
            <thead><tr><th>{{ __('app.number') }}</th><th>EN</th><th>AR</th><th>{{ __('app.icon') }}</th><th>{{ __('app.status') }}</th><th></th></tr></thead>
            <tbody>
                @foreach($stats as $stat)
                <tr>
                    <td><strong>{{ $stat->number }}</strong></td>
                    <td>{{ $stat->label }}</td>
                    <td>{{ $stat->label_ar }}</td>
                    <td><i class="fas {{ $stat->icon }} text-primary"></i> {{ $stat->icon }}</td>
                    <td><span class="badge {{ $stat->is_active ? 'badge-green' : 'badge-red' }}">{{ $stat->is_active ? __('app.active') : __('app.hidden') }}</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-secondary btn-sm" onclick="toggleEditStat({{ $stat->id }})"><i class="fas fa-edit"></i></button>
                            <form method="POST" action="{{ route('admin.about.stats.destroy', $stat) }}" onsubmit="return confirm('{{ __('app.delete_confirm_short') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                        {{-- Inline edit --}}
                        <div id="editStat{{ $stat->id }}" style="display:none;margin-top:.75rem;">
                            <form method="POST" action="{{ route('admin.about.stats.update', $stat) }}">
                                @csrf @method('PUT')
                                <div class="row g-2">
                                    <div class="col-2"><input type="text" name="number" value="{{ $stat->number }}" class="form-control form-control-sm" required></div>
                                    <div class="col-3"><input type="text" name="label" value="{{ $stat->label }}" class="form-control form-control-sm" required></div>
                                    <div class="col-3"><input type="text" name="label_ar" value="{{ $stat->label_ar }}" class="form-control form-control-sm" dir="rtl"></div>
                                    <div class="col-2"><input type="text" name="icon" value="{{ $stat->icon }}" class="form-control form-control-sm"></div>
                                    <div class="col-1">
                                        <div class="form-check mt-1"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $stat->is_active ? 'checked' : '' }}></div>
                                    </div>
                                    <div class="col-1"><button type="submit" class="btn btn-primary btn-sm w-100">✓</button></div>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state"><i class="fas fa-chart-bar"></i><p>{{ __('app.no_stats') }}</p></div>
        @endif
    </div>
</div>

{{-- ══════════════════════════════════════
     VALUES
══════════════════════════════════════ --}}
<div class="card mb-4">
    <div class="card-header">
        <h2><i class="fas fa-star" style="color:var(--primary-blue);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.core_values') }}</h2>
        <button class="btn btn-primary btn-sm" onclick="toggleForm('valueForm')">
            <i class="fas fa-plus me-1"></i> {{ __('app.add') }}
        </button>
    </div>

    <div id="valueForm" class="card-body border-bottom" style="display:none;background:#f8fafc;">
        <form method="POST" action="{{ route('admin.about.values.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-3"><label class="form-label fw-semibold">{{ __('app.title_en') }}</label><input type="text" name="title" class="form-control" required></div>
                <div class="col-md-3"><label class="form-label fw-semibold">{{ __('app.title_ar') }}</label><input type="text" name="title_ar" class="form-control" dir="rtl"></div>
                <div class="col-md-2"><label class="form-label fw-semibold">{{ __('app.icon') }}</label><input type="text" name="icon" class="form-control" value="fa-star"></div>
                <div class="col-md-4"><label class="form-label fw-semibold">{{ __('app.desc_en') }}</label><input type="text" name="description" class="form-control" required></div>
                <div class="col-md-4"><label class="form-label fw-semibold">{{ __('app.desc_ar') }}</label><input type="text" name="description_ar" class="form-control" dir="rtl"></div>
                <div class="col-md-2 d-flex align-items-end"><button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button></div>
            </div>
        </form>
    </div>

    <div class="table-container">
        @if($values->count())
        <table class="data-table">
            <thead><tr><th>{{ __('app.icon') }}</th><th>EN</th><th>AR</th><th>{{ __('app.description') }}</th><th>{{ __('app.status') }}</th><th></th></tr></thead>
            <tbody>
                @foreach($values as $val)
                <tr>
                    <td><i class="fas {{ $val->icon }} text-primary fa-lg"></i></td>
                    <td><strong>{{ $val->title }}</strong></td>
                    <td>{{ $val->title_ar }}</td>
                    <td style="font-size:.85rem;color:var(--gray-500)">{{ Str::limit($val->description, 50) }}</td>
                    <td><span class="badge {{ $val->is_active ? 'badge-green' : 'badge-red' }}">{{ $val->is_active ? __('app.active') : __('app.hidden') }}</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-secondary btn-sm" onclick="toggleEditValue({{ $val->id }})"><i class="fas fa-edit"></i></button>
                            <form method="POST" action="{{ route('admin.about.values.destroy', $val) }}" onsubmit="return confirm('{{ __('app.delete_confirm_short') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                        <div id="editValue{{ $val->id }}" style="display:none;margin-top:.75rem;">
                            <form method="POST" action="{{ route('admin.about.values.update', $val) }}">
                                @csrf @method('PUT')
                                <div class="row g-2">
                                    <div class="col-3"><input type="text" name="title" value="{{ $val->title }}" class="form-control form-control-sm" required></div>
                                    <div class="col-3"><input type="text" name="title_ar" value="{{ $val->title_ar }}" class="form-control form-control-sm" dir="rtl"></div>
                                    <div class="col-2"><input type="text" name="icon" value="{{ $val->icon }}" class="form-control form-control-sm"></div>
                                    <div class="col-1"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $val->is_active ? 'checked' : '' }}></div></div>
                                    <div class="col-12"><input type="text" name="description" value="{{ $val->description }}" class="form-control form-control-sm" required placeholder="EN"></div>
                                    <div class="col-12"><input type="text" name="description_ar" value="{{ $val->description_ar }}" class="form-control form-control-sm" dir="rtl" placeholder="AR"></div>
                                    <div class="col-2"><button type="submit" class="btn btn-primary btn-sm w-100">✓</button></div>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state"><i class="fas fa-star"></i><p>{{ __('app.no_values') }}</p></div>
        @endif
    </div>
</div>

{{-- ══════════════════════════════════════
     TEAM
══════════════════════════════════════ --}}
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-users" style="color:var(--primary-blue);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.team') }}</h2>
        <button class="btn btn-primary btn-sm" onclick="toggleForm('teamForm')">
            <i class="fas fa-plus me-1"></i> {{ __('app.add') }}
        </button>
    </div>

    <div id="teamForm" class="card-body border-bottom" style="display:none;background:#f8fafc;">
        <form method="POST" action="{{ route('admin.about.team.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-3"><label class="form-label fw-semibold">{{ __('app.name') }}</label><input type="text" name="name" class="form-control" required></div>
                <div class="col-md-3"><label class="form-label fw-semibold">{{ __('app.position_en') }}</label><input type="text" name="role" class="form-control" required></div>
                <div class="col-md-3"><label class="form-label fw-semibold">{{ __('app.position_ar') }}</label><input type="text" name="role_ar" class="form-control" dir="rtl"></div>
                <div class="col-md-6"><label class="form-label fw-semibold">{{ __('app.bio_en') }}</label><input type="text" name="bio" class="form-control"></div>
                <div class="col-md-6"><label class="form-label fw-semibold">{{ __('app.bio_ar') }}</label><input type="text" name="bio_ar" class="form-control" dir="rtl"></div>
                <div class="col-md-2 d-flex align-items-end"><button type="submit" class="btn btn-primary w-100">{{ __('app.save') }}</button></div>
            </div>
        </form>
    </div>

    <div class="table-container">
        @if($team->count())
        <table class="data-table">
            <thead><tr><th>{{ __('app.name') }}</th><th>{{ __('app.position_en') }}</th><th>{{ __('app.position_ar') }}</th><th>{{ __('app.bio') }}</th><th>{{ __('app.status') }}</th><th></th></tr></thead>
            <tbody>
                @foreach($team as $member)
                <tr>
                    <td><strong>{{ $member->name }}</strong></td>
                    <td>{{ $member->role }}</td>
                    <td>{{ $member->role_ar }}</td>
                    <td style="font-size:.85rem;color:var(--gray-500)">{{ Str::limit($member->bio, 40) }}</td>
                    <td><span class="badge {{ $member->is_active ? 'badge-green' : 'badge-red' }}">{{ $member->is_active ? __('app.active') : __('app.hidden') }}</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-secondary btn-sm" onclick="toggleEditTeam({{ $member->id }})"><i class="fas fa-edit"></i></button>
                            <form method="POST" action="{{ route('admin.about.team.destroy', $member) }}" onsubmit="return confirm('{{ __('app.delete_confirm_short') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                        <div id="editTeam{{ $member->id }}" style="display:none;margin-top:.75rem;">
                            <form method="POST" action="{{ route('admin.about.team.update', $member) }}">
                                @csrf @method('PUT')
                                <div class="row g-2">
                                    <div class="col-3"><input type="text" name="name" value="{{ $member->name }}" class="form-control form-control-sm" required></div>
                                    <div class="col-3"><input type="text" name="role" value="{{ $member->role }}" class="form-control form-control-sm" required></div>
                                    <div class="col-3"><input type="text" name="role_ar" value="{{ $member->role_ar }}" class="form-control form-control-sm" dir="rtl"></div>
                                    <div class="col-1"><div class="form-check mt-1"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $member->is_active ? 'checked' : '' }}></div></div>
                                    <div class="col-12"><input type="text" name="bio" value="{{ $member->bio }}" class="form-control form-control-sm" placeholder="Bio EN"></div>
                                    <div class="col-12"><input type="text" name="bio_ar" value="{{ $member->bio_ar }}" class="form-control form-control-sm" dir="rtl" placeholder="Bio AR"></div>
                                    <div class="col-2"><button type="submit" class="btn btn-primary btn-sm w-100">✓</button></div>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state"><i class="fas fa-users"></i><p>{{ __('app.no_team_members') }}</p></div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleForm(id) {
    const el = document.getElementById(id);
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
}
function toggleEditStat(id)  { toggleForm('editStat'  + id); }
function toggleEditValue(id) { toggleForm('editValue' + id); }
function toggleEditTeam(id)  { toggleForm('editTeam'  + id); }
</script>
@endpush
