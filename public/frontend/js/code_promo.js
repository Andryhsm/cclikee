jQuery(document).ready(function() {
    var $document = $(document);
    $document.on('keyup', ".product-auto-complete", function(e) {
        var element = $(this);
        if ($.trim($(this).val()) == null || $.trim($(this).val()) == "" || $.trim($(this).val()).length == 0) {
            return false;
        }
        else {
            $(this).autocomplete({
                minLength: 2,
                source: function(req, add) {
                    if ($.trim(req.term) == "") {
                        element.autocomplete("destroy");
                        element.removeClass('ui-autocomplete-loading');
                        return false;
                    }
                    $.ajax({
                        dataType: 'json',
                        type: 'POST',
                        data: ({
                            datastring: $.trim(req.term),
                        }),
                        url: base_url + 'marchand/get-product',
                        success: function(response) {
                            json_response_array = response['json_array'];
                            var suggestions = [];
                            var count = 0;
                            $.each(response, function(index, value) {
                                var suggestions_test = {};
                                if ($.trim(req.term) == value.product_name) {
                                    count = 1;
                                }
                                /*console.log(value.product_name);*/
                                suggestions_test.label = value.product_name;
                                suggestions_test.value = value.product_id;
                                suggestions.push(suggestions_test);
                            });
                            var suggestions_test = {};
                            /*   if (count == 0) {
                                   suggestions_test.label = "Add : " + $.trim(req.term);
                                   suggestions_test.value = $.trim(req.term);
                                   suggestions.push(suggestions_test);
                               }*/
                            add(suggestions);
                        }
                    });
                },
                open: function(event, ui) {
                    var m = 0;
                    $(this).removeClass("ui-autocomplete-loading");
                },
                focus: function(event, ui) {
                    var selected_item = ui.item.label;
                    if (selected_item.indexOf("Add : ") > -1) {
                        selected_item = selected_item.replace("Add : ", "");
                    }
                    if (selected_item.indexOf("No result found") > -1) {
                        $(this).autocomplete("close");
                        $(this).removeClass("ui-autocomplete-loading");
                        selected_item = "";
                        return false;
                    }
                    element.val(selected_item);
                    return false;
                },
                select: function(e, ui) {
                    var selected_item = ui.item;
                    /* if (selected_item.label.indexOf("Add : ") > -1) {
                         var selected_item_add = selected_item.label = selected_item.label.replace("Add : ", "");
                         $.ajax({
                             type: "POST",
                             data: "category_name=" + selected_item_add,
                             url: base_url + 'admin/save-brand-category',
                             success: function (data) {
                                 var brand_category = $document.find('#category').val();
                                 var category_arr = (brand_category!="") ? brand_category.split(',') : [];
                                 category_arr.push(data.brand_category_id);
                                 $document.find('#category').val(category_arr.join(','));
                                 element.parent('li.search-input').before('<li class="search-choice" id="' + selected_item.value + '"><span class="search-box-remove">×</span>' + selected_item.label + '</li>');
                             }
                         });
                     } else {*/
                    var product_val = $document.find('#product').val();
                    var category_arr = (product_val != "") ? product_val.split(',') : [];
                    category_arr.push(selected_item.value);
                    $document.find('#product').val(category_arr.join(','));
                    element.parent('li.search-input').before('<li class="search-choice" id="' + selected_item.value + '"><span class="search-box-remove">×</span>' + selected_item.label + '</li>');
                    //  }
                    element.val(null);
                },
                close: function() {
                    if ($(this).hasClass('single_autocomplete') && ($(this).prev('span.search-choice-text').length > 0)) {
                        $(this).attr('style', 'display:none');
                    }
                    $(this).val("");
                }
            });
        }

    });



    $document.on("click", ".active-brand", function() {
        $(".category-autocomplete").toggleClass('hidden');
    });
    $document.on("click", ".search-box-remove", function() {
        var removable_tag = $(this).parent('li').attr('id');
        var product_tag = $document.find('#product').val();
        var tag_arr = (product_tag != "") ? product_tag.split(',') : [];
        tag_arr.splice($.inArray(removable_tag, tag_arr), 1);
        $document.find('#product').val(tag_arr.join(','));
        $(this).parent('li').remove();
    });
});
