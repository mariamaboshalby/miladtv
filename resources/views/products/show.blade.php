﻿@extends('layouts.app')

@section('title', $product['name'] . ' - MJK')

@section('content')

<div style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 100%);padding:2.5rem 0;">
    <div class="container">
        <h1 class="text-white fw-bold mb-1">{{ Str::limit($product['name'], 60) }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-white-50 text-decoration-none">{{ __('app.prod_breadcrumb_home') }}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('products.index') }}" class="text-white-50 text-decoration-none">{{ __('app.prod_header_title') }}</a>
                </li>
                <li class="breadcrumb-item active text-white-50">{{ Str::limit($product['name'], 40) }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">

        {{-- ═══ TOP: Image + Info ═══ --}}
        <div class="pd-layout">

            {{-- ── Gallery ── --}}
            @php
                $product_model = \App\Models\Product::find($product['id']);
                $media = $product_model ? $product_model->getMedia('product-images') : collect();
                $catIcon = $product['category'] === 'printers' ? 'print'
                         : ($product['category'] === 'mice' ? 'mouse'
                         : ($product['category'] === 'headphones' ? 'headphones' : 'usb'));
            @endphp

            <div class="pd-gallery">
                {{-- Thumbnails column --}}
                @if($media->count() > 1)
                <div class="pd-thumbs">
                    @foreach($media as $img)
                    <button class="pd-thumb {{ $loop->first ? 'active' : '' }}"
                            onclick="switchImg('{{ $img->getUrl('card') }}', this)">
                        <img src="{{ $img->getUrl('thumb') }}" alt="">
                    </button>
                    @endforeach
                </div>
                @endif

                {{-- Main image --}}
                <div class="pd-main-img-wrap">
                    @if($media->count() > 0)
                        <img src="{{ $media->first()->getUrl('card') }}"
                             id="mainImg"
                             class="pd-main-img"
                             alt="{{ $product['name'] }}">
                    @else
                        <div class="pd-no-img">
                            <i class="fas fa-{{ $catIcon }}"></i>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ── Info column ── --}}
            <div class="pd-info">

                {{-- Brand + badge --}}
                <div class="pd-brand-row">
                    <span class="pd-brand">{{ $product['brand'] }}</span>
                    @if($product['badge'])
                    <span class="badge badge-{{ $product['badge_color'] }}">{{ $product['badge'] }}</span>
                    @endif
                </div>

                <h1 class="pd-title">{{ $product['name'] }}</h1>

                {{-- Rating --}}
                <div class="pd-rating">
                    @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star {{ $i < $product['rating'] ? 'active' : '' }}"></i>
                    @endfor
                    <span>({{ $product['reviews'] ?? 0 }} {{ __('app.prod_reviews') }})</span>
                </div>

                {{-- Price --}}
                <div class="pd-price-box">
                    <span class="pd-price">{{ number_format($product['price']) }} EGP</span>
                    @if($product['old_price'])
                    <span class="pd-old-price">{{ number_format($product['old_price']) }} EGP</span>
                    <span class="pd-save">{{ __('app.prod_save', ['amount' => number_format($product['old_price'] - $product['price'])]) }}</span>
                    @endif
                </div>

                <p class="pd-desc">{{ $product['description'] }}</p>

                {{-- Specs table --}}
                @if(!empty($product['specs']))
                <div class="pd-specs">
                    <div class="pd-specs-title">
                        <i class="fas fa-list-ul"></i> {{ __('app.prod_specs_title') }}
                    </div>
                    <table class="pd-specs-table">
                        @foreach($product['specs'] as $spec)
                        @php
                            $parts = explode(':', $spec, 2);
                            $key   = trim($parts[0]);
                            $val   = isset($parts[1]) ? trim($parts[1]) : '';
                        @endphp
                        <tr>
                            <td class="spec-key">{{ $key }}</td>
                            <td class="spec-val">{{ $val ?: $key }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif

                {{-- Actions --}}
                <div class="pd-actions">
                    <div class="qty-box">
                        <button onclick="changeQty(-1)">−</button>
                        <input type="number" id="qty" value="1" min="1" max="99">
                        <button onclick="changeQty(1)">+</button>
                    </div>
                    <button class="btn btn-primary btn-lg pd-cart-btn"
                            onclick="addToCart({{ $product['id'] }}, '{{ addslashes($product['name']) }}', {{ $product['price'] }}, '{{ $product['image_url'] ?? '' }}')">
                        <i class="fas fa-shopping-cart"></i> {{ __('app.prod_add_cart_lg') }}
                    </button>
                </div>

                {{-- Guarantees --}}
                <div class="pd-guarantees">
                    <div class="guar-item"><i class="fas fa-shield-alt"></i><span>{{ __('app.prod_warranty') }}</span></div>
                    <div class="guar-item"><i class="fas fa-truck"></i><span>{{ __('app.prod_delivery') }}</span></div>
                    <div class="guar-item"><i class="fas fa-undo"></i><span>{{ __('app.prod_returns') }}</span></div>
                    <div class="guar-item"><i class="fas fa-headset"></i><span>{{ __('app.prod_support') }}</span></div>
                </div>
            </div>
        </div>

        {{-- ═══ Related Products ═══ --}}
        @if(count($related) > 0)
        <div class="pd-related">
            <h2 class="pd-related-title"><i class="fas fa-th-large"></i> {{ __('app.prod_related_title') }}</h2>
            <div class="related-grid">
                @foreach($related as $item)
                @php
                    $rIcon = $item['category'] === 'printers' ? 'print'
                           : ($item['category'] === 'mice' ? 'mouse'
                           : ($item['category'] === 'headphones' ? 'headphones' : 'usb'));
                @endphp
                <div class="product-card">
                    @if($item['badge'])
                    <span class="product-badge badge badge-{{ $item['badge_color'] }}">{{ $item['badge'] }}</span>
                    @endif
                    <div class="product-image">
                        @if(!empty($item['image_url']))
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div class="placeholder-image" style="display:none">
                                <i class="fas fa-{{ $rIcon }}"></i>
                            </div>
                        @else
                            <div class="placeholder-image">
                                <i class="fas fa-{{ $rIcon }}"></i>
                            </div>
                        @endif
                    </div>
                    <div class="product-info">
                        <span class="product-brand">{{ $item['brand'] }}</span>
                        <h3>{{ $item['name'] }}</h3>
                        <div class="product-price">
                            <span class="price-current">{{ number_format($item['price']) }} EGP</span>
                            @if($item['old_price'])
                            <span class="price-old">{{ number_format($item['old_price']) }} EGP</span>
                            @endif
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-primary"
                                    onclick="addToCart({{ $item['id'] }}, '{{ addslashes($item['name']) }}', {{ $item['price'] }}, '{{ $item['image_url'] ?? '' }}')">
                                <i class="fas fa-shopping-cart"></i> {{ __('app.prod_add_cart') }}
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
/* ═══════════════════════════════════════
   PRODUCT DETAIL PAGE
═══════════════════════════════════════ */
.pd-layout {
    display: grid;
    grid-template-columns: 520px 1fr;
    gap: 3.5rem;
    align-items: start;
    margin-bottom: 4rem;
}
.pd-gallery { display: flex; gap: .875rem; align-items: flex-start; }
.pd-thumbs { display: flex; flex-direction: column; gap: .625rem; flex-shrink: 0; }
.pd-thumb {
    width: 72px; height: 72px; border-radius: 8px; overflow: hidden;
    border: 2px solid #E2E8F0; cursor: pointer; transition: all .2s ease;
    padding: 0; background: #fff; flex-shrink: 0;
}
.pd-thumb img { width: 100%; height: 100%; object-fit: cover; }
.pd-thumb:hover, .pd-thumb.active {
    border-color: #2563EB;
    box-shadow: 0 0 0 3px rgba(37,99,235,.15);
}
.pd-main-img-wrap {
    flex: 1; background: #fff; border-radius: 16px;
    border: 1px solid #E2E8F0; overflow: hidden; height: 420px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 16px rgba(0,0,0,.07);
}
.pd-main-img {
    width: 100%; height: 100%; object-fit: contain;
    transition: transform .4s ease; padding: 1rem;
}
.pd-main-img-wrap:hover .pd-main-img { transform: scale(1.04); }
.pd-no-img {
    display: flex; align-items: center; justify-content: center;
    width: 100%; height: 100%; font-size: 7rem; color: #CBD5E1;
}
.pd-brand-row { display: flex; align-items: center; gap: .75rem; margin-bottom: .875rem; }
.pd-brand {
    display: inline-block; background: #EFF6FF; color: #2563EB;
    padding: .35rem 1rem; border-radius: 50px; font-size: .8125rem;
    font-weight: 800; text-transform: uppercase; letter-spacing: 1px;
}
.pd-title { font-size: 1.625rem; font-weight: 800; color: #0F172A; margin-bottom: .75rem; line-height: 1.3; }
.pd-rating { display: flex; align-items: center; gap: .25rem; margin-bottom: 1.25rem; }
.pd-rating i { color: #D1D5DB; font-size: .875rem; }
.pd-rating i.active { color: #F59E0B; }
.pd-rating span { color: #64748B; font-size: .875rem; margin-right: .375rem; }
.pd-price-box {
    display: flex; align-items: center; gap: .875rem; flex-wrap: wrap;
    padding: 1rem 1.25rem; background: #F8FAFC; border-radius: 12px;
    border: 1px solid #E2E8F0; margin-bottom: 1.25rem;
}
.pd-price { font-size: 2rem; font-weight: 900; color: #2563EB; }
.pd-old-price { font-size: 1.125rem; color: #94A3B8; text-decoration: line-through; }
.pd-save { background: #FEE2E2; color: #DC2626; padding: .3rem .75rem; border-radius: 50px; font-size: .8125rem; font-weight: 700; }
.pd-desc { font-size: .9375rem; color: #475569; line-height: 1.8; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid #F1F5F9; }
.pd-specs { margin-bottom: 1.75rem; border: 1px solid #E2E8F0; border-radius: 12px; overflow: hidden; }
.pd-specs-title { background: #1E3A8A; color: #fff; padding: .625rem 1rem; font-size: .875rem; font-weight: 700; display: flex; align-items: center; gap: .5rem; }
.pd-specs-table { width: 100%; border-collapse: collapse; }
.pd-specs-table tr:nth-child(even) { background: #F8FAFC; }
.pd-specs-table tr:nth-child(odd)  { background: #fff; }
.pd-specs-table tr:hover { background: #EFF6FF; }
.spec-key { padding: .6rem 1rem; font-size: .875rem; font-weight: 700; color: #334155; width: 40%; border-left: 1px solid #E2E8F0; border-bottom: 1px solid #F1F5F9; }
.spec-val { padding: .6rem 1rem; font-size: .875rem; color: #475569; border-bottom: 1px solid #F1F5F9; }
.pd-actions { display: flex; gap: 1rem; align-items: center; margin-bottom: 1.5rem; }
.qty-box { display: flex; align-items: center; border: 2px solid #E2E8F0; border-radius: 50px; overflow: hidden; flex-shrink: 0; }
.qty-box button { width: 42px; height: 46px; background: #F1F5F9; color: #334155; font-size: 1.25rem; font-weight: 700; transition: all .2s ease; }
.qty-box button:hover { background: #2563EB; color: #fff; }
.qty-box input { width: 52px; height: 46px; text-align: center; border: none; font-size: 1.0625rem; font-weight: 700; color: #0F172A; }
.qty-box input:focus { outline: none; }
.pd-cart-btn { flex: 1; justify-content: center; }
.pd-guarantees { display: grid; grid-template-columns: repeat(4, 1fr); gap: .75rem; }
.guar-item { display: flex; flex-direction: column; align-items: center; gap: .375rem; padding: .875rem .5rem; background: #EFF6FF; border-radius: 12px; color: #2563EB; font-size: .8125rem; font-weight: 600; text-align: center; }
.guar-item i { font-size: 1.375rem; }
.pd-related { border-top: 2px solid #F1F5F9; padding-top: 3rem; }
.pd-related-title { font-size: 1.5rem; font-weight: 800; margin-bottom: 1.75rem; display: flex; align-items: center; gap: .625rem; color: #0F172A; }
.pd-related-title i { color: #2563EB; }
.related-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; }
.product-card { position: relative; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.06); transition: all .3s ease; border: 1px solid #F1F5F9; }
.product-card:hover { box-shadow: 0 12px 36px rgba(0,0,0,.12); transform: translateY(-5px); }
.product-badge { position: absolute; top: .75rem; right: .75rem; z-index: 2; }
.product-image { height: 180px; background: #F8FAFC; display: flex; align-items: center; justify-content: center; overflow: hidden; }
.product-image img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
.product-card:hover .product-image img { transform: scale(1.06); }
.placeholder-image { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; color: #CBD5E1; }
.product-info { padding: 1.125rem; }
.product-brand { font-size: .75rem; font-weight: 700; color: #2563EB; text-transform: uppercase; letter-spacing: 1px; margin-bottom: .375rem; display: block; }
.product-info h3 { font-size: .9375rem; margin-bottom: .75rem; color: #0F172A; }
.product-price { display: flex; align-items: center; gap: .5rem; margin-bottom: .875rem; }
.price-current { font-size: 1.125rem; font-weight: 800; color: #2563EB; }
.price-old { font-size: .8125rem; color: #94A3B8; text-decoration: line-through; }
.product-actions { display: grid; grid-template-columns: 1fr auto; gap: .5rem; }
.product-actions .btn { font-size: .8125rem; padding: .5rem .875rem; }

@media (max-width: 1100px) {
    .pd-layout { grid-template-columns: 1fr; gap: 2rem; }
    .pd-gallery { max-width: 520px; }
    .pd-guarantees { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .pd-main-img-wrap { height: 300px; }
    .pd-thumb { width: 58px; height: 58px; }
    .pd-actions { flex-direction: column; }
    .pd-cart-btn { width: 100%; }
    .related-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 480px) {
    .related-grid { grid-template-columns: 1fr; }
    .pd-guarantees { grid-template-columns: repeat(2, 1fr); }
}
</style>
@endpush

@push('scripts')
<script>
function switchImg(url, btn) {
    const img = document.getElementById('mainImg');
    if (img) img.src = url;
    document.querySelectorAll('.pd-thumb').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
}

function changeQty(delta) {
    const input = document.getElementById('qty');
    input.value = Math.max(1, parseInt(input.value || 1) + delta);
}
</script>
@endpush
