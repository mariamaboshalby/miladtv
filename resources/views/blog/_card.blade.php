<article class="blog-card card h-100 border-0 shadow-sm">
    <div class="blog-header-area position-relative">
        <div class="blog-gradient-bg d-flex align-items-center justify-content-center">
            <i class="fas fa-pen-nib text-white opacity-25" style="font-size:3.5rem;"></i>
        </div>
        <div class="position-absolute top-0 start-0 m-3">
            <span class="blog-cat-badge">{{ $post->category }}</span>
        </div>
        <div class="position-absolute top-0 end-0 m-3 d-flex align-items-center gap-1 text-white-50" style="font-size:.75rem;">
            <i class="fas fa-eye"></i> {{ number_format($post->views) }}
        </div>
    </div>

    <div class="card-body d-flex flex-column p-4">
        <div class="d-flex flex-wrap gap-3 text-muted mb-3" style="font-size:.8125rem;">
            <span><i class="fas fa-calendar-alt text-primary me-1"></i>{{ $post->published_at?->format('d M Y') }}</span>
            <span><i class="fas fa-user text-primary me-1"></i>{{ $post->author }}</span>
            <span><i class="fas fa-clock text-primary me-1"></i>{{ $post->read_time }} {{ __('app.home_blog_min_read') }}</span>
        </div>

        <h5 class="fw-bold text-dark blog-title mb-2">{{ $post->getLocalTitle() }}</h5>
        <p class="text-secondary blog-excerpt flex-grow-1 mb-3" style="font-size:.9375rem;">{{ $post->getLocalExcerpt() }}</p>

        <div class="d-flex align-items-center justify-content-between gap-2 pt-3 border-top flex-wrap">
            <div class="d-flex gap-2 flex-wrap">
                @foreach(($post->tags ?? []) as $tag)
                <span class="blog-tag">{{ $tag }}</span>
                @endforeach
            </div>
            <a href="{{ route('blog.show', $post->id) }}" class="text-primary fw-bold text-decoration-none" style="font-size:.9375rem;white-space:nowrap;">
                {{ __('app.home_blog_read_more') }} <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</article>
