@extends('layouts.app')

@section('title', 'المنتجات - MJK')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>المنتجات</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">الرئيسية</a>
            <i class="fas fa-chevron-left"></i>
            <span>المنتجات</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="products-layout">

            <!-- Sidebar Filters -->
            <aside class="products-sidebar">
                <div class="filter-card">
                    <h3><i class="fas fa-filter"></i> تصفية المنتجات</h3>

                    <div class="filter-group">
                        <h4>الفئة</h4>
                        @foreach($categories as $key => $label)
                        <a href="{{ route('products.index', ['category' => $key, 'sort' => $sort]) }}"
                           class="filter-option {{ $category === $key ? 'active' : '' }}">
                            <i class="fas fa-{{ $key === 'printers' ? 'print' : ($key === 'mice' ? 'mouse' : ($key === 'headphones' ? 'headphones' : ($key === 'flash' ? 'usb' : 'th-large'))) }}"></i>
                            {{ $label }}
                        </a>
                        @endforeach
                    </div>

                    <div class="filter-group">
                        <h4>الترتيب</h4>
                        <a href="{{ route('products.index', ['category' => $category, 'sort' => 'default']) }}"
                           class="filter-option {{ $sort === 'default' ? 'active' : '' }}">الافتراضي</a>
                        <a href="{{ route('products.index', ['category' => $category, 'sort' => 'price_asc']) }}"
                           class="filter-option {{ $sort === 'price_asc' ? 'active' : '' }}">السعر: الأقل أولاً</a>
                        <a href="{{ route('products.index', ['category' => $category, 'sort' => 'price_desc']) }}"
                           class="filter-option {{ $sort === 'price_desc' ? 'active' : '' }}">السعر: الأعلى أولاً</a>
                        <a href="{{ route('products.index', ['category' => $category, 'sort' => 'rating']) }}"
                           class="filter-option {{ $sort === 'rating' ? 'active' : '' }}">الأعلى تقييماً</a>
                    </div>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="products-main">
                <div class="products-toolbar">
                    <p>{{ count($products) }} منتج</p>
                </div>

                @if(count($products) > 0)
                <div class="products-grid-main">
                    @foreach($products as $product)
                    <div class="product-card">
                        @if($product['badge'])
                        <span class="product-badge badge badge-{{ $product['badge_color'] }}">{{ $product['badge'] }}</span>
                        @endif
                        <div class="product-image">
                            @if(!empty($product['image_url']))
                                <img src="{{ $product['image_url'] }}" alt="{{ $product['name'] }}"
                                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                <div class="placeholder-image" style="display:none">
                                    <i class="fas fa-{{ $product['category'] === 'printers' ? 'print' : ($product['category'] === 'mice' ? 'mouse' : ($product['category'] === 'headphones' ? 'headphones' : 'usb')) }}"></i>
                                </div>
                            @else
                                <div class="placeholder-image">
                                    <i class="fas fa-{{ $product['category'] === 'printers' ? 'print' : ($product['category'] === 'mice' ? 'mouse' : ($product['category'] === 'headphones' ? 'headphones' : 'usb')) }}"></i>
                                </div>
                            @endif
                        </div>
                        <div class="product-info">
                            <span class="product-brand">{{ $product['brand'] }}</span>
                            <h3>{{ $product['name'] }}</h3>
                            <p class="product-description">{{ $product['description'] }}</p>
                            <div class="product-rating">
                                @for($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star {{ $i < $product['rating'] ? 'active' : '' }}"></i>
                                @endfor
                                <span>({{ $product['reviews'] }})</span>
                            </div>
                            <div class="product-price">
                                <span class="price-current">{{ number_format($product['price']) }} جنيه</span>
                                @if($product['old_price'])
                                <span class="price-old">{{ number_format($product['old_price']) }} جنيه</span>
                                @endif
                            </div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart({{ $product['id'] }}, '{{ $product['name'] }}', {{ $product['price'] }}, '{{ $product['image'] }}')">
                                    <i class="fas fa-shopping-cart"></i> أضف للسلة
                                </button>
                                <a href="{{ route('products.show', $product['id']) }}" class="btn btn-outline">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h3>لا توجد منتجات</h3>
                    <p>لا توجد منتجات في هذه الفئة حالياً</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">عرض جميع المنتجات</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.products-layout {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 2rem;
    align-items: start;
}

.filter-card {
    background: var(--white, #fff);
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    position: sticky;
    top: 90px;
    border: 1px solid #F1F5F9;
}

.filter-card h3 {
    font-size: 1rem;
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: .625rem;
    color: #2563EB;
}

.filter-group {
    margin-bottom: 1.5rem;
}

.filter-group h4 {
    font-size: .875rem;
    color: #64748B;
    margin-bottom: .75rem;
    padding-bottom: .5rem;
    border-bottom: 1px solid #F1F5F9;
    text-transform: uppercase;
    letter-spacing: .5px;
}

.filter-option {
    display: flex;
    align-items: center;
    gap: .625rem;
    padding: .625rem .875rem;
    border-radius: 8px;
    color: #475569;
    font-size: .9rem;
    transition: all .2s ease;
    margin-bottom: .25rem;
}

.filter-option:hover,
.filter-option.active {
    background: #EFF6FF;
    color: #2563EB;
    font-weight: 600;
}

.products-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.25rem;
    padding: .875rem 1.25rem;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
    border: 1px solid #F1F5F9;
}

.products-toolbar p {
    margin: 0;
    color: #64748B;
    font-weight: 600;
    font-size: .9375rem;
}

.products-grid-main {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}

.product-card {
    position: relative;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    transition: all .3s ease;
    border: 1px solid #F1F5F9;
}

.product-card:hover {
    box-shadow: 0 12px 36px rgba(0,0,0,.12);
    transform: translateY(-5px);
}

.product-badge {
    position: absolute;
    top: .75rem;
    right: .75rem;
    z-index: 2;
}

.product-image {
    height: 180px;
    background: #F8FAFC;
    display: flex;
    align-items: center;
    justify-content: center;
}

.placeholder-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3.5rem;
    color: #CBD5E1;
}

.product-info { padding: 1.125rem; }

.product-brand {
    font-size: .75rem;
    font-weight: 700;
    color: #2563EB;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: .375rem;
    display: block;
}

.product-info h3 {
    font-size: .9375rem;
    margin-bottom: .5rem;
    color: #0F172A;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-description {
    font-size: .8125rem;
    color: #64748B;
    margin-bottom: .625rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: .2rem;
    margin-bottom: .625rem;
}

.product-rating i { color: #CBD5E1; font-size: .75rem; }
.product-rating i.active { color: #F59E0B; }
.product-rating span { color: #94A3B8; font-size: .75rem; margin-right: .25rem; }

.product-price {
    display: flex;
    align-items: center;
    gap: .5rem;
    margin-bottom: .875rem;
}

.price-current { font-size: 1.25rem; font-weight: 800; color: #2563EB; }
.price-old { font-size: .875rem; color: #94A3B8; text-decoration: line-through; }

.product-actions {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: .5rem;
}

.product-actions .btn {
    font-size: .8125rem;
    padding: .5rem .875rem;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #94A3B8;
}

.empty-state i {
    font-size: 3.5rem;
    margin-bottom: 1rem;
    display: block;
    opacity: .3;
}

@media (max-width: 1024px) {
    .products-layout { grid-template-columns: 1fr; }
    .filter-card { position: static; }
    .products-grid-main { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 640px) {
    .products-grid-main { grid-template-columns: 1fr; }
}
</style>
@endpush
