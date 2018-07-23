var map;

function start_map($shop_data) {
    var shop_lat = $shop_data.data('latitude');
    var shop_lng = $shop_data.data('longitude');
    var shop_name = $shop_data.data('store_name');
    var shop_short_description = $shop_data.data('short_description');
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: shop_lat, lng: shop_lng },
        zoom: 8
    });
    var store_position = { lat: shop_lat, lng: shop_lng };
    var info_shop = '<div class="info-customer">';
    info_shop += '<div class="row" style="margin:0;">';
    info_shop += '<div class="content-info">';
    info_shop += '<span>Nom du magasin : </span><strong>' + shop_name + '</strong><br>';
    info_shop += '<span>Description : </span><strong>' + shop_short_description + '</strong>';
    info_shop += '</div>';
    info_shop += '</div>';
    info_shop += '</div>';
    var infoWindow = new google.maps.InfoWindow({
        content: info_shop
    });
    var marker = new google.maps.Marker({
        position: store_position,
        map: map
    });
    marker.addListener('click', function() {
        infoWindow.open(map, marker);
    });

    $('.show-shop').click(function(event) {
        event.preventDefault();
        var lat = parseFloat($(this).data('latitude'));
        var lng = parseFloat($(this).data('longitude'));
        map.setCenter(new google.maps.LatLng(lat, lng));
    });
}

jQuery(document).ready(function($) {
    change_header_title();
    aside_fixed();
    // $('.nav-menu .list-menu').on('click', '.nav-link', function(event) {
    //     var content = $(this).attr('id')
    //     event.preventDefault();
    //     var menu_active = $('.nav-menu .list-menu').find('.active');
    //     menu_active.removeClass('active');
    //     $(this).addClass('active');
    //     var url = $(this).data('url');
    //     change_header_title();
    //     change_page(url);
    //     customer_aside_fixed();
    // });

    $('.datepicker').datepicker({
        todayHighlight: true
    });


    changeGender();
    changeDateFormat();

});

function reception(box) {
    var $icon = $(box).find("i");
    var $map = $(box).parents('.order').find('.content-map');
    var $shop_data = $(box).parents('.order').find('.shop-data');

    if ($icon.hasClass('fa-angle-up')) {
        // Close Other open map
        $('.order').each(function(index, order) {
            if ($(order).find('fa-angle-down')) {
                $(order).find('.shop').fadeOut('slow');
                $(order).find('#map').remove();
                $(order).find('.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-up');
            }
        });
        $icon.removeClass('fa-angle-up').addClass('fa-angle-down');
        $(box).closest('.order').find('.shop').show("slow");
        // Add map element
        $map.html('<div id="map"></div>');
        start_map($shop_data);
        get_distance_store($shop_data);
    }
    else {
        $icon.removeClass('fa-angle-down').addClass('fa-angle-up');
        $(box).parents('.order').find('.shop').fadeOut("slow");
        // Remove map element
        $(box).parents('.order').find('#map').remove();
        $map.html();
    }

};

function get_distance_store($shop_data) {
    var url = $shop_data.data('url');
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: { latitude: $shop_data.data('latitude'), longitude: $shop_data.data('longitude'), country: $shop_data.data('country') },
        })
        .done(function(data) {
            $('.store-distance').html('À ' + data.distance + ' km de chez vous');
        })
        .fail(function(xhr) {})
        .always(function() {

        });
}

function activate(ids) {
    var id = $(ids).attr("id");
    $('.panel-default').removeClass('actives');
    $('#' + id).addClass('actives');
}

function changeGender() {
    var gender = $("#gender").val();
    $(".gender#" + gender).trigger('click');
}


function simulateRadioButton(box) {
    var id = $(box).attr("id");
    checka(box);
    if (id == "Femme") {
        $('#Homme i').removeClass('fa-dot-circle-o');
        $('#Homme i').addClass('fa-circle-o');
    }
    else {
        $('#Femme i').removeClass('fa-dot-circle-o');
        $('#Femme i').addClass('fa-circle-o');
    }
}

function changeDateFormat() {
    if ($('#birthday').val() != null) {
        var date = $('#birthday').val().split('-');
        var birthday = "" + date[2] + "-" + date[1] + "-" + date[0];
        $('#birthday').val(birthday);
    }
}
/*$('.nav-menu .list-menu').on('click', '.nav-link', function(event) {
    event.preventDefault();
    var menu_active = $('.nav-menu .list-menu').find('.active');
    menu_active.removeClass('active');
    $(this).addClass('active');
    var url = $(this).data('url');
    change_header_title();
    change_page(url);
});*/



function change_header_title() {
    var menu_active = $('.nav-menu .list-menu').find('.active');
    var src_active = menu_active.children('img').attr('src');
    var text_active = menu_active.children('span').html();
    $('.title-active').find('img').attr('src', src_active);
    $('.title-active').find('.text-title-active').html(text_active);
}


function change_page(url) {

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        beforeSend: function() {
            $.LoadingOverlay("show", { 'size': "10%", 'zIndex': 9999 });

        },
        success: function(response, status) {
            // console.log($(response).find(".ajax-content").html());
            $(".ajax-content").html($(response).find(".ajax-content").html());
            history.pushState(null, null, url);
            $.LoadingOverlay("hide");
            changeGender();
            changeDateFormat();
            setTimeout(aside_fixed, '1000');
            $('.datepicker').datepicker({
                todayHighlight: true
            });
        },
        error: function(xhr, status, error) {}
    });
}

function checka(box) {
    var id = $(box).attr("id");
    if ($('#' + id + ' i').hasClass('fa-circle-o')) {
        $('#' + id + ' i').removeClass('fa-circle-o');
        $('#' + id + ' i').addClass('fa-dot-circle-o');
    }
    else {
        $('#' + id + ' i').removeClass('fa-dot-circle-o');
        $('#' + id + ' i').addClass('fa-circle-o');
    }
}

function iconeyes(icon) {
    var check_id = $(icon).attr("id");
    if ($('#' + check_id).hasClass('fa-eye')) {
        $('#' + check_id).removeClass('fa-eye');
        $('#' + check_id).addClass('fa-eye-slash');
    }
    else {
        $('#' + check_id).removeClass('fa-eye-slash');
        $('#' + check_id).addClass('fa-eye');
    }
    $("#-" + check_id).trigger("click");
}

function togglePassword(pass) {
    var password_id = $(pass).attr("id");
    if ($('#' + password_id).is(':checked')) {
        $("#password" + password_id).attr("type", "text");

        $("#toggleText").text("Hide");
    }
    else {
        $("#password" + password_id).attr("type", "password");

        $("#toggleText").text("Show");
    }
}

function changepassword() {
    var old = $('#password-old').val();
    var news = $('#password-new').val();
    url = $('#form-update-password').attr('action');
    $.ajax({
            url: url,
            type: 'POST',
            data: { old_password: old, new_password: news },
        })
        .done(function(datas) {
            if (datas.success) {
                toastr.success(datas.message);
            }
            else {
                toastr.error(datas.message);
            }
        })
        .fail(function(xhr) {
            console.log(xhr.responseText);
        });
}

function updateCustomerInfo() {
    var form_customer = $('#customer-form');
    form_customer.validate({
        rules: {
            last_name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            }
        }
    });
    if (form_customer.valid()) {
        $data = form_customer.serialize();
        var url = $('#customer-form').attr('action');
        $.ajax({
                url: url,
                type: 'POST',
                data: $data
            })
            .done(function(response) {
                if (response.success) {
                    toastr.success(response.message);
                }
                else {
                    toastr.error(response.message);
                }
            });
    }

}

function waiting_order(classe) {
    var $this = $(classe);
    var cle = $(classe).attr("id");
    var url = $this.data('url');
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
        })
        .done(function(data) {
            $(classe).closest(".order-form").html("<div> <a href = \"current-coupon/" + cle + "\" class = 'Coupon btn btn-customer-filled pull-right'> Coupon à présenter </a> </div> <div><button class='Reception btn btn-customer-filled pull-right' type='button' onclick='reception(this);'> <span>Réception</span><i class='fa fa-angle-up'></i></button> </div>");
            toastr.success(data.message);
        })
        .fail(function(xhr) {})
        .always(function() {

        });
}

function canceled_order(classe) {
    var $this = $(classe);
    var url = $this.data('url');
    
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
        })
        .done(function(data) {
            $(classe).closest(".ajax-content").remove();
            toastr.success(data.message);
        })
        .fail(function(xhr) {})
        .always(function() {

        });
}
