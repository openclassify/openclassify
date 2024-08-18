$('.slider-controller-bar').clone().appendTo('.fotorama__wrap--slide')

$('.slider-controller-bar').last().remove()


if (typeof fotorama !== 'undefined' && fotorama.size == 1)
    $('.slider-controller-bar').css('bottom', 0);