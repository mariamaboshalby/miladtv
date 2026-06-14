@extends('admin.layouts.app')
@section('title', __('app.manage_downloads'))
@section('page-title', __('app.downloads'))
@section('breadcrumb') / <span>{{ __('app.downloads') }}</span> @endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-download" style="color:var(--primary-blue);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.download_files') }}</h2>
        <a href="{{ route('admin.downloads.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> {{ __('app.new_file') }}
        </a>
    </div>

    <div class="card-body" style="padding:1rem 1.5rem;border-bottom:1px solid var(--gray-100);">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('app.search') }}..." class="form-control" style="max-width:260px;">
            <select name="category" class="form-control" style="max-width:180px;">
                <option value="">{{ __('app.all_categories') }}</option>
                @foreach(['Drivers','Software','Manuals','Catalogues'] as $cat)
                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <button class="btn btn-secondary btn-sm"><i class="fas fa-search me-1"></i> {{ __('app.search') }}</button>
            @if(request()->hasAny(['search','category']))
            <a href="{{ route('admin.downloads.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('app.clear') }}</a>
            @endif
        </form>
    </div>

    <div class="table-container">
        @if($downloads->count())
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('app.file_name') }}</th>
                    <th>{{ __('app.category') }}</th>
                    <th>{{ __('app.brand') }}</th>
                    <th>{{ __('app.version') }}</th>
                    <th>{{ __('app.size') }}</th>
                    <th>{{ __('app.dl_count') }}</th>
                    <th>{{ __('app.status') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($downloads as $dl)
                <tr>
                    <td>{{ $dl->id }}</td>
                    <td><strong>{{ Str::limit($dl->title, 40) }}</strong></td>
                    <td><span class="badge badge-blue">{{ $dl->category }}</span></td>
                    <td>{{ $dl->brand }}</td>
                    <td>{{ $dl->version }}</td>
                    <td>{{ $dl->size }}</td>
                    <td>{{ number_format($dl->downloads) }}</td>
                    <td>
                        <span class="badge {{ $dl->is_active ? 'badge-green' : 'badge-red' }}">
                            {{ $dl->is_active ? __('app.active') : __('app.hidden') }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.downloads.edit', $dl) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('admin.downloads.destroy', $dl) }}" onsubmit="return confirm('{{ __('app.delete_file_confirm') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:1rem 1.5rem;">{{ $downloads->links() }}</div>
        @else
        <div class="empty-state"><i class="fas fa-download"></i><p>{{ __('app.no_files') }}</p></div>
        @endif
    </div>
</div>
@endsection
