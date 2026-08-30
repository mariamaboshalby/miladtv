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
    <div class="card" style="max-width: 650px; margin: 0 auto;">
        <div class="card-header">
            <h2><i class="fas fa-folder-plus" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.new_category') }}</h2>
        </div>
        <div class="card-body">
            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label required">{{ __('app.name_arabic') }}</label>
                <input type="text" name="name_ar" class="form-control @error('name_ar') is-error @enderror" value="{{ old('name_ar') }}" required placeholder="مثال: شاشات التلفزيون">
                @error('name_ar')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label required">{{ __('app.name_english') }}</label>
                <input type="text" name="name_en" class="form-control @error('name_en') is-error @enderror" value="{{ old('name_en') }}" required placeholder="e.g. TV Screens">
                @error('name_en')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label required">{{ __('app.slug_label') }}</label>
                <input type="text" name="slug" class="form-control @error('slug') is-error @enderror" value="{{ old('slug') }}" required placeholder="tv-screens">
                <small style="color:#64748b;font-size:.8125rem">{{ __('app.slug_hint') }}</small>
                @error('slug')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="margin-bottom:1.25rem">
                <label class="form-label">{{ __('app.icon') }} (FontAwesome)</label>
                <div class="input-group">
                    <span class="input-group-text" id="iconPreview"><i class="fas fa-{{ old('icon', 'tag') }}"></i></span>
                    <input type="text" name="icon" id="categoryIcon" class="form-control @error('icon') is-error @enderror" value="{{ old('icon', 'tag') }}" placeholder="tv, tag, laptop...">
                </div>
                <small style="color:#64748b;font-size:.8125rem">{{ __('app.icon_hint') }}</small>
                @error('icon')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            {{-- Category Image Upload --}}
            <div class="form-group" style="margin-bottom:1.5rem">
                <label class="form-label">{{ app()->getLocale() === 'ar' ? 'صورة الفئة' : 'Category Image' }}</label>
                
                <div class="category-upload-zone" id="categoryUploadZone">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>{{ __('app.drag_image') }} <span>{{ __('app.click_to_select') }}</span></p>
                    <small>{{ __('app.upload_limit_single') }} (JPG, PNG, WEBP, GIF, SVG — Max 2MB)</small>
                </div>
                
                <input type="file" name="image" id="categoryImageInput" accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml" style="display:none">
                
                <div id="categoryImagePreviewWrap" style="display:none;margin-top:.85rem;position:relative;width:fit-content;">
                    <img id="categoryImagePreview" src="" alt="preview" style="width:130px;height:130px;object-fit:cover;border-radius:12px;border:2px solid var(--primary, #051836);box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                    <button type="button" id="categoryImageRemoveBtn" title="{{ __('app.remove_image') }}" style="position:absolute;top:-8px;right:-8px;width:26px;height:26px;background:#EF4444;color:#fff;border:none;border-radius:50%;font-size:.75rem;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,0.2);">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @error('image')<span class="form-error" style="display:block;margin-top:.4rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-check" style="margin-bottom:1.5rem">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active">{{ __('app.active_category') }}</label>
            </div>

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
    border: 2px dashed #CBD5E1;
    border-radius: 12px;
    padding: 1.5rem 1rem;
    text-align: center;
    cursor: pointer;
    transition: all .25s ease;
    background: #F8FAFC;
}
.category-upload-zone:hover, .category-upload-zone.drag-over {
    border-color: var(--primary, #051836);
    background: #eef4ff;
}
.category-upload-zone i {
    font-size: 2.25rem;
    color: #94A3B8;
    display: block;
    margin-bottom: .5rem;
    transition: color .2s;
}
.category-upload-zone:hover i {
    color: var(--primary, #051836);
}
.category-upload-zone p {
    font-weight: 600;
    color: #475569;
    margin: 0 0 .25rem;
    font-size: .9375rem;
}
.category-upload-zone p span {
    color: var(--primary, #051836);
    text-decoration: underline;
}
.category-upload-zone small {
    color: #94A3B8;
    font-size: .8125rem;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Dynamic icon preview
    const iconInput = document.getElementById('categoryIcon');
    const iconPreview = document.getElementById('iconPreview');
    if (iconInput && iconPreview) {
        iconInput.addEventListener('input', function () {
            const val = this.value.trim() || 'tag';
            iconPreview.innerHTML = '<i class="fas fa-' + val.replace(/^fa-/, '') + '"></i>';
        });
    }

    // Image upload zone & preview
    const zone = document.getElementById('categoryUploadZone');
    const input = document.getElementById('categoryImageInput');
    const previewWrap = document.getElementById('categoryImagePreviewWrap');
    const previewImg = document.getElementById('categoryImagePreview');
    const removeBtn = document.getElementById('categoryImageRemoveBtn');

    if (zone && input) {
        zone.addEventListener('click', () => input.click());

        zone.addEventListener('dragover', (e) => {
            e.preventDefault();
            zone.classList.add('drag-over');
        });

        zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));

        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('drag-over');
            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                handleFile(e.dataTransfer.files[0]);
            }
        });

        input.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                handleFile(this.files[0]);
            }
        });

        removeBtn.addEventListener('click', function () {
            input.value = '';
            previewWrap.style.display = 'none';
            previewImg.src = '';
            zone.style.display = '';
        });

        function handleFile(file) {
            if (!file.type.startsWith('image/')) {
                alert('الرجاء اختيار ملف صورة صالح (JPG, PNG, WEBP, GIF, SVG)');
                return;
            }
            if (file.size > 2 * 1024 * 1024) {
                alert('حجم الصورة يجب أن لا يتجاوز 2MB');
                return;
            }

            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;

            const reader = new FileReader();
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
