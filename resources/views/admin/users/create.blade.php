@extends('admin.layouts.app')

@section('title', __('app.add_user'))
@section('page-title', __('app.add_new_user'))
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i>
    <a href="{{ route('admin.users.index') }}">{{ __('app.users') }}</a>
    <i class="fas fa-chevron-left"></i>
    <span>{{ __('app.add') }}</span>
@endsection

@section('content')
<div class="form-center">
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-user-plus" style="color:var(--primary-blue);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.user_data') }}</h2>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">{{ __('app.full_name') }}</label>
                    <input type="text" name="name" class="form-control @error('name') is-error @enderror"
                        value="{{ old('name') }}" placeholder="{{ __('app.full_name_ph') }}" required>
                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label required">{{ __('app.email') }}</label>
                    <input type="email" name="email" class="form-control @error('email') is-error @enderror"
                        value="{{ old('email') }}" placeholder="example@email.com" required>
                    @error('email')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">{{ __('app.phone') }}</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-error @enderror"
                        value="{{ old('phone') }}" placeholder="01xxxxxxxxx">
                    @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label required">{{ __('app.role') }}</label>
                    <select name="role" class="form-control" required>
                        <option value="user"  {{ old('role','user')=='user'  ? 'selected':'' }}>👤 {{ __('app.role_regular_user') }}</option>
                        <option value="admin" {{ old('role')=='admin' ? 'selected':'' }}>👑 {{ __('app.role_admin') }}</option>
                    </select>
                    @error('role')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">{{ __('app.password') }}</label>
                    <input type="password" name="password" class="form-control @error('password') is-error @enderror"
                        placeholder="{{ __('app.password_min') }}" required>
                    @error('password')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" style="opacity:0">.</label>
                    <div class="form-check" style="margin-top:.5rem">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active',true) ? 'checked':'' }}>
                        <label for="is_active">{{ __('app.active_account') }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="btn-group" style="margin-top:1.5rem">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> {{ __('app.save_user') }}
        </button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> {{ __('app.cancel') }}
        </a>
    </div>
</form>
</div>
@endsection

@push('styles')
<style>
.form-center { max-width: 800px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.form-error { display: block; color: var(--error); font-size: .8125rem; margin-top: .375rem; }
.form-control.is-error { border-color: var(--error); }
@media (max-width: 640px) { .form-row { grid-template-columns: 1fr; } }
</style>
@endpush
