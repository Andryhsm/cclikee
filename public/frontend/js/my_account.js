$(function() {
    $.fn.customerProfile = function(options) {

        if (options.role_id == '1') {
            getAjaxData('completed-orders-content', base_url + language_code + '/customer/order/completed?page=1');
            getAjaxData('pending-orders-content', base_url + language_code + '/customer/order/pending?page=1');
        }
        else {
            getAjaxData('merchant-orders-content', base_url + language_code + '/merchant/orders?page=1');
            getAjaxData('store-content', base_url + language_code + '/merchant/stores?page=1');
            getAjaxData('merchant-invoice-content', base_url + language_code + '/merchant/invoices?page=1');
        }
        // getAjaxData('merchant-pending-orders-content', base_url + 'customer/order/merchant-pending-orders?page=1');
        $('.my-acccount-container').on('click', '.pager a', function(event) {
            getAjaxData($(this).parents('.content').attr('id'), $(this).attr('href'));
            event.preventDefault();
        });

        function getAjaxData(container, url) {
            $.ajax({
                type: "GET",
                url: url,
                beforeSend: function() {
                    $("#" + container).html($('#my-account').find('.account-loading').html());
                },
                success: function(msg) {
                    $("#" + container).html(msg);
                }
            });
            return false;
        }

        $(document).off('click ', '#updateUserInfo');
        $(document).on('click ', '#updateUserInfo', function(e) {
            var form = $("#userForm");
            if (form.valid()) {
                form.submit();
            }
            e.preventDefault();
        });

        $(document).off('click ', '#updatePassword');
        $(document).on('click ', '#updatePassword', function(e) {
            var form = $("#userPassword");
            if (form.valid()) {
                form.submit();
            }
            e.preventDefault();
        });

        var $form = $('#card_form');
        $form.submit(function(event) {
            // Disable the submit button to prevent repeated clicks:
            $form.find('.submit').prop('disabled', true);

            // Request a token from Stripe and function to handle response
            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from being submitted:
            return false;
        });


        function stripeResponseHandler(status, response) {
            // Grab the form:
            var $form = $('#card_form');
            if (response.error) { // Problem!
                $form.find('.payment-errors').text(response.error.message);
                $form.find('.submit').prop('disabled', false); // Re-enable submission
            }
            else { // Token was created!
                // Get the token ID:
                var token = response.id;
                // Insert the token ID into the form so it gets submitted to the server:
                $form.append($('<input type="hidden" name="stripeToken">').val(token));
                // Submit the form:
                $form.get(0).submit();
            }
        };
    }
    //$(".open-time").prop('disabled', true);
    // $('.open-time').datetimepicker({
    //     format: 'HH:mm',
    //     icons: {
    //         time: 'fa fa-time',
    //         date: 'fa fa-calendar',
    //         up: 'fa fa-chevron-up',
    //         down: 'fa fa-chevron-down',
    //         previous: 'fa fa-backward',
    //         next: 'fa fa-chevron-right',
    //         today: 'fa fa-screenshot',
    //         clear: 'fa fa-trash',
    //         close: 'fa fa-remove'
    //     }
    // });
    $('.account-area').on('click', '.open-day', function(event) {
        event.preventDefault();
        console.log("active value");
        var $inputs = $(this).parents('.info-one-day').find('.open-time');
        var $icon = $(this).find('i');
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $icon.removeClass('fa-check-square');
            $icon.addClass('fa-square-o');
            $inputs.prop('disabled', true);
            $inputs.val(null);
        }
        else {
            $(this).addClass('active');
            $inputs.prop('disabled', false);
            $icon.removeClass('fa-square-o');
            $icon.addClass('fa-check-square');
        }
    });


});
