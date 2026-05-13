﻿@extends('layouts.app')

@section('title', $item['title'] . ' - MJK')

@section('content')

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 100%);padding:2.5rem 0;">
    <div class="container">
        <h1 class="text-white fw-bold mb-1">{{ Str::limit($item['title'], 60) }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}" class="text-white-50 text-decoration-none">News</a></li>
                <li class="breadcrumb-item active text-white-50">Article</li>
            </ol>
        </nav>
    </div>
</div>

{{-- Article Layout --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">

            {{-- Main Article --}}
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm" style="border-radius:16px;">
                    {{-- Image --}}
                    <div class="article-img-area">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="fas fa-newspaper text-secondary opacity-25" style="font-size:6rem;"></i>
                        </div>
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        {{-- Meta --}}
                        <div class="d-flex flex-wrap gap-3 mb-3" style="font-size:.9375rem;">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2" style="border-radius:50px;">{{ $item['category'] }}</span>
                            <span class="text-muted"><i class="fas fa-calendar-alt text-primary me-1"></i>{{ \Carbon\Carbon::parse($item['date'])->format('d M Y') }}</span>
                            <span class="text-muted"><i class="fas fa-user text-primary me-1"></i>{{ $item['author'] }}</span>
                            <span class="text-muted"><i class="fas fa-eye text-primary me-1"></i>{{ number_format($item['views']) }}</span>
                        </div>

                        {{-- Title --}}
                        <h1 class="fw-bold mb-4" style="font-size:1.875rem;color:#0f172a;">{{ $item['title'] }}</h1>

                        {{-- Content --}}
                        <div class="article-content text-secondary" style="font-size:1.0625rem;line-height:2;">
                            <p>{{ $item['content'] }}</p>
                        </div>
                    </div>
                </article>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="border-radius:16px;top:90px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-primary mb-3 pb-3 border-bottom">More News</h5>

                        @foreach($related as $rel)
                        <a href="{{ route('news.show', $rel['id']) }}" class="d-flex gap-3 text-decoration-none mb-3 pb-3 border-bottom sidebar-item">
                            <div class="sidebar-icon flex-shrink-0">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <h6 class="fw-semibold text-dark mb-1 sidebar-title">{{ Str::limit($rel['title'], 50) }}</h6>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($rel['date'])->format('d M Y') }}</small>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.article-img-area {
    height: 380px;
    background: #f1f5f9;
}

.sidebar-icon {
    width: 44px;
    height: 44px;
    background: #eff6ff;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2563eb;
    font-size: 1.125rem;
}

.sidebar-item {
    transition: all .25s ease;
}

.sidebar-item:hover .sidebar-title {
    color: #2563eb !important;
}

.sidebar-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.sidebar-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
}
</style>
@endpush
