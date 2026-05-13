@extends('layouts.app')

@section('title', 'About Us - MJK')

@section('content')

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 100%);padding:2.5rem 0;">
    <div class="container">
        <h1 class="text-white fw-bold mb-1">About Us</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active text-white-50">About Us</li>
            </ol>
        </nav>
    </div>
</div>

{{-- About Intro --}}
<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4" style="font-size:2rem;color:#0f172a;">MJK — Your Trusted Tech Partner</h2>
                <p class="text-secondary lh-lg mb-3" style="font-size:1.0625rem;">
                    Founded in 2017, MJK has been delivering top-tier tech solutions to businesses and individuals across Egypt. We specialise in the latest printers and accessories from the world's leading brands.
                </p>
                <p class="text-secondary lh-lg mb-0" style="font-size:1.0625rem;">
                    Our vision is to be the go-to destination for anyone seeking quality and reliability in tech products, backed by exceptional customer service and expert technical support.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="about-img-wrap">
                    <img src="{{ asset('images/about.png') }}" alt="MJK Store" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit:cover;max-height:400px;">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Stats Section --}}
<section class="py-5" style="background:linear-gradient(135deg,#1e3a8a 0%,#2563eb 100%);">
    <div class="container">
        <div class="row g-4">
            @foreach($stats as $stat)
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card text-center p-4 rounded-4 h-100">
                    <div class="stat-icon mx-auto mb-3">
                        <i class="fas {{ $stat['icon'] }}"></i>
                    </div>
                    <h3 class="text-white fw-bold mb-1" style="font-size:2.5rem;">{{ $stat['number'] }}</h3>
                    <p class="mb-0" style="color:rgba(255,255,255,.85);font-size:1.0625rem;">{{ $stat['label'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Values Section --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:#0f172a;">Our Values &amp; Principles</h2>
            <p class="text-secondary">We believe success is built on a strong foundation of values and principles.</p>
        </div>
        <div class="row g-4">
            @foreach($values as $value)
            <div class="col-md-6">
                <div class="value-card card border-0 shadow-sm h-100 p-4">
                    <div class="value-icon mb-3">
                        <i class="fas {{ $value['icon'] }}"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color:#0f172a;">{{ $value['title'] }}</h4>
                    <p class="text-secondary mb-0 lh-lg">{{ $value['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Team Section --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color:#0f172a;">Our Team</h2>
            <p class="text-secondary">Meet the dedicated professionals behind our success.</p>
        </div>
        <div class="row g-4">
            @foreach($team as $member)
            <div class="col-sm-6 col-lg-3">
                <div class="team-card card border-0 shadow-sm text-center p-4 h-100">
                    <div class="team-avatar mx-auto mb-3">
                        <i class="fas fa-user"></i>
                    </div>
                    <h5 class="fw-bold mb-1" style="color:#0f172a;">{{ $member['name'] }}</h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3 d-inline-block" style="border-radius:50px;">{{ $member['role'] }}</span>
                    <p class="text-secondary mb-0" style="font-size:.9375rem;line-height:1.7;">{{ $member['bio'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-5 text-center" style="background:linear-gradient(135deg,#1e3a8a 0%,#2563eb 100%);">
    <div class="container">
        <h2 class="text-white fw-bold mb-3" style="font-size:2.5rem;">Have a Question?</h2>
        <p class="mb-4" style="color:rgba(255,255,255,.9);font-size:1.25rem;">Our team is ready to answer all your questions and help you choose the right product.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="tel:+201001324539" class="btn btn-light btn-lg px-5 fw-bold">
                <i class="fas fa-phone-alt me-2"></i>Call Us
            </a>
            <a href="https://wa.me/201001324539" class="btn btn-outline-light btn-lg px-5 fw-bold">
                <i class="fab fa-whatsapp me-2"></i>WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.stat-card {
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.2);
    backdrop-filter: blur(10px);
    transition: all .3s ease;
}

.stat-card:hover {
    background: rgba(255,255,255,.18);
    transform: translateY(-5px);
}

.stat-icon {
    width: 70px;
    height: 70px;
    background: rgba(255,255,255,.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #fff;
}

.value-card {
    border-radius: 16px !important;
    transition: all .3s ease;
}

.value-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 48px rgba(0,0,0,.1) !important;
}

.value-icon {
    width: 64px;
    height: 64px;
    background: #eff6ff;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: #2563eb;
    transition: all .3s ease;
}

.value-card:hover .value-icon {
    background: #2563eb;
    color: #fff;
}

.team-card {
    border-radius: 16px !important;
    transition: all .3s ease;
}

.team-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 48px rgba(0,0,0,.1) !important;
}

.team-avatar {
    width: 90px;
    height: 90px;
    background: #eff6ff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: #2563eb;
    transition: all .3s ease;
}

.team-card:hover .team-avatar {
    background: #2563eb;
    color: #fff;
}
</style>
@endpush
