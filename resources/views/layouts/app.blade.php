@php $locale = app()->getLocale(); $isAr = $locale === 'ar'; @endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isAr ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MJK - Premium Printers and Tech Accessories')</title>
    <meta name="description" content="@yield('description', 'MJK - Egypt s number one destination for printers and computer accessories.')">

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts: Inter + Cairo (Arabic) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 — RTL or LTR -->
    @if($isAr)
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    @else
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    @endif

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @if($isAr)
    <style>
        /* Arabic: apply Cairo only to text elements, never to icon fonts */
        body,
        p, span, a, h1, h2, h3, h4, h5, h6,
        li, td, th, label, input, textarea, select, button,
        .mjk-nav-link, .mjk-mobile-link, .mjk-footer-heading,
        .mjk-footer-links a, .mjk-footer-contact li,
        .mjk-bn-item span, .cart-sidebar-header h3 {
            font-family: 'Cairo', sans-serif !important;
        }
        /* RTL mega-menu alignment fix */
        .mjk-mega-menu {
            left: auto !important;
            right: 0 !important;
            transform: translateX(0) translateY(8px) !important;
        }
        .mjk-dropdown:hover .mjk-mega-menu {
            transform: translateX(0) translateY(0) !important;
        }
    </style>
    @else
    <style>
        body,
        p, span, a, h1, h2, h3, h4, h5, h6,
        li, td, th, label, input, textarea, select, button,
        .mjk-nav-link, .mjk-mobile-link, .mjk-footer-heading,
        .mjk-footer-links a, .mjk-footer-contact li,
        .mjk-bn-item span, .cart-sidebar-header h3 {
            font-family: 'Inter', sans-serif !important;
        }
    </style>
    @endif

    <style>
        /* Smooth scrolling for the whole page */
        html {
            scroll-behavior: smooth;
        }

        /* Page Transition Animations */
        #page-transition-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-color: #ffffff; /* White background */
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            opacity: 1;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }
        #page-transition-overlay.hidden {
            opacity: 0;
            visibility: hidden;
        }
        .loading-icon {
            font-size: 5rem;
            color: #0d6efd; /* Primary blue */
            animation: bounceSpin 1.5s infinite ease-in-out;
        }
        @keyframes bounceSpin {
            0% { transform: scale(0.8) rotate(0deg); opacity: 0.5; }
            50% { transform: scale(1.1) rotate(180deg); opacity: 1; }
            100% { transform: scale(0.8) rotate(360deg); opacity: 0.5; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Page Transition Overlay -->
    <div id="page-transition-overlay">
        <i class="fas fa-microchip loading-icon"></i>
        <div class="mt-4 text-primary fw-bold" style="letter-spacing: 2px; font-size: 1.5rem;">MJK</div>
    </div>
    <!-- ===== MAIN NAVBAR ===== -->
    <nav class="mjk-navbar sticky-top " id="mjkNavbar" style="z-index: 10000;">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between gap-3 py-2">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="mjk-brand flex-shrink-0">
                    <img src="{{ asset('images/mjk_logo.png') }}" alt="MJK" class="mjk-logo-img">
                </a>
                <!-- Nav Links desktop -->
                <div class="d-none d-lg-flex align-items-center gap-1" id="navbarMenu">
                    <a href="{{ route('home') }}" class="mjk-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('app.nav_home') }}</a>

                    <div class="mjk-dropdown">
                        <a href="{{ route('products.index') }}" class="mjk-nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                            {{ __('app.nav_products') }} <i class="fas fa-chevron-down mjk-arrow ms-1"></i>
                        </a>
                        <div class="mjk-mega-menu">
                            <div class="mjk-mega-inner">
                                @forelse($navCategories as $category)
                                <div class="mjk-mega-col">
                                    <p class="mjk-mega-heading">
                                        @if($category->icon)
                                        <i class="{{ $category->icon }}"></i>
                                        @endif
                                        {{ $isAr ? $category->name_ar : $category->name_en }}
                                    </p>
                                    <a href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $isAr ? $category->name_ar : $category->name_en }}</a>
                                </div>
                                @empty
                                <div class="mjk-mega-col">
                                    <p class="mjk-mega-heading">{{ __('app.no_categories') }}</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('news.index') }}"      class="mjk-nav-link {{ request()->routeIs('news.*')      ? 'active' : '' }}">{{ __('app.nav_news') }}</a>
                    <a href="{{ route('blog.index') }}"      class="mjk-nav-link {{ request()->routeIs('blog.*')      ? 'active' : '' }}">{{ __('app.nav_blog') }}</a>
                    <a href="{{ route('downloads.index') }}" class="mjk-nav-link {{ request()->routeIs('downloads.*') ? 'active' : '' }}">{{ __('app.nav_downloads') }}</a>
                    <a href="{{ route('about.index') }}"     class="mjk-nav-link {{ request()->routeIs('about.*')     ? 'active' : '' }}">{{ __('app.nav_about') }}</a>
                </div>

                <!-- Actions -->
                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <div class="mjk-search-wrap" id="navSearchWrap">
                        <form action="{{ route('products.index') }}" method="GET" class="mjk-search-form">
                            <input type="text" name="search" placeholder="{{ __('app.nav_search') }}" value="{{ request('search') }}" aria-label="Search">
                            <button type="submit" aria-label="Search"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <button class="mjk-icon-btn" id="navSearchToggle" aria-label="Toggle search">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('cart.index') }}" class="mjk-icon-btn position-relative" id="cartBtn" aria-label="Cart">
                        <i class="fas fa-shopping-bag"></i>
                        @if(count(session()->get('cart', [])) > 0)
                        <span class="mjk-cart-badge" id="cartBadge">{{ count(session()->get('cart', [])) }}</span>
                        @endif
                    </a>

                    {{-- Language Toggle --}}
                    <select
                        onchange="window.location='/lang/'+this.value"
                        aria-label="Switch language"
                        class="mjk-lang-select d-none d-lg-flex">
                        <option value="en" {{ !$isAr ? 'selected' : '' }}>🌐 EN</option>
                        <option value="ar" {{ $isAr  ? 'selected' : '' }}>🌐 ع</option>
                    </select>

                    {{-- Auth --}}
                    @auth
                    <div class="dropdown d-none d-lg-block">
                        <button class="mjk-icon-btn dropdown-toggle" data-bs-toggle="dropdown" aria-label="Account" style="gap:0;">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" style="min-width:180px;">
                            <li><span class="dropdown-item-text small text-muted fw-semibold">{{ Auth::user()->name }}</span></li>
                            <li><hr class="dropdown-divider my-1"></li>
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
                    <a href="{{ route('login') }}" class="mjk-icon-btn d-none d-lg-flex" aria-label="Sign in" title="{{ __('app.nav_signin') }}">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                    @endauth
                    <button class="mjk-hamburger d-lg-none" id="mobileMenuBtn" aria-label="Menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>

            </div>

            <!-- Mobile Menu -->
            <div class="mjk-mobile-menu d-lg-none" id="mobileMenu">
                <a href="{{ route('home') }}"         class="mjk-mobile-link {{ request()->routeIs('home')        ? 'active' : '' }}">{{ __('app.nav_home') }}</a>
                <a href="{{ route('products.index') }}" class="mjk-mobile-link {{ request()->routeIs('products.*') ? 'active' : '' }}">{{ __('app.nav_products') }}</a>
                <a href="{{ route('news.index') }}"   class="mjk-mobile-link {{ request()->routeIs('news.*')      ? 'active' : '' }}">{{ __('app.nav_news') }}</a>
                <a href="{{ route('blog.index') }}"   class="mjk-mobile-link {{ request()->routeIs('blog.*')      ? 'active' : '' }}">{{ __('app.nav_blog') }}</a>
                <a href="{{ route('downloads.index') }}" class="mjk-mobile-link {{ request()->routeIs('downloads.*') ? 'active' : '' }}">{{ __('app.nav_downloads') }}</a>
                <a href="{{ route('about.index') }}"  class="mjk-mobile-link {{ request()->routeIs('about.*')     ? 'active' : '' }}">{{ __('app.nav_about') }}</a>

                {{-- Language Switch (mobile) --}}
                <div class="px-3 py-2">
                    <select
                        onchange="window.location='/lang/'+this.value"
                        aria-label="Switch language"
                        class="mjk-lang-select w-100">
                        <option value="en" {{ !$isAr ? 'selected' : '' }}>🌐 English</option>
                        <option value="ar" {{ $isAr  ? 'selected' : '' }}>🌐 العربية</option>
                    </select>
                </div>

                <hr class="my-2 opacity-25">
                @auth
                <div class="px-3 py-2">
                    <p class="small text-muted mb-1 fw-semibold">{{ Auth::user()->name }}</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="fas fa-sign-out-alt me-1"></i>{{ __('app.nav_signout') }}
                        </button>
                    </form>
                </div>
                @else
                <a href="{{ route('login') }}"    class="mjk-mobile-link"><i class="fas fa-sign-in-alt me-2"></i>{{ __('app.nav_signin') }}</a>
                <a href="{{ route('register') }}" class="mjk-mobile-link"><i class="fas fa-user-plus me-2"></i>{{ __('app.nav_register') }}</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main id="main-content">
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="mjk-footer">
        <div class="mjk-footer-top">
            <div class="container">
                <div class="row g-5">

                    <!-- Brand -->
                    <div class="col-lg-4">
                        <img src="{{ asset('images/mjk_logo.png') }}" alt="MJK" class="mjk-footer-logo mb-3">
                        <p class="text-secondary small lh-lg">{{ __('app.footer_tagline') }}</p>
                        <div class="d-flex gap-2 mt-3">
                            <a href="#" class="mjk-footer-social" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="mjk-footer-social" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="mjk-footer-social" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="mjk-footer-social" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="mjk-footer-social" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-sm-6 col-lg-2">
                        <h6 class="mjk-footer-heading">{{ __('app.quick_links') }}</h6>
                        <ul class="list-unstyled mjk-footer-links">
                            <li><a href="{{ route('home') }}">{{ __('app.nav_home') }}</a></li>
                            <li><a href="{{ route('products.index') }}">{{ __('app.nav_products') }}</a></li>
                            <li><a href="{{ route('news.index') }}">{{ __('app.nav_news') }}</a></li>
                            <li><a href="{{ route('blog.index') }}">{{ __('app.nav_blog') }}</a></li>
                            <li><a href="{{ route('downloads.index') }}">{{ __('app.nav_downloads') }}</a></li>
                            <li><a href="{{ route('about.index') }}">{{ __('app.nav_about') }}</a></li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div class="col-sm-6 col-lg-2">
                        <h6 class="mjk-footer-heading">{{ __('app.categories') }}</h6>
                        <ul class="list-unstyled mjk-footer-links">
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
                        <h6 class="mjk-footer-heading">{{ __('app.get_in_touch') }}</h6>
                        <ul class="list-unstyled mjk-footer-contact mb-4">
                            <li><i class="fas fa-map-marker-alt text-primary"></i>{{ __('app.footer_address') }}</li>
                            <li><i class="fas fa-phone-alt text-primary"></i>+20 10 01324539</li>
                            <li><i class="fas fa-envelope text-primary"></i>mjk@gmail.com</li>
                            <li><i class="fas fa-clock text-primary"></i>{{ __('app.footer_hours') }}</li>
                        </ul>
                        <h6 class="mjk-footer-heading">{{ __('app.newsletter') }}</h6>
                        <form class="mjk-newsletter-form" onsubmit="return false">
                            <input type="email" placeholder="{{ __('app.newsletter_ph') }}" aria-label="Email for newsletter">
                            <button type="submit" aria-label="Subscribe"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="mjk-footer-bottom">
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

    <!-- ===== BOTTOM NAV (mobile only) ===== -->
    <nav class="mjk-bottom-nav d-lg-none" aria-label="Mobile navigation">
        <a href="{{ route('home') }}"
           class="mjk-bn-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>{{ __('app.bn_home') }}</span>
        </a>
        <a href="{{ route('products.index') }}"
           class="mjk-bn-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
            <span>{{ __('app.bn_products') }}</span>
        </a>
        <a href="{{ route('cart.index') }}"
           class="mjk-bn-item mjk-bn-cart {{ request()->routeIs('cart.*') ? 'active' : '' }}"
           id="cartBtnMobile" aria-label="Cart">
            <div class="mjk-bn-cart-bubble">
                <i class="fas fa-shopping-bag"></i>
                @if(count(session()->get('cart', [])) > 0)
                <span class="mjk-bn-badge" id="cartBadgeMobile">{{ count(session()->get('cart', [])) }}</span>
                @endif
            </div>
        </a>
        <a href="{{ route('news.index') }}"
           class="mjk-bn-item {{ request()->routeIs('news.*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i>
            <span>{{ __('app.bn_news') }}</span>
        </a>
        <a href="{{ route('about.index') }}"
           class="mjk-bn-item {{ request()->routeIs('about.*') ? 'active' : '' }}">
            <i class="fas fa-info-circle"></i>
            <span>{{ __('app.bn_about') }}</span>
        </a>
        @auth
        <div class="mjk-bn-item dropdown">
            <button class="mjk-bn-item-btn" data-bs-toggle="dropdown" aria-label="Account" aria-expanded="false">
                <i class="fas fa-user-circle"></i>
                <span>{{ __('app.bn_account') }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3" style="min-width:160px;bottom:68px;top:auto;position:fixed;right:4px;">
                <li><span class="dropdown-item-text small text-muted fw-semibold">{{ Auth::user()->name }}</span></li>
                <li><hr class="dropdown-divider my-1"></li>
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
           class="mjk-bn-item {{ request()->routeIs('login') ? 'active' : '' }}">
            <i class="fas fa-sign-in-alt"></i>
            <span>{{ __('app.bn_login') }}</span>
        </a>
        @endauth
    </nav>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @stack('scripts')

    <!-- Mouse Interaction Events -->
    <style>
        .mouse-follower {
            position: fixed;
            top: 0;
            left: 0;
            width: 20px;
            height: 20px;
            background-color: rgba(13, 110, 253, 0.4);
            border-radius: 50%;
            pointer-events: none;
            z-index: 99999;
            transform: translate(-50%, -50%);
            transition: transform 0.1s;
        }
        .mouse-click-effect {
            position: fixed;
            top: 0;
            left: 0;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(13, 110, 253, 0.8);
            border-radius: 50%;
            pointer-events: none;
            z-index: 99998;
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            animation: clickRipple 0.5s ease-out forwards;
        }
        @keyframes clickRipple {
            to {
                transform: translate(-50%, -50%) scale(4);
                opacity: 0;
            }
        }
    </style>
    <!-- Floating Dots Background -->
    <style>
        .floating-dot {
            position: fixed;
            bottom: -50px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            pointer-events: none;
            z-index: 99997; /* High enough to be seen but below cursors */
            box-shadow: 0 0 6px rgba(255,255,255,0.4);
            animation: floatUp linear forwards;
        }
        @keyframes floatUp {
            0% {
                transform: translateY(0);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            90% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(-110vh);
                opacity: 0;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- Floating Dots Logic ---
            const createDot = () => {
                const dot = document.createElement('div');
                dot.className = 'floating-dot';
                
                // Random position from left to right
                dot.style.left = Math.random() * 100 + 'vw';
                
                // Random animation duration (10s to 20s)
                const duration = Math.random() * 10 + 10;
                dot.style.animationDuration = duration + 's';
                
                // Random size for the dot (2px to 5px)
                const size = (Math.random() * 3 + 2) + 'px';
                dot.style.width = size;
                dot.style.height = size;

                document.body.appendChild(dot);

                // Clean up element after it floats away
                setTimeout(() => {
                    dot.remove();
                }, duration * 1000);
            };

            // Spawn a new dot frequently
            setInterval(createDot, 600);

            // Spawn many immediately when page loads
            for(let i = 0; i < 15; i++) {
                setTimeout(createDot, i * 200);
            }

            // --- Mouse Follower Logic ---
            const follower = document.createElement('div');
            follower.className = 'mouse-follower';
            document.body.appendChild(follower);

            let mouseX = -100, mouseY = -100;
            let followerX = -100, followerY = -100;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });

            function animate() {
                followerX += (mouseX - followerX) * 0.2;
                followerY += (mouseY - followerY) * 0.2;
                follower.style.left = followerX + 'px';
                follower.style.top = followerY + 'px';
                requestAnimationFrame(animate);
            }
            animate();

            document.addEventListener('mousedown', (e) => {
                follower.style.transform = 'translate(-50%, -50%) scale(0.5)';
                const ripple = document.createElement('div');
                ripple.className = 'mouse-click-effect';
                ripple.style.left = e.clientX + 'px';
                ripple.style.top = e.clientY + 'px';
                document.body.appendChild(ripple);
                setTimeout(() => ripple.remove(), 500);
            });

            document.addEventListener('mouseup', () => {
                follower.style.transform = 'translate(-50%, -50%) scale(1)';
            });

            // Page Transition Logic
            const overlay = document.getElementById('page-transition-overlay');
            if (overlay) {
                // Hide overlay after page loads
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 150);

                document.querySelectorAll('a').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        if (this.hostname === window.location.hostname && 
                            !this.hasAttribute('target') && 
                            this.getAttribute('href') !== '#' && 
                            !this.getAttribute('href').startsWith('javascript:')) {
                            
                            e.preventDefault();
                            const href = this.getAttribute('href');
                            
                            // Show overlay
                            overlay.classList.remove('hidden');
                            
                            setTimeout(() => {
                                window.location.href = href;
                            }, 350);
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
