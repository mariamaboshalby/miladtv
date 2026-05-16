@extends('admin.layouts.app')
@section('title', __('app.edit_post'))
@section('page-title', __('app.edit_post'))
@section('breadcrumb') / <a href="{{ route('admin.blog.index') }}">{{ __('app.blog') }}</a> / <span>{{ __('app.edit') }}</span> @endsection

@section('content')
<div class="card" style="max-width:900px;">
    <div class="card-header">
        <h2><i class="fas fa-edit" style="color:var(--primary-blue);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.edit') }}: {{ Str::limit($blog->title, 40) }}</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.blog.update', $blog) }}">
            @csrf @method('PUT')
            @include('admin.blog._form', ['post' => $blog])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">{{ __('app.save_changes') }}</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">{{ __('app.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
