@php $d = $item ?? null; @endphp

@if($errors->any())
<div class="adm-alert adm-alert-error mb-3">
    <i class="fas fa-exclamation-circle"></i>
    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-semibold">{{ __('app.file_name') }} <span class="text-danger">*</span></label>
        <input type="text" name="title" value="{{ old('title', $d?->title) }}" class="form-control" required>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">{{ __('app.description') }}</label>
        <textarea name="description" rows="2" class="form-control">{{ old('description', $d?->description) }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">{{ __('app.category') }} <span class="text-danger">*</span></label>
        <select name="category" class="form-control" required>
            @foreach(['Drivers','Software','Manuals','Catalogues'] as $cat)
            <option value="{{ $cat }}" {{ old('category', $d?->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">{{ __('app.brand') }}</label>
        <input type="text" name="brand" value="{{ old('brand', $d?->brand) }}" class="form-control" placeholder="HP, Canon, Epson...">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">{{ __('app.version') }}</label>
        <input type="text" name="version" value="{{ old('version', $d?->version) }}" class="form-control" placeholder="1.0.0">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">{{ __('app.size') }}</label>
        <input type="text" name="size" value="{{ old('size', $d?->size) }}" class="form-control" placeholder="45 MB">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">{{ __('app.os') }}</label>
        <input type="text" name="os" value="{{ old('os', $d?->os) }}" class="form-control" placeholder="Windows 10/11, PDF...">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">{{ __('app.icon_fa') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas {{ old('icon', $d?->icon ?? 'fa-file') }}"></i></span>
            <input type="text" name="icon" value="{{ old('icon', $d?->icon ?? 'fa-file') }}" class="form-control" placeholder="fa-print">
        </div>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">{{ __('app.file_url') }}</label>
        <input type="url" name="file_url" value="{{ old('file_url', $d?->file_url) }}" class="form-control" placeholder="https://...">
    </div>

    {{-- Image Upload --}}
    <div class="col-12">
        <label class="form-label fw-semibold">{{ __('app.cover_image') }}</label>

        @if($d?->image)
        <div class="mb-2 d-flex align-items-center gap-3">
            <img src="{{ asset('storage/' . $d->image) }}" alt="cover"
                 style="width:90px;height:90px;object-fit:cover;border-radius:10px;border:2px solid #e2e8f0;">
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                    <label class="form-check-label text-danger" for="remove_image">
                        <i class="fas fa-trash-alt me-1"></i>{{ __('app.remove_image') }}
                    </label>
                </div>
                <small class="text-muted d-block mt-1">{{ __('app.upload_new_to_replace') }}</small>
            </div>
        </div>
        @endif

        <div class="upload-zone" id="downloadUploadZone">
            <i class="fas fa-cloud-upload-alt"></i>
            <p>{{ __('app.drag_image') }} <span>{{ __('app.click_to_select') }}</span></p>
            <small>{{ __('app.upload_limit_single') }}</small>
        </div>
        <input type="file" name="image" id="downloadImage"
               accept="image/jpeg,image/png,image/webp,image/gif"
               style="display:none">
        <div id="downloadImagePreview" style="display:none;margin-top:.75rem;position:relative;width:fit-content;">
            <img id="downloadImageThumb" src="" alt="preview"
                 style="width:120px;height:120px;object-fit:cover;border-radius:10px;border:2px solid #051836;">
            <button type="button" id="downloadImageRemove"
                    style="position:absolute;top:-8px;right:-8px;width:22px;height:22px;background:#EF4444;color:#fff;border:none;border-radius:50%;font-size:.65rem;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @error('image')<span class="text-danger" style="font-size:.8125rem">{{ $message }}</span>@enderror
    </div>
    <div class="col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $d?->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="is_active">{{ __('app.publish_file') }}</label>
        </div>
    </div>
</div>

@once
@push('styles')
<style>
/* ── Upload Zone ── */
.upload-zone {
    border: 2px dashed #CBD5E1;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all .25s ease;
    background: #F8FAFC;
}
.upload-zone:hover, .upload-zone.drag-over {
    border-color: #051836;
    background: #e8edf5;
}
.upload-zone i {
    font-size: 2rem;
    color: #94A3B8;
    display: block;
    margin-bottom: .5rem;
}
.upload-zone p {
    font-weight: 600;
    color: #475569;
    margin: 0 0 .2rem;
    font-size: .9375rem;
}
.upload-zone p span {
    color: #051836;
    text-decoration: underline;
}
.upload-zone small {
    color: #94A3B8;
    font-size: .8125rem;
}

/* ── Upload Progress Overlay ── */
#uploadProgressOverlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.55);
    backdrop-filter: blur(4px);
    z-index: 99999;
    align-items: center;
    justify-content: center;
}
#uploadProgressOverlay.active {
    display: flex;
}
.upload-progress-box {
    background: #fff;
    border-radius: 20px;
    padding: 2.5rem 2.5rem 2rem;
    width: 340px;
    max-width: 90vw;
    text-align: center;
    box-shadow: 0 25px 60px rgba(0,0,0,.25);
    animation: upBoxIn .3s cubic-bezier(.34,1.56,.64,1);
}
@keyframes upBoxIn {
    from { transform: scale(.85); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}
.upload-progress-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #051836, #60A5FA);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
    animation: iconPulse 1.5s ease-in-out infinite;
}
@keyframes iconPulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(37,99,235,.4); }
    50%       { box-shadow: 0 0 0 12px rgba(37,99,235,0); }
}
.upload-progress-icon i {
    font-size: 1.75rem;
    color: #fff;
}
.upload-progress-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #0F172A;
    margin-bottom: .35rem;
}
.upload-progress-sub {
    font-size: .875rem;
    color: #64748B;
    margin-bottom: 1.5rem;
}
.upload-progress-track {
    height: 10px;
    background: #E2E8F0;
    border-radius: 99px;
    overflow: hidden;
    margin-bottom: .75rem;
}
.upload-progress-fill {
    height: 100%;
    width: 0%;
    background: linear-gradient(90deg, #051836, #60A5FA);
    border-radius: 99px;
    transition: width .2s ease;
}
.upload-progress-pct {
    font-size: 1.5rem;
    font-weight: 800;
    color: #051836;
    line-height: 1;
    margin-bottom: .25rem;
}
.upload-progress-label {
    font-size: .8125rem;
    color: #94A3B8;
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    /* ── Image picker ── */
    const zone      = document.getElementById('downloadUploadZone');
    const input     = document.getElementById('downloadImage');
    const preview   = document.getElementById('downloadImagePreview');
    const thumb     = document.getElementById('downloadImageThumb');
    const removeBtn = document.getElementById('downloadImageRemove');

    if (!zone) return;

    zone.addEventListener('click', () => input.click());
    zone.addEventListener('dragover',  e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('drag-over');
        const file = e.dataTransfer.files[0];
        if (file) setFile(file);
    });
    input.addEventListener('change', function () {
        if (this.files[0]) setFile(this.files[0]);
    });
    removeBtn.addEventListener('click', function () {
        input.value = '';
        preview.style.display = 'none';
        thumb.src = '';
        zone.style.display = '';
    });

    function setFile(file) {
        if (!file.type.startsWith('image/')) { alert('الرجاء اختيار ملف صورة صالح'); return; }
        if (file.size > 2 * 1024 * 1024)    { alert('حجم الصورة يجب أن لا يتجاوز 2MB'); return; }
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        const reader = new FileReader();
        reader.onload = ev => {
            thumb.src = ev.target.result;
            preview.style.display = 'block';
            zone.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    /* ── Progress overlay ── */
    // Inject overlay HTML once
    const overlay = document.createElement('div');
    overlay.id = 'uploadProgressOverlay';
    overlay.innerHTML = `
        <div class="upload-progress-box">
            <div class="upload-progress-icon"><i class="fas fa-cloud-upload-alt"></i></div>
            <div class="upload-progress-title">جارٍ رفع الصورة...</div>
            <div class="upload-progress-sub">يرجى الانتظار، لا تغلق الصفحة</div>
            <div class="upload-progress-track">
                <div class="upload-progress-fill" id="upFill"></div>
            </div>
            <div class="upload-progress-pct" id="upPct">0%</div>
            <div class="upload-progress-label">جارٍ التحميل<span id="upDots"></span></div>
        </div>`;
    document.body.appendChild(overlay);

    const fill = document.getElementById('upFill');
    const pct  = document.getElementById('upPct');
    const dots = document.getElementById('upDots');

    // Animate dots
    let dotCount = 0;
    setInterval(() => {
        dotCount = (dotCount + 1) % 4;
        if (dots) dots.textContent = '.'.repeat(dotCount);
    }, 400);

    /* ── Form submit with XHR ── */
    const form = zone.closest('form');
    form.addEventListener('submit', function (e) {
        // Only intercept if there's an image to upload
        if (!input.files || input.files.length === 0) return;

        e.preventDefault();

        const fd = new FormData(form);

        const xhr = new XMLHttpRequest();

        // Show overlay
        overlay.classList.add('active');

        // Track upload progress
        xhr.upload.addEventListener('progress', function (ev) {
            if (!ev.lengthComputable) return;
            const percent = Math.round((ev.loaded / ev.total) * 100);
            fill.style.width = percent + '%';
            pct.textContent  = percent + '%';
        });

        xhr.addEventListener('load', function () {
            fill.style.width = '100%';
            pct.textContent  = '100%';

            // Small delay so user sees 100%
            setTimeout(() => {
                // Check if response contains a redirect meta or just navigate to response URL
                const finalUrl = xhr.responseURL;
                if (finalUrl && finalUrl !== window.location.href) {
                    window.location.href = finalUrl;
                } else {
                    // Re-render the returned HTML (validation errors etc.)
                    overlay.classList.remove('active');
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(xhr.responseText, 'text/html');
                    document.open();
                    document.write(doc.documentElement.outerHTML);
                    document.close();
                }
            }, 400);
        });

        xhr.addEventListener('error', function () {
            overlay.classList.remove('active');
            alert('حدث خطأ أثناء الرفع، يرجى المحاولة مرة أخرى');
        });

        xhr.open('POST', form.action);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send(fd);
    });
})();
</script>
@endpush
@endonce
