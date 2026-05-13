﻿@extends('layouts.app')

@section('title', 'Latest News - MJK')

@section('content')

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 100%);padding:2.5rem 0;">
    <div class="container">
        <h1 class="text-white fw-bold mb-1">Latest News</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white-50">News</li>
            </ol>
        </nav>
    </div>
</div>

{{-- News Grid --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            @foreach($news as $item)
            <div class="col-lg-4 col-md-6">
                <article class="news-card card h-100 border-0 shadow-sm">
                    {{-- Image area --}}
                    <div class="news-img-area position-relative">
                        <div class="news-placeholder d-flex align-items-center justify-content-center">
                            <i class="fas fa-newspaper text-secondary opacity-25" style="font-size:4rem;"></i>
                        </div>
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2" style="border-radius:50px;font-size:.8rem;">
                            {{ $item['category'] }}
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        {{-- Meta --}}
                        <div class="d-flex gap-3 text-muted mb-3" style="font-size:.8125rem;">
                            <span><i class="fas fa-calendar-alt text-primary me-1"></i>{{ \Carbon\Carbon::parse($item['date'])->format('d M Y') }}</span>
                            <span><i class="fas fa-eye text-primary me-1"></i>{{ number_format($item['views']) }}</span>
                        </div>

                        {{-- Title --}}
                        <h5 class="fw-bold text-dark news-title mb-2">{{ $item['title'] }}</h5>

                        {{-- Excerpt --}}
                        <p class="text-secondary news-excerpt flex-grow-1 mb-3" style="font-size:.9375rem;">{{ $item['excerpt'] }}</p>

                        {{-- Read More --}}
                        <a href="{{ route('news.show', $item['id']) }}" class="btn btn-outline-primary btn-sm align-self-start px-4">
                            Read More <i class="fas fa-arrow-right ms-1"></i>
                        </a>
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
.news-card {
    border-radius: 16px !important;
    overflow: hidden;
    transition: all .3s ease;
    border-top: 3px solid #2563eb !important;
}

.news-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 48px rgba(0,0,0,.12) !important;
}

.news-img-area {
    height: 200px;
    background: #f1f5f9;
}

.news-placeholder {
    width: 100%;
    height: 100%;
}

.news-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
}

.news-excerpt {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.7;
}

.news-card:hover .news-title {
    color: #2563eb !important;
}
</style>
@endpush
