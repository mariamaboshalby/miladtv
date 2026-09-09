@extends('admin.layouts.app')
@section('title', __('app.new_category'))
@section('page-title', __('app.new_category'))
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i> <a href="{{ route('admin.categories.index') }}">{{ __('app.categories') }}</a>
    <i class="fas fa-chevron-left"></i> <span>{{ __('app.add') }}</span>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card" style="max-width:700px;margin:0 auto;">
        <div class="card-header">
            <h2>
                <i class="fas fa-folder-plus" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i>
                {{ __('app.new_category') }}
            </h2>
        </div>
        <div class="card-body">

            {{-- ── Parent selector ── --}}
            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label">
                    <i class="fas fa-sitemap" style="color:var(--primary);margin-inline-end:.4rem;"></i>
                    الفئة الأصل
                    <span class="text-muted" style="font-size:.8rem;">(اتركها فارغة لجعلها فئة رئيسية)</span>
                </label>
                <select name="parent_id" class="form-control @error('parent_id') is-error @enderror" id="parentSelect">
                    <option value="">— فئة رئيسية (بدون أصل)</option>
                    @foreach($parentOptions as $opt)
                        <option value="{{ $opt['id'] }}"
                            {{ old('parent_id', request('parent_id')) == $opt['id'] ? 'selected' : '' }}
                            style="padding-inline-start:{{ $opt['depth'] * 1.2 }}rem;">
                            {{ $opt['label'] }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')<span class="form-error">{{ $message }}</span>@enderror

                {{-- Live breadcrumb preview --}}
                <div id="parentPreview" style="display:none;margin-top:.5rem;padding:.45rem .75rem;background:#f1f5f9;border-radius:8px;font-size:.8rem;color:#475569;">
                    <i class="fas fa-map-marker-alt" style="color:var(--primary);margin-inline-end:.3rem;"></i>
                    <span id="parentPreviewText"></span>
                    <span style="color:#94a3b8;"> › <strong>الفئة الجديدة</strong></span>
                </div>
            </div>

            <hr style="margin:1.25rem 0;border-color:#f1f5f9;">

            {{-- ── Names ── --}}
            <div class="row g-3" style="margin-bottom:1.25rem">
                <div class="col-sm-6">
                    <label class="form-label required">{{ __('app.name_arabic') }}</label>
                    <input type="text" name="name_ar"
                           class="form-control @error('name_ar') is-error @enderror"
                           value="{{ old('name_ar') }}" required
                           placeholder="مثال: شاشات OLED">
                    @error('name_ar')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="col-sm-6">
                    <label class="form-label required">{{ __('app.name_english') }}</label>
                    <input type="text" name="name_en"
                           class="form-control @error('name_en') is-error @enderror"
                           value="{{ old('name_en') }}" required
                           placeholder="e.g. OLED Screens">
                    @error('name_en')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- ── Slug ── --}}
            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label required">{{ __('app.slug_label') }}</label>
                <input type="text" name="slug"
                       class="form-control @error('slug') is-error @enderror"
                       value="{{ old('slug') }}" required
                       placeholder="oled-screens">
                <small style="color:#64748b;font-size:.8125rem;">{{ __('app.slug_hint') }}</small>
                @error('slug')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            {{-- ── Description ── --}}
            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label">الوصف <span class="text-muted" style="font-size:.8rem;">(اختياري)</span></label>
                <textarea name="description" rows="2"
                          class="form-control @error('description') is-error @enderror"
                          placeholder="وصف مختصر للفئة يظهر في الأدمن...">{{ old('description') }}</textarea>
                @error('description')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            {{-- ── Icon + Sort Order ── --}}
            <div class="row g-3" style="margin-bottom:1.25rem">
                <div class="col-sm-8">
                    <label class="form-label">{{ __('app.icon') }} (FontAwesome)</label>
                    <div class="input-group">
                        <span class="input-group-text" id="iconPreview">
                            <i class="fas fa-{{ old('icon', 'tag') }}"></i>
                        </span>
                        <input type="text" name="icon" id="categoryIcon"
                               class="form-control @error('icon') is-error @enderror"
                               value="{{ old('icon', 'tag') }}"
                               placeholder="tv, tag, laptop...">
                    </div>
                    <small style="color:#64748b;font-size:.8125rem;">{{ __('app.icon_hint') }}</small>
                    @error('icon')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="col-sm-4">
                    <label class="form-label">ترتيب العرض</label>
                    <input type="number" name="sort_order"
                           class="form-control @error('sort_order') is-error @enderror"
                           value="{{ old('sort_order', 0) }}" min="0"
                           placeholder="0">
                    <small style="color:#64748b;font-size:.8125rem;">الأصغر يظهر أولاً</small>
                    @error('sort_order')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- ── Image Upload ── --}}
            <div class="form-group" style="margin-bottom:1.5rem">
                <label class="form-label">{{ app()->getLocale() === 'ar' ? 'صورة الفئة' : 'Category Image' }}</label>
                <div class="category-upload-zone" id="categoryUploadZone">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>{{ __('app.drag_image') }} <span>{{ __('app.click_to_select') }}</span></p>
                    <small>JPG, PNG, WEBP, GIF, SVG — Max 2MB</small>
                </div>
                <input type="file" name="image" id="categoryImageInput"
                       accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml"
                       style="display:none">
                <div id="categoryImagePreviewWrap" style="display:none;margin-top:.85rem;position:relative;width:fit-content;">
                    <img id="categoryImagePreview" src="" alt="preview"
                         style="width:130px;height:130px;object-fit:cover;border-radius:12px;border:2px solid var(--primary,#051836);box-shadow:0 4px 12px rgba(0,0,0,.08);">
                    <button type="button" id="categoryImageRemoveBtn"
                            style="position:absolute;top:-8px;right:-8px;width:26px;height:26px;background:#EF4444;color:#fff;border:none;border-radius:50%;font-size:.75rem;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,.2);">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @error('image')<span class="form-error" style="display:block;margin-top:.4rem">{{ $message }}</span>@enderror
            </div>

            {{-- ── Active ── --}}
            <div class="form-check" style="margin-bottom:1.5rem">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active">{{ __('app.active_category') }}</label>
            </div>

            {{-- ── Buttons ── --}}
            <div class="btn-group" style="margin-top:.5rem">
                <button type="submit" class="btn btn-primary" style="flex:1">
                    <i class="fas fa-save"></i> {{ __('app.save_category') }}
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> {{ __('app.cancel') }}
                </a>
            </div>

        </div>
    </div>
</form>

@push('styles')
<style>
.category-upload-zone {
    border:2px dashed #CBD5E1; border-radius:12px; padding:1.5rem 1rem;
    text-align:center; cursor:pointer; transition:all .25s; background:#F8FAFC;
}
.category-upload-zone:hover,.category-upload-zone.drag-over {
    border-color:var(--primary,#051836); background:#eef4ff;
}
.category-upload-zone i { font-size:2.25rem; color:#94A3B8; display:block; margin-bottom:.5rem; }
.category-upload-zone:hover i { color:var(--primary,#051836); }
.category-upload-zone p { font-weight:600; color:#475569; margin:0 0 .25rem; font-size:.9375rem; }
.category-upload-zone p span { color:var(--primary,#051836); text-decoration:underline; }
.category-upload-zone small { color:#94A3B8; font-size:.8125rem; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Icon preview ── */
    var iconInput   = document.getElementById('categoryIcon');
    var iconPreview = document.getElementById('iconPreview');
    if (iconInput) {
        iconInput.addEventListener('input', function () {
            var val = this.value.trim() || 'tag';
            iconPreview.innerHTML = '<i class="fas fa-' + val.replace(/^fa-/, '') + '"></i>';
        });
    }

    /* ── Parent breadcrumb preview ── */
    var parentSelect  = document.getElementById('parentSelect');
    var parentPreview = document.getElementById('parentPreview');
    var parentText    = document.getElementById('parentPreviewText');
    if (parentSelect) {
        function updateParentPreview() {
            var opt = parentSelect.options[parentSelect.selectedIndex];
            if (opt && opt.value) {
                parentText.textContent = opt.text.replace(/^[— ]+/, '').trim();
                parentPreview.style.display = 'block';
            } else {
                parentPreview.style.display = 'none';
            }
        }
        parentSelect.addEventListener('change', updateParentPreview);
        updateParentPreview();
    }

    /* ── Image upload ── */
    var zone       = document.getElementById('categoryUploadZone');
    var input      = document.getElementById('categoryImageInput');
    var previewWrap= document.getElementById('categoryImagePreviewWrap');
    var previewImg = document.getElementById('categoryImagePreview');
    var removeBtn  = document.getElementById('categoryImageRemoveBtn');

    if (zone && input) {
        zone.addEventListener('click', function () { input.click(); });
        zone.addEventListener('dragover', function (e) { e.preventDefault(); zone.classList.add('drag-over'); });
        zone.addEventListener('dragleave', function () { zone.classList.remove('drag-over'); });
        zone.addEventListener('drop', function (e) {
            e.preventDefault(); zone.classList.remove('drag-over');
            if (e.dataTransfer.files[0]) handleFile(e.dataTransfer.files[0]);
        });
        input.addEventListener('change', function () { if (this.files[0]) handleFile(this.files[0]); });
        removeBtn.addEventListener('click', function () {
            input.value = ''; previewWrap.style.display = 'none';
            previewImg.src = ''; zone.style.display = '';
        });

        function handleFile(file) {
            if (!file.type.startsWith('image/')) { alert('اختر ملف صورة صالح'); return; }
            if (file.size > 2 * 1024 * 1024) { alert('الحجم الأقصى 2MB'); return; }
            var dt = new DataTransfer(); dt.items.add(file); input.files = dt.files;
            var reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewWrap.style.display = 'block';
                zone.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    }
});
</script>
@endpush
@endsection
