jQuery(document).ready(function () {
var $document = $(document);
var category_id = '';
if (jQuery('table.table').length > 0) {
    jQuery('table.table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": base_url+"admin/brand/get-data",
        "responsive"   : true,
        "bPaginate"    : true,
        "bLengthChange": true,
        "bFilter"      : true,
        "bInfo"        : true,
        "bAutoWidth"   : false,
        "order"        : [[3, "desc"]],
        "lengthMenu"   : [20, 40, 60, 80, 100],
        "pageLength"   : 20,
        language: {
                        paginate: {
                            first:    'Premier',
                            previous: 'Précédent',
                            next:      'Suivant',
                            last:     'Dernier'
                        },
                        "lengthMenu": "Afficher _MENU_ entrées",
                        "search": "Chercher:",
                        "processing": "En traitement ...",
                        "infoEmpty": "Aucune entrée à afficher",
                        "info": "Afficher la page _PAGE_ de _PAGES_"


        },
        columns        : [
            {data: 'brand_name', name:'brand_name', searchable: true, sortable: true},
            {data: 'website', name:'website', searchable: true, sortable: true},
            {data: 'created_at', name:'created_at',searchable: true, sortable: true},
            {data: 'created_by', name:'created_by',searchable: true, sortable: true},
            {data: 'website', name:'website', searchable: true, sortable: true},
            {data: 'created_at', name:'created_at',searchable: true, sortable: true},
            {data: 'created_by', xname:'created_by',searchable: true, sortable: true},
            {data: 'action', name:'action',searchable: false, sortable: false}
        ],
        fnDrawCallback : function () {
            var $paginate = this.siblings('.dataTables_paginate');

            if (this.api().data().length <= this.fnSettings()._iDisplayLength) {
                $paginate.hide();
            }
            else {
                $paginate.show();
            }
        }
    });
}

    $('#save-form').click(function () {
        $('#brand_form').validate({
            rules: {

            },
            invalidHandler: function (e, validator) {
                if (validator.errorList.length)
                    $('#myTab a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
            },
            errorPlacement: function (error, element) {
                var element_id = element.attr("id");
                if (element_id == "fileInput") {
                    return error.insertAfter(element.parent().parent().parent());
                }
                else if (element_id == "alphabet_letter") {
                    return error.insertAfter(element.next());
                }
                else {
                    return error.insertAfter(element);
                }
            }
        });
        if ($('#page_form').valid()) {
            $('#page_form').submit();
        }
    });

$(".request-brand").find(".brand-name").click(function(){
    var brand_name=$(this).data('name');
    var website=$(this).data('website');
    $document.find('.brand-name').val(brand_name);
    $document.find('.brand-website').val(website);
});

$document.on("click",'.remove_request_brand',function (e) {
    var element = $(this);
    var request_brand_id = element.attr('id');
    $.ajax({
        type: "GET",
        data: "",
        url: base_url + 'admin/remove-request-brand/'+request_brand_id,
        success: function (data) {
            element.parent('.brand-name').remove();
        }
    });
});

$document.on('keyup', ".auto-complete", function (e) {
        var element = $(this);
        if ($.trim($(this).val()) == null || $.trim($(this).val()) == "" || $.trim($(this).val()).length == 0) {
            return false;
        } else {
            $(this).autocomplete({
                minLength: 2,
                source: function (req, add) {
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
                        url: base_url + 'admin/get-brand-tag',
                        success: function (response) {
                            json_response_array = response['json_array'];
                            var suggestions = [];
                            var count = 0;
                            $.each(response, function (index, value) {
                                var suggestions_test = {};
                                if ($.trim(req.term) == value.tag_name) {
                                    count = 1;
                                }
                                suggestions_test.label = value.tag_name;
                                suggestions_test.value = value.brand_tag_id;
                                suggestions.push(suggestions_test);
                            });
                            var suggestions_test = {};
                            if (count == 0 && admin_role_id=='1') {
                                suggestions_test.label = "Add : " + $.trim(req.term);
                                suggestions_test.value = $.trim(req.term);
                                suggestions.push(suggestions_test);
                            }
                            add(suggestions);
                        }
                    });
                },
                open: function (event, ui) {
                    var m = 0;
                    $(this).removeClass("ui-autocomplete-loading");
                },
                focus: function (event, ui) {
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
                select: function (e, ui) {
                    var selected_item = ui.item;
                    if (selected_item.label.indexOf("Add : ") > -1) {
                        var selected_item_add = selected_item.label = selected_item.label.replace("Add : ", "");
                        $.ajax({
                            type: "POST",
                            data: "tag=" + selected_item_add+"&category_id="+category_id,
                            url: base_url + 'admin/save-brand-tag',
                            success: function (data) {
                                var brand_tag = element.parents('.tag-autocomplete').find('.brand_tag').val();
                                var tag_arr = (brand_tag!="") ? brand_tag.split(',') : [];
                                tag_arr.push(data.brand_tag_id);
                                element.parents('.tag-autocomplete').find('.brand_tag').val(tag_arr.join(','));
                                element.parent('li.search-input').before('<li class="search-choice" id="' + data.brand_tag_id + '"><span class="search-box-remove">×</span>' + selected_item.label + '</li>');

                                var tag_html = '<button type="button" id="' + data.brand_tag_id + '" class="btn btn-primary btn-sm brand-tag-btn">' + selected_item.label + '<span class="brand-tag-close">×</span> </button>';
                                $('#tag-container').append(tag_html);

                            }
                        });
                    } else {
                        var brand_tag = element.parents('.tag-autocomplete').find('.brand_tag').val();
                        var tag_arr = (brand_tag!="") ? brand_tag.split(',') : [];
                        tag_arr.push(selected_item.value);
                        element.parents('.tag-autocomplete').find('.brand_tag').val(tag_arr.join(','));
                        element.parent('li.search-input').before('<li class="search-choice" id="' + selected_item.value + '"><span class="search-box-remove">×</span>' + selected_item.label + '</li>');
                    }
                    element.val(null);
                },
                close: function () {
                    if ($(this).hasClass('single_autocomplete') && ($(this).prev('span.search-choice-text').length > 0)) {
                        $(this).attr('style', 'display:none');
                    }
                    $(this).val("");
                }
            });
        }
    });


    //add more sub brand click event
    $document.on('click','#add_more_sub_brand',function () {
        var cloned_html = $(this).parents('.sub-brand-container').clone();
        var index = parseInt($document.find('.sub-brand-container:last').attr('id'));
        var index = index + 1;
        cloned_html.attr('id',index);
        cloned_html.find('.sub_brand_name').attr('name',"sub_brand["+index+"]").val('');
        cloned_html.find('.sub_brand_id').remove();
        cloned_html.find('ul li').not('.search-input').remove();
        cloned_html.find('.brand_tag').val('').attr('name',"sub_brand_tag["+index+"]");
        cloned_html.find('.add-more-btn button').attr('id','remove_sub_brand').removeClass('btn-primary').addClass('btn-danger').text('Remove');
        $(cloned_html).insertAfter($document.find('.sub-brand-container:last'));
    });

    //remove sub brand click event
    $document.on('click','#remove_sub_brand',function () {
        $(this).parents('.sub-brand-container').remove();
    });


    $document.on("click",".search-box-remove",function () {
        var removable_tag = $(this).parent('li').attr('id');
        var brand_tag = $(this).parents('.tag-autocomplete').find('.brand_tag').val();
        var tag_arr = (brand_tag!="") ? brand_tag.split(',') : [];
        tag_arr.splice( $.inArray(removable_tag,tag_arr) ,1 );
        $(this).parents('.tag-autocomplete').find('.brand_tag').val(tag_arr.join(','));
        $(this).parent('li').remove();
    });


    $document.on('click','.brand-tag-close',function () {
        var $this = $(this);
        var removable_tag = $(this).parent('button').attr('id');
        $.ajax({
            type: "POST",
            data: "tag=" + removable_tag,
            url: base_url + 'admin/remove-brand-tag',
            success: function (data) {
                $document.find(".tag-autocomplete ul li").each(function () {
                    if($(this).attr('id')==removable_tag){
                        $(this).find('.search-box-remove').trigger('click');
                    }
                });
                $this.parent('button').remove();
            }
        });
    })

});