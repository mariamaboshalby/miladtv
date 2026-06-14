@extends('admin.layouts.app')
@section('title', __('app.new_post'))
@section('page-title', __('app.new_post'))
@section('breadcrumb') / <a href="{{ route('admin.blog.index') }}">{{ __('app.blog') }}</a> / <span>{{ __('app.new') }}</span> @endsection

@section('content')
<div class="card" style="max-width:900px;">
    <div class="card-header">
        <h2><i class="fas fa-plus" style="color:var(--primary-blue);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.add_post') }}</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.blog.store') }}">
            @csrf
            @include('admin.blog._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">{{ __('app.save_post') }}</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">{{ __('app.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
