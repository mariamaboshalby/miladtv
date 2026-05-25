@extends('admin.layouts.app')

@section('title', __('app.edit_product') . ': ' . $product->name)
@section('page-title', __('app.edit_product'))
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i>
    <a href="{{ route('admin.products.index') }}">{{ __('app.products') }}</a>
    <i class="fas fa-chevron-left"></i>
    <span>{{ __('app.edit') }}</span>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="form-layout">

        <!-- Main Column -->
        <div class="form-main">

            <div class="card" style="margin-bottom:1.5rem">
                <div class="card-header">
                    <h2><i class="fas fa-info-circle" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.product_info') }}</h2>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">{{ __('app.product_name') }}</label>
                            <input type="text" name="name" class="form-control @error('name') is-error @enderror"
                                value="{{ old('name', $product->name) }}" required>
                            @error('name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label required">{{ __('app.brand') }}</label>
                            <input type="text" name="brand" class="form-control @error('brand') is-error @enderror"
                                value="{{ old('brand', $product->brand) }}" required>
                            @error('brand')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label required">{{ __('app.description') }}</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Specs -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-list-ul" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.specs') }}</h2>
                    <button type="button" id="addSpecBtn" class="btn btn-secondary btn-sm">
                        <i class="fas fa-plus"></i> {{ __('app.add') }}
                    </button>
                </div>
                <div class="card-body">
                    <div id="specsContainer">
                        @if($product->specs)
                            @foreach($product->specs as $spec)
                            <div class="spec-row">
                                <input type="text" name="specs[]" class="form-control" value="{{ $spec }}">
                                <button type="button" class="btn btn-danger btn-sm remove-spec"><i class="fas fa-trash"></i></button>
                            </div>
                            @endforeach
                        @else
                        <div class="spec-row">
                            <input type="text" name="specs[]" class="form-control">
                            <button type="button" class="btn btn-danger btn-sm remove-spec"><i class="fas fa-trash"></i></button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- Side Column -->
        <div class="form-side">

            <!-- Images -->
            <div class="card" style="margin-bottom:1.5rem">
                <div class="card-header">
                    <h2><i class="fas fa-images" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.product_images') }}</h2>
                    <span style="font-size:.8125rem;color:#64748B">{{ $product->getMedia('product-images')->count() }} {{ __('app.images_count') }}</span>
                </div>
                <div class="card-body">

                    @if($product->hasMedia('product-images'))
                    <div class="img-gallery" style="margin-bottom:1rem">
                        @foreach($product->getMedia('product-images') as $media)
                        <div class="gallery-item" id="media-{{ $media->id }}">
                            <img src="{{ '/storage/' . ltrim($media->getPathRelativeToRoot('thumb'), '/') }}" alt="{{ $product->name }}">
                            <span class="gallery-item-order">{{ $loop->iteration }}</span>
                            <button type="button" class="gallery-item-remove" onclick="markDelete({{ $media->id }})">
                                <i class="fas fa-times"></i>
                            </button>
                            <input type="hidden" name="delete_media[]" id="del-{{ $media->id }}" disabled value="{{ $media->id }}">
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="multi-upload-zone" id="multiUploadZone">
                        <i class="fas fa-plus-circle"></i>
                        <p>{{ __('app.add_new_images') }} — <span>{{ __('app.click_or_drag') }}</span></p>
                        <small>{{ __('app.image_limits') }}</small>
                    </div>
                    <input type="file" name="images[]" id="productImages"
                           accept="image/jpeg,image/png,image/webp"
                           multiple
                           style="display:block;width:100%;margin-top:.75rem;padding:.5rem;border:1px solid #E2E8F0;border-radius:8px;font-family:inherit;font-size:.875rem">
                    <div class="img-gallery" id="imgGallery"></div>
                    @error('images.*')<span class="form-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Category & Price -->
            <div class="card" style="margin-bottom:1.5rem">
                <div class="card-header">
                    <h2><i class="fas fa-tag" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.category_and_price') }}</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label required">{{ __('app.category') }}</label>
                        <select name="category" class="form-control" required>
                            <option value="">{{ __('app.select_category') }}</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ old('category', $product->category) == $cat->slug ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? $cat->name_ar : $cat->name_en }}
                            </option>
                            @endforeach
                        </select>
                        @error('category')<span class="form-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">{{ __('app.price') }}</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" min="0" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('app.old_price') }}</label>
                            <input type="number" name="old_price" class="form-control" value="{{ old('old_price', $product->old_price) }}" min="0" step="0.01">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">{{ __('app.stock') }}</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label required">{{ __('app.rating') }}</label>
                            <select name="rating" class="form-control">
                                @for($i=5;$i>=1;$i--)
                                <option value="{{ $i }}" {{ old('rating',$product->rating)==$i ? 'selected':'' }}>{{ str_repeat('⭐',$i) }} ({{ $i }})</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Badge -->
            <div class="card" style="margin-bottom:1.5rem">
                <div class="card-header">
                    <h2><i class="fas fa-certificate" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.badge') }}</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">{{ __('app.badge_text') }}</label>
                        <input type="text" name="badge" class="form-control" value="{{ old('badge', $product->badge) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ __('app.badge_color') }}</label>
                        <select name="badge_color" class="form-control">
                            <option value="">{{ __('app.no_color') }}</option>
                            @foreach(['blue'=>'blue','green'=>'green','red'=>'red','orange'=>'orange','purple'=>'purple'] as $val => $key)
                            <option value="{{ $val }}" {{ old('badge_color',$product->badge_color)==$val ? 'selected':'' }}>{{ __('app.' . $key) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-cog" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.product_settings') }}</h2>
                </div>
                <div class="card-body">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked':'' }}>
                        <label for="is_active">{{ __('app.active_product') }}</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked':'' }}>
                        <label for="is_featured">{{ __('app.featured_product') }}</label>
                    </div>
                </div>
            </div>

            <div class="btn-group" style="margin-top:1.5rem">
                <button type="submit" class="btn btn-primary" style="flex:1">
                    <i class="fas fa-save"></i> {{ __('app.save') }}
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> {{ __('app.cancel') }}
                </a>
            </div>

        </div>
    </div>
</form>
@endsection

@push('styles')
<style>
.form-layout { display:grid; grid-template-columns:1fr 380px; gap:1.5rem; align-items:start; }
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
.form-error { display:block; color:#EF4444; font-size:.8125rem; margin-top:.375rem; }
.form-control.is-error { border-color:#EF4444; }
.spec-row { display:flex; gap:.75rem; margin-bottom:.75rem; }
.spec-row .form-control { flex:1; }

.multi-upload-zone {
    border:2px dashed #CBD5E1; border-radius:14px; padding:1.5rem;
    text-align:center; cursor:pointer; transition:all .25s ease; background:#F8FAFC;
}
.multi-upload-zone:hover, .multi-upload-zone.drag-over { border-color:#2563EB; background:#EFF6FF; }
.multi-upload-zone i { font-size:2rem; color:#94A3B8; display:block; margin-bottom:.5rem; }
.multi-upload-zone p { font-weight:600; color:#475569; margin:0 0 .25rem; font-size:.9375rem; }
.multi-upload-zone p span { color:#2563EB; text-decoration:underline; }
.multi-upload-zone small { color:#94A3B8; font-size:.8125rem; }

.img-gallery { display:grid; grid-template-columns:repeat(auto-fill,minmax(100px,1fr)); gap:.75rem; margin-top:.75rem; }
.gallery-item {
    position:relative; border-radius:10px; overflow:hidden;
    aspect-ratio:1; background:#F1F5F9; border:2px solid #E2E8F0;
}
.gallery-item:first-child { border-color:#2563EB; }
.gallery-item:first-child::after {
    content:'رئيسية'; position:absolute; bottom:0; left:0; right:0;
    background:rgba(37,99,235,.85); color:#fff; font-size:.625rem;
    font-weight:700; text-align:center; padding:.2rem;
}
.gallery-item.marked-delete { opacity:.35; border-color:#EF4444; }
.gallery-item.marked-delete::after { content:'سيُحذف'; background:rgba(239,68,68,.85); }
.gallery-item img { width:100%; height:100%; object-fit:cover; }
.gallery-item-remove {
    position:absolute; top:.3rem; left:.3rem;
    width:22px; height:22px; background:rgba(239,68,68,.9); color:#fff;
    border-radius:50%; display:flex; align-items:center; justify-content:center;
    font-size:.625rem; cursor:pointer; transition:all .2s ease; z-index:2; border:none;
}
.gallery-item-remove:hover { background:#DC2626; transform:scale(1.1); }
.gallery-item-order {
    position:absolute; top:.3rem; right:.3rem;
    width:20px; height:20px; background:rgba(0,0,0,.5); color:#fff;
    border-radius:50%; display:flex; align-items:center; justify-content:center;
    font-size:.625rem; font-weight:700;
}

@media (max-width:1024px) { .form-layout { grid-template-columns:1fr; } }
@media (max-width:640px) { .form-row { grid-template-columns:1fr; } }
</style>
@endpush

@push('scripts')
<script>
function markDelete(id) {
    const item  = document.getElementById('media-' + id);
    const input = document.getElementById('del-' + id);
    if (item.classList.contains('marked-delete')) {
        item.classList.remove('marked-delete');
        input.disabled = true;
    } else {
        item.classList.add('marked-delete');
        input.disabled = false;
    }
}

(function() {
    const zone    = document.getElementById('multiUploadZone');
    const input   = document.getElementById('productImages');
    const gallery = document.getElementById('imgGallery');
    let files = [];

    zone.addEventListener('click', () => input.click());
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
        e.preventDefault(); zone.classList.remove('drag-over');
        addFiles(Array.from(e.dataTransfer.files));
    });
    input.addEventListener('change', function() {
        const selected = Array.from(this.files);
        this.value = ''; // Clear before syncInput to avoid clearing the synced files
        addFiles(selected);
    });

    function addFiles(newFiles) {
        newFiles.forEach(file => {
            if (!file.type.startsWith('image/')) return;
            if (file.size > 50 * 1024 * 1024) { alert(file.name + ' أكبر من 50MB'); return; }
            files.push(file);
        });
        renderGallery(); syncInput();
    }

    function renderGallery() {
        gallery.innerHTML = '';
        files.forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = e => {
                const item = document.createElement('div');
                item.className = 'gallery-item';
                item.innerHTML = `
                    <img src="${e.target.result}" alt="">
                    <span class="gallery-item-order">${idx + 1}</span>
                    <button type="button" class="gallery-item-remove" onclick="removeNewFile(${idx})">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                gallery.appendChild(item);
            };
            reader.readAsDataURL(file);
        });
    }

    window.removeNewFile = function(idx) {
        files.splice(idx, 1); renderGallery(); syncInput();
    };

    function syncInput() {
        const dt = new DataTransfer();
        files.forEach(f => dt.items.add(f));
        input.files = dt.files;
    }
})();
</script>
@endpush
