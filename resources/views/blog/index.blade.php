﻿@extends('layouts.app')

@section('title', 'المدونة - MJK')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>المدونة</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">الرئيسية</a>
            <i class="fas fa-chevron-left"></i>
            <span>المدونة</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="blog-grid">
            @foreach($posts as $post)
            <article class="blog-card animate-on-scroll">
                <div class="blog-image">
                    <div class="placeholder-image">
                        <i class="fas fa-blog"></i>
                    </div>
                    <span class="blog-category">{{ $post['category'] }}</span>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($post['date'])->format('d M Y') }}</span>
                        <span><i class="fas fa-user"></i> {{ $post['author'] }}</span>
                        <span><i class="fas fa-clock"></i> {{ $post['read_time'] }} دقائق</span>
                    </div>
                    <h2>{{ $post['title'] }}</h2>
                    <p>{{ $post['excerpt'] }}</p>
                    <div class="blog-footer">
                        <div class="blog-tags">
                            @foreach($post['tags'] as $tag)
                            <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <a href="{{ route('blog.show', $post['id']) }}" class="read-more">
                            اقرأ المزيد <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.blog-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.blog-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    transition: all .3s ease;
    border: 1px solid #F1F5F9;
}

.blog-card:hover {
    box-shadow: 0 16px 48px rgba(0,0,0,.12);
    transform: translateY(-6px);
}

.blog-image {
    position: relative;
    height: 240px;
    background: #F1F5F9;
    display: flex;
    align-items: center;
    justify-content: center;
}

.blog-image .placeholder-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 5rem;
    color: #CBD5E1;
}

.blog-category {
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

.blog-content { padding: 1.75rem; }

.blog-meta {
    display: flex;
    gap: 1.25rem;
    margin-bottom: .875rem;
    color: #64748B;
    font-size: .875rem;
    flex-wrap: wrap;
}

.blog-meta span { display: flex; align-items: center; gap: .4rem; }
.blog-meta i { color: #2563EB; }

.blog-content h2 {
    font-size: 1.25rem;
    margin-bottom: .625rem;
    color: #0F172A;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: all .25s ease;
}

.blog-card:hover .blog-content h2 { color: #2563EB; }

.blog-content > p {
    color: #475569;
    font-size: .9375rem;
    margin-bottom: 1.25rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #F1F5F9;
}

.blog-tags { display: flex; gap: .5rem; flex-wrap: wrap; }

.tag {
    padding: .25rem .75rem;
    background: #F1F5F9;
    color: #475569;
    border-radius: 50px;
    font-size: .8125rem;
    font-weight: 600;
}

.read-more {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: #2563EB;
    font-weight: 700;
    font-size: .9375rem;
    transition: all .25s ease;
    white-space: nowrap;
}

.read-more:hover { gap: .875rem; }

.animate-on-scroll { opacity: 0; transform: translateY(24px); transition: all .6s ease; }
.animate-on-scroll.animate-in { opacity: 1; transform: translateY(0); }

@media (max-width: 1024px) { .blog-grid { grid-template-columns: 1fr; } }
</style>
@endpush
