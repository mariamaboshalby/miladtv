@extends('layouts.app')
@section('title', 'MJK - Your #1 Destination for Printers & Tech Accessories')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/printer-loader.css') }}">
@endpush
@push('styles')
    <style>
        /* ── Gallery Grid ── */
        .mjk-gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: 280px 280px;
            gap: 12px;
        }

        /* tall item spans 2 rows */
        .mjk-gallery-tall {
            grid-row: span 2;
        }

        /* wide item spans 2 cols */
        .mjk-gallery-wide {
            grid-column: span 2;
        }

        .mjk-gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            cursor: pointer;
        }

        .mjk-gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s cubic-bezier(.25, .46, .45, .94);
            display: block;
        }

        .mjk-gallery-item:hover img {
            transform: scale(1.07);
        }

        /* Overlay */
        .mjk-gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, .75) 0%, rgba(0, 0, 0, .1) 50%, transparent 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1.25rem 1.5rem;
            opacity: 0;
            transition: opacity .35s ease;
        }

        .mjk-gallery-item:hover .mjk-gallery-overlay {
            opacity: 1;
        }

        .mjk-gallery-tag {
            display: inline-block;
            background: rgba(37, 99, 235, .85);
            color: #fff;
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: .25rem .75rem;
            border-radius: 999px;
            margin-bottom: .5rem;
            width: fit-content;
        }

        .mjk-gallery-overlay p {
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
            text-shadow: 0 1px 4px rgba(0, 0, 0, .5);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .mjk-gallery {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto;
            }

            .mjk-gallery-tall {
                grid-row: span 1;
            }

            .mjk-gallery-wide {
                grid-column: span 2;
            }

            .mjk-gallery-item {
                height: 200px;
            }
        }

        @media (max-width: 480px) {
            .mjk-gallery {
                grid-template-columns: 1fr;
            }

            .mjk-gallery-wide {
                grid-column: span 1;
            }

            .mjk-gallery-item {
                height: 220px;
            }
        }
    </style>
@endpush
@section('content')

    {{-- ===== Hero Carousel ===== --}}
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                aria-current="true"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/slider-1.jpg') }}" class="d-block w-100 hero-img" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider-2.jpg') }}" class="d-block w-100 hero-img" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider-3.jpg') }}" class="d-block w-100 hero-img" alt="Slide 3">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider-4.jpg') }}" class="d-block w-100 hero-img" alt="Slide 4">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider-5.jpg') }}" class="d-block w-100 hero-img" alt="Slide 5">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    {{-- ===== About Us Section ===== --}}
    <section class="py-5 bg-white">
        <div class="container py-4">

            {{-- Intro Row --}}
            <div class="row align-items-center g-5 mb-5">

                {{-- Text + Stats --}}
                <div class="col-lg-6 order-2 order-lg-1">
                    <span class="badge text-bg-primary rounded-pill px-3 py-2 mb-3 fs-6">About Us</span>
                    <h2 class="fw-bold display-6 mb-3">An Egyptian Brand with a Global Mindset</h2>
                    <p class="text-secondary fs-5 lh-lg">
                        Founded in <strong>2017</strong>, MJK was built on a simple belief — that Egyptian businesses
                        and individuals deserve world-class tech products without compromise. From day one, we've
                        combined local expertise with a global standard of quality.
                    </p>
                    <p class="text-secondary fs-5 lh-lg">
                        We specialise in printers, accessories, and tech solutions from the world's leading brands,
                        backed by expert support and a commitment to excellence that goes beyond the sale.
                    </p>
                    <a href="{{ route('about.index') }}" class="btn btn-primary btn-lg mt-2 mb-4">
                        <i class="fas fa-arrow-right me-2"></i> Learn More
                    </a>

                    {{-- Stats row under the text --}}
                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:48px;height:48px;font-size:1.25rem;">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0">500+</h4>
                                    <p class="text-secondary mb-0 small">Products Available</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:48px;height:48px;font-size:1.25rem;">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0">15K+</h4>
                                    <p class="text-secondary mb-0 small">Happy Customers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:48px;height:48px;font-size:1.25rem;">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0">8+</h4>
                                    <p class="text-secondary mb-0 small">Years Since 2017</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                    style="width:48px;height:48px;font-size:1.25rem;">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0">24/7</h4>
                                    <p class="text-secondary mb-0 small">Technical Support</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Store Image --}}
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="about-img-wrap position-relative">
                        <img src="{{ asset('images/about.png') }}"
                            alt="MJK Store — An Egyptian Brand with a Global Mindset"
                            class="img-fluid rounded-4 shadow-lg w-100" style="object-fit:cover; max-height:480px;">
                        {{-- Floating badge --}}
                        <div
                            class="position-absolute bottom-0 start-0 m-3 bg-white rounded-4 shadow px-3 py-2 d-flex align-items-center gap-2">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:36px;height:36px;font-size:1rem;">
                                <i class="fas fa-store"></i>
                            </div>
                            <div>
                                <p class="fw-bold mb-0 small">Est. 2017</p>
                                <p class="text-secondary mb-0" style="font-size:.7rem;">Mansoura, Egypt</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Values Row --}}
            <div class="row g-4">

                <div class="col-12 text-center mb-2">
                    <h3 class="fw-bold">Our Core Values</h3>
                    <p class="text-secondary">The principles that drive everything we do</p>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 rounded-4">
                        <div class="mx-auto mb-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                            style="width:64px;height:64px;font-size:1.75rem;">
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="fw-bold">Quality</h5>
                        <p class="text-secondary small mb-0">We only offer genuine products from the world's top brands.
                        </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 rounded-4">
                        <div class="mx-auto mb-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                            style="width:64px;height:64px;font-size:1.75rem;">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h5 class="fw-bold">Trust</h5>
                        <p class="text-secondary small mb-0">We build long-term relationships grounded in transparency and
                            integrity.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 rounded-4">
                        <div class="mx-auto mb-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                            style="width:64px;height:64px;font-size:1.75rem;">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h5 class="fw-bold">Innovation</h5>
                        <p class="text-secondary small mb-0">We stay ahead of the curve and bring cutting-edge solutions to
                            our customers.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center p-4 rounded-4">
                        <div class="mx-auto mb-3 bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                            style="width:64px;height:64px;font-size:1.75rem;">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h5 class="fw-bold">Support</h5>
                        <p class="text-secondary small mb-0">Our technical team is available around the clock to help you
                            whenever you need.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== Featured Products Gallery ===== --}}
    <section class="py-5" style="background:#0a0f1e;">
        <div class="container py-4">

            {{-- Header --}}
            <div class="text-center mb-5">
                <span class="badge rounded-pill px-3 py-2 mb-3 fs-6"
                    style="background:rgba(37,99,235,.15);color:#60a5fa;border:1px solid rgba(37,99,235,.3);">Our
                    Products</span>
                <h2 class="fw-bold text-white mb-2">Built Different. <span style="color:#3b82f6;">Engineered to
                        Last.</span></h2>
                <p class="text-secondary mx-auto" style="max-width:520px;">From gaming peripherals to enterprise
                    networking — every product carries the MJK standard.</p>
            </div>

            {{-- Masonry-style grid --}}
            <div class="mjk-gallery">

                {{-- Big left --}}
                <div class="mjk-gallery-item mjk-gallery-tall">
                    <a href="{{ route('products.index') }}">
                        <img src="{{ asset('images/prod-gamepad.jpg') }}" alt="MJK Gaming Headset">
                        <div class="mjk-gallery-overlay">
                            <span class="mjk-gallery-tag">Controllers</span>
                            <p>MJK Premium Gamepad</p>
                        </div>
                    </a>
                </div>

                {{-- Top right --}}
                <div class="mjk-gallery-item">
                    <a href="{{ route('products.index') }}">
                        <img src="{{ asset('images/prod-mouse.jpg') }}" alt="MJK Gaming Mouse">
                        <div class="mjk-gallery-overlay">
                            <span class="mjk-gallery-tag">Gaming Mice</span>
                            <p>MJK Pro Wireless</p>
                        </div>
                    </a>
                </div>

                {{-- Bottom right top --}}
                <div class="mjk-gallery-item">
                    <a href="{{ route('products.index') }}">
                        <img src="{{ asset('images/prod-scanner.jpg') }}" alt="MJK Barcode Scanner">
                        <div class="mjk-gallery-overlay">
                            <span class="mjk-gallery-tag">Scanners</span>
                            <p>MJK Barcode Pro</p>
                        </div>
                    </a>
                </div>

                {{-- Wide bottom --}}

                <div class="mjk-gallery-item mjk-gallery-wide">
                    <a href="{{ route('products.index') }}">
                        <img src="{{ asset('images/prod-switch.jpg') }}" alt="MJK PoE Switch">
                        <div class="mjk-gallery-overlay">
                            <span class="mjk-gallery-tag">Networking</span>
                            <p>MJK PoE Switch — 4GE+2GE+1SFP</p>
                        </div>
                    </a>
                </div>

            </div>

            {{-- CTA --}}
            <div class="text-center mt-5">
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-th-large me-2"></i> Browse All Products
                </a>
            </div>

        </div>
    </section>

    {{-- ===== Contact & Map Section ===== --}}
    <section class="py-5 bg-white">
        <div class="container py-4">

            {{-- Header --}}
            <div class="text-center mb-5">
                <span class="badge text-bg-primary rounded-pill px-3 py-2 mb-3 fs-6">Contact Us</span>
                <h2 class="fw-bold mb-2">We'd Love to Hear From You</h2>
                <p class="text-secondary mx-auto" style="max-width:480px;">Visit us in Mansoura, drop us a message, or just say hello.</p>
            </div>

            <div class="row g-4 align-items-stretch">

                {{-- Left: big form --}}
                <div class="col-lg-5 d-flex flex-column">
                    <div class="rounded-4 border p-4 flex-grow-1 d-flex flex-column">

                        {{-- Mini info strip --}}
                        <div class="d-flex flex-wrap gap-3 mb-4 pb-3 border-bottom">
                            <span class="small text-secondary">
                                <i class="fas fa-map-marker-alt text-primary me-1"></i>Al Galaa St, Mansoura
                            </span>
                            <a href="tel:+201001324539" class="small text-secondary text-decoration-none">
                                <i class="fas fa-phone-alt text-primary me-1"></i>+20 123 456 7890
                            </a>
                            <a href="https://wa.me/201001324539" target="_blank" class="small text-secondary text-decoration-none">
                                <i class="fab fa-whatsapp text-primary me-1"></i>WhatsApp
                            </a>
                        </div>

                        <h5 class="fw-bold mb-1">Send Us a Message</h5>
                        <p class="text-secondary small mb-4">We'll get back to you as soon as possible.</p>

                        <form id="contactForm" class="d-flex flex-column flex-grow-1">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold">Full Name</label>
                                    <input id="contactName" type="text" class="form-control rounded-3" placeholder="John Doe" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold">Email Address</label>
                                    <input id="contactEmail" type="email" class="form-control rounded-3" placeholder="you@example.com" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Subject</label>
                                <input id="contactSubject" type="text" class="form-control rounded-3" placeholder="How can we help?" required>
                            </div>
                            <div class="mb-4 flex-grow-1">
                                <label class="form-label small fw-semibold">Message</label>
                                <textarea id="contactMessage" class="form-control rounded-3" style="min-height:140px;" placeholder="Write your message here..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3">
                                <i class="fas fa-paper-plane me-2"></i> Send Message
                            </button>
                            <div id="contactFeedback" class="mt-3 small text-center d-none"></div>
                        </form>

                    </div>
                </div>

                {{-- Right: Google Map --}}
                <div class="col-lg-7">
                    <div class="rounded-4 overflow-hidden shadow-sm" style="height:100%; min-height:500px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d427.3126741646018!2d31.3651253!3d31.040138600000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f79dc660c33b0d%3A0xcc828a49e08b04ae!2z2LTYsdmD2YcgOTAg2YPYp9mF2YrYsdin2Ko!5e0!3m2!1sar!2seg!4v1778597954263!5m2!1sar!2seg"
                            width="100%" height="100%"
                            style="border:0; min-height:500px; display:block;"
                            allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="MJK Location - Mansoura, Egypt"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @push('scripts')
    <script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const name    = document.getElementById('contactName').value.trim();
        const email   = document.getElementById('contactEmail').value.trim();
        const subject = document.getElementById('contactSubject').value.trim();
        const message = document.getElementById('contactMessage').value.trim();
        const feedback = document.getElementById('contactFeedback');

        if (!name || !email || !subject || !message) return;

        const gmailSubject = encodeURIComponent(subject + '  from ' + name);
        const gmailBody    = encodeURIComponent(
            'Name: '    + name    + '\n' +
            'Email: '   + email   + '\n' +
            'Subject: ' + subject + '\n\n' +
            'Message:\n' + message
        );

        const gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=mjk%40gmail.com&su=' + gmailSubject + '&body=' + gmailBody;
        window.open(gmailUrl, '_blank');

        feedback.classList.remove('d-none', 'text-danger');
        feedback.classList.add('text-success');
        feedback.innerHTML = '<i class="fas fa-check-circle me-1"></i> Opening Gmail...';

        setTimeout(() => {
            this.reset();
            feedback.classList.add('d-none');
        }, 3000);
    });
    </script>
    @endpush

@endsection
