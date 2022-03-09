$('.minicart-item').on('click', function () {
    if ($(this).hasClass('editing')) {
        let data = {
            item_id: $(this).find('.edit').data('id'),
            quantity: $('#quantity' + $(this).find('.edit').data('id')).val()
        }

        cart['edit'](data, cart_url.edit, function (response) {
            $('.minicart-contain .sub-total').find('.subtotal').html(response.cart.currency_subtotal);
            $('#item-' + response.cart_item.id).find('.price-amount').html(response.cart_item.currency_subtotal);
        });
    }
});

$('.cart-item-remove').on('click', function () {
    let data = {
        item_id: $(this).data('id'),
    }

    cart['add'](data, cart_url.remove, function (response) {
        $('.cart-item-count').html(response.items.length)
        $('.minicart-contain .sub-total').find('.count').html(response.items.length)
            .siblings('.subtotal').html(response.cart.currency_subtotal);
    })
});

$('.add-to-cart-btn').on('click', function () {
    let data = {
        item_id: $(this).data('id'),
        quantity: $(this).parent().find('.qty-input').find('input').val(),
        conf: $(this).parent().find('.product-variants').find('select').val()
    };

    let url = data.conf ? cart_url.configuration_add : cart_url.add;

    cart['add'](data, url, function (response) {
        $('.cart-item-count').html(response.cart_item.length)
        $('.minicart-contain .sub-total').find('.count').html(response.cart_item.length)
            .siblings('.subtotal').html(response.cart.currency_subtotal);

        if (response.status === true || response.status === 'success') {
            $('.cart-items').removeClass('d-none');
            $('.cart-is-empty-area').addClass('d-none');

            let cart = '<ul class="products">';

            $.each(response.cart_item, function (key, item) {
                cart += `<li>
                    <div class="minicart-item" id="item-${item.id}">
                        <div class="thumb">
                            <a href="${item.detail_url}">
                                <img src="${item.cover_photo}" width="90" height="90"
                                     alt="${item.name}">
                            </a>
                        </div>
                        <div class="left-info">
                            <div class="product-title">
                                <a href="${item.detail_url}" class="product-name">${item.name}</a>
                            </div>
                            <div class="price">
                                <ins>
                                    <span class="price-amount">
                                        ${item.currency_subtotal}
                                    </span>
                                </ins>
                                <div class="qty">
                                    <label for="quantity${item.id}">
                                        ${quantity}:
                                    </label>
                                    <input type="number" class="input-qty" name="quantity${item.id}"
                                           id="quantity${item.id}" value="${item.quantity}" disabled>
                                </div>
                            </div>
                            <div class="action">
                                <a href="javascript:void(0)" data-id="${item.id}" data-status="edit" class="edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" data-id="${item.id}" data-status="remove"
                                   class="remove cart-item-remove">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>`;
            });
            cart += '</ul>';
            $('.cart-inner .btn-control').removeClass('d-none')
            $('.cart-inner .cart-items').html(cart);

            Swal.fire({
                icon: 'success',
                title: add_success,
                showConfirmButton: false,
                timer: 1500
            })
        }
    })


});
