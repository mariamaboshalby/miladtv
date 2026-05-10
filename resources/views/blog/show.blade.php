﻿@extends('layouts.app')

@section('title', $post['title'] . ' - MJK')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>{{ $post['title'] }}</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Ø§Ù„Ø±Ø¦ÙŠØ³ÙŠØ©</a>
            <i class="fas fa-chevron-left"></i>
            <a href="{{ route('blog.index') }}">Ø§Ù„Ù…Ø¯ÙˆÙ†Ø©</a>
            <i class="fas fa-chevron-left"></i>
            <span>{{ Str::limit($post['title'], 40) }}</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="article-layout">
            <article class="article-main">
                <div class="article-image">
                    <div class="placeholder-image-xl">
                        <i class="fas fa-blog"></i>
                    </div>
                </div>
                <div class="article-body">
                    <div class="article-meta">
                        <span class="article-category">{{ $post['category'] }}</span>
                        <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($post['date'])->format('d M Y') }}</span>
                        <span><i class="fas fa-user"></i> {{ $post['author'] }}</span>
                        <span><i class="fas fa-briefcase"></i> {{ $post['author_role'] }}</span>
                        <span><i class="fas fa-clock"></i> {{ $post['read_time'] }} Ø¯Ù‚Ø§Ø¦Ù‚ Ù‚Ø±Ø§Ø¡Ø©</span>
                        <span><i class="fas fa-eye"></i> {{ number_format($post['views']) }}</span>
                    </div>
                    <h1>{{ $post['title'] }}</h1>
                    <div class="article-content">
                        <p>{{ $post['content'] }}</p>
                    </div>
                    <div class="article-tags">
                        @foreach($post['tags'] as $tag)
                        <span class="tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            </article>

            <aside class="article-sidebar">
                <div class="sidebar-card">
                    <h3>Ù…Ù‚Ø§Ù„Ø§Øª Ø£Ø®Ø±Ù‰</h3>
                    @foreach($related as $rel)
                    <a href="{{ route('blog.show', $rel['id']) }}" class="sidebar-item">
                        <div class="sidebar-item-icon"><i class="fas fa-blog"></i></div>
                        <div>
                            <h4>{{ Str::limit($rel['title'], 50) }}</h4>
                            <span>{{ $rel['read_time'] }} Ø¯Ù‚Ø§Ø¦Ù‚ Â· {{ \Carbon\Carbon::parse($rel['date'])->format('d M Y') }}</span>
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
    grid-template-columns: 1fr 350px;
    gap: 3rem;
    align-items: start;
}

.article-main {
    background: var(--white);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow);
}

.article-image {
    height: 400px;
    background: var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: center;
}

.placeholder-image-xl { font-size: 8rem; color: var(--gray-300); }

.article-body { padding: 2.5rem; }

.article-meta {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    color: var(--gray-500);
    font-size: 0.9375rem;
}

.article-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.article-meta i { color: var(--primary-blue); }

.article-category {
    background: var(--secondary-blue);
    color: var(--primary-blue);
    padding: 0.375rem 1rem;
    border-radius: var(--radius-full);
    font-weight: 700;
    font-size: 0.875rem;
}

.article-body h1 { font-size: 2rem; margin-bottom: 2rem; color: var(--gray-900); }

.article-content p {
    font-size: 1.0625rem;
    line-height: 2;
    color: var(--gray-700);
}

.article-tags {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--gray-200);
}

.tag {
    padding: 0.375rem 1rem;
    background: var(--gray-100);
    color: var(--gray-600);
    border-radius: var(--radius-full);
    font-size: 0.875rem;
    font-weight: 600;
}

.sidebar-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 2rem;
    box-shadow: var(--shadow);
    position: sticky;
    top: 100px;
}

.sidebar-card h3 {
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
    color: var(--primary-blue);
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--secondary-blue);
}

.sidebar-item {
    display: flex;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid var(--gray-100);
    transition: var(--transition);
}

.sidebar-item:last-child { border-bottom: none; }
.sidebar-item:hover { color: var(--primary-blue); }

.sidebar-item-icon {
    width: 50px;
    height: 50px;
    background: var(--secondary-blue);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-blue);
    font-size: 1.25rem;
    flex-shrink: 0;
}

.sidebar-item h4 { font-size: 0.9375rem; margin-bottom: 0.25rem; color: var(--gray-900); }
.sidebar-item span { font-size: 0.8125rem; color: var(--gray-500); }

@media (max-width: 1024px) {
    .article-layout { grid-template-columns: 1fr; }
    .sidebar-card { position: static; }
}
</style>
@endpush

