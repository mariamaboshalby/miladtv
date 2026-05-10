﻿@extends('layouts.app')

@section('title', 'التحميلات - MJK')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>مركز التحميلات</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">الرئيسية</a>
            <i class="fas fa-chevron-left"></i>
            <span>التحميلات</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="downloads-list">
            @foreach($downloads as $item)
            <div class="download-card animate-on-scroll">
                <div class="download-icon">
                    <i class="fas {{ $item['icon'] }}"></i>
                </div>
                <div class="download-info">
                    <div class="download-header">
                        <h3>{{ $item['title'] }}</h3>
                        <div class="download-badges">
                            <span class="badge-chip">{{ $item['category'] }}</span>
                            <span class="badge-chip brand">{{ $item['brand'] }}</span>
                        </div>
                    </div>
                    <p>{{ $item['description'] }}</p>
                    <div class="download-meta">
                        <span><i class="fas fa-code-branch"></i> الإصدار: {{ $item['version'] }}</span>
                        <span><i class="fas fa-hdd"></i> الحجم: {{ $item['size'] }}</span>
                        <span><i class="fas fa-desktop"></i> {{ $item['os'] }}</span>
                        <span><i class="fas fa-download"></i> {{ number_format($item['downloads']) }} تحميل</span>
                    </div>
                </div>
                <div class="download-action">
                    <a href="#" class="btn-download">
                        <i class="fas fa-download"></i>
                        <span>تحميل</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.downloads-list {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.download-card {
    background: #fff;
    border-radius: 16px;
    padding: 1.5rem 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    display: flex;
    align-items: center;
    gap: 1.75rem;
    transition: all .3s ease;
    border: 2px solid transparent;
}

.download-card:hover {
    border-color: #2563EB;
    box-shadow: 0 8px 28px rgba(37,99,235,.12);
    transform: translateX(-4px);
}

.download-icon {
    width: 64px;
    height: 64px;
    background: #EFF6FF;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.875rem;
    color: #2563EB;
    flex-shrink: 0;
    transition: all .3s ease;
}

.download-card:hover .download-icon {
    background: #2563EB;
    color: #fff;
}

.download-info { flex: 1; }

.download-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: .5rem;
    flex-wrap: wrap;
}

.download-header h3 {
    font-size: 1.0625rem;
    color: #0F172A;
    margin: 0;
}

.download-badges { display: flex; gap: .5rem; }

.badge-chip {
    padding: .25rem .75rem;
    background: #F1F5F9;
    color: #475569;
    border-radius: 50px;
    font-size: .75rem;
    font-weight: 700;
}

.badge-chip.brand {
    background: #EFF6FF;
    color: #2563EB;
}

.download-info p {
    color: #475569;
    font-size: .9375rem;
    margin-bottom: .625rem;
}

.download-meta {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    color: #64748B;
    font-size: .8125rem;
}

.download-meta span { display: flex; align-items: center; gap: .375rem; }
.download-meta i { color: #2563EB; }

.download-action { flex-shrink: 0; }

.btn-download {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .375rem;
    padding: .875rem 1.5rem;
    background: linear-gradient(135deg, #2563EB, #3B82F6);
    color: #fff;
    border-radius: 12px;
    font-weight: 700;
    transition: all .3s ease;
    text-decoration: none;
    min-width: 90px;
}

.btn-download i { font-size: 1.375rem; }
.btn-download span { font-size: .8125rem; }
.btn-download:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(37,99,235,.35); }

.animate-on-scroll { opacity: 0; transform: translateY(20px); transition: all .5s ease; }
.animate-on-scroll.animate-in { opacity: 1; transform: translateY(0); }

@media (max-width: 768px) {
    .download-card { flex-direction: column; align-items: flex-start; gap: 1rem; }
    .download-action { width: 100%; }
    .btn-download { flex-direction: row; width: 100%; justify-content: center; }
}
</style>
@endpush
