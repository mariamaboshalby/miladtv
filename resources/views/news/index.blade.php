﻿@extends('layouts.app')

@section('title', 'الأخبار - MJK')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>آخر الأخبار</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">الرئيسية</a>
            <i class="fas fa-chevron-left"></i>
            <span>الأخبار</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="news-grid">
            @foreach($news as $item)
            <article class="news-card animate-on-scroll">
                <div class="news-image">
                    <div class="placeholder-image">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <span class="news-category">{{ $item['category'] }}</span>
                </div>
                <div class="news-content">
                    <div class="news-meta">
                        <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item['date'])->format('d M Y') }}</span>
                        <span><i class="fas fa-eye"></i> {{ number_format($item['views']) }} مشاهدة</span>
                    </div>
                    <h2>{{ $item['title'] }}</h2>
                    <p>{{ $item['excerpt'] }}</p>
                    <a href="{{ route('news.show', $item['id']) }}" class="read-more">
                        اقرأ المزيد <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.news-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.news-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    transition: all .3s ease;
    border: 1px solid #F1F5F9;
}

.news-card:hover {
    box-shadow: 0 16px 48px rgba(0,0,0,.12);
    transform: translateY(-6px);
}

.news-image {
    position: relative;
    height: 220px;
    background: #F1F5F9;
    display: flex;
    align-items: center;
    justify-content: center;
}

.news-image .placeholder-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 5rem;
    color: #CBD5E1;
}

.news-category {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: #2563EB;
    color: #fff;
    padding: .375rem .875rem;
    border-radius: 50px;
    font-size: .8125rem;
    font-weight: 700;
}

.news-content { padding: 1.5rem; }

.news-meta {
    display: flex;
    gap: 1.25rem;
    margin-bottom: .875rem;
    color: #64748B;
    font-size: .875rem;
}

.news-meta span {
    display: flex;
    align-items: center;
    gap: .4rem;
}

.news-meta i { color: #2563EB; }

.news-content h2 {
    font-size: 1.125rem;
    margin-bottom: .625rem;
    color: #0F172A;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: all .25s ease;
}

.news-card:hover .news-content h2 { color: #2563EB; }

.news-content p {
    color: #475569;
    font-size: .9375rem;
    margin-bottom: 1.25rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.read-more {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: #2563EB;
    font-weight: 700;
    font-size: .9375rem;
    transition: all .25s ease;
}

.read-more:hover { gap: .875rem; }

.animate-on-scroll {
    opacity: 0;
    transform: translateY(24px);
    transition: all .6s ease;
}

.animate-on-scroll.animate-in {
    opacity: 1;
    transform: translateY(0);
}

@media (max-width: 1024px) { .news-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 640px)  { .news-grid { grid-template-columns: 1fr; } }
</style>
@endpush
