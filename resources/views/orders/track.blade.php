@extends('layouts.app')
@section('title', (app()->getLocale() === 'ar' ? 'تتبع الطلب' : 'Track Order') . ' - ميلاد سامي')

@section('content')

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#0f172a 0%,#030f1f 100%);padding:3rem 0;">
    <div class="container text-center">
        <div class="track-icon-hero mx-auto mb-3">
            <i class="fas fa-shipping-fast"></i>
        </div>
        <h1 class="text-white fw-bold mb-2">
            {{ app()->getLocale() === 'ar' ? 'تتبع طلبك' : 'Track Your Order' }}
        </h1>
        <p class="text-white-50 mb-0">
            {{ app()->getLocale() === 'ar' ? 'أدخل رقم طلبك لمعرفة حالته الحالية' : 'Enter your order number to check its current status' }}
        </p>
    </div>
</div>

{{-- Breadcrumb --}}
<div class="bg-white border-bottom py-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:.875rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-primary text-decoration-none">{{ __('app.nav_home') }}</a></li>
                <li class="breadcrumb-item active text-muted">
                    {{ app()->getLocale() === 'ar' ? 'تتبع الطلب' : 'Track Order' }}
                </li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5" style="background:#f8fafc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6">

                {{-- Search form --}}
                <div class="track-card mb-4">
                    <div class="track-card-header">
                        <i class="fas fa-search-location me-2 text-primary"></i>
                        {{ app()->getLocale() === 'ar' ? 'ابحث عن طلبك' : 'Find Your Order' }}
                    </div>
                    <div class="p-4">
                        <div class="track-input-group">
                            <i class="fas fa-hashtag track-input-icon"></i>
                            <input type="text"
                                   id="orderInput"
                                   class="track-input"
                                   placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: milad-ABC123' : 'e.g. milad-ABC123' }}"
                                   value="{{ request('order') }}"
                                   autocomplete="off"
                                   spellcheck="false">
                            <button id="trackBtn" class="track-submit-btn" onclick="trackOrder()">
                                <span class="btn-text">
                                    <i class="fas fa-search me-1"></i>
                                    {{ app()->getLocale() === 'ar' ? 'تتبع' : 'Track' }}
                                </span>
                                <span class="btn-loading d-none">
                                    <i class="fas fa-spinner fa-spin me-1"></i>
                                    {{ app()->getLocale() === 'ar' ? 'جارٍ...' : 'Loading...' }}
                                </span>
                            </button>
                        </div>
                        <p class="text-muted small mt-2 mb-0">
                            <i class="fas fa-info-circle text-primary me-1"></i>
                            {{ app()->getLocale() === 'ar' ? 'رقم الطلب موجود في رسالة التأكيد المرسلة إليك.' : 'Your order number can be found in your confirmation message.' }}
                        </p>
                    </div>
                </div>

                {{-- Result area --}}
                <div id="trackResult" class="d-none">

                    {{-- Error --}}
                    <div id="trackError" class="d-none">
                        <div class="alert-card alert-danger-custom">
                            <i class="fas fa-times-circle alert-icon"></i>
                            <div>
                                <h6 class="fw-bold mb-1">{{ app()->getLocale() === 'ar' ? 'طلب غير موجود' : 'Order Not Found' }}</h6>
                                <p class="mb-0 small" id="errorMsg"></p>
                            </div>
                        </div>
                    </div>

                    {{-- Success --}}
                    <div id="trackSuccess" class="d-none">

                        {{-- Order Summary Card --}}
                        <div class="track-card mb-4">
                            <div class="track-card-header d-flex align-items-center justify-content-between">
                                <span>
                                    <i class="fas fa-receipt me-2 text-primary"></i>
                                    {{ app()->getLocale() === 'ar' ? 'تفاصيل الطلب' : 'Order Details' }}
                                </span>
                                <span id="statusBadge" class="order-status-badge"></span>
                            </div>
                            <div class="p-4">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="order-detail-item">
                                            <span class="detail-label">{{ app()->getLocale() === 'ar' ? 'رقم الطلب' : 'Order #' }}</span>
                                            <span class="detail-val fw-bold text-primary" id="displayOrderNum">—</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="order-detail-item">
                                            <span class="detail-label">{{ app()->getLocale() === 'ar' ? 'اسم العميل' : 'Customer' }}</span>
                                            <span class="detail-val" id="displayCustomer">—</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="order-detail-item">
                                            <span class="detail-label">{{ app()->getLocale() === 'ar' ? 'تاريخ الطلب' : 'Date' }}</span>
                                            <span class="detail-val" id="displayDate">—</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="order-detail-item">
                                            <span class="detail-label">{{ app()->getLocale() === 'ar' ? 'إجمالي الطلب' : 'Total' }}</span>
                                            <span class="detail-val fw-bold" id="displayTotal">—</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="order-detail-item">
                                            <span class="detail-label">{{ app()->getLocale() === 'ar' ? 'عدد القطع' : 'Items' }}</span>
                                            <span class="detail-val" id="displayItems">—</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="order-detail-item">
                                            <span class="detail-label">{{ app()->getLocale() === 'ar' ? 'حالة الدفع' : 'Payment' }}</span>
                                            <span class="detail-val" id="displayPayment">—</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Status Steps --}}
                        <div class="track-card">
                            <div class="track-card-header">
                                <i class="fas fa-route me-2 text-primary"></i>
                                {{ app()->getLocale() === 'ar' ? 'مسار الطلب' : 'Order Progress' }}
                            </div>
                            <div class="p-4">
                                <div class="order-steps" id="orderSteps">
                                    {{-- Rendered by JS --}}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                {{-- Help box --}}
                <div class="track-card mt-4">
                    <div class="p-4 d-flex gap-4 align-items-center flex-wrap">
                        <div class="help-icon flex-shrink-0">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">
                                {{ app()->getLocale() === 'ar' ? 'محتاج مساعدة؟' : 'Need Help?' }}
                            </h6>
                            <p class="text-secondary small mb-0">
                                {{ app()->getLocale() === 'ar' ? 'فريقنا متاح طوال الأسبوع للرد على استفساراتك.' : 'Our team is available all week to answer your questions.' }}
                            </p>
                        </div>
                        <div class="d-flex gap-2 flex-shrink-0">
                            <a href="tel:+201093803270" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="fas fa-phone me-1"></i>{{ app()->getLocale() === 'ar' ? 'اتصل' : 'Call' }}
                            </a>
                            <a href="https://wa.me/201093803270" target="_blank" class="btn btn-sm btn-success rounded-pill px-3">
                                <i class="fab fa-whatsapp me-1"></i>WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.track-icon-hero {
    width: 80px; height: 80px;
    background: rgba(255,255,255,.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #fff;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,.3);
}
.track-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    overflow: hidden;
}
.track-card-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 1rem 1.25rem;
    font-weight: 700;
    font-size: .9375rem;
    color: #0f172a;
    display: flex;
    align-items: center;
}
.track-input-group {
    display: flex;
    align-items: center;
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 14px;
    padding: .375rem .375rem .375rem 1rem;
    transition: all .3s ease;
}
.track-input-group:focus-within {
    border-color: #051836;
    box-shadow: 0 0 0 4px rgba(37,99,235,.1);
    background: #fff;
}
.track-input-icon { color: #94a3b8; margin-right: .5rem; flex-shrink: 0; }
.track-input {
    flex: 1;
    border: none;
    background: none;
    outline: none;
    font-size: 1rem;
    color: #0f172a;
    font-weight: 500;
    letter-spacing: .02em;
}
.track-submit-btn {
    background: linear-gradient(135deg, #051836, #0a2e5c);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: .65rem 1.5rem;
    font-size: .9375rem;
    font-weight: 700;
    cursor: pointer;
    transition: all .25s ease;
    flex-shrink: 0;
}
.track-submit-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(37,99,235,.35); }

/* Alert cards */
.alert-card {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    border-radius: 14px;
}
.alert-icon { font-size: 1.5rem; flex-shrink: 0; margin-top: .1rem; }
.alert-danger-custom { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
.alert-icon { color: #ef4444; }

/* Order detail items */
.order-detail-item {
    display: flex;
    flex-direction: column;
    gap: .2rem;
}
.detail-label {
    font-size: .75rem;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: #94a3b8;
    font-weight: 600;
}
.detail-val { font-size: .9375rem; color: #0f172a; }

/* Status badge */
.order-status-badge {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .35rem .9rem;
    border-radius: 50px;
    font-size: .8125rem;
    font-weight: 700;
}
.badge-pending    { background: #fff7ed; color: #c2410c; border: 1px solid #fed7aa; }
.badge-processing { background: #e8edf5; color: #030f1f; border: 1px solid #c3d0e3; }
.badge-shipped    { background: #f5f3ff; color: #7c3aed; border: 1px solid #ddd6fe; }
.badge-delivered  { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
.badge-cancelled  { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

/* Steps */
.order-steps { position: relative; padding: .5rem 0; }
.step-item {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    position: relative;
    padding-bottom: 2rem;
}
.step-item:last-child { padding-bottom: 0; }
.step-item::before {
    content: '';
    position: absolute;
    left: 19px;
    top: 40px;
    bottom: 0;
    width: 2px;
    background: #e2e8f0;
}
[dir="rtl"] .step-item::before { left: auto; right: 19px; }
.step-item.done::before { background: #10b981; }
.step-item:last-child::before { display: none; }

.step-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .9rem;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
    transition: all .3s ease;
}
.step-circle.done    { background: #10b981; color: #fff; box-shadow: 0 0 0 4px rgba(16,185,129,.15); }
.step-circle.current { background: #051836; color: #fff; box-shadow: 0 0 0 4px rgba(37,99,235,.2); animation: pulse-step 2s infinite; }
.step-circle.pending { background: #f1f5f9; color: #94a3b8; border: 2px solid #e2e8f0; }
@keyframes pulse-step {
    0%, 100% { box-shadow: 0 0 0 4px rgba(37,99,235,.2); }
    50% { box-shadow: 0 0 0 8px rgba(37,99,235,.1); }
}
.step-body { flex: 1; padding-top: .5rem; }
.step-title { font-weight: 700; font-size: .9375rem; color: #0f172a; margin-bottom: .1rem; }
.step-title.pending { color: #94a3b8; }
.step-desc  { font-size: .8125rem; color: #94a3b8; }

/* Help */
.help-icon {
    width: 56px;
    height: 56px;
    background: #e8edf5;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #051836;
}
</style>
@endpush

@push('scripts')
<script>
const isAr = document.documentElement.lang === 'ar';

const stepConfig = [
    {
        key: 'pending',
        icon: 'fa-clock',
        label: isAr ? 'تم استلام الطلب' : 'Order Received',
        desc:  isAr ? 'تم استلام طلبك وسيتم مراجعته قريباً.' : 'Your order has been received and will be reviewed shortly.'
    },
    {
        key: 'processing',
        icon: 'fa-box',
        label: isAr ? 'قيد التجهيز' : 'Processing',
        desc:  isAr ? 'يتم تجهيز طلبك وتحضير القطع.' : 'Your order is being prepared and packed.'
    },
    {
        key: 'shipped',
        icon: 'fa-shipping-fast',
        label: isAr ? 'تم الشحن' : 'Shipped',
        desc:  isAr ? 'طلبك في الطريق إليك!' : 'Your order is on its way!'
    },
    {
        key: 'delivered',
        icon: 'fa-check-circle',
        label: isAr ? 'تم التسليم' : 'Delivered',
        desc:  isAr ? 'تم تسليم طلبك بنجاح.' : 'Your order has been delivered successfully.'
    },
];

const statusColors = {
    pending:    'badge-pending',
    processing: 'badge-processing',
    shipped:    'badge-shipped',
    delivered:  'badge-delivered',
    cancelled:  'badge-cancelled',
};

const paymentLabels = {
    unpaid:   isAr ? '⚠ غير مدفوع'  : '⚠ Unpaid',
    paid:     isAr ? '✓ مدفوع'       : '✓ Paid',
    refunded: isAr ? '↩ مسترد'       : '↩ Refunded',
};

function trackOrder() {
    const input = document.getElementById('orderInput');
    const orderNum = input.value.trim();
    if (!orderNum) {
        input.focus();
        input.style.borderColor = '#ef4444';
        setTimeout(() => input.style.borderColor = '', 1500);
        return;
    }

    const btn = document.getElementById('trackBtn');
    btn.querySelector('.btn-text').classList.add('d-none');
    btn.querySelector('.btn-loading').classList.remove('d-none');
    btn.disabled = true;

    fetch('{{ route('track-order.status') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ order_number: orderNum }),
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('trackResult').classList.remove('d-none');
        document.getElementById('trackError').classList.add('d-none');
        document.getElementById('trackSuccess').classList.add('d-none');

        if (!data.success) {
            document.getElementById('trackError').classList.remove('d-none');
            document.getElementById('errorMsg').textContent = data.message;
            return;
        }

        // Populate
        document.getElementById('displayOrderNum').textContent  = data.order_number;
        document.getElementById('displayCustomer').textContent  = data.customer_name;
        document.getElementById('displayDate').textContent      = data.created_at;
        document.getElementById('displayTotal').textContent     = data.total + ' EGP';
        document.getElementById('displayItems').textContent     = data.items_count + (isAr ? ' قطعة' : ' item(s)');
        document.getElementById('displayPayment').textContent   = paymentLabels[data.payment_status] || data.payment_label;

        const badge = document.getElementById('statusBadge');
        badge.textContent = data.status_label;
        badge.className   = 'order-status-badge ' + (statusColors[data.status] || 'badge-pending');

        // Steps
        const stepsEl = document.getElementById('orderSteps');
        stepsEl.innerHTML = '';
        stepConfig.forEach((step, i) => {
            let state = 'pending';
            if (i < data.current_step) state = 'done';
            else if (i === data.current_step) state = 'current';
            if (data.status === 'cancelled') state = i === 0 ? 'done' : 'pending';

            stepsEl.innerHTML += `
                <div class="step-item ${state === 'done' ? 'done' : ''}">
                    <div class="step-circle ${state}">
                        <i class="fas ${state === 'done' ? 'fa-check' : step.icon}"></i>
                    </div>
                    <div class="step-body">
                        <div class="step-title ${state === 'pending' ? 'pending' : ''}">${step.label}</div>
                        <div class="step-desc">${state !== 'pending' ? step.desc : (isAr ? 'في انتظار الخطوات السابقة' : 'Waiting for previous steps')}</div>
                    </div>
                </div>
            `;
        });

        if (data.status === 'cancelled') {
            stepsEl.innerHTML += `
                <div class="step-item">
                    <div class="step-circle" style="background:#fef2f2;border:2px solid #fecaca;color:#ef4444;">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="step-body">
                        <div class="step-title" style="color:#ef4444;">${isAr ? 'تم إلغاء الطلب' : 'Order Cancelled'}</div>
                        <div class="step-desc">${isAr ? 'تم إلغاء هذا الطلب.' : 'This order has been cancelled.'}</div>
                    </div>
                </div>
            `;
        }

        document.getElementById('trackSuccess').classList.remove('d-none');
    })
    .catch(() => {
        document.getElementById('trackResult').classList.remove('d-none');
        document.getElementById('trackError').classList.remove('d-none');
        document.getElementById('errorMsg').textContent = isAr ? 'حدث خطأ في الاتصال. حاول مرة أخرى.' : 'Connection error. Please try again.';
    })
    .finally(() => {
        btn.querySelector('.btn-text').classList.remove('d-none');
        btn.querySelector('.btn-loading').classList.add('d-none');
        btn.disabled = false;
    });
}

// Allow Enter key
document.getElementById('orderInput')?.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') trackOrder();
});

// Auto-track if URL param provided
@if(request('order'))
window.addEventListener('DOMContentLoaded', () => trackOrder());
@endif
</script>
@endpush
