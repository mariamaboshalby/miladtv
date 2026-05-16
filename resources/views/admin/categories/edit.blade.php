@extends('admin.layouts.app')
@section('title', __('app.edit') . ': ' . $category->name_ar)
@section('page-title', __('app.edit_category'))
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i> <a href="{{ route('admin.categories.index') }}">{{ __('app.categories') }}</a>
    <i class="fas fa-chevron-left"></i> <span>{{ __('app.edit') }}</span>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.categories.update', $category) }}">
    @csrf
    @method('PUT')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header">
            <h2>{{ __('app.edit_category') }}</h2>
        </div>
        <div class="card-body">
            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label required">{{ __('app.name_arabic') }}</label>
                <input type="text" name="name_ar" class="form-control @error('name_ar') is-error @enderror" value="{{ old('name_ar', $category->name_ar) }}" required>
                @error('name_ar')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label required">{{ __('app.name_english') }}</label>
                <input type="text" name="name_en" class="form-control @error('name_en') is-error @enderror" value="{{ old('name_en', $category->name_en) }}" required>
                @error('name_en')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label required">{{ __('app.slug_label') }}</label>
                <input type="text" name="slug" class="form-control @error('slug') is-error @enderror" value="{{ old('slug', $category->slug) }}" required>
                <small style="color:#64748b;font-size:.8125rem">{{ __('app.slug_hint') }}</small>
                @error('slug')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label">{{ __('app.icon') }} (FontAwesome)</label>
                <input type="text" name="icon" class="form-control @error('icon') is-error @enderror" value="{{ old('icon', $category->icon) }}">
                <small style="color:#64748b;font-size:.8125rem">{{ __('app.icon_hint') }}</small>
                @error('icon')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-check" style="margin-bottom:1.5rem">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                <label for="is_active">{{ __('app.active_category') }}</label>
            </div>

            <div class="btn-group" style="margin-top:.5rem">
                <button type="submit" class="btn btn-primary" style="flex:1">
                    <i class="fas fa-save"></i> {{ __('app.update_category') }}
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> {{ __('app.cancel') }}
                </a>
            </div>
        </div>
    </div>
</form>
@endsection

