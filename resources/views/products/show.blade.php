﻿@extends('layouts.app')

@section('title', $product['name'] . ' - MJK')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>{{ $product['name'] }}</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">الرئيسية</a>
            <i class="fas fa-chevron-left"></i>
            <a href="{{ route('products.index') }}">المنتجات</a>
            <i class="fas fa-chevron-left"></i>
            <span>{{ Str::limit($product['name'], 40) }}</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="product-detail-layout">

            <!-- Image -->
            <div class="product-detail-image">
                <div class="main-image">
                    <div class="placeholder-image-lg">
                        <i class="fas fa-{{ $product['category'] === 'printers' ? 'print' : ($product['category'] === 'mice' ? 'mouse' : ($product['category'] === 'headphones' ? 'headphones' : 'usb')) }}"></i>
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="product-detail-info">
                <span class="product-brand-tag">{{ $product['brand'] }}</span>
                @if($product['badge'])
                <span class="badge badge-{{ $product['badge_color'] }}" style="margin-right:.5rem">{{ $product['badge'] }}</span>
                @endif

                <h1>{{ $product['name'] }}</h1>

                <div class="product-rating" style="margin-bottom:1.5rem">
                    @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star {{ $i < $product['rating'] ? 'active' : '' }}"></i>
                    @endfor
                    <span>({{ $product['reviews'] }} تقييم)</span>
                </div>

                <div class="detail-price">
                    <span class="price-current">{{ number_format($product['price']) }} جنيه</span>
                    @if($product['old_price'])
                    <span class="price-old">{{ number_format($product['old_price']) }} جنيه</span>
                    <span class="price-save">وفر {{ number_format($product['old_price'] - $product['price']) }} جنيه</span>
                    @endif
                </div>

                <p class="detail-description">{{ $product['description'] }}</p>

                @if(!empty($product['specs']))
                <div class="product-specs">
                    <h3>المواصفات الرئيسية</h3>
                    <ul>
                        @foreach($product['specs'] as $spec)
                        <li><i class="fas fa-check-circle"></i> {{ $spec }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="detail-actions">
                    <div class="quantity-selector">
                        <button onclick="changeQty(-1)">-</button>
                        <input type="number" id="qty" value="1" min="1" max="99">
                        <button onclick="changeQty(1)">+</button>
                    </div>
                    <button class="btn btn-primary btn-lg" onclick="addToCart({{ $product['id'] }}, '{{ $product['name'] }}', {{ $product['price'] }}, '{{ $product['image'] }}')">
                        <i class="fas fa-shopping-cart"></i> أضف للسلة
                    </button>
                </div>

                <div class="product-guarantees">
                    <div class="guarantee-item"><i class="fas fa-shield-alt"></i><span>ضمان أصلي</span></div>
                    <div class="guarantee-item"><i class="fas fa-truck"></i><span>شحن سريع</span></div>
                    <div class="guarantee-item"><i class="fas fa-undo"></i><span>إرجاع 14 يوم</span></div>
                </div>
            </div>
        </div>

        @if(count($related) > 0)
        <div class="related-products">
            <h2>منتجات مشابهة</h2>
            <div class="related-grid">
                @foreach($related as $item)
                <div class="product-card">
                    @if($item['badge'])
                    <span class="product-badge badge badge-{{ $item['badge_color'] }}">{{ $item['badge'] }}</span>
                    @endif
                    <div class="product-image">
                        <div class="placeholder-image">
                            <i class="fas fa-{{ $item['category'] === 'printers' ? 'print' : ($item['category'] === 'mice' ? 'mouse' : ($item['category'] === 'headphones' ? 'headphones' : 'usb')) }}"></i>
                        </div>
                    </div>
                    <div class="product-info">
                        <span class="product-brand">{{ $item['brand'] }}</span>
                        <h3>{{ $item['name'] }}</h3>
                        <div class="product-price">
                            <span class="price-current">{{ number_format($item['price']) }} جنيه</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-primary" onclick="addToCart({{ $item['id'] }}, '{{ $item['name'] }}', {{ $item['price'] }}, '{{ $item['image'] }}')">
                                <i class="fas fa-shopping-cart"></i> أضف للسلة
                            </button>
                            <a href="{{ route('products.show', $item['id']) }}" class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection

@push('styles')
<style>
.product-detail-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: start;
    margin-bottom: 5rem;
}

.main-image {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,.08);
    height: 440px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #F1F5F9;
}

.placeholder-image-lg { font-size: 9rem; color: #CBD5E1; }

.product-brand-tag {
    display: inline-block;
    background: #EFF6FF;
    color: #2563EB;
    padding: .375rem 1rem;
    border-radius: 50px;
    font-size: .875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.product-detail-info h1 { font-size: 1.875rem; margin-bottom: 1rem; }

.product-rating { display: flex; align-items: center; gap: .375rem; }
.product-rating i { color: #CBD5E1; }
.product-rating i.active { color: #F59E0B; }
.product-rating span { color: #64748B; font-size: .9375rem; margin-right: .25rem; }

.detail-price {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.detail-price .price-current { font-size: 2.25rem; font-weight: 900; color: #2563EB; }
.detail-price .price-old { font-size: 1.375rem; color: #94A3B8; text-decoration: line-through; }

.price-save {
    background: #FEE2E2;
    color: #DC2626;
    padding: .375rem .75rem;
    border-radius: 50px;
    font-size: .875rem;
    font-weight: 700;
}

.detail-description {
    font-size: 1.0625rem;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 2rem;
}

.product-specs {
    background: #F8FAFC;
    border-radius: 14px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid #F1F5F9;
}

.product-specs h3 { font-size: 1rem; margin-bottom: 1rem; color: #0F172A; }

.product-specs ul {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: .625rem;
}

.product-specs li {
    display: flex;
    align-items: center;
    gap: .625rem;
    color: #334155;
    font-size: .9375rem;
}

.product-specs li i { color: #10B981; flex-shrink: 0; }

.detail-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-bottom: 2rem;
}

.quantity-selector {
    display: flex;
    align-items: center;
    border: 2px solid #E2E8F0;
    border-radius: 50px;
    overflow: hidden;
}

.quantity-selector button {
    width: 44px;
    height: 48px;
    background: #F1F5F9;
    color: #334155;
    font-size: 1.25rem;
    font-weight: 700;
    transition: all .25s ease;
}

.quantity-selector button:hover { background: #2563EB; color: #fff; }

.quantity-selector input {
    width: 56px;
    height: 48px;
    text-align: center;
    border: none;
    font-size: 1.125rem;
    font-weight: 700;
    color: #0F172A;
}

.quantity-selector input:focus { outline: none; }

.product-guarantees {
    display: flex;
    gap: 1.75rem;
    padding: 1.25rem 1.5rem;
    background: #EFF6FF;
    border-radius: 14px;
}

.guarantee-item {
    display: flex;
    align-items: center;
    gap: .625rem;
    color: #2563EB;
    font-weight: 600;
    font-size: .9375rem;
}

.guarantee-item i { font-size: 1.375rem; }

.related-products h2 { font-size: 1.875rem; margin-bottom: 2rem; }

.related-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
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

.product-card:hover { box-shadow: 0 12px 36px rgba(0,0,0,.12); transform: translateY(-5px); }
.product-badge { position: absolute; top: .75rem; right: .75rem; z-index: 2; }
.product-image { height: 180px; background: #F8FAFC; display: flex; align-items: center; justify-content: center; }
.placeholder-image { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; color: #CBD5E1; }
.product-info { padding: 1.125rem; }
.product-brand { font-size: .75rem; font-weight: 700; color: #2563EB; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .375rem; display: block; }
.product-info h3 { font-size: .9375rem; margin-bottom: .75rem; }
.product-price { display: flex; align-items: center; gap: .5rem; margin-bottom: .875rem; }
.price-current { font-size: 1.25rem; font-weight: 800; color: #2563EB; }
.price-old { font-size: .875rem; color: #94A3B8; text-decoration: line-through; }
.product-actions { display: grid; grid-template-columns: 1fr auto; gap: .5rem; }
.product-actions .btn { font-size: .8125rem; padding: .5rem .875rem; }

@media (max-width: 1024px) {
    .product-detail-layout { grid-template-columns: 1fr; gap: 2rem; }
    .product-specs ul { grid-template-columns: 1fr; }
    .detail-actions { flex-direction: column; }
    .product-guarantees { flex-direction: column; gap: 1rem; }
    .related-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 640px) {
    .related-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@push('scripts')
<script>
function changeQty(delta) {
    const input = document.getElementById('qty');
    input.value = Math.max(1, parseInt(input.value) + delta);
}
</script>
@endpush
