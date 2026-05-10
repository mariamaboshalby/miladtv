<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') — MJK Admin</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
              <img src="{{ asset('images/mjk_logo.png') }}" alt="MJK Logo" class="sidebar-logo-img">
        </div>
        <button class="sidebar-close" id="sidebarClose"><i class="fas fa-times"></i></button>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <span class="nav-section-title">الرئيسية</span>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i>
                <span>لوحة التحكم</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">المتجر</span>
            <a href="{{ route('admin.products.index') }}"
               class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                <span>المنتجات</span>
                <span class="nav-badge">{{ \App\Models\Product::count() }}</span>
            </a>
            <a href="{{ route('admin.products.create') }}"
               class="nav-item {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i>
                <span>إضافة منتج</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">الطلبات</span>
            <a href="{{ route('admin.orders.index') }}"
               class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-bag"></i>
                <span>جميع الطلبات</span>
                @php $pendingCount = \App\Models\Order::where('status','pending')->count(); @endphp
                @if($pendingCount > 0)
                <span class="nav-badge badge-red">{{ $pendingCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
               class="nav-item">
                <i class="fas fa-clock"></i>
                <span>قيد الانتظار</span>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}"
               class="nav-item">
                <i class="fas fa-cog"></i>
                <span>قيد المعالجة</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">المستخدمون</span>
            <a href="{{ route('admin.users.index') }}"
               class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>المستخدمون</span>
                <span class="nav-badge">{{ \App\Models\User::count() }}</span>
            </a>
            <a href="{{ route('admin.users.create') }}"
               class="nav-item {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                <i class="fas fa-user-plus"></i>
                <span>إضافة مستخدم</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">الموقع</span>
            <a href="{{ route('home') }}" target="_blank" class="nav-item">
                <i class="fas fa-external-link-alt"></i>
                <span>عرض الموقع</span>
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-user">
            <div class="user-avatar"><i class="fas fa-user-shield"></i></div>
            <div class="user-info">
                <span class="user-name">المدير</span>
                <span class="user-role">Admin</span>
            </div>
        </div>
    </div>
</aside>

<!-- Sidebar Overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Main Content -->
<div class="admin-main" id="adminMain">

    <!-- Top Bar -->
    <header class="admin-topbar">
        <div class="topbar-right">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="page-title">
                <h1>@yield('page-title', 'لوحة التحكم')</h1>
                <nav class="admin-breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">الرئيسية</a>
                    @yield('breadcrumb')
                </nav>
            </div>
        </div>
        <div class="topbar-left">
            @php $pendingOrders = \App\Models\Order::where('status','pending')->count(); @endphp
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="topbar-action">
                <i class="fas fa-bell"></i>
                @if($pendingOrders > 0)
                <span class="action-badge">{{ $pendingOrders }}</span>
                @endif
            </a>
            <a href="{{ route('home') }}" target="_blank" class="topbar-action" title="عرض الموقع">
                <i class="fas fa-globe"></i>
            </a>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="alert alert-success" id="flashAlert">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
        <button onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error" id="flashAlert">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
        <button onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
    </div>
    @endif

    <!-- Page Content -->
    <main class="admin-content">
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>
