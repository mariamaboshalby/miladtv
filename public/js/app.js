/**
 * milad E-Commerce - Main JavaScript
 * Handles all interactive features
 */

(function() {
    'use strict';

    // ========================================================================
    // DOM Elements
    // ========================================================================
    const elements = {
        navbar: document.getElementById('mainNavbar'),
        mobileMenuBtn: document.getElementById('mobileMenuBtn'),
        navbarMenu: document.getElementById('navbarMenu'),
        cartBtn: document.getElementById('cartBtn'),
        cartSidebar: document.getElementById('cartSidebar'),
        cartOverlay: document.getElementById('cartOverlay'),
        closeCart: document.getElementById('closeCart'),
        cartBadge: document.getElementById('cartBadge'),
        backToTop: document.getElementById('backToTop'),
        toastContainer: document.getElementById('toastContainer'),
    };

    // ========================================================================
    // Search toggle
    const searchToggle = document.getElementById('navSearchToggle');
    const searchWrap   = document.getElementById('navSearchWrap');
    if (searchToggle && searchWrap) {
        searchToggle.addEventListener('click', () => {
            searchWrap.classList.toggle('open');
            searchToggle.classList.toggle('active');
            if (searchWrap.classList.contains('open')) {
                searchWrap.querySelector('input')?.focus();
            }
        });
        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!searchToggle.contains(e.target) && !searchWrap.contains(e.target)) {
                searchWrap.classList.remove('open');
                searchToggle.classList.remove('active');
            }
        });
    }

    // Mobile Menu Toggle
    // ========================================================================
    if (elements.mobileMenuBtn && elements.navbarMenu) {
        elements.mobileMenuBtn.addEventListener('click', () => {
            elements.navbarMenu.classList.toggle('active');
            elements.mobileMenuBtn.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!elements.navbarMenu.contains(e.target) && 
                !elements.mobileMenuBtn.contains(e.target) &&
                elements.navbarMenu.classList.contains('active')) {
                elements.navbarMenu.classList.remove('active');
                elements.mobileMenuBtn.classList.remove('active');
            }
        });

        // Handle dropdown in mobile
        const dropdowns = document.querySelectorAll('.has-dropdown');
        dropdowns.forEach(dropdown => {
            const link = dropdown.querySelector('a');
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    dropdown.classList.toggle('active');
                }
            });
        });
    }

    // ========================================================================
    // Cart Sidebar
    // ========================================================================
    function openCart() {
        elements.cartSidebar.classList.add('active');
        elements.cartOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        loadCartItems();
    }

    function closeCart() {
        elements.cartSidebar.classList.remove('active');
        elements.cartOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (elements.cartBtn) {
        elements.cartBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openCart();
        });
    }

    if (elements.closeCart) {
        elements.closeCart.addEventListener('click', closeCart);
    }

    if (elements.cartOverlay) {
        elements.cartOverlay.addEventListener('click', closeCart);
    }

    // ========================================================================
    // Load Cart Items — fetch real data from server
    // ========================================================================
    function fetchCartItems() {
        return fetch('/cart/items', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(r => r.json())
            .then(data => renderCartSidebar(data.items, data.total))
            .catch(() => {});
    }

    function renderCartSidebar(items, total) {
        const cartBody = document.getElementById('cartSidebarBody');
        if (!cartBody) return;

        if (!items || items.length === 0) {
            cartBody.innerHTML = `
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-shopping-bag mb-3 d-block" style="font-size:2.5rem;opacity:.3;"></i>
                    <p class="mb-0">Your cart is empty</p>
                </div>`;
            updateCartTotal(0);
            return;
        }

        let html = '';
        items.forEach(item => {
            html += `
                <div class="d-flex align-items-center gap-3 py-3 border-bottom" data-id="${item.id}">
                    <div class="flex-shrink-0 bg-light rounded-3 d-flex align-items-center justify-content-center" style="width:52px;height:52px;font-size:1.25rem;color:#051836;">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="flex-grow-1 min-w-0">
                        <p class="fw-semibold mb-0 small text-dark" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${item.name}</p>
                        <p class="text-primary fw-bold mb-0 small">${Number(item.price).toLocaleString()} EGP</p>
                    </div>
                    <div class="d-flex align-items-center gap-0 flex-shrink-0">
                        <button onclick="updateQuantity(${item.id}, ${item.quantity - 1})"
                                class="btn btn-sm btn-light border" style="width:28px;height:28px;padding:0;border-radius:6px 0 0 6px;font-size:.75rem;">−</button>
                        <input
                            type="number"
                            value="${item.quantity}"
                            min="1" max="99"
                            onchange="updateQuantity(${item.id}, Math.max(1, parseInt(this.value)||1))"
                            onkeydown="if(event.key==='Enter')this.blur()"
                            class="border-top border-bottom text-center fw-bold"
                            style="width:40px;height:28px;font-size:.8rem;border-left:none;border-right:none;outline:none;-moz-appearance:textfield;">
                        <button onclick="updateQuantity(${item.id}, ${item.quantity + 1})"
                                class="btn btn-sm btn-light border" style="width:28px;height:28px;padding:0;border-radius:0 6px 6px 0;font-size:.75rem;">+</button>
                    </div>
                    <button onclick="removeFromCart(${item.id})" class="btn btn-sm text-danger flex-shrink-0" style="padding:4px 6px;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>`;
        });

        cartBody.innerHTML = html;
        updateCartTotal(total);
    }

    // Keep old name as alias so openCart() still works
    function loadCartItems() { fetchCartItems(); }

    function updateCartTotal(total) {
        const totalElement = document.getElementById('sidebarTotal');
        if (totalElement) {
            totalElement.textContent = `${Number(total).toLocaleString()} EGP`;
        }
    }

    // ========================================================================
    // Add to Cart
    // ========================================================================
    window.addToCart = function(productId, productName, productPrice, productImage) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        // Use FormData so Laravel $request->input() works correctly
        const params = new URLSearchParams({
            _token:        csrfToken,
            product_id:    productId,
            product_name:  productName,
            product_price: productPrice,
            product_image: productImage,
            quantity:      1,
        });

        fetch('/cart/add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: params.toString(),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast('success', 'Product added to cart!');
                updateCartBadge(data.cart_count);
                // Reload sidebar items then open
                fetchCartItems().then(() => openCart());
            }
        })
        .catch(() => showToast('error', 'Something went wrong. Please try again.'));
    };

    // ========================================================================
    // Remove from Cart
    // ========================================================================
    window.removeFromCart = function(productId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        const params = new URLSearchParams({ _token: csrfToken, product_id: productId });

        fetch('/cart/remove', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: params.toString(),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast('success', 'Item removed.');
                updateCartBadge(data.cart_count);
                fetchCartItems();
            }
        })
        .catch(() => showToast('error', 'Something went wrong.'));
    };

    // ========================================================================
    // Update Quantity
    // ========================================================================
    window.updateQuantity = function(productId, newQuantity) {
        if (newQuantity < 1) {
            removeFromCart(productId);
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const params = new URLSearchParams({ _token: csrfToken, product_id: productId, quantity: newQuantity });

        fetch('/cart/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: params.toString(),
        })
        .then(r => r.json())
        .then(data => { if (data.success) fetchCartItems(); })
        .catch(() => {});
    };

    // ========================================================================
    // Update Cart Badge
    // ========================================================================
    function updateCartBadge(count) {
        if (elements.cartBadge) {
            elements.cartBadge.textContent = count;
            if (count > 0) {
                elements.cartBadge.style.display = 'flex';
            } else {
                elements.cartBadge.style.display = 'none';
            }
        }
    }

    // ========================================================================
    // Toast Notifications
    // ========================================================================
    function showToast(type, message) {
        if (!elements.toastContainer) return;

        const icons = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            info: 'fa-info-circle',
        };

        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <i class="fas ${icons[type]}"></i>
            <span>${message}</span>
        `;

        elements.toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // ========================================================================
    // Back to Top Button
    // ========================================================================
    function handleScroll() {
        if (elements.backToTop) {
            if (window.scrollY > 300) {
                elements.backToTop.classList.add('visible');
            } else {
                elements.backToTop.classList.remove('visible');
            }
        }
    }

    if (elements.backToTop) {
        elements.backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    window.addEventListener('scroll', handleScroll);

    // ========================================================================
    // Smooth Scroll for Anchor Links
    // ========================================================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#' || href === '') return;

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // ========================================================================
    // Image Placeholder Handler
    // ========================================================================
    document.querySelectorAll('img[data-src]').forEach(img => {
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
    });

    // ========================================================================
    // Form Validation
    // ========================================================================
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('error');
                } else {
                    input.classList.remove('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
                showToast('error', 'الرجاء ملء جميع الحقول المطلوبة');
            }
        });
    });

    // ========================================================================
    // Initialize on Load
    // ========================================================================
    document.addEventListener('DOMContentLoaded', () => {
        console.log('milad E-Commerce initialized');
        handleScroll();
    });

})();

// ========================================================================
// Animations on Scroll
// ========================================================================
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.animate-on-scroll').forEach(el => {
    observer.observe(el);
});


// ============================================================
// milad Premium Navbar — mobile menu wiring (new layout)
// ============================================================
(function () {
    const hamburger  = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', function () {
            mobileMenu.classList.toggle('open');
            hamburger.classList.toggle('active');
        });

        document.addEventListener('click', function (e) {
            if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('open');
                hamburger.classList.remove('active');
            }
        });
    }
}());
