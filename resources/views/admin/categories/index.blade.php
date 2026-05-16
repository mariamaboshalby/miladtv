@extends('admin.layouts.app')
@section('title', __('app.manage_categories'))
@section('page-title', __('app.categories'))
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i> <span>{{ __('app.categories') }}</span>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-tags" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.categories') }}</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> {{ __('app.new_category') }}
        </a>
    </div>

    <div class="table-container">
        @if($categories->count())
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('app.name_arabic') }}</th>
                    <th>{{ __('app.name_english') }}</th>
                    <th>{{ __('app.slug_label') }}</th>
                    <th>{{ __('app.icon') }}</th>
                    <th>{{ __('app.status') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><strong>{{ $category->name_ar }}</strong></td>
                    <td>{{ $category->name_en }}</td>
                    <td>{{ $category->slug }}</td>
                    <td><i class="fas fa-{{ $category->icon }}"></i> {{ $category->icon }}</td>
                    <td>
                        <span class="badge {{ $category->is_active ? 'badge-green' : 'badge-red' }}">
                            {{ $category->is_active ? __('app.active') : __('app.inactive') }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-secondary btn-sm" title="{{ __('app.edit') }}"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('{{ __('app.delete_category_confirm') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="{{ __('app.delete') }}"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:1rem 1.5rem;">{{ $categories->links() }}</div>
        @else
        <div class="empty-state"><i class="fas fa-tags"></i><p>{{ __('app.no_categories_found') }}</p></div>
        @endif
    </div>
</div>
@endsection

