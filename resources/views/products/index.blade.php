@extends('layouts.app')

@section('title', __('app.prod_page_title'))

@section('content')

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,#0f172a 0%,#030f1f 100%);padding:2.5rem 0;">
    <div class="container">
        <h1 class="text-white fw-bold mb-1">{{ __('app.prod_header_title') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-white-50 text-decoration-none">{{ __('app.prod_breadcrumb_home') }}</a>
                </li>
                <li class="breadcrumb-item active text-white-50">{{ __('app.prod_header_title') }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">

            {{-- Sidebar --}}
            <div class="col-lg-3">

                {{-- Mobile: Filter toggle button --}}
                <button class="btn btn-primary w-100 d-lg-none mb-3 d-flex align-items-center justify-content-between px-4 py-2 rounded-3"
                        id="filterToggleBtn"
                        type="button"
                        aria-expanded="false"
                        aria-controls="filterCollapse">
                    <span class="d-flex align-items-center gap-2 fw-semibold">
                        <i class="fas fa-filter"></i> {{ __('app.prod_filter_btn') }}
                        @if($category !== 'all' || $sort !== 'default')
                        <span class="badge bg-white text-primary ms-1" style="font-size:.7rem;">{{ __('app.prod_filter_active') }}</span>
                        @endif
                    </span>
                    <i class="fas fa-chevron-down" id="filterChevron" style="transition:transform .25s ease;"></i>
                </button>

                {{-- Filter card --}}
                <div id="filterCollapse" class="d-none d-lg-block">
                    <div class="card border-0 shadow-sm sticky-top" style="border-radius:16px;top:90px;">
                        <div class="card-body p-4">
                            <h6 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2 d-none d-lg-flex">
                                <i class="fas fa-filter"></i> {{ __('app.prod_filter_title') }}
                            </h6>

                            {{-- Category --}}
                            <div class="mb-4">
                                <p class="text-uppercase text-muted fw-semibold mb-2" style="font-size:.75rem;letter-spacing:.5px;">{{ __('app.prod_cat_label') }}</p>
                                <a href="{{ route('products.index', ['category' => 'all', 'sort' => $sort]) }}"
                                   class="filter-option d-flex align-items-center gap-2 px-3 py-2 rounded-3 mb-1 text-decoration-none {{ $category === 'all' ? 'active' : '' }}">
                                    <i class="fas fa-th-large"></i> {{ __('app.cat_all') }}
                                </a>
                                @foreach($dbCategories as $cat)
                                <a href="{{ route('products.index', ['category' => $cat->slug, 'sort' => $sort]) }}"
                                   class="filter-option d-flex align-items-center gap-2 px-3 py-2 rounded-3 mb-1 text-decoration-none {{ $category === $cat->slug ? 'active' : '' }}">
                                    @if($cat->image)
                                        <img src="{{ asset('storage/' . $cat->image) }}" alt="" style="width:20px;height:20px;object-fit:cover;border-radius:4px;flex-shrink:0;">
                                    @else
                                        <i class="fas fa-{{ $cat->icon ?? 'list' }}"></i>
                                    @endif
                                    <span>{{ app()->getLocale() === 'ar' ? $cat->name_ar : $cat->name_en }}</span>
                                </a>
                                @endforeach
                            </div>

                            {{-- Sort By --}}
                            <div>
                                <p class="text-uppercase text-muted fw-semibold mb-2" style="font-size:.75rem;letter-spacing:.5px;">{{ __('app.prod_sort_label') }}</p>
                                <a href="{{ route('products.index', ['category' => $category, 'sort' => 'default']) }}"
                                   class="filter-option d-flex align-items-center gap-2 px-3 py-2 rounded-3 mb-1 text-decoration-none {{ $sort === 'default' ? 'active' : '' }}">
                                    <i class="fas fa-list"></i> {{ __('app.prod_sort_default') }}
                                </a>
                                <a href="{{ route('products.index', ['category' => $category, 'sort' => 'price_asc']) }}"
                                   class="filter-option d-flex align-items-center gap-2 px-3 py-2 rounded-3 mb-1 text-decoration-none {{ $sort === 'price_asc' ? 'active' : '' }}">
                                    <i class="fas fa-arrow-up"></i> {{ __('app.prod_sort_price_asc') }}
                                </a>
                                <a href="{{ route('products.index', ['category' => $category, 'sort' => 'price_desc']) }}"
                                   class="filter-option d-flex align-items-center gap-2 px-3 py-2 rounded-3 mb-1 text-decoration-none {{ $sort === 'price_desc' ? 'active' : '' }}">
                                    <i class="fas fa-arrow-down"></i> {{ __('app.prod_sort_price_desc') }}
                                </a>
                                <a href="{{ route('products.index', ['category' => $category, 'sort' => 'rating']) }}"
                                   class="filter-option d-flex align-items-center gap-2 px-3 py-2 rounded-3 mb-1 text-decoration-none {{ $sort === 'rating' ? 'active' : '' }}">
                                    <i class="fas fa-star"></i> {{ __('app.prod_sort_rating') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Products Main --}}
            <div class="col-lg-9">
                {{-- Toolbar --}}
                <div class="d-flex justify-content-between align-items-center mb-4 px-3 py-2 bg-white rounded-3 shadow-sm border">
                    <span class="text-secondary fw-semibold">{{ __('app.prod_found', ['count' => $products->total()]) }}</span>
                </div>

                @if(count($products) > 0)
                <div class="row g-3">
                    @foreach($products as $index => $product)
                    <div class="col-md-6 col-xl-4">
                        <a href="{{ route('products.show', $product['id']) }}"
                           class="product-card card border-0 shadow-sm h-100 text-decoration-none">

                            @if($product['badge'])
                            <span class="badge bg-danger position-absolute top-0 m-2 px-2 py-1" style="z-index:2;border-radius:8px;left:8px;">{{ $product['badge'] }}</span>
                            @endif

                            {{-- Fav button --}}
                            <button class="fav-btn"
                                    data-id="{{ $product['id'] }}"
                                    data-name="{{ $product['name'] }}"
                                    data-price="{{ $product['price'] }}"
                                    data-img="{{ $product['image_url'] }}"
                                    aria-label="Add to favourites"
                                    onclick="event.preventDefault();event.stopPropagation();toggleFav(this)">
                                <i class="fas fa-heart"></i>
                            </button>

                            {{-- Image --}}
                            <div class="product-img-area">
                                @if(!empty($product['image_url']))
                                    <img src="{{ $product['image_url'] }}" alt="{{ $product['name'] }}"
                                         class="w-100 h-100" style="object-fit:cover;"
                                         loading="{{ $index < 3 ? 'eager' : 'lazy' }}"
                                         {{ $index === 0 ? 'fetchpriority="high"' : '' }}
                                         decoding="{{ $index < 3 ? 'sync' : 'async' }}"
                                         width="300" height="180"
                                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                    <div class="product-placeholder" style="display:none;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @else
                                    <div class="product-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column p-3">
                                <span class="text-primary fw-bold mb-1" style="font-size:.75rem;text-transform:uppercase;letter-spacing:1px;">{{ $product['brand'] }}</span>
                                <h6 class="fw-bold text-dark product-name mb-1">{{ $product['name'] }}</h6>
                                <p class="text-secondary product-desc mb-2" style="font-size:.8125rem;">{{ $product['description'] }}</p>

                                {{-- Stars --}}
                                <div class="d-flex align-items-center gap-1 mb-2">
                                    @php
                                        $r = (int)$product['rating'];
                                        $stars = str_repeat('<i class="fas fa-star" style="font-size:.7rem;color:#f59e0b;"></i>', $r)
                                               . str_repeat('<i class="fas fa-star" style="font-size:.7rem;color:#d1d5db;"></i>', 5 - $r);
                                    @endphp
                                    {!! $stars !!}
                                    <span class="text-muted ms-1" style="font-size:.75rem;">({{ $product['reviews'] }})</span>
                                </div>

                                {{-- Price --}}
                                <div class="d-flex align-items-center gap-2 mb-3 mt-auto">
                                    <span class="fw-bold text-primary" style="font-size:1.25rem;">{{ number_format($product['price']) }} EGP</span>
                                    @if($product['old_price'])
                                    <span class="text-muted text-decoration-line-through" style="font-size:.875rem;">{{ number_format($product['old_price']) }} EGP</span>
                                    @endif
                                </div>

                                {{-- Actions --}}
                                <div class="d-grid gap-2" style="grid-template-columns:1fr auto;">
                                    <button class="btn btn-primary btn-sm fw-semibold"
                                            onclick="event.preventDefault();event.stopPropagation();addToCart({{ $product['id'] }}, '{{ addslashes($product['name']) }}', {{ $product['price'] }}, '{{ $product['image'] }}')">
                                        <i class="fas fa-shopping-cart me-1"></i>{{ __('app.prod_add_cart') }}
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm"
                                            onclick="event.preventDefault();event.stopPropagation();window.location='{{ route('products.show', $product['id']) }}'">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                @else
                {{-- Empty State --}}
                <div class="text-center py-5">
                    <i class="fas fa-box-open text-muted mb-3 d-block" style="font-size:3.5rem;opacity:.3;"></i>
                    <h5 class="fw-bold text-dark mb-2">{{ __('app.prod_empty_title') }}</h5>
                    <p class="text-secondary mb-4">{{ __('app.prod_empty_sub') }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary px-5">{{ __('app.prod_empty_btn') }}</a>
                </div>
                @endif

                {{-- Pagination --}}
                @if($products->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(request()->query())->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.filter-option {
    color: #475569;
    font-size: .9rem;
    transition: all .2s ease;
}
.filter-option:hover,
.filter-option.active {
    background: #e8edf5;
    color: #051836;
    font-weight: 600;
}
.product-card {
    border-radius: 14px !important;
    overflow: hidden;
    transition: all .3s ease;
    position: relative;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 36px rgba(0,0,0,.12) !important;
}
.product-img-area {
    height: 180px;
    background: #f8fafc;
    overflow: hidden;
    position: relative;
}
.product-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3.5rem;
    color: #cbd5e1;
}
.product-name {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
}
.product-desc {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.6;
}
.d-grid { display: grid; }

/* ── Fav button ── */
.fav-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    left: auto;
    z-index: 3;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: none;
    background: rgba(255,255,255,.92);
    backdrop-filter: blur(4px);
    color: #cbd5e1;
    font-size: .95rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,.12);
    transition: color .2s ease, transform .2s ease, background .2s ease;
}
.fav-btn:hover {
    background: #fff;
    color: #f43f5e;
    transform: scale(1.12);
}
.fav-btn.active {
    color: #f43f5e;
    background: #fff0f3;
}
.fav-btn.pop {
    animation: fav-pop .3s ease;
}
@keyframes fav-pop {
    0%   { transform: scale(1);    }
    50%  { transform: scale(1.35); }
    100% { transform: scale(1);    }
}</style>
@endpush

@push('scripts')
<script>
(function () {
    const btn      = document.getElementById('filterToggleBtn');
    const collapse = document.getElementById('filterCollapse');
    const chevron  = document.getElementById('filterChevron');
    if (!btn) return;

    btn.addEventListener('click', function () {
        const isOpen = !collapse.classList.contains('d-none');
        if (isOpen) {
            collapse.classList.add('d-none');
            chevron.style.transform = 'rotate(0deg)';
            btn.setAttribute('aria-expanded', 'false');
        } else {
            collapse.classList.remove('d-none');
            chevron.style.transform = 'rotate(180deg)';
            btn.setAttribute('aria-expanded', 'true');
        }
    });
}());
</script>
@endpush
