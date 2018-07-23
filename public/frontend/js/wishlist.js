/*wishlist add*/
function addwishlist(idP, idU, elt) {
    var $this = $(elt);
    var w_class = '.w' + idP;
    var wG_class = '.wG' + idP;
    /*var url = 'wishlist/' + id_product;*/
    if ($(wG_class).hasClass('coeur_gm') || $(w_class).hasClass('coeur_pm')) {
        //var urlid = base_url + 'wishlist/findid/' + idP + '§' + idU;
        var urlid = $this.data('url-find-wishlist') + '/' + idP + '§' + idU;
        
        /*var urlid = 'wishlist/findid/' + idP +'§'+ idU;*/
        /*si local*/

        $.ajax({
            type: 'GET',
            url: urlid,
            data: "",
            beforeSend: function() {
                $.LoadingOverlay("show", { 'size': "10%", 'zIndex': 9999 });
            },
            success: function(response, status) {
                //var urld = base_url +  'wishlist/remove/' + response[1];
                var urld = $this.data('url-remove-wishlist') + '/' + response[1];
        
                /*si local*/
                $.ajax({
                    type: 'GET',
                    url: urld,
                    data: "",
                    beforeSend: function() {
                        $.LoadingOverlay("show", { 'size': "10%", 'zIndex': 9999 });
                    },
                    success: function(response, status) {

                        $(w_class).removeClass('coeur_pm');
                        $(wG_class).removeClass('coeur_gm');
                        /*$(".img_wishlist").attr("src",base_url + 'images/coeur_orange_pleine.svg');*/
                        $(".icon-heart").css('background-position-y', '-36px');
                        $('.sell_coeur').html(response[1]);
                        $.LoadingOverlay("hide");
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                });

                $.LoadingOverlay("hide");
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            },
        });

    }
    else {
        //var url = base_url +  'wishlist/' + idP;
        var url = $this.data('url-add-wishlist');
        /*var url = 'wishlist/' + idP;*/
        /*si local*/
        $.ajax({
            type: 'GET',
            url: url,
            data: "",
            beforeSend: function() {
                $.LoadingOverlay("show", { 'size': "10%", 'zIndex': 9999 });
            },
            success: function(response, status) {
                console.log(response[1]);
                $(w_class).addClass('coeur_pm');
                $(wG_class).addClass('coeur_gm');
                $(".icon-heart").css('background-position-y', '-36px');

                $('.sell_coeur').html(response[1]);
                $.LoadingOverlay("hide");
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            },
        });
    }

}

/*end wishlist add*/
