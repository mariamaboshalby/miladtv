﻿@extends('layouts.app')

@section('title', $item['title'] . ' - MJK')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>{{ $item['title'] }}</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">الرئيسية</a>
            <i class="fas fa-chevron-left"></i>
            <a href="{{ route('news.index') }}">الأخبار</a>
            <i class="fas fa-chevron-left"></i>
            <span>{{ Str::limit($item['title'], 40) }}</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="article-layout">
            <article class="article-main">
                <div class="article-image">
                    <div class="placeholder-image-xl">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
                <div class="article-body">
                    <div class="article-meta">
                        <span class="article-category">{{ $item['category'] }}</span>
                        <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item['date'])->format('d M Y') }}</span>
                        <span><i class="fas fa-user"></i> {{ $item['author'] }}</span>
                        <span><i class="fas fa-eye"></i> {{ number_format($item['views']) }}</span>
                    </div>
                    <h1>{{ $item['title'] }}</h1>
                    <div class="article-content">
                        <p>{{ $item['content'] }}</p>
                    </div>
                </div>
            </article>

            <aside class="article-sidebar">
                <div class="sidebar-card">
                    <h3>أخبار أخرى</h3>
                    @foreach($related as $rel)
                    <a href="{{ route('news.show', $rel['id']) }}" class="sidebar-item">
                        <div class="sidebar-item-icon"><i class="fas fa-newspaper"></i></div>
                        <div>
                            <h4>{{ Str::limit($rel['title'], 50) }}</h4>
                            <span>{{ \Carbon\Carbon::parse($rel['date'])->format('d M Y') }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.article-layout {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 2.5rem;
    align-items: start;
}

.article-main {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    border: 1px solid #F1F5F9;
}

.article-image {
    height: 380px;
    background: #F1F5F9;
    display: flex;
    align-items: center;
    justify-content: center;
}

.placeholder-image-xl { font-size: 7rem; color: #CBD5E1; }

.article-body { padding: 2.5rem; }

.article-meta {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    color: #64748B;
    font-size: .9375rem;
}

.article-meta span { display: flex; align-items: center; gap: .4rem; }
.article-meta i { color: #2563EB; }

.article-category {
    background: #EFF6FF;
    color: #2563EB;
    padding: .375rem 1rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: .875rem;
}

.article-body h1 { font-size: 1.875rem; margin-bottom: 1.75rem; color: #0F172A; }

.article-content p {
    font-size: 1.0625rem;
    line-height: 2;
    color: #334155;
}

.sidebar-card {
    background: #fff;
    border-radius: 20px;
    padding: 1.75rem;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    position: sticky;
    top: 90px;
    border: 1px solid #F1F5F9;
}

.sidebar-card h3 {
    font-size: 1.125rem;
    margin-bottom: 1.25rem;
    color: #2563EB;
    padding-bottom: .75rem;
    border-bottom: 2px solid #EFF6FF;
}

.sidebar-item {
    display: flex;
    gap: .875rem;
    padding: .875rem 0;
    border-bottom: 1px solid #F1F5F9;
    transition: all .25s ease;
}

.sidebar-item:last-child { border-bottom: none; }
.sidebar-item:hover { color: #2563EB; }

.sidebar-item-icon {
    width: 44px;
    height: 44px;
    background: #EFF6FF;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2563EB;
    font-size: 1.125rem;
    flex-shrink: 0;
}

.sidebar-item h4 { font-size: .9rem; margin-bottom: .25rem; color: #0F172A; }
.sidebar-item span { font-size: .8125rem; color: #64748B; }

@media (max-width: 1024px) {
    .article-layout { grid-template-columns: 1fr; }
    .sidebar-card { position: static; }
}
</style>
@endpush
