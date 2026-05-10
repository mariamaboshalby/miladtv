@extends('admin.layouts.app')

@section('title', 'إضافة منتج')
@section('page-title', 'إضافة منتج جديد')
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i>
    <a href="{{ route('admin.products.index') }}">المنتجات</a>
    <i class="fas fa-chevron-left"></i>
    <span>إضافة</span>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.products.store') }}">
    @csrf
    <div class="form-layout">

        <!-- Main Column -->
        <div class="form-main">
            <div class="card" style="margin-bottom:1.5rem">
                <div class="card-header"><h2><i class="fas fa-info-circle" style="color:var(--primary-blue);margin-left:.5rem"></i> معلومات المنتج</h2></div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">اسم المنتج</label>
                            <input type="text" name="name" class="form-control @error('name') is-error @enderror"
                                value="{{ old('name') }}" placeholder="مثال: طابعة HP LaserJet Pro M404n" required>
                            @error('name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label required">الماركة</label>
                            <input type="text" name="brand" class="form-control @error('brand') is-error @enderror"
                                value="{{ old('brand') }}" placeholder="مثال: HP" required>
                            @error('brand')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label required">الوصف</label>
                        <textarea name="description" class="form-control @error('description') is-error @enderror"
                            rows="4" placeholder="وصف تفصيلي للمنتج..." required>{{ old('description') }}</textarea>
                        @error('description')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Specs -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-list-ul" style="color:var(--primary-blue);margin-left:.5rem"></i> المواصفات</h2>
                    <button type="button" id="addSpecBtn" class="btn btn-secondary btn-sm">
                        <i class="fas fa-plus"></i> إضافة مواصفة
                    </button>
                </div>
                <div class="card-body">
                    <div id="specsContainer">
                        <div class="spec-row">
                            <input type="text" name="specs[]" class="form-control" placeholder="مثال: السرعة: 40 صفحة/دقيقة">
                            <button type="button" class="btn btn-danger btn-sm remove-spec"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Column -->
        <div class="form-side">
            <div class="card" style="margin-bottom:1.5rem">
                <div class="card-header"><h2><i class="fas fa-tag" style="color:var(--primary-blue);margin-left:.5rem"></i> التصنيف والسعر</h2></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label required">الفئة</label>
                        <select name="category" class="form-control" required>
                            <option value="">اختر الفئة</option>
                            <option value="printers"   {{ old('category')=='printers'   ? 'selected':'' }}>🖨️ الطابعات</option>
                            <option value="mice"       {{ old('category')=='mice'       ? 'selected':'' }}>🖱️ الماوسات</option>
                            <option value="headphones" {{ old('category')=='headphones' ? 'selected':'' }}>🎧 السماعات</option>
                            <option value="flash"      {{ old('category')=='flash'      ? 'selected':'' }}>💾 الفلاشات</option>
                        </select>
                        @error('category')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">السعر (جنيه)</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" min="0" step="0.01" required>
                            @error('price')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">السعر القديم</label>
                            <input type="number" name="old_price" class="form-control" value="{{ old('old_price') }}" min="0" step="0.01">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">المخزون</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" min="0" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label required">التقييم</label>
                            <select name="rating" class="form-control">
                                @for($i=5;$i>=1;$i--)
                                <option value="{{ $i }}" {{ old('rating',5)==$i ? 'selected':'' }}>
                                    {{ str_repeat('⭐', $i) }} ({{ $i }})
                                </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom:1.5rem">
                <div class="card-header"><h2><i class="fas fa-certificate" style="color:var(--primary-blue);margin-left:.5rem"></i> الشارة</h2></div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">نص الشارة</label>
                        <input type="text" name="badge" class="form-control" value="{{ old('badge') }}" placeholder="مثال: جديد، خصم، مميز">
                    </div>
                    <div class="form-group">
                        <label class="form-label">لون الشارة</label>
                        <select name="badge_color" class="form-control">
                            <option value="">بدون لون</option>
                            <option value="blue"   {{ old('badge_color')=='blue'   ? 'selected':'' }}>🔵 أزرق</option>
                            <option value="green"  {{ old('badge_color')=='green'  ? 'selected':'' }}>🟢 أخضر</option>
                            <option value="red"    {{ old('badge_color')=='red'    ? 'selected':'' }}>🔴 أحمر</option>
                            <option value="orange" {{ old('badge_color')=='orange' ? 'selected':'' }}>🟠 برتقالي</option>
                            <option value="purple" {{ old('badge_color')=='purple' ? 'selected':'' }}>🟣 بنفسجي</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2><i class="fas fa-cog" style="color:var(--primary-blue);margin-left:.5rem"></i> الإعدادات</h2></div>
                <div class="card-body">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active">منتج نشط (يظهر في الموقع)</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="is_featured">منتج مميز (يظهر في الصفحة الرئيسية)</label>
                    </div>
                </div>
            </div>

            <div class="btn-group" style="margin-top:1.5rem">
                <button type="submit" class="btn btn-primary" style="flex:1">
                    <i class="fas fa-save"></i> حفظ المنتج
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> إلغاء
                </a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('styles')
<style>
.form-layout { display: grid; grid-template-columns: 1fr 380px; gap: 1.5rem; align-items: start; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.form-error { display: block; color: var(--error); font-size: .8125rem; margin-top: .375rem; }
.form-control.is-error { border-color: var(--error); }
.spec-row { display: flex; gap: .75rem; margin-bottom: .75rem; }
.spec-row .form-control { flex: 1; }
@media (max-width: 1024px) { .form-layout { grid-template-columns: 1fr; } }
@media (max-width: 640px) { .form-row { grid-template-columns: 1fr; } }
</style>
@endpush
