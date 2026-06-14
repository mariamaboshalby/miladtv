@extends('admin.layouts.app')

@section('title', __('app.edit') . ': ' . $user->name)
@section('page-title', __('app.edit_user'))
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i>
    <a href="{{ route('admin.users.index') }}">{{ __('app.users') }}</a>
    <i class="fas fa-chevron-left"></i>
    <span>{{ __('app.edit') }}</span>
@endsection

@section('content')
<div class="form-center">
<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf @method('PUT')
    <div class="card">
        <div class="card-header">
            <div style="display:flex;align-items:center;gap:1rem">
                <div class="user-avatar-lg {{ $user->role === 'admin' ? 'admin' : '' }}">
                    {{ mb_substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h2 style="margin:0">{{ $user->name }}</h2>
                    <span style="color:var(--gray-500);font-size:.9375rem">{{ $user->email }}</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">{{ __('app.full_name') }}</label>
                    <input type="text" name="name" class="form-control @error('name') is-error @enderror"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label required">{{ __('app.email') }}</label>
                    <input type="email" name="email" class="form-control @error('email') is-error @enderror"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">{{ __('app.phone') }}</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ old('phone', $user->phone) }}" placeholder="01xxxxxxxxx">
                </div>
                <div class="form-group">
                    <label class="form-label required">{{ __('app.role') }}</label>
                    <select name="role" class="form-control" required>
                        <option value="user"  {{ old('role',$user->role)=='user'  ? 'selected':'' }}>👤 {{ __('app.role_regular_user') }}</option>
                        <option value="admin" {{ old('role',$user->role)=='admin' ? 'selected':'' }}>👑 {{ __('app.role_admin') }}</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">{{ __('app.new_password') }}</label>
                    <input type="password" name="password" class="form-control @error('password') is-error @enderror"
                        placeholder="{{ __('app.password_leave_empty') }}">
                    @error('password')<span class="form-error">{{ $message }}</span>@enderror
                    <span style="font-size:.8125rem;color:var(--gray-500);margin-top:.375rem;display:block">
                        <i class="fas fa-info-circle"></i> {{ __('app.password_keep_hint') }}
                    </span>
                </div>
                <div class="form-group">
                    <label class="form-label" style="opacity:0">.</label>
                    <div class="form-check" style="margin-top:.5rem">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', $user->is_active) ? 'checked':'' }}>
                        <label for="is_active">{{ __('app.active_account') }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="card" style="margin-top:1.5rem">
        <div class="card-body">
            <div class="user-meta-grid">
                <div class="meta-item">
                    <i class="fas fa-calendar-alt"></i>
                    <div>
                        <span class="meta-label">{{ __('app.registration_date') }}</span>
                        <span class="meta-value">{{ $user->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <span class="meta-label">{{ __('app.last_updated') }}</span>
                        <span class="meta-value">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
                <div class="meta-item">
                    <i class="fas fa-shield-alt"></i>
                    <div>
                        <span class="meta-label">{{ __('app.current_role') }}</span>
                        <span class="meta-value">{{ $user->role === 'admin' ? '👑 ' . __('app.role_admin') : '👤 ' . __('app.role_user') }}</span>
                    </div>
                </div>
                <div class="meta-item">
                    <i class="fas fa-circle" style="color:{{ $user->is_active ? 'var(--success)' : 'var(--error)' }}"></i>
                    <div>
                        <span class="meta-label">{{ __('app.status') }}</span>
                        <span class="meta-value">{{ $user->is_active ? __('app.active') : __('app.inactive') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="btn-group" style="margin-top:1.5rem">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> {{ __('app.save_changes') }}
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

.user-avatar-lg {
    width: 60px; height: 60px;
    background: var(--secondary-blue);
    color: var(--primary-blue);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; font-weight: 700;
    flex-shrink: 0;
}
.user-avatar-lg.admin { background: #E9D5FF; color: #9333EA; }

.user-meta-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: .75rem;
    color: var(--primary-blue);
}

.meta-item > div {
    display: flex;
    flex-direction: column;
}

.meta-label {
    font-size: .75rem;
    color: var(--gray-500);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .5px;
}

.meta-value {
    font-size: .9375rem;
    color: var(--gray-900);
    font-weight: 600;
}

@media (max-width: 768px) {
    .form-row { grid-template-columns: 1fr; }
    .user-meta-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>
@endpush
