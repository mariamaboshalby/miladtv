﻿@extends('layouts.app')

@section('title', 'Download Center - MJK')

@section('content')

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 100%);padding:2.5rem 0;">
    <div class="container">
        <h1 class="text-white fw-bold mb-1">Download Center</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white-50">Downloads</li>
            </ol>
        </nav>
    </div>
</div>

{{-- Filter Tabs --}}
<div class="bg-white border-bottom shadow-sm py-3">
    <div class="container">
        <ul class="nav nav-pills gap-2 flex-wrap" id="downloadTabs">
            <li class="nav-item">
                <button class="nav-link active" data-filter="all">
                    <i class="fas fa-th-large me-1"></i> All
                </button>
            </li>
            @foreach($categories as $cat)
            <li class="nav-item">
                <button class="nav-link" data-filter="{{ $cat }}">
                    @if($cat === 'Drivers') <i class="fas fa-microchip me-1"></i>
                    @elseif($cat === 'Software') <i class="fas fa-laptop-code me-1"></i>
                    @elseif($cat === 'Manuals') <i class="fas fa-file-pdf me-1"></i>
                    @elseif($cat === 'Catalogues') <i class="fas fa-book me-1"></i>
                    @else <i class="fas fa-folder me-1"></i>
                    @endif
                    {{ $cat }}
                </button>
            </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- Downloads List --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex flex-column gap-3" id="downloadsList">
            @foreach($downloads as $item)
            <div class="download-card card border-0 shadow-sm" data-category="{{ $item['category'] }}">
                <div class="card-body d-flex align-items-center gap-4 p-4">

                    {{-- Icon --}}
                    <div class="dl-icon flex-shrink-0">
                        <i class="fas {{ $item['icon'] }}"></i>
                    </div>

                    {{-- Info --}}
                    <div class="flex-grow-1 min-w-0">
                        <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                            <h5 class="mb-0 fw-bold text-dark">{{ $item['title'] }}</h5>
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold">{{ $item['category'] }}</span>
                            <span class="badge bg-info bg-opacity-10 text-info fw-semibold">{{ $item['brand'] }}</span>
                        </div>
                        <p class="text-secondary mb-2 small">{{ $item['description'] }}</p>
                        <div class="d-flex flex-wrap gap-3 text-muted" style="font-size:.8125rem;">
                            <span><i class="fas fa-code-branch text-primary me-1"></i>v{{ $item['version'] }}</span>
                            <span><i class="fas fa-hdd text-primary me-1"></i>{{ $item['size'] }}</span>
                            <span><i class="fas fa-desktop text-primary me-1"></i>{{ $item['os'] }}</span>
                            <span><i class="fas fa-download text-primary me-1"></i>{{ number_format($item['downloads']) }} downloads</span>
                        </div>
                    </div>

                    {{-- Download Button --}}
                    <div class="flex-shrink-0">
                        <a href="#" class="btn btn-primary d-flex flex-column align-items-center px-4 py-3 gap-1">
                            <i class="fas fa-download fs-5"></i>
                            <span style="font-size:.8rem;">Download</span>
                        </a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        {{-- Empty state (hidden by default) --}}
        <div id="emptyState" class="text-center py-5 d-none">
            <i class="fas fa-folder-open text-muted" style="font-size:3rem;opacity:.3;"></i>
            <p class="mt-3 text-muted">No downloads found in this category.</p>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.dl-icon {
    width: 64px;
    height: 64px;
    background: #eff6ff;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: #2563eb;
    transition: all .3s ease;
}

.download-card {
    border: 2px solid transparent !important;
    transition: all .3s ease;
    border-radius: 14px !important;
}

.download-card:hover {
    border-color: #2563eb !important;
    box-shadow: 0 8px 28px rgba(37,99,235,.12) !important;
}

.download-card:hover .dl-icon {
    background: #2563eb;
    color: #fff;
}

#downloadTabs .nav-link {
    color: #475569;
    border: 1px solid #e2e8f0;
    border-radius: 50px;
    padding: .45rem 1.1rem;
    font-size: .875rem;
    font-weight: 600;
    transition: all .2s ease;
}

#downloadTabs .nav-link:hover,
#downloadTabs .nav-link.active {
    background: #2563eb;
    border-color: #2563eb;
    color: #fff;
}

@media (max-width: 768px) {
    .download-card .card-body {
        flex-direction: column;
        align-items: flex-start !important;
    }
    .download-card .card-body > div:last-child {
        width: 100%;
    }
    .download-card .card-body > div:last-child .btn {
        width: 100%;
        flex-direction: row;
        justify-content: center;
        gap: .5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('#downloadTabs .nav-link');
    const cards = document.querySelectorAll('.download-card');
    const emptyState = document.getElementById('emptyState');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            let visible = 0;

            cards.forEach(card => {
                const match = filter === 'all' || card.dataset.category === filter;
                card.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            emptyState.classList.toggle('d-none', visible > 0);
        });
    });
});
</script>
@endpush
