﻿@extends('layouts.app')
@section('title', 'Blog - MJK')

@section('content')

<div style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 100%);padding:2.5rem 0;">
    <div class="container">
        <h1 class="text-white fw-bold mb-1">{{ __('app.nav_blog') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">{{ __('app.nav_home') }}</a></li>
                <li class="breadcrumb-item active text-white-50">{{ __('app.nav_blog') }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-lg-6">
                <article class="blog-card card h-100 border-0 shadow-sm">
                    <div class="blog-header-area position-relative">
                        <div class="blog-gradient-bg d-flex align-items-center justify-content-center">
                            <i class="fas fa-pen-nib text-white opacity-25" style="font-size:4rem;"></i>
                        </div>
                        <span class="badge bg-white text-primary position-absolute top-0 start-0 m-3 px-3 py-2 fw-bold" style="border-radius:50px;font-size:.8rem;">
                            {{ $post->category }}
                        </span>
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
                                <span class="badge bg-light text-secondary border" style="border-radius:50px;font-size:.75rem;font-weight:600;">{{ $tag }}</span>
                                @endforeach
                            </div>
                            <a href="{{ route('blog.show', $post->id) }}" class="text-primary fw-bold text-decoration-none blog-read-more" style="font-size:.9375rem;white-space:nowrap;">
                                {{ __('app.home_blog_read_more') }} <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.blog-card { border-radius:16px !important; overflow:hidden; transition:all .3s ease; }
.blog-card:hover { transform:translateY(-6px); box-shadow:0 16px 48px rgba(0,0,0,.12) !important; }
.blog-header-area { height:220px; }
.blog-gradient-bg { width:100%; height:100%; background:linear-gradient(135deg,#1e3a8a 0%,#2563eb 100%); }
.blog-title { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; line-height:1.4; }
.blog-excerpt { display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden; line-height:1.7; }
.blog-card:hover .blog-title { color:#2563eb !important; }
</style>
@endpush
