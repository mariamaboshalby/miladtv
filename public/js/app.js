/**
 * MJK E-Commerce - Main JavaScript
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
    // Load Cart Items
    // ========================================================================
    function loadCartItems() {
        // This would typically fetch from server/session
        // For now, we'll use a placeholder
        const cartBody = document.getElementById('cartSidebarBody');
        if (!cartBody) return;

        // Placeholder - replace with actual cart data
        const cartItems = getCartFromSession();
        
        if (cartItems.length === 0) {
            cartBody.innerHTML = `
                <div style="text-align: center; padding: 3rem 1rem; color: var(--gray-500);">
                    <i class="fas fa-shopping-cart" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                    <p>السلة فارغة</p>
                </div>
            `;
            updateCartTotal(0);
            return;
        }

        let html = '';
        let total = 0;

        cartItems.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            
            html += `
                <div class="cart-item" data-id="${item.id}">
                    <div class="cart-item-image">
                        <div class="placeholder-image">
                            <i class="fas fa-image"></i>
                        </div>
                    </div>
                    <div class="cart-item-details">
                        <h4>${item.name}</h4>
                        <p class="cart-item-price">${item.price} جنيه</p>
                        <div class="cart-item-quantity">
                            <button class="qty-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                            <span>${item.quantity}</span>
                            <button class="qty-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                        </div>
                    </div>
                    <button class="remove-item" onclick="removeFromCart(${item.id})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
        });

        cartBody.innerHTML = html;
        updateCartTotal(total);
    }

    function getCartFromSession() {
        // This would fetch from server session
        // Placeholder implementation
        return [];
    }

    function updateCartTotal(total) {
        const totalElement = document.getElementById('sidebarTotal');
        if (totalElement) {
            totalElement.textContent = `${total.toLocaleString()} جنيه`;
        }
    }

    // ========================================================================
    // Add to Cart
    // ========================================================================
    window.addToCart = function(productId, productName, productPrice, productImage) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                product_id: productId,
                product_name: productName,
                product_price: productPrice,
                product_image: productImage,
                quantity: 1,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('success', data.message);
                updateCartBadge(data.cart_count);
                openCart();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'حدث خطأ أثناء إضافة المنتج');
        });
    };

    // ========================================================================
    // Remove from Cart
    // ========================================================================
    window.removeFromCart = function(productId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        
        fetch('/cart/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                product_id: productId,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('success', data.message);
                updateCartBadge(data.cart_count);
                loadCartItems();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'حدث خطأ أثناء حذف المنتج');
        });
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
        
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: newQuantity,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadCartItems();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
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
        console.log('MJK E-Commerce initialized');
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
