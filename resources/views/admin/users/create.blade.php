@extends('admin.layouts.app')

@section('title', 'إضافة مستخدم')
@section('page-title', 'إضافة مستخدم جديد')
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i>
    <a href="{{ route('admin.users.index') }}">المستخدمون</a>
    <i class="fas fa-chevron-left"></i>
    <span>إضافة</span>
@endsection

@section('content')
<div class="form-center">
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-user-plus" style="color:var(--primary-blue);margin-left:.5rem"></i> بيانات المستخدم</h2>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">الاسم الكامل</label>
                    <input type="text" name="name" class="form-control @error('name') is-error @enderror"
                        value="{{ old('name') }}" placeholder="مثال: أحمد محمد" required>
                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label required">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control @error('email') is-error @enderror"
                        value="{{ old('email') }}" placeholder="example@email.com" required>
                    @error('email')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-error @enderror"
                        value="{{ old('phone') }}" placeholder="01xxxxxxxxx">
                    @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label required">الدور</label>
                    <select name="role" class="form-control" required>
                        <option value="user"  {{ old('role','user')=='user'  ? 'selected':'' }}>👤 مستخدم عادي</option>
                        <option value="admin" {{ old('role')=='admin' ? 'selected':'' }}>👑 مدير</option>
                    </select>
                    @error('role')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">كلمة المرور</label>
                    <input type="password" name="password" class="form-control @error('password') is-error @enderror"
                        placeholder="8 أحرف على الأقل" required>
                    @error('password')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" style="opacity:0">.</label>
                    <div class="form-check" style="margin-top:.5rem">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active',true) ? 'checked':'' }}>
                        <label for="is_active">حساب نشط</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="btn-group" style="margin-top:1.5rem">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> حفظ المستخدم
        </button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> إلغاء
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
