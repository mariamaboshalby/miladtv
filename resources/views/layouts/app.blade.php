<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MJK - Premium Printers and Tech Accessories')</title>
    <meta name="description" content="@yield('description', 'MJK - Egypt s number one destination for printers and computer accessories.')">

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 LTR -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body>
    <!-- ===== MAIN NAVBAR ===== -->
    <nav class="mjk-navbar sticky-top" id="mjkNavbar">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between gap-3 py-2">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="mjk-brand flex-shrink-0">
                    <img src="{{ asset('images/mjk_logo.png') }}" alt="MJK" class="mjk-logo-img">
                </a>
                <!-- Nav Links desktop -->
                <div class="d-none d-lg-flex align-items-center gap-1" id="navbarMenu">
                    <a href="{{ route('home') }}" class="mjk-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

                    <div class="mjk-dropdown">
                        <a href="{{ route('products.index') }}" class="mjk-nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                            Products <i class="fas fa-chevron-down mjk-arrow ms-1"></i>
                        </a>
                        <div class="mjk-mega-menu">
                            <div class="mjk-mega-inner">
                                <div class="mjk-mega-col">
                                    <p class="mjk-mega-heading"><i class="fas fa-print"></i> Printers</p>
                                    <a href="{{ route('products.index', ['category' => 'printers']) }}">HP Printers</a>
                                    <a href="{{ route('products.index', ['category' => 'printers']) }}">Canon Printers</a>
                                    <a href="{{ route('products.index', ['category' => 'printers']) }}">Epson Printers</a>
                                    <a href="{{ route('products.index', ['category' => 'printers']) }}">Brother Printers</a>
                                </div>
                                <div class="mjk-mega-col">
                                    <p class="mjk-mega-heading"><i class="fas fa-mouse"></i> Mice</p>
                                    <a href="{{ route('products.index', ['category' => 'mice']) }}">Wireless Mice</a>
                                    <a href="{{ route('products.index', ['category' => 'mice']) }}">Gaming Mice</a>
                                    <a href="{{ route('products.index', ['category' => 'mice']) }}">Office Mice</a>
                                </div>
                                <div class="mjk-mega-col">
                                    <p class="mjk-mega-heading"><i class="fas fa-headphones"></i> Headphones</p>
                                    <a href="{{ route('products.index', ['category' => 'headphones']) }}">Wireless Headphones</a>
                                    <a href="{{ route('products.index', ['category' => 'headphones']) }}">Gaming Headsets</a>
                                    <a href="{{ route('products.index', ['category' => 'headphones']) }}">Office Headsets</a>
                                </div>
                                <div class="mjk-mega-col">
                                    <p class="mjk-mega-heading"><i class="fas fa-usb"></i> Flash Drives</p>
                                    <a href="{{ route('products.index', ['category' => 'flash']) }}">USB 3.0 Drives</a>
                                    <a href="{{ route('products.index', ['category' => 'flash']) }}">USB 3.2 Drives</a>
                                    <a href="{{ route('products.index', ['category' => 'flash']) }}">High-Capacity Drives</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('news.index') }}"      class="mjk-nav-link {{ request()->routeIs('news.*')      ? 'active' : '' }}">News</a>
                    <a href="{{ route('blog.index') }}"      class="mjk-nav-link {{ request()->routeIs('blog.*')      ? 'active' : '' }}">Blog</a>
                    <a href="{{ route('downloads.index') }}" class="mjk-nav-link {{ request()->routeIs('downloads.*') ? 'active' : '' }}">Downloads</a>
                    <a href="{{ route('about.index') }}"     class="mjk-nav-link {{ request()->routeIs('about.*')     ? 'active' : '' }}">About Us</a>
                </div>

                <!-- Actions -->
                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <div class="mjk-search-wrap" id="navSearchWrap">
                        <form action="{{ route('products.index') }}" method="GET" class="mjk-search-form">
                            <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" aria-label="Search">
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
                    <button class="mjk-hamburger d-lg-none" id="mobileMenuBtn" aria-label="Menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>

            </div>

            <!-- Mobile Menu -->
            <div class="mjk-mobile-menu d-lg-none" id="mobileMenu">
                <a href="{{ route('home') }}"         class="mjk-mobile-link {{ request()->routeIs('home')        ? 'active' : '' }}">Home</a>
                <a href="{{ route('products.index') }}" class="mjk-mobile-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a>
                <a href="{{ route('news.index') }}"   class="mjk-mobile-link {{ request()->routeIs('news.*')      ? 'active' : '' }}">News</a>
                <a href="{{ route('blog.index') }}"   class="mjk-mobile-link {{ request()->routeIs('blog.*')      ? 'active' : '' }}">Blog</a>
                <a href="{{ route('downloads.index') }}" class="mjk-mobile-link {{ request()->routeIs('downloads.*') ? 'active' : '' }}">Downloads</a>
                <a href="{{ route('about.index') }}"  class="mjk-mobile-link {{ request()->routeIs('about.*')     ? 'active' : '' }}">About Us</a>
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
                        <p class="text-secondary small lh-lg">An Egyptian brand with a global mindset. Since 2017, we've been delivering world-class printers and tech accessories to businesses and individuals across Egypt.</p>
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
                        <h6 class="mjk-footer-heading">Quick Links</h6>
                        <ul class="list-unstyled mjk-footer-links">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('products.index') }}">Products</a></li>
                            <li><a href="{{ route('news.index') }}">News</a></li>
                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                            <li><a href="{{ route('downloads.index') }}">Downloads</a></li>
                            <li><a href="{{ route('about.index') }}">About Us</a></li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div class="col-sm-6 col-lg-2">
                        <h6 class="mjk-footer-heading">Categories</h6>
                        <ul class="list-unstyled mjk-footer-links">
                            <li><a href="{{ route('products.index', ['category' => 'printers']) }}"><i class="fas fa-print me-2 text-primary"></i>Printers</a></li>
                            <li><a href="{{ route('products.index', ['category' => 'mice']) }}"><i class="fas fa-mouse me-2 text-primary"></i>Mice</a></li>
                            <li><a href="{{ route('products.index', ['category' => 'headphones']) }}"><i class="fas fa-headphones me-2 text-primary"></i>Headphones</a></li>
                            <li><a href="{{ route('products.index', ['category' => 'flash']) }}"><i class="fas fa-usb me-2 text-primary"></i>Flash Drives</a></li>
                        </ul>
                    </div>

                    <!-- Contact + Newsletter -->
                    <div class="col-lg-4">
                        <h6 class="mjk-footer-heading">Get in Touch</h6>
                        <ul class="list-unstyled mjk-footer-contact mb-4">
                            <li><i class="fas fa-map-marker-alt text-primary"></i>Al Galaa St, Mansoura, Egypt 7650001</li>
                            <li><i class="fas fa-phone-alt text-primary"></i>+20 123 456 7890</li>
                            <li><i class="fas fa-envelope text-primary"></i>info@mjk.com</li>
                            <li><i class="fas fa-clock text-primary"></i>Sat - Thu: 9AM - 9PM</li>
                        </ul>
                        <h6 class="mjk-footer-heading">Newsletter</h6>
                        <form class="mjk-newsletter-form" onsubmit="return false">
                            <input type="email" placeholder="Your email address" aria-label="Email for newsletter">
                            <button type="submit" aria-label="Subscribe"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="mjk-footer-bottom">
            <div class="container d-flex flex-wrap justify-content-between align-items-center gap-3">
                <p class="mb-0 small text-secondary">&copy; {{ date('Y') }} MJK Technology. All rights reserved.</p>
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
            <h3><i class="fas fa-shopping-bag me-2"></i>Your Cart</h3>
            <button class="close-cart" id="closeCart" aria-label="Close cart"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-sidebar-body" id="cartSidebarBody"></div>
        <div class="cart-sidebar-footer">
            <div class="cart-total">
                <span>Total:</span>
                <span class="total-price" id="sidebarTotal">0 EGP</span>
            </div>
            <a href="{{ route('cart.index') }}" class="btn-primary-full">View Full Cart</a>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>