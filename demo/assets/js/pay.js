//pay
document.addEventListener('DOMContentLoaded', function () {
    const paymentMethod = document.getElementById('payment_method');
    const qrCodeContainer = document.getElementById('qrCodeContainer');

    function toggleQRCode() {
        if (paymentMethod.value === 'Chuyển khoản') {
            qrCodeContainer.style.display = 'block';
        } else {
            qrCodeContainer.style.display = 'none';
        }
    }
    paymentMethod.addEventListener('change', toggleQRCode);
    toggleQRCode(); 
});
