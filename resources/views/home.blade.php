@extends('layouts.app')
@section('title', __('app.home_about_badge') === 'About Us' ? 'MJK - Your #1 Destination for Printers & Tech
    Accessories' : 'MJK - وجهتك الأولى للطابعات والملحقات التقنية')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/printer-loader.css') }}">
    @endpush
    @push('styles')
        <style>
            /* ── Gallery Grid ── */
            .mjk-gallery {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                grid-template-rows: 280px 280px;
                gap: 12px;
            }

            /* tall item spans 2 rows */
            .mjk-gallery-tall {
                grid-row: span 2;
            }

            /* wide item spans 2 cols */
            .mjk-gallery-wide {
                grid-column: span 2;
            }

            .mjk-gallery-item {
                position: relative;
                overflow: hidden;
                border-radius: 16px;
                cursor: pointer;
            }

            .mjk-gallery-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform .5s cubic-bezier(.25, .46, .45, .94);
                display: block;
            }

            .mjk-gallery-item:hover img {
                transform: scale(1.07);
            }

            /* Overlay */
            .mjk-gallery-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(0, 0, 0, .75) 0%, rgba(0, 0, 0, .1) 50%, transparent 100%);
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                padding: 1.25rem 1.5rem;
                opacity: 0;
                transition: opacity .35s ease;
            }

            .mjk-gallery-item:hover .mjk-gallery-overlay {
                opacity: 1;
            }

            .mjk-gallery-tag {
                display: inline-block;
                background: rgba(37, 99, 235, .85);
                color: #fff;
                font-size: .7rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .08em;
                padding: .25rem .75rem;
                border-radius: 999px;
                margin-bottom: .5rem;
                width: fit-content;
            }

            .mjk-gallery-overlay p {
                color: #fff;
                font-weight: 600;
                font-size: 1rem;
                margin: 0;
                text-shadow: 0 1px 4px rgba(0, 0, 0, .5);
            }

            /* Responsive */
            @media (max-width: 768px) {
                .mjk-gallery {
                    grid-template-columns: 1fr 1fr;
                    grid-template-rows: auto;
                }

                .mjk-gallery-tall {
                    grid-row: span 1;
                }

                .mjk-gallery-wide {
                    grid-column: span 2;
                }

                .mjk-gallery-item {
                    height: 200px;
                }
            }

            @media (max-width: 480px) {
                .mjk-gallery {
                    grid-template-columns: 1fr;
                }

                .mjk-gallery-wide {
                    grid-column: span 1;
                }

                .mjk-gallery-item {
                    height: 220px;
                }
            }
            /* Global Hover Effects */
            .card {
                transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.3s ease !important;
            }
            .card:hover {
                transform: translateY(-8px);
                box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
            }
            
            .bg-light.shadow-sm {
                transition: transform 0.3s ease, box-shadow 0.3s ease !important;
            }
            .bg-light.shadow-sm:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 25px rgba(0,0,0,0.08) !important;
                background-color: #ffffff !important;
            }

            .btn {
                transition: transform 0.2s ease, box-shadow 0.2s ease !important;
            }
            .btn:hover {
                transform: translateY(-2px) scale(1.02);
                box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
            }

            .about-img-wrap img {
                transition: transform 0.5s ease;
            }
            .about-img-wrap:hover img {
                transform: scale(1.03);
            }

            /* Scroll Reveal Animation */
            .reveal {
                opacity: 0;
            }

            /* Carousel Custom Height */
            .hero-img {
                height: 850px;
                object-fit: cover;
            }
            @media (max-width: 991px) {
                .hero-img {
                    height: 500px; /* Ensure it's not too huge on mobile */
                }
            }

            /* Inner Shadow for Carousel Images */
            .carousel-item::after {
                content: '';
                position: absolute;
                inset: 0;
                box-shadow: inset 0 0 120px rgba(0, 0, 0, 0.85);
                pointer-events: none;
            }
        </style>
    @endpush
@section('content')

    {{-- ===== Hero Carousel ===== --}}
    <div class="container-fluid pt-4 pb-2 px-0">
        <div class="mx-auto rounded-4 overflow-hidden shadow-lg" style="width: 90%; max-width: none;">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                aria-current="true"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/slider-1.jpg') }}" class="d-block w-100 hero-img" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider-2.jpg') }}" class="d-block w-100 hero-img" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider-3.jpg') }}" class="d-block w-100 hero-img" alt="Slide 3">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider-4.jpg') }}" class="d-block w-100 hero-img" alt="Slide 4">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider-5.jpg') }}" class="d-block w-100 hero-img" alt="Slide 5">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
        </div>
    </div>

    {{-- ===== About Us Section ===== --}}
    <section class="py-5 bg-white">
        <div class="container py-4">

            {{-- Intro Row --}}
            <div class="row align-items-center g-5 mb-5">

                {{-- Text + Stats --}}
                <div class="col-lg-6 order-2 order-lg-1">
                    <span
                        class="badge text-bg-primary rounded-pill px-3 py-2 mb-3 fs-6">{{ __('app.home_about_badge') }}</span>
                    <h2 class="fw-bold display-6 mb-3">{{ __('app.home_about_title') }}</h2>
                    <p class="text-secondary fs-5 lh-lg">{!! __('app.home_about_p1') !!}</p>
                    <p class="text-secondary fs-5 lh-lg">{{ __('app.home_about_p2') }}</p>
                    <a href="{{ route('about.index') }}" class="btn btn-primary btn-lg mt-2 mb-4">
                        <i class="fas fa-arrow-right me-2"></i> {{ __('app.home_about_btn') }}
                    </a>

                    {{-- Stats row under the text --}}
                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:48px;height:48px;font-size:1.25rem;">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0">500+</h4>
                                    <p class="text-secondary mb-0 small">{{ __('app.home_stat_products') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:48px;height:48px;font-size:1.25rem;">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0">15K+</h4>
                                    <p class="text-secondary mb-0 small">{{ __('app.home_stat_customers') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:48px;height:48px;font-size:1.25rem;">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0">8+</h4>
                                    <p class="text-secondary mb-0 small">{{ __('app.home_stat_years') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:48px;height:48px;font-size:1.25rem;">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0">24/7</h4>
                                    <p class="text-secondary mb-0 small">{{ __('app.home_stat_support') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Store Image --}}
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="about-img-wrap position-relative">
                        <img src="{{ asset('images/about.png') }}"
                            alt="MJK Store — An Egyptian Brand with a Global Mindset"
                            class="img-fluid rounded-4 shadow-lg w-100" style="object-fit:cover; max-height:480px;">
                        {{-- Floating badge --}}
                        <div
                            class="position-absolute bottom-0 start-0 m-3 bg-white rounded-4 shadow px-3 py-2 d-flex align-items-center gap-2">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:36px;height:36px;font-size:1rem;">
                                <i class="fas fa-store"></i>
                            </div>
                            <div>
                                <p class="fw-bold mb-0 small">Est. 2017</p>
                                <p class="text-secondary mb-0" style="font-size:.7rem;">{{ __('app.home_est_location') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Values Row --}}
            <div class="row g-4">

                <div class="col-12 text-center mb-2">
                    <h3 class="fw-bold">{{ __('app.home_values_title') }}</h3>
                    <p class="text-secondary">{{ __('app.home_values_sub') }}</p>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 rounded-4">
                        <div class="mx-auto mb-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                            style="width:64px;height:64px;font-size:1.75rem;">
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="fw-bold">{{ __('app.home_val_quality') }}</h5>
                        <p class="text-secondary small mb-0">{{ __('app.home_val_quality_desc') }}</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 rounded-4">
                        <div class="mx-auto mb-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                            style="width:64px;height:64px;font-size:1.75rem;">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h5 class="fw-bold">{{ __('app.home_val_trust') }}</h5>
                        <p class="text-secondary small mb-0">{{ __('app.home_val_trust_desc') }}</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 rounded-4">
                        <div class="mx-auto mb-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                            style="width:64px;height:64px;font-size:1.75rem;">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h5 class="fw-bold">{{ __('app.home_val_innovation') }}</h5>
                        <p class="text-secondary small mb-0">{{ __('app.home_val_innovation_desc') }}</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 rounded-4">
                        <div class="mx-auto mb-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                            style="width:64px;height:64px;font-size:1.75rem;">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h5 class="fw-bold">{{ __('app.home_val_support') }}</h5>
                        <p class="text-secondary small mb-0">{{ __('app.home_val_support_desc') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== Featured Products Gallery ===== --}}
    <section class="py-5" style="background:#0a0f1e;">
        <div class="container py-4">

            {{-- Header --}}
            <div class="text-center mb-5">
                <span class="badge rounded-pill px-3 py-2 mb-3 fs-6"
                    style="background:rgba(37,99,235,.15);color:#60a5fa;border:1px solid rgba(37,99,235,.3);">{{ __('app.home_prod_badge') }}</span>
                <h2 class="fw-bold text-white mb-2">{{ __('app.home_prod_title') }} <span
                        style="color:#3b82f6;">{{ __('app.home_prod_title_span') }}</span></h2>
                <p class="text-secondary mx-auto" style="max-width:520px;">{{ __('app.home_prod_sub') }}</p>
            </div>

            {{-- Masonry-style grid --}}
            <div class="mjk-gallery">

                {{-- Big left --}}
                <div class="mjk-gallery-item mjk-gallery-tall">
                    <a href="{{ route('products.index') }}">
                        <img src="{{ asset('images/prod-gamepad.jpg') }}" alt="MJK Gaming Headset">
                        <div class="mjk-gallery-overlay">
                            <span class="mjk-gallery-tag">{{ __('app.home_prod_tag_ctrl') }}</span>
                            <p>{{ __('app.home_prod_gamepad') }}</p>
                        </div>
                    </a>
                </div>

                {{-- Top right --}}
                <div class="mjk-gallery-item">
                    <a href="{{ route('products.index') }}">
                        <img src="{{ asset('images/prod-mouse.jpg') }}" alt="MJK Gaming Mouse">
                        <div class="mjk-gallery-overlay">
                            <span class="mjk-gallery-tag">{{ __('app.home_prod_tag_mice') }}</span>
                            <p>{{ __('app.home_prod_mouse') }}</p>
                        </div>
                    </a>
                </div>

                {{-- Bottom right top --}}
                <div class="mjk-gallery-item">
                    <a href="{{ route('products.index') }}">
                        <img src="{{ asset('images/prod-scanner.jpg') }}" alt="MJK Barcode Scanner">
                        <div class="mjk-gallery-overlay">
                            <span class="mjk-gallery-tag">{{ __('app.home_prod_tag_scan') }}</span>
                            <p>{{ __('app.home_prod_scanner') }}</p>
                        </div>
                    </a>
                </div>

                {{-- Wide bottom --}}
                <div class="mjk-gallery-item mjk-gallery-wide">
                    <a href="{{ route('products.index') }}">
                        <img src="{{ asset('images/prod-switch.jpg') }}" alt="MJK PoE Switch">
                        <div class="mjk-gallery-overlay">
                            <span class="mjk-gallery-tag">{{ __('app.home_prod_tag_net') }}</span>
                            <p>{{ __('app.home_prod_switch') }}</p>
                        </div>
                    </a>
                </div>

            </div>

            {{-- CTA --}}
            <div class="text-center mt-5">
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-th-large me-2"></i> {{ __('app.home_prod_browse') }}
                </a>
            </div>

        </div>
    </section>

    {{-- ===== Top Categories Section ===== --}}
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge text-bg-primary rounded-pill px-3 py-2 mb-3 fs-6">{{ app()->getLocale() === 'ar' ? 'التصنيفات' : 'Categories' }}</span>
                <h2 class="fw-bold mb-2">{{ app()->getLocale() === 'ar' ? 'أول أربع تصنيفات' : 'Top 4 Categories' }}</h2>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($topCategories as $category)
                    <div class="col-6 col-md-3">
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm text-center p-4 rounded-4 h-100">
                                <div class="mx-auto mb-3 bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width:80px;height:80px;font-size:2rem;">
                                    <i class="fas fa-{{ $category->icon ?? 'list' }}"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-0">{{ app()->getLocale() === 'ar' ? $category->name_ar : $category->name_en }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== Best Selling Products ===== --}}
    <section class="py-5" style="background:#f8fafc;">
        <div class="container py-4">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <span class="badge text-bg-danger rounded-pill px-3 py-2 mb-2 fs-6">{{ app()->getLocale() === 'ar' ? 'الأكثر مبيعاً' : 'Best Sellers' }}</span>
                    <h2 class="fw-bold mb-0">{{ app()->getLocale() === 'ar' ? 'الاصناف الاكثر مبيعا' : 'Best Selling Products' }}</h2>
                </div>
            </div>
            <div class="row g-4">
                @foreach($bestSellingProducts as $product)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card border-0 shadow-sm h-100 rounded-4">
                            <div style="height: 150px; overflow: hidden; position: relative;">
                                @if(!empty($product['image_url']))
                                    <img src="{{ $product['image_url'] }}" class="w-100 h-100" style="object-fit:cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                        <i class="fas fa-box fa-3x"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-3 text-center d-flex flex-column">
                                <h6 class="fw-bold mb-1" style="font-size:0.9rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $product['name'] }}</h6>
                                <p class="text-primary fw-bold mb-0 mt-auto">{{ number_format($product['price']) }} EGP</p>
                                <a href="{{ route('products.show', $product['id']) }}" class="btn btn-outline-primary btn-sm w-100 mt-2 rounded-pill">{{ __('app.prod_add_cart') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== Most Visited Products ===== --}}
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <span class="badge text-bg-warning rounded-pill px-3 py-2 mb-2 fs-6 text-white">{{ app()->getLocale() === 'ar' ? 'الأكثر زيارة' : 'Most Visited' }}</span>
                    <h2 class="fw-bold mb-0">{{ app()->getLocale() === 'ar' ? 'الاصناف الاكثر زيارة' : 'Most Visited Products' }}</h2>
                </div>
            </div>
            <div class="row g-4">
                @foreach($mostVisitedProducts as $product)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card border-0 shadow-sm h-100 rounded-4">
                            <div style="height: 150px; overflow: hidden; position: relative;">
                                @if(!empty($product['image_url']))
                                    <img src="{{ $product['image_url'] }}" class="w-100 h-100" style="object-fit:cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                        <i class="fas fa-box fa-3x"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-3 text-center d-flex flex-column">
                                <h6 class="fw-bold mb-1" style="font-size:0.9rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $product['name'] }}</h6>
                                <p class="text-primary fw-bold mb-0 mt-auto">{{ number_format($product['price']) }} EGP</p>
                                <a href="{{ route('products.show', $product['id']) }}" class="btn btn-outline-primary btn-sm w-100 mt-2 rounded-pill">{{ __('app.prod_add_cart') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== Latest Products ===== --}}
    <section class="py-5" style="background:#f8fafc;">
        <div class="container py-4">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <span class="badge text-bg-success rounded-pill px-3 py-2 mb-2 fs-6">{{ app()->getLocale() === 'ar' ? 'وصل حديثاً' : 'New Arrivals' }}</span>
                    <h2 class="fw-bold mb-0">{{ app()->getLocale() === 'ar' ? 'اخر 5 اصناف' : 'Latest 5 Products' }}</h2>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($latestProducts as $product)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card border-0 shadow-sm h-100 rounded-4">
                            <div style="height: 150px; overflow: hidden; position: relative;">
                                @if(!empty($product['image_url']))
                                    <img src="{{ $product['image_url'] }}" class="w-100 h-100" style="object-fit:cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                        <i class="fas fa-box fa-3x"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-3 text-center d-flex flex-column">
                                <h6 class="fw-bold mb-1" style="font-size:0.9rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $product['name'] }}</h6>
                                <p class="text-primary fw-bold mb-0 mt-auto">{{ number_format($product['price']) }} EGP</p>
                                <a href="{{ route('products.show', $product['id']) }}" class="btn btn-outline-primary btn-sm w-100 mt-2 rounded-pill">{{ __('app.prod_add_cart') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== Deal of the Day ===== --}}
    @if(($settings['home_show_deal'] ?? '0') == '1' && $dealProduct)
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row align-items-center rounded-4 p-4 p-md-5" style="background: linear-gradient(135deg, #1e3a8a, #2563eb);">
                <div class="col-md-6 text-white mb-4 mb-md-0">
                    <span class="badge bg-danger rounded-pill px-3 py-2 mb-3 fs-6">{{ app()->getLocale() === 'ar' ? 'عرض اليوم' : 'Deal of the Day' }}</span>
                    <h2 class="fw-bold display-6 mb-3">{{ $dealProduct['name'] }}</h2>
                    <p class="fs-5 mb-4 opacity-75" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $dealProduct['description'] }}</p>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <span class="fs-2 fw-bold text-warning">{{ number_format($dealProduct['price']) }} EGP</span>
                        @if($dealProduct['old_price'])
                        <span class="fs-5 text-white-50 text-decoration-line-through">{{ number_format($dealProduct['old_price']) }} EGP</span>
                        @endif
                    </div>
                    
                    @if($dealProduct['end_time'])
                    <div class="d-flex gap-3 text-center mb-4" id="dealCountdown" data-end="{{ \Carbon\Carbon::parse($dealProduct['end_time'])->toIso8601String() }}">
                        <div class="bg-white text-dark rounded-3 p-2" style="min-width: 70px;">
                            <h3 class="fw-bold mb-0" id="dealDays">00</h3>
                            <small class="text-muted">{{ app()->getLocale() === 'ar' ? 'يوم' : 'Days' }}</small>
                        </div>
                        <div class="bg-white text-dark rounded-3 p-2" style="min-width: 70px;">
                            <h3 class="fw-bold mb-0" id="dealHours">00</h3>
                            <small class="text-muted">{{ app()->getLocale() === 'ar' ? 'ساعة' : 'Hours' }}</small>
                        </div>
                        <div class="bg-white text-dark rounded-3 p-2" style="min-width: 70px;">
                            <h3 class="fw-bold mb-0" id="dealMinutes">00</h3>
                            <small class="text-muted">{{ app()->getLocale() === 'ar' ? 'دقيقة' : 'Mins' }}</small>
                        </div>
                        <div class="bg-white text-dark rounded-3 p-2" style="min-width: 70px;">
                            <h3 class="fw-bold mb-0" id="dealSeconds">00</h3>
                            <small class="text-muted">{{ app()->getLocale() === 'ar' ? 'ثانية' : 'Secs' }}</small>
                        </div>
                    </div>
                    @endif

                    <a href="{{ route('products.show', $dealProduct['id']) }}" class="btn btn-light btn-lg px-5 rounded-pill text-primary fw-bold">
                        <i class="fas fa-shopping-cart me-2"></i> {{ __('app.prod_add_cart') }}
                    </a>
                </div>
                <div class="col-md-6 text-center">
                    @if(!empty($dealProduct['image_url']))
                        <img src="{{ $dealProduct['image_url'] }}" class="img-fluid rounded-4 shadow-lg" style="max-height: 400px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-4 d-flex align-items-center justify-content-center" style="height: 300px;">
                            <i class="fas fa-box fa-5x text-muted"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===== Shop by Brand ===== --}}
    @if(($settings['home_show_brands'] ?? '0') == '1' && count($brands) > 0)
    <section class="py-4" style="background:#f8fafc;">
        <div class="container py-3 text-center">
            <h4 class="fw-bold mb-4 text-muted">{{ app()->getLocale() === 'ar' ? 'تسوق حسب الماركة' : 'Shop by Brand' }}</h4>
            <div class="d-flex flex-wrap justify-content-center gap-4">
                @foreach($brands as $brand)
                <a href="{{ route('products.index', ['brand' => $brand->name]) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-circle d-flex align-items-center justify-content-center bg-white" style="width: 100px; height: 100px; overflow:hidden;">
                        @if($brand->hasMedia('brand-logos'))
                            <img src="{{ $brand->getFirstMediaUrl('brand-logos') }}" alt="{{ $brand->name }}" class="w-75">
                        @else
                            <span class="fw-bold text-dark">{{ $brand->name }}</span>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== Recommended For You ===== --}}
    @if(($settings['home_show_recommended'] ?? '0') == '1' && count($recommendedProducts) > 0)
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <span class="badge text-bg-primary rounded-pill px-3 py-2 mb-2 fs-6">{{ app()->getLocale() === 'ar' ? 'مقترح لك' : 'Recommended For You' }}</span>
                    <h2 class="fw-bold mb-0">{{ app()->getLocale() === 'ar' ? 'بناءً على تصفحك' : 'Based on your activity' }}</h2>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($recommendedProducts as $product)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card border-0 shadow-sm h-100 rounded-4">
                            <div style="height: 150px; overflow: hidden; position: relative;">
                                @if(!empty($product['image_url']))
                                    <img src="{{ $product['image_url'] }}" class="w-100 h-100" style="object-fit:cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                        <i class="fas fa-box fa-3x"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-3 text-center d-flex flex-column">
                                <h6 class="fw-bold mb-1" style="font-size:0.9rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $product['name'] }}</h6>
                                <p class="text-primary fw-bold mb-0 mt-auto">{{ number_format($product['price']) }} EGP</p>
                                <a href="{{ route('products.show', $product['id']) }}" class="btn btn-outline-primary btn-sm w-100 mt-2 rounded-pill">{{ __('app.prod_add_cart') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== FAQ ===== --}}
    @if(($settings['home_show_faq'] ?? '0') == '1' && count($faqs) > 0)
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge text-bg-primary rounded-pill px-3 py-2 mb-3 fs-6">{{ app()->getLocale() === 'ar' ? 'الأسئلة الشائعة' : 'FAQ' }}</span>
                <h2 class="fw-bold mb-2">{{ app()->getLocale() === 'ar' ? 'كيف يمكننا مساعدتك؟' : 'How can we help you?' }}</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion accordion-flush" id="faqAccordion">
                        @foreach($faqs as $index => $faq)
                        <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }} fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}">
                                    {{ app()->getLocale() === 'ar' ? $faq->question_ar : ($faq->question_en ?: $faq->question_ar) }}
                                </button>
                            </h2>
                            <div id="faq{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary">
                                    {{ app()->getLocale() === 'ar' ? $faq->answer_ar : ($faq->answer_en ?: $faq->answer_ar) }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===== Track Your Order ===== --}}
    @if(($settings['home_show_track_order'] ?? '0') == '1')
    <section class="py-5" style="background:#f8fafc;">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 text-center">
                        <div class="mx-auto mb-3 bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width:64px;height:64px;font-size:1.75rem;">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                        <h4 class="fw-bold mb-3">{{ app()->getLocale() === 'ar' ? 'تتبع طلبك' : 'Track Your Order' }}</h4>
                        <p class="text-secondary mb-4">{{ app()->getLocale() === 'ar' ? 'أدخل رقم الطلب لمعرفة حالته ومكان الشحنة.' : 'Enter your order number to track its status.' }}</p>
                        
                        <form id="trackOrderForm">
                            <div class="input-group mb-3">
                                <input type="text" id="trackOrderNumber" class="form-control form-control-lg bg-light border-0" placeholder="{{ app()->getLocale() === 'ar' ? 'رقم الطلب (مثال: ORD-12345)' : 'Order Number (e.g. ORD-12345)' }}" required>
                                <button class="btn btn-primary px-4 fw-bold" type="submit">{{ app()->getLocale() === 'ar' ? 'تتبع' : 'Track' }}</button>
                            </div>
                        </form>
                        <div id="trackOrderResult" class="mt-3 fw-bold p-3 rounded-3 d-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ===== Newsletter ===== --}}
    @if(($settings['home_show_newsletter'] ?? '0') == '1')
    <section class="py-5 text-white text-center" style="background: linear-gradient(135deg, #0f172a, #1e3a8a);">
        <div class="container py-4">
            <i class="fas fa-envelope-open-text fa-3x mb-3 text-primary"></i>
            <h2 class="fw-bold mb-3">{{ app()->getLocale() === 'ar' ? 'اشترك في النشرة البريدية' : 'Subscribe to our Newsletter' }}</h2>
            <p class="mb-4 mx-auto" style="max-width: 500px;">{{ app()->getLocale() === 'ar' ? 'احصل على أحدث العروض والأخبار مباشرة على بريدك الإلكتروني.' : 'Get the latest offers and news directly to your inbox.' }}</p>
            <form id="newsletterForm" class="d-flex justify-content-center mx-auto" style="max-width: 400px;">
                @csrf
                <input type="email" id="newsletterEmail" class="form-control rounded-start-pill border-0 px-4" placeholder="{{ app()->getLocale() === 'ar' ? 'بريدك الإلكتروني' : 'Your Email Address' }}" required>
                <button type="submit" class="btn btn-primary rounded-end-pill px-4 fw-bold" style="border-radius: 0 50rem 50rem 0;">{{ app()->getLocale() === 'ar' ? 'اشتراك' : 'Subscribe' }}</button>
            </form>
            <div id="newsletterFeedback" class="mt-3 small d-none"></div>
        </div>
    </section>
    @endif

    {{-- ===== Latest from the Blog ===== --}}
    <section class="py-5" style="background:#f8fafc;">
        <div class="container py-3">

            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <span
                        class="badge text-bg-primary rounded-pill px-3 py-2 mb-2 fs-6">{{ __('app.home_blog_badge') }}</span>
                    <h2 class="fw-bold mb-0">{{ __('app.home_blog_title') }}</h2>
                </div>
                <a href="{{ route('blog.index') }}"
                    class="btn btn-outline-primary rounded-pill px-4 d-none d-md-inline-flex align-items-center gap-2">
                    {{ __('app.home_blog_view_all') }} <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="row g-4">

                @foreach ($blogPosts as $post)
                    <div class="col-md-4">
                        <article class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden"
                            style="transition:transform .25s,box-shadow .25s;">
                            {{-- Placeholder image with category colour --}}
                            <div class="d-flex align-items-center justify-content-center position-relative"
                                style="height:180px;background:linear-gradient(135deg,#1e3a8a,#2563eb);">
                                <i class="fas fa-newspaper text-white opacity-25" style="font-size:4rem;"></i>
                                <span class="position-absolute top-0 start-0 m-3 badge rounded-pill"
                                    style="background:rgba(255,255,255,.2);color:#fff;font-size:.75rem;">
                                    {{ $post->category }}
                                </span>
                            </div>

                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex align-items-center gap-3 mb-2 text-secondary" style="font-size:.8rem;">
                                    <span><i
                                            class="fas fa-calendar-alt me-1 text-primary"></i>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d M Y') : $post->created_at->format('d M Y') }}</span>
                                    <span><i class="fas fa-clock me-1 text-primary"></i>{{ $post->read_time ?? 5 }}
                                        {{ __('app.home_blog_min_read') }}</span>
                                    <span><i
                                            class="fas fa-eye me-1 text-primary"></i>{{ number_format($post->views) }}</span>
                                </div>
                                <h6 class="fw-bold mb-2 lh-base"
                                    style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                    {{ app()->getLocale() === 'ar' ? $post->title_ar ?? $post->title : $post->title }}
                                </h6>
                                <p class="text-secondary small mb-3 flex-grow-1"
                                    style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
                                    {{ app()->getLocale() === 'ar' ? $post->excerpt_ar ?? $post->excerpt : $post->excerpt }}
                                </p>
                                <a href="{{ route('blog.show', $post->id) }}"
                                    class="btn btn-sm btn-outline-primary rounded-pill align-self-start">
                                    {{ __('app.home_blog_read_more') }} <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach

            </div>

            <div class="text-center mt-4 d-md-none">
                <a href="{{ route('blog.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                    {{ __('app.home_blog_view_all_full') }} <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

        </div>
    </section>

    {{-- ===== Customer Testimonials Section ===== --}}
    <section class="py-5" style="background:#f8fafc;">
        <div class="container py-3">

            {{-- Header --}}
            <div class="text-center mb-5">
                <span
                    class="badge text-bg-primary rounded-pill px-3 py-2 mb-3 fs-6">{{ __('app.home_testimonials_badge') }}</span>
                <h2 class="fw-bold mb-2">{{ __('app.home_testimonials_title') }}</h2>
                <p class="text-secondary mx-auto" style="max-width:480px;">{{ __('app.home_testimonials_sub') }}</p>
            </div>

            {{-- Testimonials Grid --}}
            @if ($testimonials->count() > 0)
                <div class="row g-4 mb-5">
                    @foreach ($testimonials as $testimonial)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:48px;height:48px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $testimonial->name }}</h6>
                                        <div class="text-warning small">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-secondary mb-0 small">{{ $testimonial->message }}</p>
                                <div class="mt-3 pt-3 border-top">
                                    <small class="text-muted">
                                        <i
                                            class="fas fa-calendar-alt me-1"></i>{{ $testimonial->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Testimonial Form --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <h4 class="fw-bold mb-3">{{ __('app.home_testimonial_form_title') }}</h4>
                        <p class="text-secondary">{{ __('app.home_testimonial_form_sub') }}</p>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="fas fa-shield-alt text-primary"></i>
                            <small class="text-muted">{{ __('app.home_testimonial_privacy') }}</small>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form id="testimonialForm">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label
                                        class="form-label small fw-semibold">{{ __('app.home_testimonial_name') }}</label>
                                    <input id="testimonialName" type="text" class="form-control rounded-3"
                                        placeholder="{{ __('app.home_testimonial_name_ph') }}" required>
                                </div>
                                <div class="col-sm-6">
                                    <label
                                        class="form-label small fw-semibold">{{ __('app.home_testimonial_email') }}</label>
                                    <input id="testimonialEmail" type="email" class="form-control rounded-3"
                                        placeholder="{{ __('app.home_testimonial_email_ph') }}" required>
                                </div>
                                <div class="col-12">
                                    <label
                                        class="form-label small fw-semibold">{{ __('app.home_testimonial_rating') }}</label>
                                    <div class="d-flex gap-2" id="ratingStars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star fa-2x text-muted rating-star"
                                                data-rating="{{ $i }}" style="cursor:pointer;"></i>
                                        @endfor
                                    </div>
                                    <input type="hidden" id="testimonialRating" value="5">
                                </div>
                                <div class="col-12">
                                    <label
                                        class="form-label small fw-semibold">{{ __('app.home_testimonial_message') }}</label>
                                    <textarea id="testimonialMessage" class="form-control rounded-3" rows="3"
                                        placeholder="{{ __('app.home_testimonial_message_ph') }}" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3">
                                        <i class="fas fa-paper-plane me-2"></i> {{ __('app.home_testimonial_submit') }}
                                    </button>
                                </div>
                            </div>
                            <div id="testimonialFeedback" class="mt-3 small text-center d-none"></div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ===== Contact & Map Section ===== --}}
    <section class="py-5 bg-white">
        <div class="container py-4">

            {{-- Header --}}
            <div class="text-center mb-5">
                <span
                    class="badge text-bg-primary rounded-pill px-3 py-2 mb-3 fs-6">{{ __('app.home_contact_badge') }}</span>
                <h2 class="fw-bold mb-2">{{ __('app.home_contact_title') }}</h2>
                <p class="text-secondary mx-auto" style="max-width:480px;">{{ __('app.home_contact_sub') }}</p>
            </div>

            <div class="row g-4 align-items-stretch">

                {{-- Left: big form --}}
                <div class="col-lg-5 d-flex flex-column">
                    <div class="rounded-4 border p-4 flex-grow-1 d-flex flex-column">

                        {{-- Mini info strip --}}
                        <div class="d-flex flex-wrap gap-3 mb-4 pb-3 border-bottom">
                            <span class="small text-secondary">
                                <i
                                    class="fas fa-map-marker-alt text-primary me-1"></i>{{ __('app.home_contact_address') }}
                            </span>
                            <a href="tel:+201001324539" class="small text-secondary text-decoration-none">
                                <i class="fas fa-phone-alt text-primary me-1"></i>+20 123 456 7890
                            </a>
                            <a href="https://wa.me/201001324539" target="_blank"
                                class="small text-secondary text-decoration-none">
                                <i class="fab fa-whatsapp text-primary me-1"></i>{{ __('app.home_contact_whatsapp') }}
                            </a>
                        </div>

                        <h5 class="fw-bold mb-1">{{ __('app.home_contact_form_title') }}</h5>
                        <p class="text-secondary small mb-4">{{ __('app.home_contact_form_sub') }}</p>

                        <form id="contactForm" class="d-flex flex-column flex-grow-1">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold">{{ __('app.home_contact_name') }}</label>
                                    <input id="contactName" type="text" class="form-control rounded-3"
                                        placeholder="{{ __('app.home_contact_name_ph') }}" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold">{{ __('app.home_contact_email') }}</label>
                                    <input id="contactEmail" type="email" class="form-control rounded-3"
                                        placeholder="{{ __('app.home_contact_email_ph') }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">{{ __('app.home_contact_subject') }}</label>
                                <input id="contactSubject" type="text" class="form-control rounded-3"
                                    placeholder="{{ __('app.home_contact_subject_ph') }}" required>
                            </div>
                            <div class="mb-4 flex-grow-1">
                                <label class="form-label small fw-semibold">{{ __('app.home_contact_message') }}</label>
                                <textarea id="contactMessage" class="form-control rounded-3" style="min-height:140px;"
                                    placeholder="{{ __('app.home_contact_message_ph') }}" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3">
                                <i class="fas fa-paper-plane me-2"></i> {{ __('app.home_contact_send') }}
                            </button>
                            <div id="contactFeedback" class="mt-3 small text-center d-none"></div>
                        </form>

                    </div>
                </div>

                {{-- Right: Google Map --}}
                <div class="col-lg-7" style="min-height:500px;">
                    <div class="rounded-4 overflow-hidden shadow-sm m-2">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d427.3126741646018!2d31.3651253!3d31.040138600000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f79dc660c33b0d%3A0xcc828a49e08b04ae!2z2LTYsdmD2YcgOTAg2YPYp9mF2YrYsdin2Ko!5e0!3m2!1sar!2seg!4v1778597954263!5m2!1sar!2seg"
                            width="100%" height="100%" style="border:0; min-height:500px; display:block;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="MJK Location - Mansoura, Egypt"></iframe>
                    </div>
                    <div class="rounded-4 overflow-hidden shadow-sm m-2">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d792.201006963661!2d31.307853230395082!3d30.088475194083156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sen!2seg!4v1779698431846!5m2!1sen!2seg"
                            width="100%" height="100%" style="border:0; min-height:400px; display:block;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="MJK Additional Location"></iframe>
                    </div>
                </div>

            </div>
            
        </div>
    </section>

    @push('scripts')
        <script>
            document.getElementById('contactForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const name = document.getElementById('contactName').value.trim();
                const email = document.getElementById('contactEmail').value.trim();
                const subject = document.getElementById('contactSubject').value.trim();
                const message = document.getElementById('contactMessage').value.trim();
                const feedback = document.getElementById('contactFeedback');

                if (!name || !email || !subject || !message) return;

                const gmailSubject = encodeURIComponent(subject + '  from ' + name);
                const gmailBody = encodeURIComponent(
                    'Name: ' + name + '\n' +
                    'Email: ' + email + '\n' +
                    'Subject: ' + subject + '\n\n' +
                    'Message:\n' + message
                );

                const gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=mjk%40gmail.com&su=' + gmailSubject +
                    '&body=' + gmailBody;
                window.open(gmailUrl, '_blank');

                feedback.classList.remove('d-none', 'text-danger');
                feedback.classList.add('text-success');
                feedback.innerHTML = '<i class="fas fa-check-circle me-1"></i> {{ __('app.home_contact_opening') }}';

                setTimeout(() => {
                    this.reset();
                    feedback.classList.add('d-none');
                }, 3000);
            });

            // Testimonial Form
            const ratingStars = document.querySelectorAll('.rating-star');
            const ratingInput = document.getElementById('testimonialRating');
            let currentRating = 5;

            ratingStars.forEach(star => {
                star.addEventListener('click', function() {
                    currentRating = parseInt(this.dataset.rating);
                    ratingInput.value = currentRating;
                    updateStars();
                });

                star.addEventListener('mouseenter', function() {
                    const hoverRating = parseInt(this.dataset.rating);
                    highlightStars(hoverRating);
                });

                star.addEventListener('mouseleave', function() {
                    highlightStars(currentRating);
                });
            });

            function updateStars() {
                highlightStars(currentRating);
            }

            function highlightStars(rating) {
                ratingStars.forEach(star => {
                    const starRating = parseInt(star.dataset.rating);
                    if (starRating <= rating) {
                        star.classList.remove('text-muted');
                        star.classList.add('text-warning');
                    } else {
                        star.classList.remove('text-warning');
                        star.classList.add('text-muted');
                    }
                });
            }

            // Initialize stars
            updateStars();

            // Submit testimonial
            document.getElementById('testimonialForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const name = document.getElementById('testimonialName').value.trim();
                const email = document.getElementById('testimonialEmail').value.trim();
                const rating = document.getElementById('testimonialRating').value;
                const message = document.getElementById('testimonialMessage').value.trim();
                const feedback = document.getElementById('testimonialFeedback');

                if (!name || !email || !message) return;

                fetch('{{ route('testimonials.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name, email, rating, message })
                    })
                    .then(response => response.json())
                    .then(data => {
                        feedback.classList.remove('d-none', 'text-danger');
                        if (data.success) {
                            feedback.classList.add('text-success');
                            feedback.innerHTML = '<i class="fas fa-check-circle me-1"></i> ' + data.message;
                            this.reset();
                            ratingInput.value = 5;
                            currentRating = 5;
                            updateStars();

                            setTimeout(() => {
                                feedback.classList.add('d-none');
                            }, 5000);
                        } else {
                            feedback.classList.add('text-danger');
                            feedback.innerHTML = '<i class="fas fa-times-circle me-1"></i> ' + data.message;
                        }
                    })
                    .catch(error => {
                        feedback.classList.remove('d-none', 'text-success');
                        feedback.classList.add('text-danger');
                        feedback.innerHTML =
                            '<i class="fas fa-exclamation-circle me-1"></i> {{ __('app.home_testimonial_error') }}';
                    });
            });

            // Countdown Timer
            const cd = document.getElementById('dealCountdown');
            if (cd) {
                const endTime = new Date(cd.dataset.end).getTime();
                const timer = setInterval(() => {
                    const now = new Date().getTime();
                    const diff = endTime - now;
                    if (diff < 0) {
                        clearInterval(timer);
                        return;
                    }
                    document.getElementById('dealDays').innerText = Math.floor(diff / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
                    document.getElementById('dealHours').innerText = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
                    document.getElementById('dealMinutes').innerText = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
                    document.getElementById('dealSeconds').innerText = Math.floor((diff % (1000 * 60)) / 1000).toString().padStart(2, '0');
                }, 1000);
            }

            // Newsletter
            const nForm = document.getElementById('newsletterForm');
            if (nForm) {
                nForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = document.getElementById('newsletterEmail').value;
                    const fb = document.getElementById('newsletterFeedback');
                    fetch('{{ route('newsletter.subscribe') }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({ email })
                    }).then(res => res.json()).then(data => {
                        fb.classList.remove('d-none', 'text-danger', 'text-success');
                        fb.classList.add(data.success ? 'text-white' : 'text-danger');
                        fb.innerHTML = (data.success ? '<i class="fas fa-check-circle me-1"></i>' : '<i class="fas fa-exclamation-circle me-1"></i>') + data.message;
                        if(data.success) nForm.reset();
                    });
                });
            }

            // Track Order
            const tForm = document.getElementById('trackOrderForm');
            if (tForm) {
                tForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const orderNum = document.getElementById('trackOrderNumber').value;
                    const resDiv = document.getElementById('trackOrderResult');
                    fetch('{{ route('track-order.status') }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({ order_number: orderNum })
                    }).then(res => res.json()).then(data => {
                        resDiv.classList.remove('d-none', 'text-danger', 'bg-danger', 'bg-opacity-10', 'text-success', 'bg-success');
                        if (data.success) {
                            resDiv.classList.add('text-success', 'bg-success', 'bg-opacity-10');
                            resDiv.innerHTML = '<i class="fas fa-check-circle me-2"></i> {{ app()->getLocale() === "ar" ? "حالة الطلب:" : "Order Status:" }} ' + data.status;
                        } else {
                            resDiv.classList.add('text-danger', 'bg-danger', 'bg-opacity-10');
                            resDiv.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i> ' + data.message;
                        }
                    });
                });
            }

            // Parallax Reverse Motion on Carousel
            const heroCarousel = document.getElementById('heroCarousel');
            if (heroCarousel) {
                heroCarousel.addEventListener('mousemove', function(e) {
                    const rect = heroCarousel.getBoundingClientRect();
                    
                    // Calculate mouse position relative to the center of the carousel
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    
                    // Move the image in the OPPOSITE direction of the mouse
                    const moveX = -(x / 20);
                    const moveY = -(y / 20);

                    // Find the active image
                    const activeImage = heroCarousel.querySelector('.carousel-item.active .hero-img');
                    if (activeImage) {
                        // Apply transform (scale slightly to avoid showing borders when moving)
                        activeImage.style.transform = `scale(1.05) translate(${moveX}px, ${moveY}px)`;
                        activeImage.style.transition = 'transform 0.1s ease-out';
                    }
                });

                // Reset position when mouse leaves the carousel
                heroCarousel.addEventListener('mouseleave', function() {
                    const images = heroCarousel.querySelectorAll('.hero-img');
                    images.forEach(img => {
                        img.style.transform = 'scale(1) translate(0px, 0px)';
                        img.style.transition = 'transform 0.5s ease-out';
                    });
                });
            }
        </script>
    @endpush

@endsection
