@extends('layouts.app')

@section('title', 'Ù…Ù† Ù†Ø­Ù† - MJK')

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Ù…Ù† Ù†Ø­Ù†</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Ø§Ù„Ø±Ø¦ÙŠØ³ÙŠØ©</a>
            <i class="fas fa-chevron-left"></i>
            <span>Ù…Ù† Ù†Ø­Ù†</span>
        </nav>
    </div>
</div>

<!-- About Section -->
<section class="section">
    <div class="container">
        <div class="about-intro">
            <div class="about-text">
                <h2>Ù†Ø­Ù† MJK - Ø´Ø±ÙŠÙƒÙƒ Ø§Ù„Ù…ÙˆØ«ÙˆÙ‚ ÙÙŠ Ø¹Ø§Ù„Ù… Ø§Ù„ØªÙ‚Ù†ÙŠØ©</h2>
                <p>Ù…Ù†Ø° Ø£ÙƒØ«Ø± Ù…Ù† 10 Ø³Ù†ÙˆØ§ØªØŒ Ù†Ù‚Ø¯Ù… Ø£ÙØ¶Ù„ Ø§Ù„Ø­Ù„ÙˆÙ„ Ø§Ù„ØªÙ‚Ù†ÙŠØ© Ù„Ù„Ø´Ø±ÙƒØ§Øª ÙˆØ§Ù„Ø£ÙØ±Ø§Ø¯ ÙÙŠ Ù…ØµØ±. Ù†Ø­Ù† Ù…ØªØ®ØµØµÙˆÙ† ÙÙŠ ØªÙˆÙÙŠØ± Ø£Ø­Ø¯Ø« Ø§Ù„Ø·Ø§Ø¨Ø¹Ø§Øª ÙˆØ§Ù„Ø§ÙƒØ³Ø³ÙˆØ§Ø±Ø§Øª Ø§Ù„ØªÙ‚Ù†ÙŠØ© Ù…Ù† Ø£Ø´Ù‡Ø± Ø§Ù„Ø¹Ù„Ø§Ù…Ø§Øª Ø§Ù„ØªØ¬Ø§Ø±ÙŠØ© Ø§Ù„Ø¹Ø§Ù„Ù…ÙŠØ©.</p>
                <p>Ø±Ø¤ÙŠØªÙ†Ø§ Ù‡ÙŠ Ø£Ù† Ù†ÙƒÙˆÙ† Ø§Ù„ÙˆØ¬Ù‡Ø© Ø§Ù„Ø£ÙˆÙ„Ù‰ Ù„ÙƒÙ„ Ù…Ù† ÙŠØ¨Ø­Ø« Ø¹Ù† Ø§Ù„Ø¬ÙˆØ¯Ø© ÙˆØ§Ù„Ù…ÙˆØ«ÙˆÙ‚ÙŠØ© ÙÙŠ Ø§Ù„Ù…Ù†ØªØ¬Ø§Øª Ø§Ù„ØªÙ‚Ù†ÙŠØ©ØŒ Ù…Ø¹ ØªÙ‚Ø¯ÙŠÙ… Ø®Ø¯Ù…Ø© Ø¹Ù…Ù„Ø§Ø¡ Ø§Ø³ØªØ«Ù†Ø§Ø¦ÙŠØ© ÙˆØ¯Ø¹Ù… ÙÙ†ÙŠ Ù…ØªÙ…ÙŠØ².</p>
            </div>
            <div class="about-image">
                <div class="placeholder-image-about">
                    <i class="fas fa-building"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section-about">
    <div class="container">
        <div class="stats-grid-about">
            @foreach($stats as $stat)
            <div class="stat-card-about animate-on-scroll">
                <div class="stat-icon-about">
                    <i class="fas {{ $stat['icon'] }}"></i>
                </div>
                <h3>{{ $stat['number'] }}</h3>
                <p>{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Ù‚ÙŠÙ…Ù†Ø§ ÙˆÙ…Ø¨Ø§Ø¯Ø¦Ù†Ø§</h2>
            <p>Ù†Ø¤Ù…Ù† Ø¨Ø£Ù† Ø§Ù„Ù†Ø¬Ø§Ø­ ÙŠØ¨Ù†Ù‰ Ø¹Ù„Ù‰ Ø£Ø³Ø§Ø³ Ù‚ÙˆÙŠ Ù…Ù† Ø§Ù„Ù‚ÙŠÙ… ÙˆØ§Ù„Ù…Ø¨Ø§Ø¯Ø¦</p>
        </div>
        <div class="values-grid">
            @foreach($values as $value)
            <div class="value-card animate-on-scroll">
                <div class="value-icon">
                    <i class="fas {{ $value['icon'] }}"></i>
                </div>
                <h3>{{ $value['title'] }}</h3>
                <p>{{ $value['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section team-section">
    <div class="container">
        <div class="section-header">
            <h2>ÙØ±ÙŠÙ‚ Ø§Ù„Ø¹Ù…Ù„</h2>
            <p>ØªØ¹Ø±Ù Ø¹Ù„Ù‰ Ø§Ù„ÙØ±ÙŠÙ‚ Ø§Ù„Ù…Ø­ØªØ±Ù Ø§Ù„Ø°ÙŠ ÙŠÙ‚Ù ÙˆØ±Ø§Ø¡ Ù†Ø¬Ø§Ø­Ù†Ø§</p>
        </div>
        <div class="team-grid">
            @foreach($team as $member)
            <div class="team-card animate-on-scroll">
                <div class="team-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h3>{{ $member['name'] }}</h3>
                <span class="team-role">{{ $member['role'] }}</span>
                <p>{{ $member['bio'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="cta-section-about">
    <div class="container">
        <div class="cta-content-about">
            <h2>Ù‡Ù„ Ù„Ø¯ÙŠÙƒ Ø§Ø³ØªÙØ³Ø§Ø±ØŸ</h2>
            <p>ÙØ±ÙŠÙ‚Ù†Ø§ Ø¬Ø§Ù‡Ø² Ù„Ù„Ø¥Ø¬Ø§Ø¨Ø© Ø¹Ù„Ù‰ Ø¬Ù…ÙŠØ¹ Ø£Ø³Ø¦Ù„ØªÙƒ ÙˆÙ…Ø³Ø§Ø¹Ø¯ØªÙƒ ÙÙŠ Ø§Ø®ØªÙŠØ§Ø± Ø§Ù„Ù…Ù†ØªØ¬ Ø§Ù„Ù…Ù†Ø§Ø³Ø¨</p>
            <div class="cta-buttons">
                <a href="tel:+201234567890" class="btn btn-white btn-lg">
                    <i class="fas fa-phone-alt"></i> Ø§ØªØµÙ„ Ø¨Ù†Ø§
                </a>
                <a href="https://wa.me/201234567890" class="btn btn-outline btn-lg" style="border-color: white; color: white;">
                    <i class="fab fa-whatsapp"></i> ÙˆØ§ØªØ³Ø§Ø¨
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>


.about-intro {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.about-text h2 {
    font-size: 2rem;
    margin-bottom: 1.5rem;
    color: var(--gray-900);
}

.about-text p {
    font-size: 1.0625rem;
    line-height: 1.9;
    color: var(--gray-600);
    margin-bottom: 1.25rem;
}

.about-image {
    background: var(--gray-100);
    border-radius: var(--radius-xl);
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-lg);
}

.placeholder-image-about {
    font-size: 8rem;
    color: var(--gray-300);
}

.stats-section-about {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
    padding: 4rem 0;
    color: var(--white);
}

.stats-grid-about {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
}

.stat-card-about {
    text-align: center;
    padding: 2rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: var(--radius-xl);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: var(--transition);
}

.stat-card-about:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-5px);
}

.stat-icon-about {
    width: 70px;
    height: 70px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--white);
    margin: 0 auto 1.25rem;
}

.stat-card-about h3 {
    font-size: 2.5rem;
    color: var(--white);
    margin-bottom: 0.5rem;
}

.stat-card-about p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.0625rem;
    margin: 0;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.value-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.value-card:hover {
    box-shadow: var(--shadow-xl);
    transform: translateY(-8px);
}

.value-icon {
    width: 70px;
    height: 70px;
    background: var(--secondary-blue);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--primary-blue);
    margin-bottom: 1.5rem;
    transition: var(--transition);
}

.value-card:hover .value-icon {
    background: var(--primary-blue);
    color: var(--white);
    transform: scale(1.1);
}

.value-card h3 {
    font-size: 1.375rem;
    margin-bottom: 1rem;
    color: var(--gray-900);
}

.value-card p {
    color: var(--gray-600);
    font-size: 1rem;
    line-height: 1.8;
    margin: 0;
}

.team-section {
    background: var(--gray-50);
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
}

.team-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 2rem;
    text-align: center;
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.team-card:hover {
    box-shadow: var(--shadow-xl);
    transform: translateY(-8px);
}

.team-avatar {
    width: 100px;
    height: 100px;
    background: var(--secondary-blue);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: var(--primary-blue);
    margin: 0 auto 1.25rem;
    transition: var(--transition);
}

.team-card:hover .team-avatar {
    background: var(--primary-blue);
    color: var(--white);
}

.team-card h3 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: var(--gray-900);
}

.team-role {
    display: block;
    color: var(--primary-blue);
    font-weight: 600;
    font-size: 0.9375rem;
    margin-bottom: 1rem;
}

.team-card p {
    color: var(--gray-600);
    font-size: 0.9375rem;
    line-height: 1.7;
    margin: 0;
}

.cta-section-about {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
    padding: 5rem 0;
    text-align: center;
    color: var(--white);
}

.cta-content-about h2 {
    color: var(--white);
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.cta-content-about p {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2.5rem;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.animate-on-scroll {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
}

.animate-on-scroll.animate-in {
    opacity: 1;
    transform: translateY(0);
}

@media (max-width: 1024px) {
    .about-intro { grid-template-columns: 1fr; }
    .stats-grid-about { grid-template-columns: repeat(2, 1fr); }
    .values-grid { grid-template-columns: 1fr; }
    .team-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 640px) {
    .stats-grid-about { grid-template-columns: 1fr; }
    .team-grid { grid-template-columns: 1fr; }
    .cta-buttons { flex-direction: column; }
}
</style>
@endpush

