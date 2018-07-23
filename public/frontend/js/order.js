Number.prototype.round = function(p) {
    p = p || 10;
    return parseFloat(this.toFixed(p));
};
$(function() {
    $.fn.orderDetail = function() {
        $(".coupon-code").toggle();
        var order_detail_container = $(".order-detail-container");
        $(order_detail_container).find(".order-item-container").on('click', '.row', function(event) {
            $(order_detail_container).find(".row").removeClass('active');
            $(this).addClass('active');
        });
        $(order_detail_container).find(".notification-btn").on('click', 'a', function(event) {
            event.preventDefault();
            var url = base_url + language_code + '/choose-seller/' + $(this).data('merchant');
            var item_id = $(this).data('item-id');
            var customer_id = $(this).data('customer');
            var merchant_id = $(this).data('merchant');
            var available_type = $(this).data('available_type');
            var available_time = $(this).data('available_time');
            var product_name = $(this).data('product_name');
            var product_link = $(this).data('product_link');
            $.ajax({
                type: 'POST',
                url: url,
                data: { 'item_id': item_id, 'merchant': merchant_id, 'customer': customer_id, 'available_type': available_type, 'available_time': available_time, 'product_name': product_name, 'product_link': product_link },
                beforeSend: function() {
                    $.LoadingOverlay("show", { 'size': "10%", 'zIndex': 9999 });
                },
                success: function(response, status) {
                    $.LoadingOverlay("hide");
                    window.location.reload();
                }
            });
        });

        $(".response-to-customer").click(function(e) {
            var form = $("#product_search_form_".$(this).data('index'));
            $(form).submit();
        });

        $(".cancel_order").on('click', function(e) {
            e.preventDefault();
            var form = $("#product_booking_" + $(this).data('index'));
            var form_url = form.attr('action');
            var new_url = form_url.replace('booking-request', 'cancel-request');
            form.attr('action', new_url);
            $(form).submit();
        });

        $(".booking-request").click(function(e) {
            var form = $("#product_booking_".$(this).data('index'));
            $(form).submit();
        });

        $(".coupon-code-btn").click(function() {
            $(this).next().toggle();
        });

    }
    calcul_total_price();
    $('.cart-product').on('change', '.quantity', function(event) {
        store_quantity_in_session();
        calcul_total_price();
    });

})

function store_quantity_in_session() {
    $.ajax({
            url: base_url + '/checkout_store_quantity_session',
            type: 'GET',
            dataType: 'json',
            data: $('#cart_form').serialize()
        })
        .done(function(data) {
            console.log(data);
        })
        .fail(function(xhr) {
            console.log(xhr.responseText);
        });
}

function calcul_total_price() {
    total_amount = 0.00;

    $('.real-price').each(function(index, el) {
        var quantity = $(this).parents('.cart-product').find('.quantity').val();
        var price = $(this).data('price');
        var amount = parseFloat(price);
        var total_peer_product = amount * parseInt(quantity);
        total_amount += total_peer_product;
    });
    total_amount = total_amount.round(2);
    $('.total_original_amount').html(fixed_two_after_dot(total_amount) + '<i class="fa fa-eur"></i>');

}

function fixed_two_after_dot(number) {
    var str = number.toString();
    tmp = str.split(".");
    if (tmp.length == 2) {
        if (tmp[1].length >= 2) {
            return str;
        }
        if (tmp[1].length == 1) {
            return tmp[0] + "." + tmp[1] + "0";
        }
        return tmp[0] + ".00";
    }
    return str + ".00";
}
