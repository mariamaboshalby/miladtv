{{-- Floating Social Buttons --}}
<div class="social-float-buttons">
    {{-- WhatsApp --}}
    <a href="https://wa.me/201093803270" 
       target="_blank" 
       rel="noopener noreferrer"
       class="social-float-btn whatsapp-btn"
       aria-label="WhatsApp"
       title="{{ app()->getLocale() === 'ar' ? 'تواصل معنا عبر WhatsApp' : 'Contact us on WhatsApp' }}">
        <i class="fab fa-whatsapp"></i>
        <span class="social-float-text">WhatsApp</span>
    </a>

    {{-- Phone --}}
    <a href="tel:+201093803270" 
       class="social-float-btn phone-btn"
       aria-label="Phone"
       title="{{ app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Call us' }}">
        <i class="fas fa-phone-alt"></i>
        <span class="social-float-text">{{ app()->getLocale() === 'ar' ? 'اتصل' : 'Call' }}</span>
    </a>

    {{-- Facebook Messenger --}}
    <a href="https://m.me/181WTrqgHu" 
       target="_blank" 
       rel="noopener noreferrer"
       class="social-float-btn messenger-btn"
       aria-label="Facebook Messenger"
       title="{{ app()->getLocale() === 'ar' ? 'راسلنا على Messenger' : 'Message us on Messenger' }}">
        <i class="fab fa-facebook-messenger"></i>
        <span class="social-float-text">Messenger</span>
    </a>
</div>

<style>
.social-float-buttons {
    position: fixed;
    bottom: 100px;
    left: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 12px;
    animation: slideInLeft 0.5s ease-out;
}

[dir="rtl"] .social-float-buttons {
    left: auto;
    right: 20px;
}

.social-float-btn {
    position: relative;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    text-decoration: none;
    overflow: hidden;
}

.social-float-btn:hover {
    transform: scale(1.1) translateX(5px);
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.3);
    color: #fff;
}

[dir="rtl"] .social-float-btn:hover {
    transform: scale(1.1) translateX(-5px);
}

.social-float-text {
    position: absolute;
    right: 64px;
    background: inherit;
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.875rem;
    font-weight: 600;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

[dir="rtl"] .social-float-text {
    right: auto;
    left: 64px;
}

.social-float-btn:hover .social-float-text {
    opacity: 1;
    visibility: visible;
    right: 74px;
}

[dir="rtl"] .social-float-btn:hover .social-float-text {
    right: auto;
    left: 74px;
}

/* WhatsApp Button */
.whatsapp-btn {
    background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
}

.whatsapp-btn:hover {
    background: linear-gradient(135deg, #128C7E 0%, #075E54 100%);
}

/* Phone Button */
.phone-btn {
    background: linear-gradient(135deg, #051836 0%, #0a2e5c 100%);
}

.phone-btn:hover {
    background: linear-gradient(135deg, #030f1f 0%, #051836 100%);
}

/* Messenger Button */
.messenger-btn {
    background: linear-gradient(135deg, #0084FF 0%, #0066CC 100%);
}

.messenger-btn:hover {
    background: linear-gradient(135deg, #0066CC 0%, #004C99 100%);
}

/* Pulse Animation */
.social-float-btn::before {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    background: inherit;
    opacity: 0.6;
    animation: pulse 2s infinite;
    z-index: -1;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(0.95);
        opacity: 0.6;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.3;
    }
}

@keyframes slideInLeft {
    from {
        transform: translateX(-100px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Mobile Adjustments */
@media (max-width: 768px) {
    .social-float-buttons {
        bottom: 80px;
        left: 15px;
        gap: 10px;
    }
    
    [dir="rtl"] .social-float-buttons {
        left: auto;
        right: 15px;
    }
    
    .social-float-btn {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }
    
    .social-float-text {
        font-size: 0.75rem;
        padding: 6px 12px;
    }
}

/* Hide on very small screens */
@media (max-width: 480px) {
    .social-float-text {
        display: none;
    }
    
    .social-float-btn {
        width: 48px;
        height: 48px;
        font-size: 1.125rem;
    }
}
</style>
