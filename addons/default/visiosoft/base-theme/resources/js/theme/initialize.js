$(function () {

    // Go!
});

var TxtType = function (el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
};

TxtType.prototype.tick = function () {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.placeholder = this.txt;

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) {
        delta /= 2;
    }

    if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
    }

    setTimeout(function () {
        that.tick();
    }, delta);
};

window.onload = function () {

    var elements = document.getElementById('search_ac_navigator');
    var toRotate = elements.getAttribute('data-type');
    var period = elements.getAttribute('data-period');
    if (toRotate) {
        new TxtType(elements, JSON.parse(toRotate), period);
    }


    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);
};

$('.navigation-category-select-item').on('click', function () {
    $('.select-category-navigation-id').val($(this).attr('data-id'));
})

$('.navigation-category-select-item').on('click', function () {
    $('.select-category-home-id').val($(this).attr('data-id'));
})

$('.navigation-city-select-item').on('click', function () {
    $('.select-city-home-id').val($(this).attr('data-id'));
})