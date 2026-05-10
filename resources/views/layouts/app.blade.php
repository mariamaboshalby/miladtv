<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MJK - للطابعات والاكسسوارات التقنية')</title>
    <meta name="description" content="@yield('description', 'MJK الوجهة الأولى للطابعات وأكسسوارات الكمبيوتر في مصر. طابعات HP, Canon, Epson, Brother وأكثر.')">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.ico') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Printer Loader CSS -->
    <link rel="stylesheet" href="{{ asset('css/printer-loader.css') }}">

    @stack('styles')
</head>
<body>

    <!-- GIF Loading Animation -->
    <div class="printer-loader-overlay" id="printerLoaderOverlay">
        <div class="printer-loader-container">
            <img src="{{ asset('images/mjk.gif') }}" alt="MJK Loading" class="loader-gif">
        </div>
    </div>

    <!-- Top Bar -->
    <div class="topbar">
        <div class="container">
            <div class="topbar-left">
                <span><i class="fas fa-phone-alt"></i> +20 123 456 7890</span>
                <span><i class="fas fa-envelope"></i> info@mjk.com</span>
            </div>
            <div class="topbar-right">
                <span><i class="fas fa-truck"></i> شحن مجاني للطلبات فوق 500 جنيه</span>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar" id="mainNavbar">
        <div class="container nav-container">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('images/mjk_logo.png') }}" alt="MJK" class="navbar-logo-img">
            </a>

            <!-- Nav Links (center) -->
            <div class="navbar-menu" id="navbarMenu">
                <ul class="nav-links">
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            الرئيسية
                        </a>
                    </li>
                    <li class="has-dropdown">
                        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                            المنتجات <i class="fas fa-chevron-down arrow"></i>
                        </a>
                        <div class="mega-menu">
                            <div class="mega-menu-inner">
                                <div class="mega-col">
                                    <h4><i class="fas fa-print"></i> الطابعات</h4>
                                    <a href="{{ route('products.index', ['category' => 'printers']) }}">طابعات HP</a>
                                    <a href="{{ route('products.index', ['category' => 'printers']) }}">طابعات Canon</a>
                                    <a href="{{ route('products.index', ['category' => 'printers']) }}">طابعات Epson</a>
                                    <a href="{{ route('products.index', ['category' => 'printers']) }}">طابعات Brother</a>
                                </div>
                                <div class="mega-col">
                                    <h4><i class="fas fa-mouse"></i> الماوسات</h4>
                                    <a href="{{ route('products.index', ['category' => 'mice']) }}">ماوسات لاسلكية</a>
                                    <a href="{{ route('products.index', ['category' => 'mice']) }}">ماوسات جيمينج</a>
                                    <a href="{{ route('products.index', ['category' => 'mice']) }}">ماوسات مكتبية</a>
                                </div>
                                <div class="mega-col">
                                    <h4><i class="fas fa-headphones"></i> السماعات</h4>
                                    <a href="{{ route('products.index', ['category' => 'headphones']) }}">سماعات لاسلكية</a>
                                    <a href="{{ route('products.index', ['category' => 'headphones']) }}">سماعات جيمينج</a>
                                    <a href="{{ route('products.index', ['category' => 'headphones']) }}">سماعات مكتبية</a>
                                </div>
                                <div class="mega-col">
                                    <h4><i class="fas fa-usb"></i> الفلاشات</h4>
                                    <a href="{{ route('products.index', ['category' => 'flash']) }}">فلاشات USB 3.0</a>
                                    <a href="{{ route('products.index', ['category' => 'flash']) }}">فلاشات USB 3.2</a>
                                    <a href="{{ route('products.index', ['category' => 'flash']) }}">فلاشات كبيرة السعة</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a href="{{ route('news.index') }}"      class="{{ request()->routeIs('news.*')      ? 'active' : '' }}">الأخبار</a></li>
                    <li><a href="{{ route('blog.index') }}"      class="{{ request()->routeIs('blog.*')      ? 'active' : '' }}">المدونة</a></li>
                    <li><a href="{{ route('downloads.index') }}" class="{{ request()->routeIs('downloads.*') ? 'active' : '' }}">التحميلات</a></li>
                    <li><a href="{{ route('about.index') }}"     class="{{ request()->routeIs('about.*')     ? 'active' : '' }}">من نحن</a></li>
                </ul>
            </div>

            <!-- Right: Search + Cart + Hamburger -->
            <div class="navbar-actions">
                <!-- Search -->
                <div class="nav-search-wrap" id="navSearchWrap">
                    <form action="{{ route('products.index') }}" method="GET" class="nav-search-form">
                        <input type="text" name="search" placeholder="ابحث عن منتج..." value="{{ request('search') }}">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <button class="nav-search-toggle" id="navSearchToggle" aria-label="بحث">
                    <i class="fas fa-search"></i>
                </button>

                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="nav-action cart-btn" id="cartBtn">
                    <i class="fas fa-shopping-cart"></i>
                    @if(count(session()->get('cart', [])) > 0)
                    <span class="cart-badge" id="cartBadge">{{ count(session()->get('cart', [])) }}</span>
                    @endif
                </a>

                <!-- Hamburger -->
                <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="القائمة">
                    <span></span><span></span><span></span>
                </button>
            </div>

        </div>
    </nav>

    <!-- Page Content -->
    <main id="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-grid">

                    <!-- Brand -->
                    <div class="footer-col footer-brand">
                        <img src="{{ asset('images/mjk_logo.png') }}" alt="MJK"
                             style="height:48px;width:auto;object-fit:contain;filter:brightness(0) invert(1);margin-bottom:1rem">
                        <p>الوجهة الأولى للطابعات وأكسسوارات الكمبيوتر في مصر. نقدم أفضل المنتجات بأفضل الأسعار مع ضمان الجودة والدعم الفني.</p>
                        <div class="footer-social">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="footer-col">
                        <h4>روابط سريعة</h4>
                        <ul>
                            <li><a href="{{ route('home') }}"><i class="fas fa-chevron-left"></i> الرئيسية</a></li>
                            <li><a href="{{ route('products.index') }}"><i class="fas fa-chevron-left"></i> المنتجات</a></li>
                            <li><a href="{{ route('news.index') }}"><i class="fas fa-chevron-left"></i> الأخبار</a></li>
                            <li><a href="{{ route('blog.index') }}"><i class="fas fa-chevron-left"></i> المدونة</a></li>
                            <li><a href="{{ route('downloads.index') }}"><i class="fas fa-chevron-left"></i> التحميلات</a></li>
                            <li><a href="{{ route('about.index') }}"><i class="fas fa-chevron-left"></i> من نحن</a></li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div class="footer-col">
                        <h4>الفئات</h4>
                        <ul>
                            <li><a href="{{ route('products.index', ['category' => 'printers']) }}"><i class="fas fa-print"></i> الطابعات</a></li>
                            <li><a href="{{ route('products.index', ['category' => 'mice']) }}"><i class="fas fa-mouse"></i> الماوسات</a></li>
                            <li><a href="{{ route('products.index', ['category' => 'headphones']) }}"><i class="fas fa-headphones"></i> السماعات</a></li>
                            <li><a href="{{ route('products.index', ['category' => 'flash']) }}"><i class="fas fa-usb"></i> الفلاشات</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div class="footer-col">
                        <h4>تواصل معنا</h4>
                        <ul class="contact-list">
                            <li><i class="fas fa-map-marker-alt"></i> القاهرة، مصر</li>
                            <li><i class="fas fa-phone-alt"></i> +20 123 456 7890</li>
                            <li><i class="fas fa-envelope"></i> info@mjk.com</li>
                            <li><i class="fas fa-clock"></i> السبت - الخميس: 9ص - 9م</li>
                        </ul>
                        <!-- Newsletter -->
                        <div class="footer-newsletter">
                            <p style="color:#94A3B8;font-size:.875rem;margin-bottom:.75rem">اشترك في نشرتنا البريدية</p>
                            <form class="newsletter-form" onsubmit="return false">
                                <input type="email" placeholder="بريدك الإلكتروني">
                                <button type="submit"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p>&copy; {{ date('Y') }} شركة MJK للطابعات والتقنية. جميع الحقوق محفوظة.</p>
                <div class="payment-icons">
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
            <h3><i class="fas fa-shopping-cart"></i> سلة التسوق</h3>
            <button class="close-cart" id="closeCart"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-sidebar-body" id="cartSidebarBody">
            <!-- Cart items loaded via JS -->
        </div>
        <div class="cart-sidebar-footer">
            <div class="cart-total">
                <span>الإجمالي:</span>
                <span class="total-price" id="sidebarTotal">0 جنيه</span>
            </div>
            <a href="{{ route('cart.index') }}" class="btn-primary-full">عرض السلة الكاملة</a>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop" aria-label="العودة للأعلى">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Main JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Printer Loader JS -->
    <script src="{{ asset('js/printer-loader.js') }}"></script>

    @stack('scripts')
</body>
</html>
