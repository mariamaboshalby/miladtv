@extends('admin.layouts.app')

@section('title', __('app.orders'))
@section('page-title', __('app.manage_orders'))
@section('breadcrumb')
    <i class="fas fa-chevron-left"></i> <span>{{ __('app.orders') }}</span>
@endsection

@section('content')

<div class="toolbar">
    <form class="toolbar-search" method="GET" action="{{ route('admin.orders.index') }}">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" name="search" placeholder="{{ __('app.order_search_ph') }}" value="{{ request('search') }}">
        </div>
        <select name="status" class="form-control" style="width:180px">
            <option value="">{{ __('app.all_statuses') }}</option>
            <option value="pending"    {{ request('status')=='pending'    ? 'selected':'' }}>{{ __('app.status_pending') }}</option>
            <option value="processing" {{ request('status')=='processing' ? 'selected':'' }}>{{ __('app.status_processing') }}</option>
            <option value="shipped"    {{ request('status')=='shipped'    ? 'selected':'' }}>{{ __('app.status_shipped') }}</option>
            <option value="delivered"  {{ request('status')=='delivered'  ? 'selected':'' }}>{{ __('app.status_delivered') }}</option>
            <option value="cancelled"  {{ request('status')=='cancelled'  ? 'selected':'' }}>{{ __('app.status_cancelled') }}</option>
        </select>
        <select name="payment_status" class="form-control" style="width:160px">
            <option value="">{{ __('app.all_payment_statuses') }}</option>
            <option value="unpaid"   {{ request('payment_status')=='unpaid'   ? 'selected':'' }}>{{ __('app.payment_unpaid') }}</option>
            <option value="paid"     {{ request('payment_status')=='paid'     ? 'selected':'' }}>{{ __('app.payment_paid') }}</option>
            <option value="refunded" {{ request('payment_status')=='refunded' ? 'selected':'' }}>{{ __('app.payment_refunded') }}</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> {{ __('app.search') }}</button>
        @if(request()->hasAny(['search','status','payment_status']))
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i> {{ __('app.clear') }}</a>
        @endif
    </form>
</div>

<div class="card">
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>{{ __('app.order_number') }}</th>
                    <th>{{ __('app.customer') }}</th>
                    <th>{{ __('app.city') }}</th>
                    <th>{{ __('app.items_count') }}</th>
                    <th>{{ __('app.total') }}</th>
                    <th>{{ __('app.order_status') }}</th>
                    <th>{{ __('app.payment_status') }}</th>
                    <th>{{ __('app.date') }}</th>
                    <th>{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><strong style="color:var(--primary)">{{ $order->order_number }}</strong></td>
                    <td>
                        <div>
                            <strong>{{ $order->customer_name }}</strong>
                            <span style="display:block;font-size:.8125rem;color:var(--ink-500)">{{ $order->customer_phone }}</span>
                        </div>
                    </td>
                    <td>{{ $order->city }}</td>
                    <td>
                        <span class="badge badge-blue">{{ $order->items->count() }} {{ __('app.pieces') }}</span>
                    </td>
                    <td><strong style="color:var(--primary)">{{ number_format($order->total) }} ج</strong></td>
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
                    <td style="color:var(--ink-500);font-size:.875rem">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary btn-sm" title="{{ __('app.view') }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    data-confirm="{{ __('app.delete_order_confirm') }}">
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
                            <p>{{ __('app.no_orders_found') }}</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div style="padding:1.5rem;border-top:1px solid var(--ink-200)">
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
.search-box i { position:absolute; right:1rem; top:50%; transform:translateY(-50%); color:var(--ink-400); }
.search-box input { width:100%; padding:.75rem 2.75rem .75rem 1.25rem; border:2px solid var(--ink-200); border-radius:var(--r-md); font-family:inherit; font-size:.9375rem; transition:var(--t); }
.search-box input:focus { outline:none; border-color:var(--primary); box-shadow:0 0 0 4px rgba(37,99,235,.1); }
</style>
@endpush

