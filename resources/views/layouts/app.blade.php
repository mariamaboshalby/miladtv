@php $locale = app()->getLocale(); $isAr = $locale === 'ar'; @endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isAr ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ميلاد سامي - قطع غيار شاشات التلفزيون')</title>
    <meta name="description" content="@yield('description', 'ميلاد سامي - وجهتك الأولى لقطع غيار شاشات التلفزيون في مصر. جودة عالية وأسعار منافسة.')">

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Preconnect to external origins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <!-- Google Fonts: async load to avoid render-blocking -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Cairo:wght@400;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet"></noscript>

    <!-- Bootstrap 5 — RTL or LTR (critical, keep sync) -->
    @if($isAr)
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    @else
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    @endif

    <!-- Font Awesome — async load (non-render-blocking) -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"></noscript>

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-colors.css') }}">

    @if($isAr)
    <style>
        /* Arabic: apply Cairo only to text elements, never to icon fonts */
        body,
        p, span, a, h1, h2, h3, h4, h5, h6,
        li, td, th, label, input, textarea, select, button,
        .milad-nav-link, .milad-mobile-link, .milad-footer-heading,
        .milad-footer-links a, .milad-footer-contact li,
        .milad-bn-item span, .cart-sidebar-header h3 {
            font-family: 'Cairo', sans-serif !important;
        }
        /* RTL mega-menu alignment fix */
        .milad-mega-menu {
            left: auto !important;
            right: 0 !important;
            transform: translateX(0) translateY(8px) !important;
        }
        .milad-dropdown:hover .milad-mega-menu {
            transform: translateX(0) translateY(0) !important;
        }
    </style>
    @else
    <style>
        body,
        p, span, a, h1, h2, h3, h4, h5, h6,
        li, td, th, label, input, textarea, select, button,
        .milad-nav-link, .milad-mobile-link, .milad-footer-heading,
        .milad-footer-links a, .milad-footer-contact li,
        .milad-bn-item span, .cart-sidebar-header h3 {
            font-family: 'Inter', sans-serif !important;
        }
    </style>
    @endif

    <style>
        /* Smooth scrolling for the whole page */
        html { scroll-behavior: smooth; }
    </style>
    @stack('styles')
</head>
<body>
    <!-- ===== MAIN NAVBAR ===== -->
    <nav class="milad-navbar sticky-top " id="miladNavbar" style="z-index: 10000;">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between gap-3 py-2">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="milad-brand flex-shrink-0">
                    <img src="{{ asset('images/milad-logo.png') }}" alt="ميلاد سامي" class="milad-logo-img"
                         width="140" height="40" fetchpriority="high"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div style="display:none;align-items:center;gap:8px;">
                        <i class="fas fa-tv" style="font-size:1.75rem;color:#051836;"></i>
                        <span style="font-size:1.1rem;font-weight:900;color:#0F172A;letter-spacing:-.02em;">ميلاد<span style="color:#051836;">سامي</span></span>
                    </div>
                </a>
                <!-- Nav Links desktop -->
                <div class="d-none d-lg-flex align-items-center gap-1" id="navbarMenu">
                    <a href="{{ route('home') }}" class="milad-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('app.nav_home') }}</a>

                    <div class="milad-dropdown">
                        <a href="{{ route('products.index') }}" class="milad-nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                            {{ __('app.nav_products') }} <i class="fas fa-chevron-down milad-arrow ms-1"></i>
                        </a>
                        <div class="milad-mega-menu">
                            <div class="milad-mega-inner">
                                @forelse($navCategories as $category)
                                <div class="milad-mega-col">
                                    <p class="milad-mega-heading d-flex align-items-center gap-2">
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="" style="width:22px;height:22px;object-fit:cover;border-radius:4px;">
                                        @elseif($category->icon)
                                            <i class="{{ str_starts_with($category->icon, 'fa-') || str_starts_with($category->icon, 'fas') ? $category->icon : 'fas fa-' . $category->icon }}"></i>
                                        @endif
                                        <span>{{ $isAr ? $category->name_ar : $category->name_en }}</span>
                                    </p>
                                    <a href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $isAr ? $category->name_ar : $category->name_en }}</a>
                                </div>
                                @empty
                                <div class="milad-mega-col">
                                    <p class="milad-mega-heading">{{ __('app.no_categories') }}</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('news.index') }}"      class="milad-nav-link {{ request()->routeIs('news.*')      ? 'active' : '' }}">{{ __('app.nav_news') }}</a>
                    <a href="{{ route('blog.index') }}"      class="milad-nav-link {{ request()->routeIs('blog.*')      ? 'active' : '' }}">{{ __('app.nav_blog') }}</a>
                    <a href="{{ route('about.index') }}"     class="milad-nav-link {{ request()->routeIs('about.*')     ? 'active' : '' }}">{{ __('app.nav_about') }}</a>
                </div>

                <!-- Actions -->
                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <div class="milad-search-wrap" id="navSearchWrap">
                        <form action="{{ route('products.index') }}" method="GET" class="milad-search-form">
                            <input type="text" name="search" placeholder="{{ __('app.nav_search') }}" value="{{ request('search') }}" aria-label="Search">
                            <button type="submit" aria-label="Search"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <button class="milad-icon-btn" id="navSearchToggle" aria-label="Toggle search">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('cart.index') }}" class="milad-icon-btn position-relative" id="cartBtn" aria-label="Cart">
                        <i class="fas fa-shopping-bag"></i>
                        @if(count(session()->get('cart', [])) > 0)
                        <span class="milad-cart-badge" id="cartBadge">{{ count(session()->get('cart', [])) }}</span>
                        @endif
                    </a>

                    {{-- Language Toggle --}}
                    <select
                        onchange="window.location='/lang/'+this.value"
                        aria-label="Switch language"
                        class="milad-lang-select d-none d-lg-flex">
                        <option value="en" {{ !$isAr ? 'selected' : '' }}>🌐 EN</option>
                        <option value="ar" {{ $isAr  ? 'selected' : '' }}>🌐 ع</option>
                    </select>

                    {{-- Auth --}}
                    @auth
                    <div class="dropdown d-none d-lg-block">
                        <button class="milad-icon-btn dropdown-toggle" data-bs-toggle="dropdown" aria-label="Account" style="gap:0;">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" style="min-width:180px;">
                            <li><span class="dropdown-item-text small text-muted fw-semibold">{{ Auth::user()->name }}</span></li>
                            <li><hr class="dropdown-divider my-1"></li>
                            @if(Auth::user()->isAdmin())
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                    <i class="fas fa-tachometer-alt me-2 text-primary"></i>{{ __('app.nav_dashboard') }}
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('app.nav_signout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="milad-icon-btn d-none d-lg-flex" aria-label="Sign in" title="{{ __('app.nav_signin') }}">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                    @endauth
                    <button class="milad-hamburger d-lg-none" id="mobileMenuBtn" aria-label="Menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>

            </div>

            <!-- Mobile Menu -->
            <div class="milad-mobile-menu d-lg-none" id="mobileMenu">
                <a href="{{ route('home') }}"         class="milad-mobile-link {{ request()->routeIs('home')        ? 'active' : '' }}">{{ __('app.nav_home') }}</a>
                <a href="{{ route('products.index') }}" class="milad-mobile-link {{ request()->routeIs('products.*') ? 'active' : '' }}">{{ __('app.nav_products') }}</a>
                <a href="{{ route('news.index') }}"   class="milad-mobile-link {{ request()->routeIs('news.*')      ? 'active' : '' }}">{{ __('app.nav_news') }}</a>
                <a href="{{ route('blog.index') }}"   class="milad-mobile-link {{ request()->routeIs('blog.*')      ? 'active' : '' }}">{{ __('app.nav_blog') }}</a>
                <a href="{{ route('about.index') }}"  class="milad-mobile-link {{ request()->routeIs('about.*')     ? 'active' : '' }}">{{ __('app.nav_about') }}</a>

                {{-- Language Switch (mobile) --}}
                <div class="px-3 py-2">
                    <select
                        onchange="window.location='/lang/'+this.value"
                        aria-label="Switch language"
                        class="milad-lang-select w-100">
                        <option value="en" {{ !$isAr ? 'selected' : '' }}>🌐 English</option>
                        <option value="ar" {{ $isAr  ? 'selected' : '' }}>🌐 العربية</option>
                    </select>
                </div>

                <hr class="my-2 opacity-25">
                @auth
                <div class="px-3 py-2">
                    <p class="small text-muted mb-1 fw-semibold">{{ Auth::user()->name }}</p>
                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-primary w-100 mb-2">
                        <i class="fas fa-tachometer-alt me-1"></i>{{ __('app.nav_dashboard') }}
                    </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="fas fa-sign-out-alt me-1"></i>{{ __('app.nav_signout') }}
                        </button>
                    </form>
                </div>
                @else
                <a href="{{ route('login') }}"    class="milad-mobile-link"><i class="fas fa-sign-in-alt me-2"></i>{{ __('app.nav_signin') }}</a>
                <a href="{{ route('register') }}" class="milad-mobile-link"><i class="fas fa-user-plus me-2"></i>{{ __('app.nav_register') }}</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main id="main-content">
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="milad-footer">
        <div class="milad-footer-top">
            <div class="container">
                <div class="row g-5">

                    <!-- Brand -->
                    <div class="col-lg-4">
                        <img src="{{ asset('images/milad_logo.png') }}" alt="ميلاد سامي" class="milad-footer-logo mb-3"
                             width="140" height="40" loading="lazy" decoding="async"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <div class="d-none align-items-center gap-2 mb-3">
                            <i class="fas fa-tv fa-2x text-primary"></i>
                            <span class="text-white fw-bold fs-5">ميلاد <span class="text-primary">سامي</span></span>
                        </div>
                        <p class="text-secondary small lh-lg">{{ __('app.footer_tagline') }}</p>
                        <div class="d-flex gap-2 mt-3">
                            <a href="https://www.facebook.com/share/181WTrqgHu/" target="_blank" rel="noopener noreferrer" class="milad-footer-social" aria-label="Facebook" title="تابعنا على Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/miladsami.tv/" target="_blank" rel="noopener noreferrer" class="milad-footer-social" aria-label="Instagram" title="تابعنا على Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://wa.me/201093803270" target="_blank" rel="noopener noreferrer" class="milad-footer-social" aria-label="WhatsApp" title="راسلنا على WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="tel:+201093803270" class="milad-footer-social" aria-label="Phone" title="اتصل بنا">
                                <i class="fas fa-phone-alt"></i>
                            </a>
                            <a href="https://www.youtube.com/@miladsami-tv" target="_blank" rel="noopener noreferrer" class="milad-footer-social" aria-label="YouTube" title="قناتنا على YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-sm-6 col-lg-2">
                        <h6 class="milad-footer-heading">{{ __('app.quick_links') }}</h6>
                        <ul class="list-unstyled milad-footer-links">
                            <li><a href="{{ route('home') }}">{{ __('app.nav_home') }}</a></li>
                            <li><a href="{{ route('products.index') }}">{{ __('app.nav_products') }}</a></li>
                            <li><a href="{{ route('news.index') }}">{{ __('app.nav_news') }}</a></li>
                            <li><a href="{{ route('blog.index') }}">{{ __('app.nav_blog') }}</a></li>
                            <li><a href="{{ route('about.index') }}">{{ __('app.nav_about') }}</a></li>
                            <li><a href="{{ route('track-order') }}"><i class="fas fa-shipping-fast me-1 text-primary"></i>{{ __('app.track_order') }}</a></li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div class="col-sm-6 col-lg-2">
                        <h6 class="milad-footer-heading">{{ __('app.categories') }}</h6>
                        <ul class="list-unstyled milad-footer-links">
                            @forelse($navCategories as $category)
                            <li><a href="{{ route('products.index', ['category' => $category->slug]) }}">
                                @if($category->icon)
                                <i class="{{ $category->icon }} me-2 text-primary"></i>
                                @endif
                                {{ $isAr ? $category->name_ar : $category->name_en }}
                            </a></li>
                            @empty
                            <li><span class="text-muted small">{{ __('app.no_categories') }}</span></li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Contact + Newsletter -->
                    <div class="col-lg-4">
                        <h6 class="milad-footer-heading">{{ __('app.get_in_touch') }}</h6>
                        <ul class="list-unstyled milad-footer-contact mb-4">
                            <li><i class="fas fa-map-marker-alt text-primary"></i>{{ __('app.footer_address') }}</li>
                            <li>
                                <i class="fas fa-phone-alt text-primary"></i>
                                <a href="tel:+201093803270" class="text-decoration-none" style="color:inherit;">+20 10 93803270</a>
                            </li>
                            <li>
                                <i class="fas fa-envelope text-primary"></i>
                                <a href="mailto:miladsami.tv@gmail.com" class="text-decoration-none" style="color:inherit;">miladsami.tv@gmail.com</a>
                            </li>
                            <li><i class="fas fa-clock text-primary"></i>{{ __('app.footer_hours') }}</li>
                        </ul>
                        <a href="https://www.google.com/maps/place/30%C2%B056'37.3%22N+31%C2%B017'22.0%22E/@30.9436857,31.2894227,21z" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="btn btn-sm w-100 mb-3" 
                           style="background:rgba(5,24,54,.1);color:#051836;border-radius:8px;font-weight:600;transition:all .3s ease;"
                           onmouseover="this.style.background='#051836';this.style.color='#fff';"
                           onmouseout="this.style.background='rgba(5,24,54,.1)';this.style.color='#051836';">
                            <i class="fas fa-map-marker-alt me-2"></i>{{ app()->getLocale() === 'ar' ? 'عرض الموقع على الخريطة' : 'View on Map' }}
                        </a>
                        <h6 class="milad-footer-heading">{{ __('app.newsletter') }}</h6>
                        <form class="milad-newsletter-form" id="newsletterForm">
                            @csrf
                            <input type="email" name="email" id="newsletterEmail" placeholder="{{ __('app.newsletter_ph') }}" aria-label="Email for newsletter" required>
                            <button type="submit" aria-label="Subscribe" id="newsletterBtn"><i class="fas fa-paper-plane"></i></button>
                        </form>
                        <div id="newsletterMsg" class="mt-2 small d-none"></div>
                    </div>

                </div>
            </div>
        </div>

        <div class="milad-footer-bottom">
            <div class="container d-flex flex-wrap justify-content-between align-items-center gap-3">
                <p class="mb-0 small text-secondary">{{ __('app.footer_copy', ['year' => date('Y')]) }}</p><br>
                <p class="mb-0 small text-secondary">{{ __('app.rights') }}</p>
                <div class="d-flex gap-3 align-items-center" style="font-size:1.5rem; color:#64748b;">
                    <i class="fab fa-cc-visa" title="Visa"></i>
                    <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                    <i class="fas fa-money-bill-wave" title="Cash"></i>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cart Sidebar -->
    <div class="cart-overlay" id="cartOverlay"></div>
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-sidebar-header">
            <h3><i class="fas fa-shopping-bag me-2"></i>{{ __('app.your_cart') }}</h3>
            <button class="close-cart" id="closeCart" aria-label="Close cart"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-sidebar-body" id="cartSidebarBody"></div>
        <div class="cart-sidebar-footer">
            <div class="cart-total">
                <span>{{ __('app.total') }}</span>
                <span class="total-price" id="sidebarTotal">0 EGP</span>
            </div>
            <a href="{{ route('cart.index') }}" class="btn-primary-full">{{ __('app.view_full_cart') }}</a>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Floating Social Buttons -->
    @include('components.social-float-buttons')

    <!-- ===== BOTTOM NAV (mobile only) ===== -->
    <nav class="milad-bottom-nav d-lg-none" aria-label="Mobile navigation">
        <a href="{{ route('home') }}"
           class="milad-bn-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>{{ __('app.bn_home') }}</span>
        </a>
        <a href="{{ route('products.index') }}"
           class="milad-bn-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
            <span>{{ __('app.bn_products') }}</span>
        </a>
        <a href="{{ route('cart.index') }}"
           class="milad-bn-item milad-bn-cart {{ request()->routeIs('cart.*') ? 'active' : '' }}"
           id="cartBtnMobile" aria-label="Cart">
            <div class="milad-bn-cart-bubble">
                <i class="fas fa-shopping-bag"></i>
                @if(count(session()->get('cart', [])) > 0)
                <span class="milad-bn-badge" id="cartBadgeMobile">{{ count(session()->get('cart', [])) }}</span>
                @endif
            </div>
        </a>
        <a href="{{ route('news.index') }}"
           class="milad-bn-item {{ request()->routeIs('news.*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i>
            <span>{{ __('app.bn_news') }}</span>
        </a>
        <a href="{{ route('about.index') }}"
           class="milad-bn-item {{ request()->routeIs('about.*') ? 'active' : '' }}">
            <i class="fas fa-info-circle"></i>
            <span>{{ __('app.bn_about') }}</span>
        </a>
        @auth
        <div class="milad-bn-item dropdown">
            <button class="milad-bn-item-btn" data-bs-toggle="dropdown" aria-label="Account" aria-expanded="false">
                <i class="fas fa-user-circle"></i>
                <span>{{ __('app.bn_account') }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3" style="min-width:160px;bottom:68px;top:auto;position:fixed;right:4px;">
                <li><span class="dropdown-item-text small text-muted fw-semibold">{{ Auth::user()->name }}</span></li>
                <li><hr class="dropdown-divider my-1"></li>
                @if(Auth::user()->isAdmin())
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item small">
                        <i class="fas fa-tachometer-alt me-2 text-primary"></i>{{ __('app.nav_dashboard') }}
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1"></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger small">
                            <i class="fas fa-sign-out-alt me-2"></i>{{ __('app.nav_signout') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @else
        <a href="{{ route('login') }}"
           class="milad-bn-item {{ request()->routeIs('login') ? 'active' : '' }}">
            <i class="fas fa-sign-in-alt"></i>
            <span>{{ __('app.bn_login') }}</span>
        </a>
        @endauth
    </nav>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>

    @stack('scripts')

    <!-- Newsletter AJAX -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('newsletterForm');
        if (!form) return;
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const email  = document.getElementById('newsletterEmail')?.value.trim();
            const btn    = document.getElementById('newsletterBtn');
            const msgEl  = document.getElementById('newsletterMsg');
            if (!email) return;

            if (btn) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                btn.disabled  = true;
            }

            fetch('{{ route('newsletter.subscribe') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email }),
            })
            .then(r => r.json())
            .then(data => {
                if (msgEl) {
                    msgEl.classList.remove('d-none', 'text-danger', 'text-success');
                    if (data.success) {
                        msgEl.textContent = data.message;
                        msgEl.classList.add('text-success');
                        form.reset();
                    } else {
                        const msg = data.errors?.email?.[0] || data.message || 'Error';
                        msgEl.textContent = msg;
                        msgEl.classList.add('text-danger');
                    }
                }
            })
            .catch(() => {
                if (msgEl) {
                    msgEl.textContent = '{{ app()->getLocale() === 'ar' ? 'حدث خطأ. حاول مرة أخرى.' : 'Something went wrong. Try again.' }}';
                    msgEl.classList.remove('d-none');
                    msgEl.classList.add('text-danger');
                }
            })
            .finally(() => {
                if (btn) {
                    btn.innerHTML = '<i class="fas fa-paper-plane"></i>';
                    btn.disabled  = false;
                }
            });
        });

    });
    </script>
</body>
</html>
