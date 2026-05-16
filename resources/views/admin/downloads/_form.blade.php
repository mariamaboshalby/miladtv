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
    <div class="col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $d?->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="is_active">{{ __('app.publish_file') }}</label>
        </div>
    </div>
</div>
