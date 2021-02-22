var wpLink = controlNumber(document.querySelector('.phoneCheck'))

if (wpLink) {
    $('.whatsapp-link').removeClass('hidden');
    $('.footer-mobile-device').removeClass('hidden');
} else {
    $('.alert-phoneNumber').removeClass('hidden');
    $('.footer-mobile-device').removeClass('d-block');
}