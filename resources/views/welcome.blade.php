<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MJK - لتقنية المعلومات والاكسسوارات</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="mjk-navbar" id="mjkNavbar">
        <div class="nav-container">
            <a href="#" class="brand-logo">MJK<span>.</span></a>
            <button class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-links" id="navLinks">
                <li><a href="#hero" class="active">الرئيسية</a></li>
                <li><a href="#products">المنتجات</a></li>
                <li><a href="#downloads">تحميلات</a></li>
                <li><a href="#contact">تواصل معنا</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="hero" class="hero-section">
        <div class="hero-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <div class="hero-content">
            <h1 class="animate-fade-in-up">مرحباً بكم في <span class="highlight">MJK</span></h1>
            <p class="animate-fade-in-up delay-1">الوجهة الأولى لأحدث اكسسوارات الكمبيوتر، الطابعات، والماسحات الضوئية.</p>
            <div class="hero-buttons animate-fade-in-up delay-2">
                <a href="#products" class="btn btn-primary">تصفح المنتجات</a>
                <a href="#contact" class="btn btn-outline">تواصل معنا</a>
            </div>
        </div>
        <div class="scroll-down">
            <a href="#products"><i class="fas fa-chevron-down"></i></a>
        </div>
    </header>

    <!-- Products Section -->
    <section id="products" class="section">
        <div class="section-container">
            <div class="section-header reveal">
                <h2>منتجاتنا المميزة</h2>
                <p>نقدم تشكيلة واسعة من أفضل الأجهزة والاكسسوارات</p>
            </div>
            <div class="products-grid">
                <!-- Product Card 1 -->
                <div class="product-card reveal">
                    <div class="card-icon"><i class="fas fa-laptop"></i></div>
                    <h3>اكسسوارات كمبيوتر</h3>
                    <p>لوحات مفاتيح، ماوسات، وسماعات عالية الجودة لتجربة استخدام مثالية.</p>
                </div>
                <!-- Product Card 2 -->
                <div class="product-card reveal">
                    <div class="card-icon"><i class="fas fa-print"></i></div>
                    <h3>طابعات متطورة</h3>
                    <p>طابعات ليزر وحبر تناسب احتياجات الشركات والأفراد.</p>
                </div>
                <!-- Product Card 3 -->
                <div class="product-card reveal">
                    <div class="card-icon"><i class="fas fa-scanner-keyboard"></i><i class="fas fa-barcode"></i></div>
                    <h3>ماسحات ضوئية</h3>
                    <p>أجهزة سكانر سريعة ودقيقة لأرشفة مستنداتك بسهولة.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Downloads Section -->
    <section id="downloads" class="section dark-section">
        <div class="section-container">
            <div class="section-header reveal">
                <h2>مركز التحميلات</h2>
                <p>حمل أحدث التعريفات والبرامج المساعدة لأجهزتك</p>
            </div>
            <div class="downloads-wrapper reveal">
                <div class="download-item">
                    <i class="fas fa-file-archive"></i>
                    <div class="download-info">
                        <h4>تعريفات الطابعات الشاملة</h4>
                        <span>حجم الملف: 45MB</span>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> تحميل</a>
                </div>
                <div class="download-item">
                    <i class="fas fa-file-archive"></i>
                    <div class="download-info">
                        <h4>برنامج إدارة الماسح الضوئي</h4>
                        <span>حجم الملف: 120MB</span>
                    </div>
                    <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> تحميل</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="section-container">
            <div class="section-header reveal">
                <h2>تواصل معنا</h2>
                <p>نحن هنا للرد على استفساراتكم وتلبية طلباتكم</p>
            </div>
            <div class="contact-wrapper reveal">
                <div class="contact-info">
                    <div class="info-box">
                        <i class="fas fa-map-marker-alt"></i>
                        <h4>العنوان</h4>
                        <p>القاهرة، مصر</p>
                    </div>
                    <div class="info-box">
                        <i class="fas fa-phone-alt"></i>
                        <h4>الهاتف</h4>
                        <p>+20 123 456 7890</p>
                    </div>
                    <div class="info-box">
                        <i class="fas fa-envelope"></i>
                        <h4>البريد الإلكتروني</h4>
                        <p>info@mjk.com</p>
                    </div>
                </div>
                <div class="contact-form-container">
                    <form id="mjkContactForm" class="contact-form">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="الاسم الكريم" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" rows="5" placeholder="رسالتك..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">إرسال الرسالة</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="mjk-footer">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} شركة MJK للكمبيوتر والطابعات. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>
