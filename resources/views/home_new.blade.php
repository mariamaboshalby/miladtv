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
    <button class="sl-thumb active" data-i="0" style="background-image:url('/images/slide-1.jpg')"></button>
    <button class="sl-thumb" data-i="1" style="background-image:url('/images/slide-2.jpg')"></button>
    <button class="sl-thumb" data-i="2" style="background-image:url('/images/slide-3.jpg')"></button>
    <button class="sl-thumb" data-i="3" style="background-image:url('/images/slide-4.jpg')"></button>
    <button class="sl-thumb" data-i="4" style="background-image:url('/images/slide-5.jpg')"></button>
  </div>
</section>
