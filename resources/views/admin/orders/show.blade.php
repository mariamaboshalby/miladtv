@extends('admin.layouts.app')

@section('title', __('app.orders') . ': ' . $order->order_number)
@section('page-title', __('app.order_details'))
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i>
    <a href="{{ route('admin.orders.index') }}">{{ __('app.orders') }}</a>
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
                <h2><i class="fas fa-box" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.ordered_products') }}</h2>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr><th>{{ __('app.product_col') }}</th><th>{{ __('app.unit_price') }}</th><th>{{ __('app.quantity') }}</th><th>{{ __('app.total') }}</th></tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:.75rem">
                                    <div style="width:40px;height:40px;background:var(--primary-pale);border-radius:var(--r);display:flex;align-items:center;justify-content:center;color:var(--primary)">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <strong>{{ $item->product_name }}</strong>
                                </div>
                            </td>
                            <td>{{ number_format($item->price) }} ج</td>
                            <td><span class="badge badge-blue">× {{ $item->quantity }}</span></td>
                            <td><strong style="color:var(--primary)">{{ number_format($item->total) }} ج</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="padding:1.5rem;border-top:1px solid var(--ink-100)">
                <div class="order-totals">
                    <div class="total-row"><span>{{ __('app.subtotal') }}</span><span>{{ number_format($order->subtotal) }} ج</span></div>
                    <div class="total-row"><span>{{ __('app.shipping') }}</span><span>{{ $order->shipping > 0 ? number_format($order->shipping).' ج' : __('app.free_shipping') }}</span></div>
                    <div class="total-row total-final"><span>{{ __('app.total') }}</span><span>{{ number_format($order->total) }} ج</span></div>
                </div>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="card">
            <div class="card-header"><h2><i class="fas fa-user" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.customer_info') }}</h2></div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item"><span class="info-label">{{ __('app.name') }}</span><span class="info-value">{{ $order->customer_name }}</span></div>
                    <div class="info-item"><span class="info-label">{{ __('app.email') }}</span><span class="info-value">{{ $order->customer_email }}</span></div>
                    <div class="info-item"><span class="info-label">{{ __('app.phone') }}</span><span class="info-value">{{ $order->customer_phone }}</span></div>
                    <div class="info-item"><span class="info-label">{{ __('app.city') }}</span><span class="info-value">{{ $order->city }}</span></div>
                    <div class="info-item" style="grid-column:1/-1"><span class="info-label">{{ __('app.address') }}</span><span class="info-value">{{ $order->customer_address }}</span></div>
                    @if($order->notes)
                    <div class="info-item" style="grid-column:1/-1"><span class="info-label">{{ __('app.notes') }}</span><span class="info-value">{{ $order->notes }}</span></div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Status -->
    <div class="order-side">

        <!-- Order Status -->
        <div class="card" style="margin-bottom:1.5rem">
            <div class="card-header"><h2><i class="fas fa-truck" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.order_status') }}</h2></div>
            <div class="card-body">
                <div style="margin-bottom:1rem">
                    <span class="badge badge-{{ $order->status_color }}" style="font-size:1rem;padding:.5rem 1.25rem">
                        {{ $order->status_label }}
                    </span>
                </div>
                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label class="form-label">{{ __('app.change_status') }}</label>
                        <select name="status" class="form-control">
                            <option value="pending"    {{ $order->status=='pending'    ? 'selected':'' }}>{{ __('app.status_pending') }}</option>
                            <option value="processing" {{ $order->status=='processing' ? 'selected':'' }}>{{ __('app.status_processing') }}</option>
                            <option value="shipped"    {{ $order->status=='shipped'    ? 'selected':'' }}>{{ __('app.status_shipped') }}</option>
                            <option value="delivered"  {{ $order->status=='delivered'  ? 'selected':'' }}>{{ __('app.status_delivered') }}</option>
                            <option value="cancelled"  {{ $order->status=='cancelled'  ? 'selected':'' }}>{{ __('app.status_cancelled') }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%">
                        <i class="fas fa-save"></i> {{ __('app.update_status') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="card" style="margin-bottom:1.5rem">
            <div class="card-header"><h2><i class="fas fa-credit-card" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.payment_status') }}</h2></div>
            <div class="card-body">
                @php $pc = match($order->payment_status) { 'paid'=>'green','refunded'=>'orange', default=>'red' }; @endphp
                <div style="margin-bottom:1rem">
                    <span class="badge badge-{{ $pc }}" style="font-size:1rem;padding:.5rem 1.25rem">
                        {{ $order->payment_status_label }}
                    </span>
                </div>
                <div style="margin-bottom:1rem;color:var(--ink-600);font-size:.9375rem">
                    <i class="fas fa-money-bill-wave" style="color:var(--primary)"></i>
                    {{ __('app.payment_method') }}
                    <strong>{{ match($order->payment_method) { 'cash'=>__('app.pay_cash'),'card'=>__('app.pay_card'),'transfer'=>__('app.pay_transfer'), default=>$order->payment_method } }}</strong>
                </div>
                <form method="POST" action="{{ route('admin.orders.payment', $order) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label class="form-label">{{ __('app.change_payment') }}</label>
                        <select name="payment_status" class="form-control">
                            <option value="unpaid"   {{ $order->payment_status=='unpaid'   ? 'selected':'' }}>{{ __('app.payment_unpaid') }}</option>
                            <option value="paid"     {{ $order->payment_status=='paid'     ? 'selected':'' }}>{{ __('app.payment_paid') }}</option>
                            <option value="refunded" {{ $order->payment_status=='refunded' ? 'selected':'' }}>{{ __('app.payment_refunded') }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success" style="width:100%">
                        <i class="fas fa-save"></i> {{ __('app.update_payment') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Info -->
        <div class="card">
            <div class="card-header"><h2><i class="fas fa-info-circle" style="color:var(--primary);margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}:.5rem"></i> {{ __('app.order_info') }}</h2></div>
            <div class="card-body">
                <div class="info-item" style="margin-bottom:.75rem"><span class="info-label">{{ __('app.order_number') }}</span><span class="info-value" style="color:var(--primary);font-weight:700">{{ $order->order_number }}</span></div>
                <div class="info-item" style="margin-bottom:.75rem"><span class="info-label">{{ __('app.order_date') }}</span><span class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</span></div>
                <div class="info-item"><span class="info-label">{{ __('app.last_updated') }}</span><span class="info-value">{{ $order->updated_at->format('d/m/Y H:i') }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.order-layout { display:grid; grid-template-columns:1fr 360px; gap:1.5rem; align-items:start; }
.order-totals { max-width:300px; margin-inline-start:auto; }
.total-row { display:flex; justify-content:space-between; padding:.5rem 0; color:var(--ink-600); border-bottom:1px solid var(--ink-100); }
.total-row:last-child { border-bottom:none; }
.total-final { font-size:1.25rem; font-weight:700; color:var(--ink-900); padding-top:1rem; }
.total-final span:last-child { color:var(--primary); }
.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
.info-item { display:flex; flex-direction:column; gap:.25rem; }
.info-label { font-size:.8125rem; color:var(--ink-500); font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
.info-value { color:var(--ink-900); font-weight:500; }
@media (max-width:1024px) { .order-layout { grid-template-columns:1fr; } }
</style>
@endpush


