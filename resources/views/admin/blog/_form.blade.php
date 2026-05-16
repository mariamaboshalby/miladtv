@php $p = $post ?? null; @endphp

@if($errors->any())
<div class="adm-alert adm-alert-error mb-3">
    <i class="fas fa-exclamation-circle"></i>
    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">{{ __('app.title_en') }} <span class="text-danger">*</span></label>
        <input type="text" name="title" value="{{ old('title', $p?->title) }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">{{ __('app.title_ar') }}</label>
        <input type="text" name="title_ar" value="{{ old('title_ar', $p?->title_ar) }}" class="form-control" dir="rtl">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">{{ __('app.category') }} <span class="text-danger">*</span></label>
        <input type="text" name="category" value="{{ old('category', $p?->category) }}" class="form-control" placeholder="Reviews, Tips, Maintenance..." required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">{{ __('app.author') }} <span class="text-danger">*</span></label>
        <input type="text" name="author" value="{{ old('author', $p?->author) }}" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">{{ __('app.author_role') }}</label>
        <input type="text" name="author_role" value="{{ old('author_role', $p?->author_role) }}" class="form-control">
    </div>
    <div class="col-md-2">
        <label class="form-label fw-semibold">{{ __('app.read_time_min') }}</label>
        <input type="number" name="read_time" value="{{ old('read_time', $p?->read_time ?? 5) }}" class="form-control" min="1">
    </div>
    <div class="col-md-2">
        <label class="form-label fw-semibold">{{ __('app.publish_date') }}</label>
        <input type="date" name="published_at" value="{{ old('published_at', $p?->published_at?->format('Y-m-d')) }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">{{ __('app.tags_comma') }}</label>
        <input type="text" name="tags" value="{{ old('tags', $p ? implode(', ', $p->tags ?? []) : '') }}" class="form-control" placeholder="Printers, Tips, Review">
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">{{ __('app.excerpt_en') }} <span class="text-danger">*</span></label>
        <textarea name="excerpt" rows="2" class="form-control" required>{{ old('excerpt', $p?->excerpt) }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">{{ __('app.excerpt_ar') }}</label>
        <textarea name="excerpt_ar" rows="2" class="form-control" dir="rtl">{{ old('excerpt_ar', $p?->excerpt_ar) }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">{{ __('app.content_en') }} <span class="text-danger">*</span></label>
        <textarea name="content" rows="6" class="form-control" required>{{ old('content', $p?->content) }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">{{ __('app.content_ar') }}</label>
        <textarea name="content_ar" rows="6" class="form-control" dir="rtl">{{ old('content_ar', $p?->content_ar) }}</textarea>
    </div>
    <div class="col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $p?->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="is_active">{{ __('app.publish_post') }}</label>
        </div>
    </div>
</div>
