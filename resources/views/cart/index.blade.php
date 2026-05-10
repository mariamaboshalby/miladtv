@extends('layouts.app')

@section('title', 'سلة التسوق')

@section('content')

<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-shopping-cart"></i> سلة التسوق</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">الرئيسية</a>
            <i class="fas fa-chevron-left"></i>
            <span>سلة التسوق</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        @if(count($cart) === 0)
        <div class="empty-state">
            <i class="fas fa-cart-shopping"></i>
            <h2>السلة فارغة</h2>
            <p>لم تضف أي منتجات إلى سلتك بعد</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> تصفح المنتجات
            </a>
        </div>
        @else
        <div class="cart-layout">
            <div class="cart-items">
                <div class="cart-header">
                    <h2>المنتجات ({{ array_sum(array_column($cart, 'qty')) }} عنصر)</h2>
                    <button class="btn-text-danger" id="clearCartBtn">
                        <i class="fas fa-trash"></i> إفراغ السلة
                    </button>
                </div>

                @foreach($cart as $item)
                <div class="cart-item" data-id="{{ $item['id'] }}">
                    <div class="cart-item-img">
                        <i class="fas {{ $item['icon'] }}"></i>
                    </div>
                    <div class="cart-item-info">
                        <h3>{{ $item['name'] }}</h3>
                        <span class="cart-item-price">{{ number_format($item['price']) }} ج.م</span>
                    </div>
                    <div class="cart-item-qty">
                        <button class="qty-btn cart-qty-minus" data-id="{{ $item['id'] }}"><i class="fas fa-minus"></i></button>
                        <span class="cart-qty-val">{{ $item['qty'] }}</span>
                        <button class="qty-btn cart-qty-plus" data-id="{{ $item['id'] }}"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="cart-item-total">
                        {{ number_format($item['price'] * $item['qty']) }} ج.م
                    </div>
                    <button class="cart-item-remove" data-id="{{ $item['id'] }}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endforeach
            </div>

            <div class="cart-summary">
                <h2>ملخص الطلب</h2>
                <div class="summary-row">
                    <span>المجموع الفرعي</span>
                    <span id="cartSubtotal">{{ number_format($total) }} ج.م</span>
                </div>
                <div class="summary-row">
                    <span>الشحن</span>
                    <span class="text-success">مجاني</span>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-row total">
                    <span>الإجمالي</span>
                    <span id="cartTotal">{{ number_format($total) }} ج.م</span>
                </div>
                <button class="btn btn-primary btn-block mt-3">
                    <i class="fas fa-credit-card"></i> إتمام الطلب
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-outline btn-block mt-2">
                    <i class="fas fa-arrow-right"></i> متابعة التسوق
                </a>
                <div class="cart-trust">
                    <span><i class="fas fa-lock"></i> دفع آمن</span>
                    <span><i class="fas fa-shield-halved"></i> ضمان الجودة</span>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Remove item
    $(document).on('click', '.cart-item-remove', function() {
        const id = $(this).data('id');
        $.post('{{ route("cart.remove") }}', {
            _token: '{{ csrf_token() }}',
            id: id
        }, function() {
            location.reload();
        });
    });

    // Update qty
    $(document).on('click', '.cart-qty-plus, .cart-qty-minus', function() {
        const id = $(this).data('id');
        const $item = $(this).closest('.cart-item');
        const $qtyEl = $item.find('.cart-qty-val');
        let qty = parseInt($qtyEl.text());

        if ($(this).hasClass('cart-qty-plus')) qty++;
        else qty--;

        $.post('{{ route("cart.update") }}', {
            _token: '{{ csrf_token() }}',
            id: id,
            qty: qty
        }, function(res) {
            if (res.success) {
                if (qty <= 0) {
                    location.reload();
                } else {
                    $qtyEl.text(qty);
                    $('#cartCount').text(res.count);
                    location.reload();
                }
            }
        });
    });

    // Clear cart
    $('#clearCartBtn').on('click', function() {
        if (confirm('هل تريد إفراغ السلة؟')) {
            $.post('{{ route("cart.clear") }}', {
                _token: '{{ csrf_token() }}'
            }, function() {
                location.reload();
            });
        }
    });
});
</script>
@endpush
