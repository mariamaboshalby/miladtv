@extends('admin.layouts.app')
@section('title', __('app.new_category'))
@section('page-title', __('app.new_category'))
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i> <a href="{{ route('admin.categories.index') }}">{{ __('app.categories') }}</a>
    <i class="fas fa-chevron-left"></i> <span>{{ __('app.add') }}</span>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header">
            <h2>{{ __('app.new_category') }}</h2>
        </div>
        <div class="card-body">
            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label required">{{ __('app.name_arabic') }}</label>
                <input type="text" name="name_ar" class="form-control @error('name_ar') is-error @enderror" value="{{ old('name_ar') }}" required>
                @error('name_ar')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label required">{{ __('app.name_english') }}</label>
                <input type="text" name="name_en" class="form-control @error('name_en') is-error @enderror" value="{{ old('name_en') }}" required>
                @error('name_en')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label required">{{ __('app.slug_label') }}</label>
                <input type="text" name="slug" class="form-control @error('slug') is-error @enderror" value="{{ old('slug') }}" required>
                <small style="color:#64748b;font-size:.8125rem">{{ __('app.slug_hint') }}</small>
                @error('slug')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label">{{ __('app.icon') }} (FontAwesome)</label>
                <input type="text" name="icon" class="form-control @error('icon') is-error @enderror" value="{{ old('icon', 'tag') }}">
                <small style="color:#64748b;font-size:.8125rem">{{ __('app.icon_hint') }}</small>
                @error('icon')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-check" style="margin-bottom:1.5rem">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active">{{ __('app.active_category') }}</label>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%">
                <i class="fas fa-save"></i> {{ __('app.save_category') }}
            </button>
        </div>
    </div>
</form>
@endsection
