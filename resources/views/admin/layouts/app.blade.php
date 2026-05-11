<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') — MJK</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

<!-- ══════════════════════════════════════
     SIDEBAR
══════════════════════════════════════ -->
<aside class="adm-sidebar" id="admSidebar">

    <!-- Logo -->
    <div class="adm-sidebar-head">
        <a href="{{ route('admin.dashboard') }}" class="adm-logo">
            <img src="{{ asset('images/mjk_logo.png') }}" alt="MJK" class="adm-logo-img">
        </a>
        <button class="adm-sidebar-close" id="admSidebarClose">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="adm-nav">

        <div class="adm-nav-group">
            <span class="adm-nav-label">الرئيسية</span>
            <a href="{{ route('admin.dashboard') }}"
               class="adm-nav-item {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                <span class="adm-nav-icon"><i class="fas fa-chart-pie"></i></span>
                <span>لوحة التحكم</span>
            </a>
        </div>

        <div class="adm-nav-group">
            <span class="adm-nav-label">المتجر</span>
            <a href="{{ route('admin.products.index') }}"
               class="adm-nav-item {{ request()->routeIs('admin.products.index') ? 'is-active' : '' }}">
                <span class="adm-nav-icon"><i class="fas fa-box"></i></span>
                <span>المنتجات</span>
                <span class="adm-nav-count">{{ \App\Models\Product::count() }}</span>
            </a>
            <a href="{{ route('admin.products.create') }}"
               class="adm-nav-item {{ request()->routeIs('admin.products.create') ? 'is-active' : '' }}">
                <span class="adm-nav-icon"><i class="fas fa-plus"></i></span>
                <span>إضافة منتج</span>
            </a>
        </div>

        <div class="adm-nav-group">
            <span class="adm-nav-label">الطلبات</span>
            <a href="{{ route('admin.orders.index') }}"
               class="adm-nav-item {{ request()->routeIs('admin.orders.index') ? 'is-active' : '' }}">
                <span class="adm-nav-icon"><i class="fas fa-shopping-bag"></i></span>
                <span>جميع الطلبات</span>
                @php $pending = \App\Models\Order::where('status','pending')->count(); @endphp
                @if($pending > 0)
                <span class="adm-nav-badge">{{ $pending }}</span>
                @endif
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
               class="adm-nav-item">
                <span class="adm-nav-icon"><i class="fas fa-clock"></i></span>
                <span>قيد الانتظار</span>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}"
               class="adm-nav-item">
                <span class="adm-nav-icon"><i class="fas fa-cog"></i></span>
                <span>قيد المعالجة</span>
            </a>
        </div>

        <div class="adm-nav-group">
            <span class="adm-nav-label">المستخدمون</span>
            <a href="{{ route('admin.users.index') }}"
               class="adm-nav-item {{ request()->routeIs('admin.users.index') ? 'is-active' : '' }}">
                <span class="adm-nav-icon"><i class="fas fa-users"></i></span>
                <span>المستخدمون</span>
                <span class="adm-nav-count">{{ \App\Models\User::count() }}</span>
            </a>
            <a href="{{ route('admin.users.create') }}"
               class="adm-nav-item {{ request()->routeIs('admin.users.create') ? 'is-active' : '' }}">
                <span class="adm-nav-icon"><i class="fas fa-user-plus"></i></span>
                <span>إضافة مستخدم</span>
            </a>
        </div>

        <div class="adm-nav-group">
            <span class="adm-nav-label">الموقع</span>
            <a href="{{ route('home') }}" target="_blank" class="adm-nav-item">
                <span class="adm-nav-icon"><i class="fas fa-globe"></i></span>
                <span>عرض الموقع</span>
                <i class="fas fa-external-link-alt" style="font-size:.625rem;margin-right:auto;opacity:.4"></i>
            </a>
        </div>

    </nav>

    <!-- User -->
    <div class="adm-sidebar-foot">
        <div class="adm-user">
            <div class="adm-user-avatar">
                {{ mb_substr(auth()->user()->name ?? 'م', 0, 1) }}
            </div>
            <div class="adm-user-info">
                <span class="adm-user-name">{{ auth()->user()->name ?? 'المدير' }}</span>
                <span class="adm-user-role">Admin</span>
            </div>
        </div>
    </div>

</aside>

<!-- Overlay -->
<div class="adm-overlay" id="admOverlay"></div>

<!-- ══════════════════════════════════════
     MAIN
══════════════════════════════════════ -->
<div class="adm-main" id="admMain">

    <!-- Topbar -->
    <header class="adm-topbar">
        <div class="adm-topbar-right">
            <button class="adm-toggle-btn" id="admToggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="adm-page-info">
                <h1>@yield('page-title', 'لوحة التحكم')</h1>
                <nav class="adm-breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">الرئيسية</a>
                    @yield('breadcrumb')
                </nav>
            </div>
        </div>
        <div class="adm-topbar-left">
            @php $pendingCount = \App\Models\Order::where('status','pending')->count(); @endphp
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="adm-topbar-btn" title="الطلبات المعلقة">
                <i class="fas fa-bell"></i>
                @if($pendingCount > 0)
                <span class="adm-topbar-dot">{{ $pendingCount }}</span>
                @endif
            </a>
            <a href="{{ route('home') }}" target="_blank" class="adm-topbar-btn" title="عرض الموقع">
                <i class="fas fa-globe"></i>
            </a>
            <div class="adm-topbar-user">
                <div class="adm-topbar-avatar">
                    {{ mb_substr(auth()->user()->name ?? 'م', 0, 1) }}
                </div>
                <span>{{ auth()->user()->name ?? 'المدير' }}</span>
            </div>
        </div>
    </header>

    <!-- Alerts -->
    @if(session('success'))
    <div class="adm-alert adm-alert-success" id="admAlert">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
    </div>
    @endif
    @if(session('error'))
    <div class="adm-alert adm-alert-error" id="admAlert">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
    </div>
    @endif

    <!-- Content -->
    <main class="admin-content">
        @yield('content')
    </main>

</div>

<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>
