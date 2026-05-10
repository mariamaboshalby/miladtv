@extends('admin.layouts.app')

@section('title', 'الطلبات')
@section('page-title', 'إدارة الطلبات')
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i> <span>الطلبات</span>
@endsection

@section('content')

<div class="toolbar">
    <form class="toolbar-search" method="GET" action="{{ route('admin.orders.index') }}">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" name="search" placeholder="بحث برقم الطلب أو اسم العميل..." value="{{ request('search') }}">
        </div>
        <select name="status" class="form-control" style="width:180px">
            <option value="">كل الحالات</option>
            <option value="pending"    {{ request('status')=='pending'    ? 'selected':'' }}>⏳ قيد الانتظار</option>
            <option value="processing" {{ request('status')=='processing' ? 'selected':'' }}>⚙️ قيد المعالجة</option>
            <option value="shipped"    {{ request('status')=='shipped'    ? 'selected':'' }}>🚚 تم الشحن</option>
            <option value="delivered"  {{ request('status')=='delivered'  ? 'selected':'' }}>✅ تم التسليم</option>
            <option value="cancelled"  {{ request('status')=='cancelled'  ? 'selected':'' }}>❌ ملغي</option>
        </select>
        <select name="payment_status" class="form-control" style="width:160px">
            <option value="">حالة الدفع</option>
            <option value="unpaid"   {{ request('payment_status')=='unpaid'   ? 'selected':'' }}>غير مدفوع</option>
            <option value="paid"     {{ request('payment_status')=='paid'     ? 'selected':'' }}>مدفوع</option>
            <option value="refunded" {{ request('payment_status')=='refunded' ? 'selected':'' }}>مسترد</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> بحث</button>
        @if(request()->hasAny(['search','status','payment_status']))
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i> مسح</a>
        @endif
    </form>
</div>

<div class="card">
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>العميل</th>
                    <th>المدينة</th>
                    <th>المنتجات</th>
                    <th>الإجمالي</th>
                    <th>حالة الطلب</th>
                    <th>حالة الدفع</th>
                    <th>التاريخ</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><strong style="color:var(--primary-blue)">{{ $order->order_number }}</strong></td>
                    <td>
                        <div>
                            <strong>{{ $order->customer_name }}</strong>
                            <span style="display:block;font-size:.8125rem;color:var(--gray-500)">{{ $order->customer_phone }}</span>
                        </div>
                    </td>
                    <td>{{ $order->city }}</td>
                    <td>
                        <span class="badge badge-blue">{{ $order->items->count() }} منتج</span>
                    </td>
                    <td><strong style="color:var(--primary-blue)">{{ number_format($order->total) }} ج</strong></td>
                    <td>
                        <span class="badge badge-{{ $order->status_color }}">{{ $order->status_label }}</span>
                    </td>
                    <td>
                        @php
                            $pc = match($order->payment_status) { 'paid'=>'green','refunded'=>'orange', default=>'red' };
                            $pl = $order->payment_status_label;
                        @endphp
                        <span class="badge badge-{{ $pc }}">{{ $pl }}</span>
                    </td>
                    <td style="color:var(--gray-500);font-size:.875rem">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary btn-sm" title="عرض">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    data-confirm="هل أنت متأكد من حذف هذا الطلب؟">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">
                        <div class="empty-state">
                            <i class="fas fa-shopping-bag"></i>
                            <p>لا توجد طلبات</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div style="padding:1.5rem;border-top:1px solid var(--gray-200)">
        {{ $orders->withQueryString()->links('admin.pagination') }}
    </div>
    @endif
</div>

@endsection

@push('styles')
<style>
.toolbar { display:flex; align-items:center; justify-content:space-between; gap:1rem; margin-bottom:1.5rem; flex-wrap:wrap; }
.toolbar-search { display:flex; align-items:center; gap:.75rem; flex-wrap:wrap; flex:1; }
.search-box { position:relative; flex:1; min-width:220px; }
.search-box i { position:absolute; right:1rem; top:50%; transform:translateY(-50%); color:var(--gray-400); }
.search-box input { width:100%; padding:.75rem 2.75rem .75rem 1.25rem; border:2px solid var(--gray-200); border-radius:var(--radius-md); font-family:inherit; font-size:.9375rem; transition:var(--transition); }
.search-box input:focus { outline:none; border-color:var(--primary-blue); box-shadow:0 0 0 4px rgba(0,86,210,.1); }
.empty-state { text-align:center; padding:3rem; color:var(--gray-400); }
.empty-state i { font-size:3rem; margin-bottom:1rem; display:block; }
</style>
@endpush
