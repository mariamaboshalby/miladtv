@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')
@section('page-title', 'لوحة التحكم')

@section('content')

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-box"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['total_products']) }}</h3>
            <p>إجمالي المنتجات</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-shopping-bag"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['total_orders']) }}</h3>
            <p>إجمالي الطلبات</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="fas fa-clock"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['pending_orders']) }}</h3>
            <p>طلبات قيد الانتظار</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-coins"></i></div>
        <div class="stat-content">
            <h3>{{ number_format($stats['total_revenue']) }}</h3>
            <p>إجمالي الإيرادات (جنيه)</p>
        </div>
    </div>
</div>

<!-- Main Grid -->
<div class="dashboard-grid">

    <!-- Recent Orders -->
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-shopping-bag" style="color:var(--primary-blue);margin-left:.5rem"></i> آخر الطلبات</h2>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">عرض الكل</a>
        </div>
        <div class="table-container">
            @if($recent_orders->count())
            <table class="data-table">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>العميل</th>
                        <th>الإجمالي</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_orders as $order)
                    <tr>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>{{ $order->customer_name }}</td>
                        <td><strong style="color:var(--primary-blue)">{{ number_format($order->total) }} ج</strong></td>
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
                <p>لا توجد طلبات بعد</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Right Column -->
    <div class="dashboard-right">

        <!-- Low Stock -->
        <div class="card" style="margin-bottom:1.5rem">
            <div class="card-header">
                <h2><i class="fas fa-exclamation-triangle" style="color:var(--warning);margin-left:.5rem"></i> مخزون منخفض</h2>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">إدارة</a>
            </div>
            <div class="card-body" style="padding:0">
                @if($low_stock_products->count())
                @foreach($low_stock_products as $product)
                <div class="stock-item">
                    <div class="stock-icon">
                        <i class="fas fa-{{ $product->category === 'printers' ? 'print' : ($product->category === 'mice' ? 'mouse' : ($product->category === 'headphones' ? 'headphones' : 'usb')) }}"></i>
                    </div>
                    <div class="stock-info">
                        <span class="stock-name">{{ Str::limit($product->name, 30) }}</span>
                        <span class="stock-qty {{ $product->stock == 0 ? 'out' : 'low' }}">
                            {{ $product->stock == 0 ? 'نفد المخزون' : $product->stock . ' قطعة' }}
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
                    <p>المخزون بخير!</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-bolt" style="color:var(--warning);margin-left:.5rem"></i> إجراءات سريعة</h2>
            </div>
            <div class="card-body">
                <div class="quick-actions">
                    <a href="{{ route('admin.products.create') }}" class="quick-action-btn">
                        <i class="fas fa-plus-circle"></i>
                        <span>إضافة منتج</span>
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="quick-action-btn">
                        <i class="fas fa-clock"></i>
                        <span>طلبات الانتظار</span>
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="quick-action-btn">
                        <i class="fas fa-cog"></i>
                        <span>قيد المعالجة</span>
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="quick-action-btn">
                        <i class="fas fa-globe"></i>
                        <span>عرض الموقع</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
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
</style>
@endpush
