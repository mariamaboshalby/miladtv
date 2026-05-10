<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') - MJK Admin</title>

    <!-- Google Fonts - Tajawal -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome 6.5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('styles')
</head>
<body class="admin-body">

    <!-- ===== SIDEBAR ===== -->
    <aside class="admin-sidebar" id="adminSidebar">
        <!-- Sidebar Logo -->
        <div class="sidebar-logo">
            <a href="{{ route('admin.dashboard') }}">
                <img src="/images/mjk_logo.png" alt="MJK Logo" class="sidebar-logo-img">
                <span class="sidebar-logo-text">MJK Admin</span>
            </a>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="sidebar-nav">
            <ul class="sidebar-menu">

                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>لوحة التحكم</span>
                    </a>
                </li>

                <li class="sidebar-section-title">المنتجات</li>

                <li class="sidebar-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}" class="sidebar-link">
                        <i class="fas fa-boxes"></i>
                        <span>المنتجات</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.create') }}" class="sidebar-link">
                        <i class="fas fa-plus-circle"></i>
                        <span>إضافة منتج</span>
                    </a>
                </li>

                <li class="sidebar-section-title">الطلبات</li>

                <li class="sidebar-item {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index') }}" class="sidebar-link">
                        <i class="fas fa-shopping-bag"></i>
                        <span>الطلبات</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.orders.pending') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="sidebar-link">
                        <i class="fas fa-clock"></i>
                        <span>الطلبات المعلقة</span>
                        <span class="sidebar-badge pending-badge">!</span>
                    </a>
                </li>

                <li class="sidebar-section-title">المستخدمون</li>

                <li class="sidebar-item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link">
                        <i class="fas fa-users"></i>
                        <span>المستخدمون</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.create') }}" class="sidebar-link">
                        <i class="fas fa-user-plus"></i>
                        <span>إضافة مستخدم</span>
                    </a>
                </li>

                <li class="sidebar-divider"></li>

                <li class="sidebar-item">
                    <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        <span>عرض الموقع</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class="sidebar-link sidebar-logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>تسجيل الخروج</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
    </aside>

    <!-- ===== MAIN WRAPPER ===== -->
    <div class="admin-main" id="adminMain">

        <!-- ===== TOPBAR ===== -->
        <header class="admin-topbar">
            <div class="topbar-right">
                <!-- Hamburger Toggle -->
                <button class="sidebar-toggle-btn" id="sidebarToggleBtn" aria-label="تبديل القائمة">
                    <i class="fas fa-bars"></i>
                </button>
                <!-- Page Title & Breadcrumb -->
                <div class="topbar-title">
                    <h4 class="page-title">@yield('page-title', 'لوحة التحكم')</h4>
                    <nav class="breadcrumb-nav" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="topbar-left">
                <!-- Notifications -->
                <button class="topbar-icon-btn" aria-label="الإشعارات">
                    <i class="fas fa-bell"></i>
                    <span class="topbar-badge">3</span>
                </button>
                <!-- Language / Globe -->
                <button class="topbar-icon-btn" aria-label="اللغة">
                    <i class="fas fa-globe"></i>
                </button>
                <!-- Admin Avatar -->
                <div class="topbar-user">
                    <div class="topbar-avatar">
                        <i class="fas fa-user-circle fa-2x"></i>
                    </div>
                    <span class="topbar-username">{{ auth()->user()->name ?? 'المدير' }}</span>
                </div>
            </div>
        </header>

        <!-- ===== FLASH ALERTS ===== -->
        <div class="admin-alerts">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error alert-dismissible">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-error alert-dismissible">
                    <i class="fas fa-exclamation-triangle"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
        </div>

        <!-- ===== CONTENT ===== -->
        <div class="admin-content">
            @yield('content')
        </div>

    </div><!-- /.admin-main -->

    <!-- Admin JS -->
    <script src="{{ asset('js/admin.js') }}"></script>

    @stack('scripts')
</body>
</html>
