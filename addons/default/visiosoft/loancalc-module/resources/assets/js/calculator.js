// Set first payment value and default values
let initialPrice = price * advancePaymentPercentage;
$('.initial-payment').text(thouSep(Number(initialPrice).toFixed(2)) + ' TL');
$('input[name="firstPayment"]').val(initialPrice);
$('#downMonth').val(36)
calculateLoan();

$('#downMonth').change(function(event) {
    $('.number-month').text(event.target.value);

    calculateLoan()
});

$('#loanForm').submit(function(e) {
    e.preventDefault();
    $('#submit').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    $.ajax({
        type: 'POST',
        data: $(this).serialize(),
        url: '/ajax/loanApplication',
        success: function (response) {
            if (response['success']) {
                $('.success-message').removeClass('hidden');
                $('#loanForm').hide();
            }
        },
    });
});

function calculateLoan() {
    let numberOfMonths = $('#downMonth').val(),
        extraPaymentPerMonth = price * (1 - advancePaymentPercentage) * interestRate / 100,
        totalMonthlyPayment = extraPaymentPerMonth * numberOfMonths,
        totalPayment = price * (1 - advancePaymentPercentage) + totalMonthlyPayment,
        paymentPerMonth = totalPayment / numberOfMonths;

    $('.monthly-payment').text(thouSep(Number(paymentPerMonth).toFixed(2)) + ' TL');
    $('input[name="monthlyPayment"]').val(paymentPerMonth);
    $('input[name="totalPayment"]').val(totalPayment);
    $('input[name="applicationTerm"]').val(numberOfMonths);
}

function thouSep(n) {
    n += '';
    let x = n.split('.');
    let x1 = x[0];
    let x2 = x.length > 1 ? '.' + x[1] : '';
    let rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
