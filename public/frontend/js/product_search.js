$(function () {
    $.fn.productSearch = function () {
        var product_listing=$(".product-listing-container");
        $(product_listing).find("#sorting").off("change");
        $(product_listing).find("#sorting").on("change", function (e) {
            var sort_by = $(this).val();
            var search_keyword = $(".search-keyword").val();
            var url = base_url + '/' + 'product-sorting'
            var data = $("#product_sorting_form").serialize() + '&keyword=' + search_keyword + '&sort_by=' + sort_by;
            $.ajax({
                type: 'post',
                url: url,
                data: data,
                beforeSend: function () {
                    $.LoadingOverlay("show", {'size': "10%", 'zIndex': 9999});
                },
                success: function (response, status) {
                    $(".product-listing").html($(response).find('.product-listing').html());
                    $.LoadingOverlay("hide");

                }
            });
        });
        $('table tbody').sortable({
            helper: fixWidthHelper,
            stop: function (event, ui) {
                var url = base_url + '/' + 'remove-product'
                var search_keyword = $(".search-keyword").val();
                var order = $("#product_sorting_form").serialize() + '&keyword=' + search_keyword;
                $.ajax({
                    type: 'post',
                    url: url,
                    data: order,
                    beforeSend: function () {
                        $.LoadingOverlay("show", {'size': "10%", 'zIndex': 9999});
                    },
                    success: function (response, status) {
                        $.LoadingOverlay("hide");
                    }
                });
            }
        }).disableSelection();

        function fixWidthHelper(e, ui) {
            ui.children().each(function () {
                $(this).width($(this).width());
            });
            return ui;
        }

        $(".product-area").find(".remove-product").off("click");
        $(".product-area").on('click', '.remove-product', function (event) {
            var type = $(this).data('type');
            var key = $(this).data('key');
            var url = base_url + '/' + 'remove-product'
            var data = $("#product_sorting_form").serialize();
            $(this).parents('tr').remove();
            $.ajax({
                type: 'post',
                url: url,
                data: data,
                beforeSend: function () {
                    $.LoadingOverlay("show", {'size': "10%", 'zIndex': 9999});
                },
                success: function (response, status) {
                    $.LoadingOverlay("hide");
                }
            });
        });
    }
});
