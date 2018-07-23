$(".product-container").find(".category-drop").off("click");
$(".product-container").on('click', '.category-drop', function (event) {
    if ($(this).hasClass('fa-caret-up')) {
        $(this).removeClass('fa-caret-up');
        $(this).addClass('fa-caret-down');
    } else {
        $(this).addClass('fa-caret-up');
        $(this).removeClass('fa-caret-down');
    }
    $(this).parent().toggleClass('collapsed');
    $(this).next().toggleClass('in');
})

//------------ filter for checkbox ------------------//
$(".product-container").find(".filter").off("click");   
$(".product-container").on('click', '.filter', function (event) {
    event.preventDefault();
    if ($(this).parents('.category-filter').find('.selected').length > 0) {
        $(this).parents('.category-filter').find('a').removeClass('selected');
    }
    if ($(this).parents('.discount-filter').find('.selected').length > 0) {
        $(this).parents('.discount-filter').find('a').removeClass('selected');
    }
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
    } else {
        $(this).addClass('selected');
    }
    var filter_url = get_filter_url();
    apply_filter(filter_url);
});

//------------ select the active filter after loading page ------------------//
$(".product-container").find(".filter-size, .filter").each(function() {
    if($(this).hasClass('selected')){ 
        $(this).prop('checked', true);
        var parent_ = $(this).closest('.facet-content');
        if(parent_.hasClass('hide-filter')){    
            parent_.removeClass('hide-filter');
            parent_.prev().children('.title-filter').children().removeClass('fa-angle-right').addClass('fa-angle-down');
        }
    }
});
$(".product-container").on('change', '.filter-size', function (event) {
    if($(this).is(':checked')){
        if ($(this).hasClass('all-size')) {
            $(this).parents('.size-filter').find('a').removeClass('selected');
        } else if ($(this).parents().hasClass('size-filter')) {
            $(".all-size").removeClass('selected');
        }
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            $(this).addClass('selected');
        }
        var filter_url = get_filter_url();
        apply_filter(filter_url);
    }else{
        $(this).removeClass('selected');
        var filter_url = get_filter_url();
        apply_filter(filter_url);
    }
});

//Avoir le resultat du produit par page
function changeNumberProduct(){
    if ($(".product-container").parents('.category-filter').find('.selected').length > 0) {
        $(".product-container").parents('.category-filter').find('a').removeClass('selected');
    }
    if ($(".product-container").hasClass('all-size')) {
        $(".product-container").parents('.size-filter').find('a').removeClass('selected');
    } else if ($(".product-container").parents().hasClass('size-filter')) {
        $(".all-size").removeClass('selected');
    }
    if ($(".product-container").parents('.discount-filter').find('.selected').length > 0) {
        $(".product-container").parents('.discount-filter').find('a').removeClass('selected');
    }
    if ($(".product-container").hasClass('selected')) {
        $(".product-container").removeClass('selected');
    } else {
        $(".product-container").addClass('selected');
    }
    var filter_url = get_filter_url();
    apply_filter(filter_url);
}
    

function apply_filter(url) {
    $.ajax({
        type: 'get',
        url: url,
        beforeSend: function () {
            $.LoadingOverlay("show",{'size': "10%",'zIndex': 9999});
        },
        success: function (response, status) {
            $(".product-container").html($(response).find(".product-container").html())
            history.pushState(null, null, url);
            initializePriceSlider();
            category_selected();
            check_active_filter();
            $.LoadingOverlay("hide");
        }
    });
}

function get_filter_url() {
    var url = $(".category-url").data('url');
    var brands = [];
    var tags = [];
    var color = [];
    var size = [];
    size['attrs'] = [];

    $(".brands-filter").find(".selected").each(function () {
        brands.push($.trim($(this).data('id')));
    });
    $(".tags-filter").find(".selected").each(function () {
        tags.push($.trim($(this).data('id')));
    });
    $(".color-filter").find(".selected").each(function () {
        color.push($.trim($(this).data('id')));
    });
    $(".size-filter").find(".selected").each(function () {
        var attribute_id = $.trim($(this).data('attribute_id'));
        var attribute_option_id = $.trim($(this).data('id'));
        if(typeof size['attrs'][attribute_id]==='undefined'){
            size['attrs'][attribute_id] = [];
        }
        size['attrs'][attribute_id].push(attribute_option_id);
    });
    var category = $.trim(($(".category-filter").find(".selected").data('id')));
    var discount = $.trim(($(".discount-filter").find(".selected").data('id')));
    if (brands.length > 0) {
        url += "&brand=" + brands.toString();
    }
    if (tags.length > 0) {
        url += "&tag=" + tags.toString();
    }
    if (color.length > 0) {
        url += "&color=" + color.toString();
    }
    var attrs = [];
    var query_string = '';
    if (size.attrs.length > 0) {
        $.each(size['attrs'], function (key,val) {
            if(typeof val!='undefined'){
                attrs[key] = val.toString();
                query_string+='&attrs['+key+']='+val.toString();
            }
        });
    }

    url += query_string;

    if (category) {
        url += "&category=" + category;
    }

    if (discount) {
        url += "&discount=" + discount;
    }
    var start_price = $(".start-price").val();
    var end_price = $(".end-price").val();
    if (start_price > 0 && end_price > 0) {
        url += "&start_price=" + start_price + '&end_price=' + end_price;
    }
    url += "&nb="+$("#nb").val();                         //Associer le filtre par pagination 
    return url;
}

function price_filter(start_price, end_price) {
    $(".start-price").val(start_price);
    $(".end-price").val(end_price);
    var filter_url = get_filter_url();
    apply_filter(filter_url);
}

function initializePriceSlider() {
    var start_price = ($(".start-price").val() > 0) ? $(".start-price").val() : 30;
    var end_price = ($(".end-price").val() > 0) ? $(".end-price").val() : 470;
    $("#amount").val("$" + start_price +
        " - $" + end_price);
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 500,
        values: [start_price, end_price],
        slide: function (event, ui) {
        },
        change: function (e, ui) {
            price_filter(ui.values[0], ui.values[1])
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });

    $('#cate-toggle li.has-sub').on('click', function () {
        $(this).find('a').removeAttr('href');
        var $that = $(this).find('a');
        var element = $that.parent('li');
        if (element.hasClass('open')) {
            element.removeClass('open');
            element.find('li').removeClass('open');
            element.find('ul').slideUp();
        } else if ($that.next().hasClass('category-sub')) {
            element.addClass('open');
            element.children('ul').slideDown();
        }
    });
}
category_selected();
function category_selected(){
    var category_filter=$('.category-filter');
    var selected_filter=$(category_filter).find('.selected');
    if ($(selected_filter)) {
        $(selected_filter).parents('.list-group-submenu').addClass('in');
        $(selected_filter).parent().addClass('in');
    }
}

//Voir et cacher les contenues des filtres
$(".product-container").find(".facet-title").off('click');
$(".product-container").on('click', '.facet-title', function(event){
    event.preventDefault();
    var current = $(this).next();
    if(current.hasClass('hide-filter')){
        current.show(300);  
        current.removeClass('hide-filter');
        $(this).find('.fa').removeClass('fa-angle-right').addClass('fa-angle-down');
    }else{
        current.hide(300);
        current.addClass('hide-filter');
        $(this).find('.fa').removeClass('fa-angle-down').addClass('fa-caret-right');
        
    }
});     
//------------ select the active filter after loading ajax ------------------//
function check_active_filter(){
    $(".product-container").find(".filter-size, .filter").each(function() {
        if($(this).hasClass('selected')){ 
            $(this).prop('checked', true);
            var parent_ = $(this).closest('.facet-content');
            if(parent_.hasClass('hide-filter')){    
                parent_.removeClass('hide-filter');
                parent_.prev().children('.title-filter').children().removeClass('fa-angle-right').addClass('fa-angle-down');
            }
        }
    });
}


