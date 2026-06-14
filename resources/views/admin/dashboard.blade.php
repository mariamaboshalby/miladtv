@extends('admin.layouts.app')

@section('title', __('app.dashboard'))
@section('page-title', __('app.dashboard'))

@section('content')

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-box"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['total_products']) }}</h3>
            <p>{{ __('app.total_products') }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-shopping-bag"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['total_orders']) }}</h3>
            <p>{{ __('app.total_orders') }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="fas fa-clock"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['pending_orders']) }}</h3>
            <p>{{ __('app.pending_orders') }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-coins"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['total_revenue']) }}</h3>
            <p>{{ __('app.total_revenue') }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#eef2ff;color:#4f46e5;"><i class="fas fa-pen-nib"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['total_blog_posts']) }}</h3>
            <p>{{ __('app.blog') }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#f0fdf4;color:#16a34a;"><i class="fas fa-download"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['total_downloads']) }}</h3>
            <p>{{ __('app.downloads') }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fff7ed;color:#ea580c;"><i class="fas fa-info-circle"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['total_about_entries']) }}</h3>
            <p>{{ __('app.about') }}</p>
        </div>
    </div>
</div>

<!-- Main Grid -->
<div class="dashboard-grid">

    <!-- Recent Orders -->
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-shopping-bag" style="color:var(--primary-blue);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.recent_orders') }}</h2>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">{{ __('app.view_all') }}</a>
        </div>
        <div class="table-container">
            @if($recent_orders->count())
            <table class="data-table">
                <thead>
                    <tr>
                        <th>{{ __('app.order_number') }}</th>
                        <th>{{ __('app.customer') }}</th>
                        <th>{{ __('app.total') }}</th>
                        <th>{{ __('app.status') }}</th>
                        <th>{{ __('app.date') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_orders as $order)
                    <tr>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>{{ $order->customer_name }}</td>
                        <td><strong style="color:var(--primary-blue)">{{ number_format($order->total) }} {{ app()->getLocale() === 'ar' ? 'ج' : 'EGP' }}</strong></td>
                        <td>
                            <span class="badge badge-{{ $order->status_color }}">
                                {{ $order->status_label }}
                            </span>
                        </td>
                        <td style="color:var(--gray-500);font-size:.875rem">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <i class="fas fa-shopping-bag"></i>
                <p>{{ __('app.no_orders') }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Right Column -->
    <div class="dashboard-right">

        <!-- Low Stock -->
        <div class="card" style="margin-bottom:1.5rem">
            <div class="card-header">
                <h2><i class="fas fa-exclamation-triangle" style="color:var(--warning);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.low_stock') }}</h2>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">{{ __('app.manage') }}</a>
            </div>
            <div class="card-body" style="padding:0">
                @if($low_stock_products->count())
                @foreach($low_stock_products as $product)
                <div class="stock-item">
                    <div class="stock-icon">
                        @php $catModel = $categories->where('slug', $product->category)->first(); @endphp
                        <i class="fas fa-{{ $catModel ? $catModel->icon : 'box' }}"></i>
                    </div>
                    <div class="stock-info">
                        <span class="stock-name">{{ Str::limit($product->name, 30) }}</span>
                        <span class="stock-qty {{ $product->stock == 0 ? 'out' : 'low' }}">
                            {{ $product->stock == 0 ? __('app.out_of_stock') : $product->stock . ' ' . __('app.pieces') }}
                        </span>
                    </div>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
                @endforeach
                @else
                <div class="empty-state" style="padding:2rem">
                    <i class="fas fa-check-circle" style="color:var(--success)"></i>
                    <p>{{ __('app.stock_ok') }}</p>
                </div>
                @endif
            </div>
        </div>
        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-bolt" style="color:var(--warning);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.quick_actions') }}</h2>
            </div>
            <div class="card-body">
                <div class="quick-actions">
                    <a href="{{ route('admin.products.create') }}" class="quick-action-btn">
                        <i class="fas fa-plus-circle"></i>
                        <span>{{ __('app.add_product') }}</span>
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="quick-action-btn">
                        <i class="fas fa-clock"></i>
                        <span>{{ __('app.pending_orders') }}</span>
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="quick-action-btn">
                        <i class="fas fa-cog"></i>
                        <span>{{ __('app.processing') }}</span>
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="quick-action-btn">
                        <i class="fas fa-globe"></i>
                        <span>{{ __('app.view_site') }}</span>
                    </a>
                    <a href="{{ route('admin.blog.index') }}" class="quick-action-btn">
                        <i class="fas fa-pen-nib"></i>
                        <span>{{ __('app.blog') }}</span>
                    </a>
                    <a href="{{ route('admin.downloads.index') }}" class="quick-action-btn">
                        <i class="fas fa-download"></i>
                        <span>{{ __('app.downloads') }}</span>
                    </a>
                    <a href="{{ route('admin.about.index') }}" class="quick-action-btn">
                        <i class="fas fa-info-circle"></i>
                        <span>{{ __('app.about') }}</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- ===== LOW STOCK FULL SECTION ===== -->
<div class="card ls-card" style="margin-top:1.5rem">
    <div class="card-header">
        <h2>
            <i class="fas fa-exclamation-triangle ls-header-icon"></i>
            {{ __('app.low_stock_alert') }}
            @if($low_stock_products->count())
            <span class="ls-count-badge">{{ $low_stock_products->count() }} {{ __('app.products') }}</span>
            @endif
        </h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">{{ __('app.manage_products') }}</a>
    </div>

    @if($low_stock_products->count())
    <div class="ls-grid">
        @foreach($low_stock_products as $product)
        @php
            $isOut  = $product->stock == 0;
            $isLow  = $product->stock > 0 && $product->stock <= 5;
            $pct    = $isOut ? 0 : min(100, ($product->stock / 10) * 100);
            $catModel = $categories->where('slug', $product->category)->first();
            $catIcon = $catModel ? $catModel->icon : 'box';
            $catName = $catModel ? $catModel->name_ar : ucfirst($product->category);
        @endphp
        <div class="ls-item {{ $isOut ? 'ls-out' : 'ls-low' }}">

            {{-- Status stripe --}}
            <div class="ls-stripe"></div>

            {{-- Icon --}}
            <div class="ls-icon">
                <i class="fas fa-{{ $catIcon }}"></i>
            </div>

            {{-- Info --}}
            <div class="ls-info">
                <div class="ls-name">{{ $product->name }}</div>
                <div class="ls-meta">
                    <span class="ls-brand">{{ $product->brand }}</span>
                    <span class="ls-sep">·</span>
                    <span class="ls-cat">{{ $catName }}</span>
                </div>

                {{-- Progress bar --}}
                <div class="ls-bar-wrap">
                    <div class="ls-bar" style="width:{{ $pct }}%"></div>
                </div>
            </div>

            {{-- Stock badge --}}
            <div class="ls-badge-wrap">
                <span class="ls-badge {{ $isOut ? 'ls-badge-out' : 'ls-badge-low' }}">
                    @if($isOut)
                        <i class="fas fa-times-circle"></i> {{ __('app.out') }}
                    @else
                        <i class="fas fa-exclamation-circle"></i> {{ $product->stock }} {{ __('app.pieces') }}
                    @endif
                </span>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary btn-sm ls-edit-btn">
                    <i class="fas fa-edit"></i> {{ __('app.edit') }}
                </a>
            </div>

        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state" style="padding:3rem">
        <i class="fas fa-check-circle" style="color:var(--success);font-size:3rem;margin-bottom:1rem;display:block;"></i>
        <p style="font-size:1.125rem;font-weight:600;color:var(--gray-700)">{{ __('app.stock_ok') }}</p>
        <p style="color:var(--gray-500)">{{ __('app.all_stock_good') }}</p>
    </div>
    @endif
</div>

@endsection

@push('styles')
<style>
.dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 1.5rem;
    align-items: start;
}

.stock-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--gray-100);
    transition: var(--transition);
}

.stock-item:last-child { border-bottom: none; }
.stock-item:hover { background: var(--gray-50); }

.stock-icon {
    width: 40px;
    height: 40px;
    background: var(--secondary-blue);
    border-radius: var(--radius);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-blue);
    flex-shrink: 0;
}

.stock-info {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.stock-name {
    font-weight: 600;
    color: var(--gray-900);
    font-size: .9375rem;
}

.stock-qty {
    font-size: .8125rem;
    font-weight: 700;
}

.stock-qty.low { color: var(--warning); }
.stock-qty.out { color: var(--error); }

.quick-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.quick-action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .75rem;
    padding: 1.5rem 1rem;
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    color: var(--gray-700);
    text-decoration: none;
    font-weight: 600;
    font-size: .9375rem;
    transition: var(--transition);
    text-align: center;
}

.quick-action-btn i {
    font-size: 1.75rem;
    color: var(--primary-blue);
}

.quick-action-btn:hover {
    background: var(--secondary-blue);
    color: var(--primary-blue);
    transform: translateY(-3px);
}

.empty-state {
    text-align: center;
    padding: 3rem;
    color: var(--gray-400);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
}

@media (max-width: 1024px) {
    .dashboard-grid { grid-template-columns: 1fr; }
}

/* ===== Low Stock Full Section ===== */
.ls-card { overflow: hidden; }

.ls-header-icon {
    color: var(--warning);
    margin-left: .5rem;
}

.ls-count-badge {
    display: inline-flex;
    align-items: center;
    background: #FEF3C7;
    color: #D97706;
    font-size: .75rem;
    font-weight: 700;
    padding: .2rem .75rem;
    border-radius: 50px;
    margin-right: .75rem;
}

.ls-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1px;
    background: var(--gray-100);
}

.ls-item {
    position: relative;
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    background: #fff;
    transition: background .2s ease;
    overflow: hidden;
}

.ls-item:hover { background: var(--gray-50); }

/* Left colour stripe */
.ls-stripe {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    width: 4px;
}

.ls-out .ls-stripe  { background: var(--error); }
.ls-low .ls-stripe  { background: var(--warning); }

/* Icon */
.ls-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.375rem;
    flex-shrink: 0;
}

.ls-out .ls-icon { background: #FEE2E2; color: var(--error); }
.ls-low .ls-icon { background: #FEF3C7; color: #D97706; }

/* Info */
.ls-info { flex: 1; min-width: 0; }

.ls-name {
    font-weight: 700;
    font-size: .9375rem;
    color: var(--gray-900);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: .2rem;
}

.ls-meta {
    font-size: .8125rem;
    color: var(--gray-500);
    margin-bottom: .625rem;
}

.ls-sep { margin: 0 .375rem; }

/* Progress bar */
.ls-bar-wrap {
    height: 6px;
    background: var(--gray-100);
    border-radius: 99px;
    overflow: hidden;
}

.ls-bar {
    height: 100%;
    border-radius: 99px;
    transition: width .4s ease;
}

.ls-out .ls-bar { background: var(--error); }
.ls-low .ls-bar { background: var(--warning); }

/* Badge + edit */
.ls-badge-wrap {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: .5rem;
    flex-shrink: 0;
}

.ls-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .3rem .875rem;
    border-radius: 50px;
    font-size: .8125rem;
    font-weight: 700;
    white-space: nowrap;
}

.ls-badge-out { background: #FEE2E2; color: var(--error); }
.ls-badge-low { background: #FEF3C7; color: #D97706; }

.ls-edit-btn { white-space: nowrap; }

@media (max-width: 768px) {
    .ls-grid { grid-template-columns: 1fr; }
    .ls-item { padding: 1rem; }
}
</style>
@endpush
