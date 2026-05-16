@extends('admin.layouts.app')
@section('title', __('app.manage_blog'))
@section('page-title', __('app.blog'))
@section('breadcrumb') / <span>{{ __('app.blog') }}</span> @endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-pen-nib" style="color:var(--primary-blue);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.blog_posts') }}</h2>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> {{ __('app.new_post') }}
        </a>
    </div>

    {{-- Search / Filter --}}
    <div class="card-body" style="padding:1rem 1.5rem;border-bottom:1px solid var(--gray-100);">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('app.blog_search_ph') }}" class="form-control" style="max-width:280px;">
            <input type="text" name="category" value="{{ request('category') }}" placeholder="{{ __('app.category') }}..." class="form-control" style="max-width:180px;">
            <button class="btn btn-secondary btn-sm"><i class="fas fa-search me-1"></i> {{ __('app.search') }}</button>
            @if(request()->hasAny(['search','category']))
            <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('app.clear') }}</a>
            @endif
        </form>
    </div>

    <div class="table-container">
        @if($posts->count())
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('app.title') }}</th>
                    <th>{{ __('app.category') }}</th>
                    <th>{{ __('app.author') }}</th>
                    <th>{{ __('app.views') }}</th>
                    <th>{{ __('app.publish_date') }}</th>
                    <th>{{ __('app.status') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        <strong>{{ Str::limit($post->title, 45) }}</strong>
                        @if($post->title_ar)
                        <br><small class="text-muted">{{ Str::limit($post->title_ar, 45) }}</small>
                        @endif
                    </td>
                    <td><span class="badge badge-blue">{{ $post->category }}</span></td>
                    <td>{{ $post->author }}</td>
                    <td>{{ number_format($post->views) }}</td>
                    <td style="font-size:.875rem;color:var(--gray-500)">{{ $post->published_at?->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge {{ $post->is_active ? 'badge-green' : 'badge-red' }}">
                            {{ $post->is_active ? __('app.active') : __('app.hidden') }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" onsubmit="return confirm('{{ __('app.delete_post_confirm') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm" style="background:#fee2e2;color:#dc2626;"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:1rem 1.5rem;">{{ $posts->links() }}</div>
        @else
        <div class="empty-state"><i class="fas fa-pen-nib"></i><p>{{ __('app.no_posts') }}</p></div>
        @endif
    </div>
</div>

@endsection
