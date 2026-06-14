@extends('admin.layouts.app')
@section('title', __('app.new_file'))
@section('page-title', __('app.new_file'))
@section('breadcrumb') / <a href="{{ route('admin.downloads.index') }}">{{ __('app.downloads') }}</a> / <span>{{ __('app.new') }}</span> @endsection

@section('content')
<div class="card" style="max-width:800px;">
    <div class="card-header">
        <h2><i class="fas fa-plus" style="color:var(--primary-blue);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.add_download_file') }}</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.downloads.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.downloads._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
                <a href="{{ route('admin.downloads.index') }}" class="btn btn-secondary">{{ __('app.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
