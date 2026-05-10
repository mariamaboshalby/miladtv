/**
 * MJK Admin Dashboard JS
 */
(function () {
    'use strict';

    const sidebar = document.getElementById('adminSidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('active');
        sidebarOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (sidebarToggle) sidebarToggle.addEventListener('click', openSidebar);
    if (sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

    // Auto-dismiss flash alerts
    const flashAlert = document.getElementById('flashAlert');
    if (flashAlert) {
        setTimeout(() => {
            flashAlert.style.opacity = '0';
            flashAlert.style.transform = 'translateY(-10px)';
            flashAlert.style.transition = 'all 0.4s ease';
            setTimeout(() => flashAlert.remove(), 400);
        }, 4000);
    }

    // Confirm delete
    document.querySelectorAll('[data-confirm]').forEach(btn => {
        btn.addEventListener('click', function (e) {
            if (!confirm(this.dataset.confirm || 'هل أنت متأكد؟')) {
                e.preventDefault();
            }
        });
    });

    // Specs dynamic rows
    const addSpecBtn = document.getElementById('addSpecBtn');
    const specsContainer = document.getElementById('specsContainer');

    if (addSpecBtn && specsContainer) {
        addSpecBtn.addEventListener('click', () => {
            const row = document.createElement('div');
            row.className = 'spec-row';
            row.innerHTML = `
                <input type="text" name="specs[]" class="form-control" placeholder="مثال: السرعة: 40 صفحة/دقيقة">
                <button type="button" class="btn btn-danger btn-sm remove-spec">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            specsContainer.appendChild(row);
            row.querySelector('.remove-spec').addEventListener('click', () => row.remove());
        });

        // Existing remove buttons
        specsContainer.querySelectorAll('.remove-spec').forEach(btn => {
            btn.addEventListener('click', () => btn.closest('.spec-row').remove());
        });
    }

})();
