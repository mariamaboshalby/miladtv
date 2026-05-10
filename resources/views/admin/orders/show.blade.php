@extends('admin.layouts.app')

@section('title', 'طلب: ' . $order->order_number)
@section('page-title', 'تفاصيل الطلب')
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i>
    <a href="{{ route('admin.orders.index') }}">الطلبات</a>
    <i class="fas fa-chevron-left"></i>
    <span>{{ $order->order_number }}</span>
@endsection

@section('content')
<div class="order-layout">

    <!-- Left: Details -->
    <div class="order-main">

        <!-- Items -->
        <div class="card" style="margin-bottom:1.5rem">
            <div class="card-header">
                <h2><i class="fas fa-box" style="color:var(--primary-blue);margin-left:.5rem"></i> المنتجات المطلوبة</h2>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr><th>المنتج</th><th>السعر</th><th>الكمية</th><th>الإجمالي</th></tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:.75rem">
                                    <div style="width:40px;height:40px;background:var(--secondary-blue);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--primary-blue)">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <strong>{{ $item->product_name }}</strong>
                                </div>
                            </td>
                            <td>{{ number_format($item->price) }} ج</td>
                            <td><span class="badge badge-blue">× {{ $item->quantity }}</span></td>
                            <td><strong style="color:var(--primary-blue)">{{ number_format($item->total) }} ج</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="padding:1.5rem;border-top:1px solid var(--gray-200)">
                <div class="order-totals">
                    <div class="total-row"><span>المجموع الفرعي</span><span>{{ number_format($order->subtotal) }} ج</span></div>
                    <div class="total-row"><span>الشحن</span><span>{{ $order->shipping > 0 ? number_format($order->shipping).' ج' : 'مجاني' }}</span></div>
                    <div class="total-row total-final"><span>الإجمالي</span><span>{{ number_format($order->total) }} ج</span></div>
                </div>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="card">
            <div class="card-header"><h2><i class="fas fa-user" style="color:var(--primary-blue);margin-left:.5rem"></i> بيانات العميل</h2></div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item"><span class="info-label">الاسم</span><span class="info-value">{{ $order->customer_name }}</span></div>
                    <div class="info-item"><span class="info-label">البريد الإلكتروني</span><span class="info-value">{{ $order->customer_email }}</span></div>
                    <div class="info-item"><span class="info-label">الهاتف</span><span class="info-value">{{ $order->customer_phone }}</span></div>
                    <div class="info-item"><span class="info-label">المدينة</span><span class="info-value">{{ $order->city }}</span></div>
                    <div class="info-item" style="grid-column:1/-1"><span class="info-label">العنوان</span><span class="info-value">{{ $order->customer_address }}</span></div>
                    @if($order->notes)
                    <div class="info-item" style="grid-column:1/-1"><span class="info-label">ملاحظات</span><span class="info-value">{{ $order->notes }}</span></div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Status -->
    <div class="order-side">

        <!-- Order Status -->
        <div class="card" style="margin-bottom:1.5rem">
            <div class="card-header"><h2><i class="fas fa-truck" style="color:var(--primary-blue);margin-left:.5rem"></i> حالة الطلب</h2></div>
            <div class="card-body">
                <div style="margin-bottom:1rem">
                    <span class="badge badge-{{ $order->status_color }}" style="font-size:1rem;padding:.5rem 1.25rem">
                        {{ $order->status_label }}
                    </span>
                </div>
                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label class="form-label">تغيير الحالة</label>
                        <select name="status" class="form-control">
                            <option value="pending"    {{ $order->status=='pending'    ? 'selected':'' }}>⏳ قيد الانتظار</option>
                            <option value="processing" {{ $order->status=='processing' ? 'selected':'' }}>⚙️ قيد المعالجة</option>
                            <option value="shipped"    {{ $order->status=='shipped'    ? 'selected':'' }}>🚚 تم الشحن</option>
                            <option value="delivered"  {{ $order->status=='delivered'  ? 'selected':'' }}>✅ تم التسليم</option>
                            <option value="cancelled"  {{ $order->status=='cancelled'  ? 'selected':'' }}>❌ ملغي</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%">
                        <i class="fas fa-save"></i> تحديث الحالة
                    </button>
                </form>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="card" style="margin-bottom:1.5rem">
            <div class="card-header"><h2><i class="fas fa-credit-card" style="color:var(--primary-blue);margin-left:.5rem"></i> حالة الدفع</h2></div>
            <div class="card-body">
                @php $pc = match($order->payment_status) { 'paid'=>'green','refunded'=>'orange', default=>'red' }; @endphp
                <div style="margin-bottom:1rem">
                    <span class="badge badge-{{ $pc }}" style="font-size:1rem;padding:.5rem 1.25rem">
                        {{ $order->payment_status_label }}
                    </span>
                </div>
                <div style="margin-bottom:1rem;color:var(--gray-600);font-size:.9375rem">
                    <i class="fas fa-money-bill-wave" style="color:var(--primary-blue)"></i>
                    طريقة الدفع:
                    <strong>{{ match($order->payment_method) { 'cash'=>'كاش','card'=>'بطاقة','transfer'=>'تحويل', default=>$order->payment_method } }}</strong>
                </div>
                <form method="POST" action="{{ route('admin.orders.payment', $order) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label class="form-label">تغيير حالة الدفع</label>
                        <select name="payment_status" class="form-control">
                            <option value="unpaid"   {{ $order->payment_status=='unpaid'   ? 'selected':'' }}>غير مدفوع</option>
                            <option value="paid"     {{ $order->payment_status=='paid'     ? 'selected':'' }}>مدفوع</option>
                            <option value="refunded" {{ $order->payment_status=='refunded' ? 'selected':'' }}>مسترد</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success" style="width:100%">
                        <i class="fas fa-save"></i> تحديث الدفع
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Info -->
        <div class="card">
            <div class="card-header"><h2><i class="fas fa-info-circle" style="color:var(--primary-blue);margin-left:.5rem"></i> معلومات الطلب</h2></div>
            <div class="card-body">
                <div class="info-item" style="margin-bottom:.75rem"><span class="info-label">رقم الطلب</span><span class="info-value" style="color:var(--primary-blue);font-weight:700">{{ $order->order_number }}</span></div>
                <div class="info-item" style="margin-bottom:.75rem"><span class="info-label">تاريخ الطلب</span><span class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</span></div>
                <div class="info-item"><span class="info-label">آخر تحديث</span><span class="info-value">{{ $order->updated_at->format('d/m/Y H:i') }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.order-layout { display:grid; grid-template-columns:1fr 360px; gap:1.5rem; align-items:start; }
.order-totals { max-width:300px; margin-right:auto; }
.total-row { display:flex; justify-content:space-between; padding:.5rem 0; color:var(--gray-600); border-bottom:1px solid var(--gray-100); }
.total-row:last-child { border-bottom:none; }
.total-final { font-size:1.25rem; font-weight:700; color:var(--gray-900); padding-top:1rem; }
.total-final span:last-child { color:var(--primary-blue); }
.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
.info-item { display:flex; flex-direction:column; gap:.25rem; }
.info-label { font-size:.8125rem; color:var(--gray-500); font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
.info-value { color:var(--gray-900); font-weight:500; }
@media (max-width:1024px) { .order-layout { grid-template-columns:1fr; } }
</style>
@endpush
