@extends('layouts.app')
@section('title', 'MJK - الوجهة الاولى للطابعات والاكسسوارات التقنية')
@section('content')

<section class="hero-slider-wrap">
  <div class="hero-slider" id="heroSlider">

    <div class="slide active">
      <div class="slide-bg" style="background-image:url('/images/slide-1.jpg')"></div>
      <div class="slide-overlay"></div>
      <div class="slide-inner container">
        <div class="slide-text">
          <span class="slide-tag"><i class="fas fa-print"></i> طابعات MJK</span>
          <h1>تشكيلة واسعة<br><span>من طابعات MJK</span></h1>
          <p>طابعات حرارية وباركود بأحجام وموديلات متعددة  مثالية للمطاعم والمحلات التجارية والشركات</p>
          <div class="slide-btns">
            <a href="/products?category=printers" class="sbtn sbtn-white"><i class="fas fa-shopping-cart"></i> تسوق الان</a>
            <a href="/about" class="sbtn sbtn-ghost">تعرف علينا</a>
          </div>
          <div class="slide-stats">
            <div class="ss-item"><strong>6+</strong><span>موديل</span></div>
            <div class="ss-sep"></div>
            <div class="ss-item"><strong>حراري</strong><span>طباعة</span></div>
            <div class="ss-sep"></div>
            <div class="ss-item"><strong>MJK</strong><span>ضمان اصلي</span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="slide">
      <div class="slide-bg" style="background-image:url('/images/slide-2.jpg')"></div>
      <div class="slide-overlay"></div>
      <div class="slide-inner container">
        <div class="slide-text">
          <span class="slide-tag"><i class="fas fa-print"></i> موديلات الطابعات</span>
          <h1>طابعات احترافية<br><span>لكل الاحتياجات</span></h1>
          <p>من الطابعات الحرارية الصغيرة الى طابعات الباركود والليبل  MJK عندها الحل المناسب لعملك</p>
          <div class="slide-btns">
            <a href="/products?category=printers" class="sbtn sbtn-white"><i class="fas fa-shopping-cart"></i> تسوق الان</a>
            <a href="/products" class="sbtn sbtn-ghost">عرض الكل</a>
          </div>
          <div class="slide-stats">
            <div class="ss-item"><strong>USB</strong><span>اتصال</span></div>
            <div class="ss-sep"></div>
            <div class="ss-item"><strong>80mm</strong><span>عرض الورق</span></div>
            <div class="ss-sep"></div>
            <div class="ss-item"><strong>سريع</strong><span>طباعة</span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="slide">
      <div class="slide-bg" style="background-image:url('/images/slide-3.jpg')"></div>
      <div class="slide-overlay"></div>
      <div class="slide-inner container">
        <div class="slide-text">
          <span class="slide-tag"><i class="fas fa-mouse"></i> ماوس جيمينج</span>
          <h1>MJK Gaming Mouse<br><span>دقة التلاعب</span></h1>
          <p>ماوس جيمينج MJK بتصميم مستقبلي واضاءة RGB  دقة عالية وتحكم مثالي لتجربة العاب لا تنسى</p>
          <div class="slide-btns">
            <a href="/products?category=mice" class="sbtn sbtn-white"><i class="fas fa-shopping-cart"></i> تسوق الان</a>
            <a href="/products?category=mice" class="sbtn sbtn-ghost">عرض الكل</a>
          </div>
          <div class="slide-stats">
            <div class="ss-item"><strong>RGB</strong><span>اضاءة</span></div>
            <div class="ss-sep"></div>
            <div class="ss-item"><strong>Gaming</strong><span>دقة عالية</span></div>
            <div class="ss-sep"></div>
            <div class="ss-item"><strong>MJK</strong><span>ضمان</span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="slide">
      <div class="slide-bg" style="background-image:url('/images/slide-4.jpg')"></div>
      <div class="slide-overlay"></div>
      <div class="slide-inner container">
        <div class="slide-text">
          <span class="slide-tag"><i class="fas fa-keyboard"></i> كيبورد MJK</span>
          <h1>تخطيط ذكي<br><span>لانجاز اسرع</span></h1>
          <p>كيبورد MJK بتصميم عصري وتخطيط ذكي عربي وانجليزي  Smart Layout for Instant Success</p>
          <div class="slide-btns">
            <a href="/products" class="sbtn sbtn-white"><i class="fas fa-shopping-cart"></i> تسوق الان</a>
            <a href="/products" class="sbtn sbtn-ghost">عرض الكل</a>
          </div>
          <div class="slide-stats">
            <div class="ss-item"><strong>عربي</strong><span>انجليزي</span></div>
            <div class="ss-sep"></div>
            <div class="ss-item"><strong>USB</strong><span>اتصال</span></div>
            <div class="ss-sep"></div>
            <div class="ss-item"><strong>مريح</strong><span>تصميم</span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="slide">
      <div class="slide-bg" style="background-image:url('/images/slide-5.jpg')"></div>
      <div class="slide-overlay"></div>
      <div class="slide-inner container">
        <div class="slide-text">
          <span class="slide-tag"><i class="fas fa-headphones"></i> سماعات MJK</span>
          <h1>صوت يلمس<br><span>الاحساس</span></h1>
          <p>سماعات MJK الاحترافية بجودة صوت استثنائية ومايكروفون واضح  مثالية للعمل والالعاب والترفيه</p>
          <div class="slide-btns">
            <a href="/products?category=headphones" class="sbtn sbtn-white"><i class="fas fa-shopping-cart"></i> تسوق الان</a>
            <a href="/products?category=headphones" class="sbtn sbtn-ghost">عرض الكل</a>
          </div>
          <div class="slide-stats">
            <div class="ss-item"><strong>HD</strong><span>جودة صوت</span></div>
            <div class="ss-sep"></div>
            <div class="ss-item"><strong>مايك</strong><span>واضح</span></div>
            <div class="ss-sep"></div>
            <div class="ss-item"><strong>MJK</strong><span>ضمان</span></div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <button class="sl-arrow sl-prev" id="slPrev"><i class="fas fa-chevron-right"></i></button>
  <button class="sl-arrow sl-next" id="slNext"><i class="fas fa-chevron-left"></i></button>

  <div class="sl-dots" id="slDots">
    <button class="sl-dot active" data-i="0"></button>
    <button class="sl-dot" data-i="1"></button>
    <button class="sl-dot" data-i="2"></button>
    <button class="sl-dot" data-i="3"></button>
    <button class="sl-dot" data-i="4"></button>
  </div>

  <div class="sl-progress"><div id="slBar"></div></div>

  <div class="sl-thumbs">
    <button class="sl-thumb active" data-i="0" style="background:url('/images/slide-1.jpg')"></button>
    <button class="sl-thumb" data-i="1" style="background-image:url('/images/slide-2.jpg')"></button>
    <button class="sl-thumb" data-i="2" style="background-image:url('/images/slide-3.jpg')"></button>
    <button class="sl-thumb" data-i="3" style="background-image:url('/images/slide-4.jpg')"></button>
    <button class="sl-thumb" data-i="4" style="background-image:url('/images/slide-5.jpg')"></button>
  </div>
</section>

<section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                @foreach ($stats as $stat)
                    <div class="stat-card animate-on-scroll">
                        <div class="stat-icon"><i class="fas {{ $stat['icon'] }}"></i></div>
                        <div class="stat-content">
                            <h3>{{ $stat['number'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="section categories-section">
        <div class="container">
            <div class="section-header">
                <h2>تصفح حسب الفئة</h2>
                <p>اختر الفئة المناسبة لاحتياجاتك</p>
            </div>
            <div class="categories-grid">
                <a href="/products?category=mice" class="category-card animate-on-scroll">
                    <div class="cat-img" style="background-image:url('/images/product-2.jpg')"></div>
                    <div class="cat-overlay"></div>
                    <div class="cat-content">
                        <div class="cat-icon"><i class="fas fa-mouse"></i></div>
                        <h3>الماوسات</h3>
                        <p>Lenovo - Logitech - Razer</p>
                        <span class="cat-link">تسوق الان <i class="fas fa-arrow-left"></i></span>
                    </div>
                </a>
                <a href="/products" class="category-card animate-on-scroll">
                    <div class="cat-img" style="background-image:url('/images/product-4.jpg')"></div>
                    <div class="cat-overlay"></div>
                    <div class="cat-content">
                        <div class="cat-icon"><i class="fas fa-volume-up"></i></div>
                        <h3>السبيكرات</h3>
                        <p>MJK - USB - ستيريو</p>
                        <span class="cat-link">تسوق الان <i class="fas fa-arrow-left"></i></span>
                    </div>
                </a>
                <a href="/products" class="category-card animate-on-scroll">
                    <div class="cat-img" style="background-image:url('/images/product-5.jpg')"></div>
                    <div class="cat-overlay"></div>
                    <div class="cat-content">
                        <div class="cat-icon"><i class="fas fa-tv"></i></div>
                        <h3>HDMI Splitter</h3>
                        <p>MJK - 2 Port - Full HD</p>
                        <span class="cat-link">تسوق الان <i class="fas fa-arrow-left"></i></span>
                    </div>
                </a>
                <a href="/products" class="category-card animate-on-scroll">
                    <div class="cat-img" style="background-image:url('/images/product-6.jpg')"></div>
                    <div class="cat-overlay"></div>
                    <div class="cat-content">
                        <div class="cat-icon"><i class="fas fa-bolt"></i></div>
                        <h3>Power Supply</h3>
                        <p>MJK - 100-240V - CE</p>
                        <span class="cat-link">تسوق الان <i class="fas fa-arrow-left"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="section featured-products">
        <div class="container">
            <div class="section-header">
                <h2>المنتجات المميزة</h2>
                <p>افضل المنتجات المختارة خصيصا لك</p>
            </div>
            <div class="products-grid">
                @foreach ($featuredProducts as $index => $product)
                    <div class="product-card animate-on-scroll">
                        @if ($product['badge'])
                            <span
                                class="product-badge badge badge-{{ $product['badge_color'] }}">{{ $product['badge'] }}</span>
                        @endif
                        <div class="product-image">
                            @php $imgNum = ($index % 10) + 1; @endphp
                            <img src="/images/product-{{ $imgNum }}.jpg" alt="{{ $product['name'] }}"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div class="placeholder-image" style="display:none">
                                <i
                                    class="fas fa-{{ $product['category'] === 'printers' ? 'print' : ($product['category'] === 'mice' ? 'mouse' : ($product['category'] === 'headphones' ? 'headphones' : 'usb')) }}"></i>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3>{{ $product['name'] }}</h3>
                            <p class="product-description">{{ $product['description'] }}</p>
                            <div class="product-rating">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star {{ $i < $product['rating'] ? 'active' : '' }}"></i>
                                @endfor
                                <span>({{ $product['reviews'] }})</span>
                            </div>
                            <div class="product-price">
                                <span class="price-current">{{ number_format($product['price']) }} جنيه</span>
                                @if ($product['old_price'])
                                    <span class="price-old">{{ number_format($product['old_price']) }} جنيه</span>
                                @endif
                            </div>
                            <div class="product-actions">
                                <button class="btn btn-primary"
                                    onclick="addToCart({{ $product['id'] }}, '{{ addslashes($product['name']) }}', {{ $product['price'] }}, '{{ $product['image'] }}')">
                                    <i class="fas fa-shopping-cart"></i> اضف للسلة
                                </button>
                                <a href="/product/{{ $product['id'] }}" class="btn btn-outline"><i
                                        class="fas fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center" style="margin-top:3rem">
                <a href="/products" class="btn btn-primary btn-lg">عرض جميع المنتجات <i
                        class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </section>

    <!-- Why Us -->
    <section class="section why-us-section">
        <div class="container">
            <div class="section-header">
                <h2>لماذا تختار MJK؟</h2>
                <p>نقدم افضل تجربة تسوق للمنتجات التقنية</p>
            </div>
            <div class="features-grid">
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-certificate"></i></div>
                    <h3>منتجات اصلية 100%</h3>
                    <p>جميع منتجاتنا اصلية ومضمونة من الموزعين الرسميين</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-truck"></i></div>
                    <h3>شحن سريع ومجاني</h3>
                    <p>توصيل مجاني لجميع انحاء الجمهورية للطلبات فوق 500 جنيه</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-undo"></i></div>
                    <h3>ارجاع سهل</h3>
                    <p>سياسة ارجاع مرنة خلال 14 يوم من الشراء</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-headset"></i></div>
                    <h3>دعم فني متميز</h3>
                    <p>فريق دعم فني محترف متاح 24/7 لمساعدتك</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-tags"></i></div>
                    <h3>اسعار تنافسية</h3>
                    <p>افضل الاسعار في السوق مع عروض وخصومات مستمرة</p>
                </div>
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>ضمان شامل</h3>
                    <p>ضمان رسمي على جميع المنتجات مع خدمة ما بعد البيع</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="cta-bg" style="background-image:url('/images/product-10.jpg')"></div>
        <div class="cta-overlay"></div>
        <div class="container" style="position:relative;z-index:2">
            <div class="cta-content">
                <h2>هل تحتاج مساعدة في اختيار المنتج المناسب؟</h2>
                <p>فريقنا المتخصص جاهز لمساعدتك في اختيار المنتج الانسب لاحتياجاتك</p>
                <div class="cta-buttons">
                    <a href="tel:+201234567890" class="btn btn-white btn-lg"><i class="fas fa-phone-alt"></i> اتصل بنا
                        الان</a>
                    <a href="https://wa.me/201234567890" class="btn btn-lg"
                        style="background:rgba(255,255,255,.15);color:#fff;border:2px solid rgba(255,255,255,.4)"><i
                            class="fab fa-whatsapp"></i> واتساب</a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        /* ===== HERO SLIDER ===== */
        .hero-slider-wrap {
            position: relative;
            height: 100vh;
            min-height: 580px;
            max-height: 860px;
            overflow: hidden;
        }

        .hero-slider {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            visibility: hidden;
            transition: opacity .9s ease, visibility .9s ease;
        }

        .slide.active {
            opacity: 1;
            visibility: visible;
        }

        .slide-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transform: scale(1.05);
            transition: transform 6s ease;
        }

        .slide.active .slide-bg {
            transform: scale(1);
        }

        .slide-overlay {
            position: absolute;
            inset: 0;
            background: transparent;
        }

        .slide-inner {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .slide-text {
            max-width: 620px;
            color: #fff;
        }

        .slide-tag {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(37, 99, 235, .25);
            color: #93C5FD;
            border: 1px solid rgba(147, 197, 253, .3);
            padding: .45rem 1.125rem;
            border-radius: 50px;
            font-size: .875rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            letter-spacing: .5px;
        }

        .slide-text h1 {
            font-size: clamp(2.25rem, 5vw, 4rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.25rem;
            color: #fff;
        }

        .slide-text h1 span {
            background: linear-gradient(135deg, #60A5FA, #3B82F6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .slide-text p {
            font-size: 1.0625rem;
            color: rgba(255, 255, 255, .8);
            line-height: 1.8;
            margin-bottom: 2rem;
            max-width: 520px;
        }

        .slide-btns {
            display: flex;
            gap: 1rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .sbtn {
            display: inline-flex;
            align-items: center;
            gap: .625rem;
            padding: .875rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            transition: all .3s ease;
            text-decoration: none;
            background: linear-gradient(135deg, #1D4ED8, #3B82F6);
            color: #fff;
            box-shadow: 0 8px 24px rgba(29, 78, 216, .4);
        }

        .sbtn:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 32px rgba(29, 78, 216, .5);
        }

        .sbtn-white {
            background: #fff;
            color: #1D4ED8;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .2);
        }

        .sbtn-white:hover {
            box-shadow: 0 14px 32px rgba(0, 0, 0, .3);
        }

        .sbtn-ghost {
            background: rgba(255, 255, 255, .12);
            color: #fff;
            border: 2px solid rgba(255, 255, 255, .35);
            box-shadow: none;
            backdrop-filter: blur(8px);
        }

        .sbtn-ghost:hover {
            background: rgba(255, 255, 255, .22);
            border-color: rgba(255, 255, 255, .6);
        }

        .slide-stats {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .ss-item {
            display: flex;
            flex-direction: column;
        }

        .ss-item strong {
            font-size: 1.5rem;
            font-weight: 900;
            color: #fff;
            line-height: 1;
        }

        .ss-item span {
            font-size: .8125rem;
            color: rgba(255, 255, 255, .6);
            margin-top: .2rem;
        }

        .ss-sep {
            width: 1px;
            height: 36px;
            background: rgba(255, 255, 255, .2);
        }

        /* Arrows */
        .sl-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 52px;
            height: 52px;
            background: rgba(255, 255, 255, .12);
            border: 2px solid rgba(255, 255, 255, .25);
            border-radius: 50%;
            color: #fff;
            font-size: 1.125rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .3s ease;
            backdrop-filter: blur(8px);
        }

        .sl-arrow:hover {
            background: rgba(255, 255, 255, .25);
            transform: translateY(-50%) scale(1.08);
        }

        .sl-prev {
            right: 1.75rem;
        }

        .sl-next {
            left: 1.75rem;
        }

        /* Dots */
        .sl-dots {
            position: absolute;
            bottom: 5.5rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            gap: .625rem;
        }

        .sl-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .35);
            border: none;
            cursor: pointer;
            transition: all .3s ease;
            padding: 0;
        }

        .sl-dot.active {
            background: #fff;
            width: 28px;
            border-radius: 4px;
        }

        /* Progress */
        .sl-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: rgba(255, 255, 255, .15);
            z-index: 10;
        }

        .sl-progress div {
            height: 100%;
            background: rgba(255, 255, 255, .7);
            width: 0%;
            transition: width .1s linear;
        }

        /* Thumbnails */
        .sl-thumbs {
            position: absolute;
            bottom: 1.25rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            gap: .625rem;
        }

        .sl-thumb {
            width: 56px;
            height: 40px;
            border-radius: 8px;
            background-size: cover;
            background-position: center;
            border: 2px solid rgba(255, 255, 255, .3);
            cursor: pointer;
            transition: all .3s ease;
            opacity: .55;
        }

        .sl-thumb.active {
            border-color: #fff;
            opacity: 1;
            transform: scale(1.1);
        }

        .sl-thumb:hover {
            opacity: .85;
        }

        /* ===== STATS ===== */
        .stats-section {
            background: #fff;
            padding: 2.5rem 0;
            border-bottom: 1px solid #E2E8F0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            background: #F8FAFC;
            border-radius: 16px;
            transition: all .25s ease;
        }

        .stat-card:hover {
            background: #EFF6FF;
            transform: translateY(-3px);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #2563EB, #3B82F6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.375rem;
            flex-shrink: 0;
        }

        .stat-content h3 {
            font-size: 2rem;
            color: #0F172A;
            margin: 0;
            font-weight: 800;
        }

        .stat-content p {
            color: #64748B;
            margin: 0;
            font-size: .875rem;
            font-weight: 600;
        }

        /* ===== CATEGORIES ===== */
        .categories-section {
            background: #F8FAFC;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
        }

        .category-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 280px;
            display: block;
            transition: all .35s ease;
        }

        .category-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
        }

        .cat-img {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform .5s ease;
        }

        .category-card:hover .cat-img {
            transform: scale(1.08);
        }

        .cat-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, .85) 0%, rgba(0, 0, 0, .3) 50%, rgba(0, 0, 0, .05) 100%);
            transition: var(--t);
        }

        .category-card:hover .cat-overlay {
            background: linear-gradient(to top, rgba(29, 78, 216, .85) 0%, rgba(29, 78, 216, .4) 50%, rgba(0, 0, 0, .1) 100%);
        }

        .cat-content {
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            padding: 1.5rem;
            color: #fff;
        }

        .cat-icon {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, .15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: .875rem;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, .2);
            transition: all .3s ease;
        }

        .category-card:hover .cat-icon {
            background: rgba(255, 255, 255, .25);
        }

        .cat-content h3 {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: .25rem;
        }

        .cat-content p {
            font-size: .8125rem;
            color: rgba(255, 255, 255, .7);
            margin: 0 0 .875rem;
        }

        .cat-link {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-size: .875rem;
            font-weight: 700;
            color: #fff;
            background: rgba(255, 255, 255, .15);
            padding: .4rem 1rem;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, .3);
            transition: all .3s ease;
        }

        .category-card:hover .cat-link {
            background: rgba(255, 255, 255, .25);
        }

        /* ===== PRODUCTS ===== */
        .featured-products {
            background: #fff;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .product-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
            transition: all .3s ease;
            border: 1px solid #F1F5F9;
            position: relative;
        }

        .product-card:hover {
            box-shadow: 0 16px 48px rgba(0, 0, 0, .12);
            transform: translateY(-6px);
        }

        .product-badge {
            position: absolute;
            top: .875rem;
            right: .875rem;
            z-index: 2;
        }

        .product-image {
            height: 220px;
            background: #F8FAFC;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.06);
        }

        .placeholder-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4.5rem;
            color: #CBD5E1;
        }

        .product-info {
            padding: 1.25rem;
        }

        .product-info h3 {
            font-size: 1rem;
            margin-bottom: .5rem;
            color: #0F172A;
            font-weight: 700;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-description {
            font-size: .875rem;
            color: #64748B;
            margin-bottom: .75rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: .25rem;
            margin-bottom: .75rem;
        }

        .product-rating i {
            color: #CBD5E1;
            font-size: .8125rem;
        }

        .product-rating i.active {
            color: #F59E0B;
        }

        .product-rating span {
            color: #94A3B8;
            font-size: .8125rem;
            margin-right: .25rem;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: .625rem;
            margin-bottom: 1rem;
        }

        .price-current {
            font-size: 1.375rem;
            font-weight: 800;
            color: #2563EB;
        }

        .price-old {
            font-size: .9375rem;
            color: #94A3B8;
            text-decoration: line-through;
        }

        .product-actions {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: .5rem;
        }

        .product-actions .btn {
            font-size: .875rem;
            padding: .6rem 1rem;
        }

        /* ===== WHY US ===== */
        .why-us-section {
            background: #F8FAFC;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .feature-card {
            background: #fff;
            border-radius: 20px;
            padding: 2rem 1.75rem;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
            transition: all .3s ease;
            border: 1px solid #F1F5F9;
        }

        .feature-card:hover {
            box-shadow: 0 12px 36px rgba(37, 99, 235, .12);
            transform: translateY(-6px);
        }

        .feature-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 1.25rem;
            background: #EFF6FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #2563EB;
            transition: all .3s ease;
        }

        .feature-card:hover .feature-icon {
            background: #2563EB;
            color: #fff;
            transform: scale(1.1);
        }

        .feature-card h3 {
            font-size: 1.125rem;
            margin-bottom: .625rem;
            color: #0F172A;
        }

        .feature-card p {
            color: #64748B;
            margin: 0;
            font-size: .9375rem;
            line-height: 1.7;
        }

        /* ===== CTA ===== */
        .cta-section {
            position: relative;
            padding: 6rem 0;
            text-align: center;
            overflow: hidden;
        }

        .cta-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
        }

        .cta-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(30, 58, 138, .92), rgba(37, 99, 235, .85));
        }

        .cta-content h2 {
            color: #fff;
            font-size: 2.25rem;
            margin-bottom: .875rem;
        }

        .cta-content p {
            font-size: 1.125rem;
            color: rgba(255, 255, 255, .85);
            margin-bottom: 2.5rem;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* ===== ANIMATIONS ===== */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(24px);
            transition: all .6s ease;
        }

        .animate-on-scroll.animate-in {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width:1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .sl-thumbs {
                display: none;
            }
        }

        @media (max-width:640px) {

            .stats-grid,
            .products-grid,
            .features-grid {
                grid-template-columns: 1fr;
            }

            .categories-grid {
                grid-template-columns: 1fr 1fr;
            }

            .category-card {
                height: 200px;
            }

            .slide-text h1 {
                font-size: 2rem;
            }

            .slide-text p {
                font-size: .9375rem;
            }

            .slide-btns {
                flex-direction: column;
            }

            .sbtn {
                justify-content: center;
            }

            .slide-stats {
                gap: 1rem;
            }

            .ss-item strong {
                font-size: 1.25rem;
            }

            .sl-prev {
                right: 1rem;
            }

            .sl-next {
                left: 1rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        (function() {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.sl-dot');
            const thumbs = document.querySelectorAll('.sl-thumb');
            const bar = document.getElementById('slBar');
            const DUR = 5500;
            let cur = 0,
                timer, pTimer, pVal = 0;

            function go(n) {
                slides[cur].classList.remove('active');
                dots[cur].classList.remove('active');
                if (thumbs[cur]) thumbs[cur].classList.remove('active');
                cur = (n + slides.length) % slides.length;
                slides[cur].classList.add('active');
                dots[cur].classList.add('active');
                if (thumbs[cur]) thumbs[cur].classList.add('active');
                resetBar();
            }

            function resetBar() {
                clearInterval(pTimer);
                pVal = 0;
                if (bar) bar.style.width = '0%';
                pTimer = setInterval(() => {
                    pVal += 100 / (DUR / 100);
                    if (bar) bar.style.width = Math.min(pVal, 100) + '%';
                }, 100);
            }

            function auto() {
                clearInterval(timer);
                timer = setInterval(() => go(cur + 1), DUR);
            }

            document.getElementById('slNext')?.addEventListener('click', () => {
                go(cur + 1);
                auto();
            });
            document.getElementById('slPrev')?.addEventListener('click', () => {
                go(cur - 1);
                auto();
            });
            dots.forEach(d => d.addEventListener('click', () => {
                go(+d.dataset.i);
                auto();
            }));
            thumbs.forEach(t => t.addEventListener('click', () => {
                go(+t.dataset.i);
                auto();
            }));

            let tx = 0;
            document.querySelector('.hero-slider')?.addEventListener('touchstart', e => tx = e.touches[0].clientX, {
                passive: true
            });
            document.querySelector('.hero-slider')?.addEventListener('touchend', e => {
                const d = tx - e.changedTouches[0].clientX;
                if (Math.abs(d) > 50) {
                    go(d > 0 ? cur + 1 : cur - 1);
                    auto();
                }
            }, {
                passive: true
            });

            resetBar();
            auto();

            // Scroll animations
            const obs = new IntersectionObserver(entries => {
                entries.forEach((e, i) => {
                    if (e.isIntersecting) {
                        setTimeout(() => e.target.classList.add('animate-in'), i * 80);
                        obs.unobserve(e.target);
                    }
                });
            }, {
                threshold: .1,
                rootMargin: '0px 0px -40px 0px'
            });
            document.querySelectorAll('.animate-on-scroll').forEach(el => obs.observe(el));
        })();
    </script>
@endpush
