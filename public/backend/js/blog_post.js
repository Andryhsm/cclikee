jQuery(document).ready(function () {

    var $document = $(document);

    $('#add-blog-post').click(function () {

        $('#blog_post_form').validate({
            errorPlacement: function (error, element) {
                return error.insertAfter(element);
            }
        });
        if ($('#blog_post_form').valid()) {
            $('#blog_post_form').submit();
        }
    });

    if (jQuery('table.table').length > 0) {
        jQuery('table.table').DataTable({
            "responsive": true,
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "bAutoWidth": false,
            "order": [[3, "desc"]],
            "lengthMenu": [20, 40, 60, 80, 100],
            "pageLength": 20,
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
            columns: [
                {searchable: true, sortable: true},
                {searchable: true, sortable: false},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: false, sortable: false}
            ],
            fnDrawCallback: function () {
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

    if (jQuery('.dataTables_filter').length > 0) {
        jQuery('.dataTables_filter').find('input').addClass('form-control')
    }

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
                        url: base_url + 'admin/get-blog-tag',
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
                                suggestions_test.value = value.blog_tag_id;
                                suggestions.push(suggestions_test);
                            });
                            var suggestions_test = {};
                            if (count == 0) {
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
                            data: "tag=" + selected_item_add,
                            url: base_url + 'admin/save-blog-tag',
                            success: function (data) {
                                var blog_tag = element.parents('.tag-autocomplete').find('.blog_tag').val();
                                var tag_arr = (blog_tag != "") ? blog_tag.split(',') : [];
                                tag_arr.push(data.blog_tag_id);
                                element.parents('.tag-autocomplete').find('.blog_tag').val(tag_arr.join(','));
                                element.parent('li.search-input').before('<li class="search-choice" id="' + data.blog_tag_id + '"><span class="search-box-remove">×</span>' + selected_item.label + '</li>');
                            }
                        });
                    } else {
                        var blog_tag = element.parents('.tag-autocomplete').find('.blog_tag').val();
                        var tag_arr = (blog_tag != "") ? blog_tag.split(',') : [];
                        tag_arr.push(selected_item.value);
                        element.parents('.tag-autocomplete').find('.blog_tag').val(tag_arr.join(','));
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


    $document.on('keyup', ".related-post-input", function (e) {
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
                        url: base_url + 'admin/get-post',
                        success: function (response) {
                            json_response_array = response['json_array'];
                            var suggestions = [];
                            var count = 0;
                            $.each(response, function (index, value) {
                                var suggestions_test = {};
                                if ($.trim(req.term) == value.english_title) {
                                    count = 1;
                                }
                                suggestions_test.label = value.english_title;
                                suggestions_test.value = value.blog_post_id;
                                suggestions.push(suggestions_test);
                            });
                            var suggestions_test = {};
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
                    var html = `<p>`+selected_item.label+`
                            <span title="Delete" class="remove_post"><i class="fa fa-fw fa-trash-o"></i></span>
                            <input type="hidden" name="related_post[]" value="`+selected_item.value+`"></p>`;
                    $("#releated_post_container").append(html);
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


    $document.on("click", ".search-box-remove", function () {
        var removable_tag = $(this).parent('li').attr('id');
        var blog_tag = $(this).parents('.tag-autocomplete').find('.blog_tag').val();
        var tag_arr = (blog_tag != "") ? blog_tag.split(',') : [];
        tag_arr.splice($.inArray(removable_tag, tag_arr), 1);
        $(this).parents('.tag-autocomplete').find('.blog_tag').val(tag_arr.join(','));
        $(this).parent('li').remove();
    });

    $document.on('keyup keypress change', "#english_title", function (e) {
        var clone_text = $("#english_title").val();
        clone_text = $.trim(clone_text);
        clone_text = normalize_string(clone_text);
        clone_text = clone_text.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-').replace(/\_/g, '');
        $("#url_key").val(clone_text);
    });

    $document.on("click",".remove_post",function () {
        $(this).parents('p').remove();
    })
});
