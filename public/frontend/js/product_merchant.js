jQuery(document).ready(function() {

    var $document = $(document);
    $('#add-product').click(function(e) {

        $('#product_form').validate({
            rules: {},
            invalidHandler: function(e, validator) {
                if (validator.errorList.length)
                    $('#myTab a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
            },
            errorPlacement: function(error, element) {
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
        if ($('#product_form').valid()) {

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            e.preventDefault();
            $('#product_form').ajaxSubmit(function(data) {
                location.href = url_redirect;
            });

            //$('#product_form').submit();
        }
    });


    if (jQuery('#product_list').length > 0) {
        jQuery('#product_list').on('xhr.dt', function(e, settings, json, xhr) {
                //console.log(xhr.responseText);
            })
            .DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": url_get_data_product,
                "responsive": true,
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                "order": [
                    [6, "desc"]
                ],
                "lengthMenu": [20, 40, 60, 80, 100],
                "pageLength": 20,
                language: {
                    paginate: {
                        first: 'Premier',
                        previous: 'Précédent',
                        next: 'Suivant',
                        last: 'Dernier'
                    },
                    "lengthMenu": "Afficher _MENU_ entrées",
                    "search": "Chercher:",
                    "processing": "En traitement ...",
                    "infoEmpty": "Aucune entrée à afficher",
                    "info": "Afficher la page _PAGE_ de _PAGES_"


                },
                columns: [
                    { data: 'product_name', name: 'product_name', searchable: true, sortable: true },
                    { data: 'serial_number', name: 'serial_number', searchable: true, sortable: true }, { data: 'original_price', name: 'original_price', searchable: true, sortable: true, visible: false },
                    /*{ data: 'created_by', name: 'created_by', searchable: false, sortable: true },*/
                    { data: 'brand', name: 'brand', searchable: true, sortable: true },
                    { data: 'created_at', name: 'created_at', searchable: false, sortable: true, visible: false },
                    /*{ data: 'modified_by', name: 'modified_by', searchable: false, sortable: true, visible: false }, { data: 'modified_at', name: 'modified_at', searchable: false, sortable: true, visible: false },*/
                    { data: 'status', name: 'status', searchable: true, sortable: true },
                    { data: 'action', name: 'action', searchable: false, sortable: false }
                ],
                fnDrawCallback: function() {
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

    $('.product-image-id').click(function() {
        var img_div = $(this).parent().parent();
        var image_id = $(this).attr('data-id');
        $('#confirm').modal({ backdrop: 'static', keyboard: false })
            .one('click', '#delete', function() {
                $.ajax({
                    method: 'post',
                    data: { image_id: image_id },
                    url: url_remove_image,
                    success: function(data) {
                        if (data.success) {
                            img_div.remove();
                        }
                        $.show_notification(data.message)
                        setTimeout(function() {
                            $('.notification_area').fadeOut('slow');
                        }, 3000);
                    }
                })
            });
    });







    /*
        if ($("#product_media").length > 0) {
            Dropzone.autoDiscover = false;

            var myDropzone = new Dropzone("#product_media", {
                autoProcessQueue: true,
                parallelUploads:1,
                url: base_url + "marchand/produit/upload",
                addRemoveLinks: true,
                acceptedFiles: 'image/!*',
                init: function () {
                    var myDropzone = this;
                    this.on("removedfile", function (file) {
                        $.ajax({
                            type: "POST",
                            url: base_url + 'admin/remove-product-image',
                            data: "image_name=" + file.name,
                            beforeSend: function () {
                            },
                            complete: function (response) {
                            }
                        });
                        $.post("delete-file.php?id=" + file.serverId);

                    });
                    if (typeof product_images != 'undefined') {
                        var images = $.parseJSON(product_images);
                        $.each(images, function (key, value) {
                            var mockFile = {name: value.name, size: value.size};
                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("thumbnail", mockFile, base_url + "upload/produit/" + value.name);
                            myDropzone.createThumbnailFromUrl(mockFile, base_url + "upload/produit/" + value.name, function () {
                                myDropzone.emit("complete", mockFile);
                            });
                        });
                    }
                }
            });
        }
    */
    
    console.log("ici pas de bug "); 
    $document.on('keyup keypress change', "#en_product_name", function(e) {
        console.log("Nous devons faire une autocompletion ");
        var clone_text = $("#fr_product_name").val();
        clone_text = $.trim(clone_text);
        clone_text = normalize_string(clone_text);
        clone_text = clone_text.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-').replace(/\_/g, '');
        $("#product_url").val(clone_text);
    });



    $('[data-toggle="tabajax"]').click(function(e) {
        var selected_attribute_set_id = $document.find('#attribute_set_ :selected').val();
        var old_attribute_set_id = $document.find("input[name='old_attribute_set_id']").val();
        var product_id = $document.find("input[name='product_id']").val();

        var $this = $(this),
            loadurl = $this.attr('href'),
            targ = $this.attr('data-target');
        if (selected_attribute_set_id != old_attribute_set_id || old_attribute_set_id == '') {
            $.ajax({
                type: "GET",
                url: loadurl,
                data: "attribute_set_id=" + selected_attribute_set_id + "&product_id=" + product_id,
                complete: function(data) {
                    $(targ).html(data.responseText);
                    $document.find(".select2").select2();
                    $document.find("input[name='old_attribute_set_id']").val(selected_attribute_set_id)
                },
                success: function(data) {
                   // console.log("data in succes : " + data);
                },
                error: function(xhr) {
                    //console.log(xhr.responseText);
                }
            });

        }
        $this.tab('show');
        return false;
    });

    jQuery.fn.extend({
        propAttr: $.fn.prop || $.fn.attr
    });

    if ($("#category").length > 0) {
        var selected_categories = $.parseJSON(selected_category);
        $("#category").dynatree({
            checkbox: true,
            selectMode: 2,
            children: $.parseJSON(category_tree_data),
            onSelect: function(select, node) {
                // Display list of selected nodes
                var selNodes = node.tree.getSelectedNodes();
                var selected_category = $.map(selNodes, function(node) {
                    return node.data.key;
                });
                $("#category_id").val(selected_category.join(", "));
            },
            onClick: function(node, event) {
                // We should not toggle, if target was "checkbox", because this
                // would result in double-toggle (i.e. no toggle)
                if (node.getEventTargetType(event) == "title")
                    node.toggleSelect();
            },
            onKeydown: function(node, event) {
                if (event.which == 32) {
                    node.toggleSelect();
                    return false;
                }
            }
        });
        $("#category").dynatree("getRoot").visit(function(node) {
            node.expand(false);
        });
        console.log(selected_categories);
        $("#category").dynatree("getRoot").visit(function(node) {
            if ($.inArray(parseInt(node.data.key), selected_categories) !== -1) {
                node.select(true);
            }
        });
    }

    $document.on("click", ".search-box-remove", function() {
        var removable_tag = $(this).parent('li').attr('id');
        var product_tag = $document.find('#product_tag').val();
        var tag_arr = (product_tag != "") ? product_tag.split(',') : [];
        tag_arr.splice($.inArray(removable_tag, tag_arr), 1);
        $document.find('#product_tag').val(tag_arr.join(','));
        $(this).parent('li').remove();
    });

    $document.on('click', '.add_option', function() {
        var row_count = parseInt($('.option_row:last').attr('id'));
        var row_index = row_count + 1;
        var input_type = $document.find('#input_type :selected').val();
        var html_data = $document.find('.master-option-container').clone();
        html_data.removeClass('master-option-container hidden').prop('id', row_index);
        html_data.find('.option_name input').attr('name', 'videos[' + row_index + '][name]');
        console.log($(html_data).html());
        if (input_type == 1) {
            html_data.find('.option_value').remove();
            html_data.find('.color_picker').removeClass('hidden');
            html_data.find('.color_picker input').attr('name', 'videos[' + row_index + '][value]');
        }
        else {
            html_data.find('.color_picker').remove();
            html_data.find('.option_value input').attr('name', 'videos[' + row_index + '][value]');
        }
        // html_data.find('.option_value input').attr('name','attribute[option_value]['+row_index+']');
        html_data.find('.button :button').removeClass('btn-primary add_option').addClass('btn-danger remove_option').text('Remove Option');
        $(html_data).hide().appendTo("#tab_4").animate({
            height: 'toggle'
        }, 500);
    });

    $document.on('click', '.remove_option', function() {
        $(this).parents('.form-group').remove();
    });


    if ($("#uploader").length > 0) {
        $("#uploader").pluploadQueue({
            // General settings
            runtimes: 'html5,flash,silverlight,html4',
            url: url_upload_image,
            rename: true,
            dragdrop: true,

            filters: {
                // Maximum file size
                max_file_size: '10mb',
                // Specify what files to browse for
                mime_types: [
                    { title: "Image files", extensions: "jpg,gif,png" },
                ]
            },

            flash_swf_url: '../../js/Moxie.swf',
            silverlight_xap_url: '../../js/Moxie.xap',
            multiple_queues: true,  
            init: {
                FilesAdded: function(up, file) {},
                FileUploaded: function(up, file, info) {
                    console.log("fdujlrerere");
                    var return_data = $.parseJSON(info.response);
                    console.log(return_data);
                    if (return_data.success) {
                        var image_url = base_url + "upload/product/" + return_data.image_name;
                        var html = `<tr>
                                                            <td><img src=` + image_url + ` width="100" height="100"></td>
                                                            <td>
                                                                <input type="text" name="image_title[]" value="" class="" style="width: 100%">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="image_alt[]" value="" class="" style="width: 100%">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="image_sort_order[]" value="" class="" style="width: 100%">
                                                            </td>
                                                            <td>
                                                                <a href="javascript://" class="btn delete-image btn-default btn-sm" title="Delete" data-product_image_id="" data-image_name="` + return_data.image_name + `"><i class="fa fa-fw fa-trash"></i></a>
                                                            </td>
                                                        </tr>

                                    `;

                        $("#image_list").find('tbody').append(html);

                    }
                },
                FilesRemoved: function(up, files) {},
                UploadComplete: function() {},
                Error: function(up, error) {
                    console.log("A error is passing");
                    console.log(error.response);
                }
            },
        });
    }

    $document.on('click', '.delete-image', function() {
        var tr = $(this).parents('tr');
        var data = $(this).data();
        $.ajax({
            type: "GET",
            url: url_remove_image,
            data: "image_name=" + data.image_name + "&product_image_id=" + data.product_image_id,
            beforeSend: function() {},
            complete: function(response) {
                console.log(response);
                tr.remove();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });

    });

    $("#product-search-btn").click(function(e) {
        e.preventDefault();
        var keyword = $('#product-search').val();
        var type = $(this).data('type');
        $.ajax({
            type: "POST",
            url: url_search_product,
            data: { 'keyword': keyword },
            beforeSend: function() {
                $.show_notification();
            },
            success: function(msg) {
                if (type == 'add') {
                    $(".table-body").html($(msg).find(".product-list").html());
                }
                else {
                    $(".table-body").append($(msg).find(".product-list").html());
                }
                $.hide_notification();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        return false;
    })

    $document.on('click', '.product-tag-close', function() {
        var $this = $(this);
        var removable_tag = $(this).parent('button').attr('id');
        $.ajax({
            type: "POST",
            data: "tag=" + removable_tag,
            url: url_remove_product_tag,
            success: function(data) {
                $document.find(".tag-autocomplete ul li").each(function() {
                    if ($(this).attr('id') == removable_tag) {
                        $(this).find('.search-box-remove').trigger('click');
                    }
                });
                $this.parent('button').remove();
            }
        });
    })



    $('#exportCSV').click(function exportTo(csv) {
        $('.table').tableExport({
            filename: 'Product_list_%DD%-%MM%-%YY%'
        });
    })


});
