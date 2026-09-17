/**
 * Taking Order Cafe - Client Side Script
 * Mengutamakan kesederhanaan dan interaktivitas esensial.
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Auto dismiss alert messages after 5 seconds
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            if (bsAlert) {
                bsAlert.close();
            }
        }, 5000);
    });

    // 2. Order Form Calculation (Real-time subtotal & total calculation)
    const orderForm = document.getElementById('orderForm');
    if (orderForm) {
        const itemRows = document.querySelectorAll('.order-item-row');
        const grandTotalDisplay = document.getElementById('grandTotalDisplay');
        const grandTotalInput = document.getElementById('grandTotalInput');
        const totalItemsDisplay = document.getElementById('totalItemsDisplay');
        const submitOrderBtn = document.getElementById('submitOrderBtn');

        function calculateOrder() {
            let total = 0;
            let totalQuantity = 0;

            itemRows.forEach(function (row) {
                const qtyInput = row.querySelector('.item-qty');
                const price = parseFloat(qtyInput.getAttribute('data-price')) || 0;
                const qty = parseInt(qtyInput.value) || 0;
                const subtotal = price * qty;
                
                const subtotalDisplay = row.querySelector('.item-subtotal');
                if (subtotalDisplay) {
                    subtotalDisplay.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
                }

                if (qty > 0) {
                    total += subtotal;
                    totalQuantity += qty;
                    row.classList.add('table-light');
                } else {
                    row.classList.remove('table-light');
                }
            });

            if (grandTotalDisplay) {
                grandTotalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
            }
            if (grandTotalInput) {
                grandTotalInput.value = total;
            }
            if (totalItemsDisplay) {
                totalItemsDisplay.textContent = totalQuantity + ' item';
            }
            if (submitOrderBtn) {
                submitOrderBtn.disabled = totalQuantity === 0;
            }
        }

        // Event listener untuk tombol plus minus dan input manual
        itemRows.forEach(function (row) {
            const qtyInput = row.querySelector('.item-qty');
            const btnPlus = row.querySelector('.btn-plus');
            const btnMinus = row.querySelector('.btn-minus');

            if (btnPlus && qtyInput) {
                btnPlus.addEventListener('click', function () {
                    qtyInput.value = (parseInt(qtyInput.value) || 0) + 1;
                    calculateOrder();
                });
            }

            if (btnMinus && qtyInput) {
                btnMinus.addEventListener('click', function () {
                    const currentVal = parseInt(qtyInput.value) || 0;
                    if (currentVal > 0) {
                        qtyInput.value = currentVal - 1;
                        calculateOrder();
                    }
                });
            }

            if (qtyInput) {
                qtyInput.addEventListener('input', function () {
                    if (parseInt(qtyInput.value) < 0 || isNaN(parseInt(qtyInput.value))) {
                        qtyInput.value = 0;
                    }
                    calculateOrder();
                });
            }
        });

        // Hitung awal saat load halaman
        calculateOrder();
    }
});
