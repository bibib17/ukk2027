/**
 * Materi UKK - Interactive JavaScript Helper
 * Tab Switcher, Copy to Clipboard, & Smooth Micro-Interactions
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Tab Switcher
    const tabButtons = document.querySelectorAll('.neu-tab-btn');
    tabButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const parent = this.closest('.neu-card') || document;
            const targetId = this.getAttribute('data-tab');

            // Reset tab buttons in the same container
            parent.querySelectorAll('.neu-tab-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Switch tab content
            parent.querySelectorAll('.neu-tab-content').forEach(c => c.classList.remove('active'));
            const targetContent = parent.querySelector('#' + targetId);
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });

    // 2. Copy Code to Clipboard
    const copyButtons = document.querySelectorAll('.btn-copy-code');
    copyButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const container = this.closest('.code-container');
            const codeEl = container ? container.querySelector('code') : null;
            if (codeEl) {
                const text = codeEl.innerText;
                navigator.clipboard.writeText(text).then(() => {
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="bi bi-check2"></i> Tersalin!';
                    this.style.background = '#15803d';
                    this.style.color = '#ffffff';

                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.style.background = '';
                        this.style.color = '';
                    }, 2000);
                });
            }
        });
    });
});
