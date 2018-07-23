jQuery(document).ready(function() {
    jQuery.browser = {};
    (function() {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();
    var $document = $(document);
    var child_array = [];
    var xhr_b;


    var edit_category = base_url + 'admin/category/edit/';
    var manage_category = base_url + 'admin/category';
    var delete_category = base_url + 'admin/category/destroy/';

    $('#add-category').click(function() {

        $('#category_form').validate({
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
        if ($('#category_form').valid()) {
            $('#category_form').submit();
        }
    });
    $("#category").dynatree({
        checkbox: false,
        selectMode: 2,
        children: $.parseJSON(category_tree_data),
        onSelect: function(select, node) {
            // Display list of selected nodes
            var selNodes = node.tree.getSelectedNodes();
            // convert to title/key array
            var selKeys = $.map(selNodes, function(node) {
                return "[" + node.data.key + "]: '" + node.data.title + "'";
            });
            $("#echoSelection2").text(selKeys.join(", "));
        },
        onClick: function(node, event) {
            var category_id = node.data.key;
            if (typeof category_id != "undefined" && category_id > 0) {
                $.ajax({
                    type: "GET",
                    url: edit_category + category_id,
                    data: "",
                    beforeSend: function() {},
                    complete: function(response) {
                        var category = response.responseJSON;
                        $("#category_form").find("input[name='en_category_name']").val(category.english.category_name);
                        $("#category_form").find("input[name='fr_category_name']").val((category.french != null) ? category.french.category_name : '');
                        /*$("#category_form").find("input[name='category_url']").val(category.url.request_url);*/
                        $("#category_form").find("input[name='is_active']").prop('checked', (category.is_active == '1') ? true : false);
                        $("#category_form").find("input[name='parent_id']").val(category.parent_id);
                        /*$("#category_form").find("input[name='url_id']").val(category.url.sys_url_rewrite_id);*/
                        $('#category_form').find("#en_category_description").text(category.english.description);
                        $('#category_form').find("#fr_category_description").text((category.french != null) ? category.french.description : '');
                        $('#category_form').attr('action', manage_category + '/' + category.category_id);
                    }
                });
            }

            if (node.getEventTargetType(event) == "title")
                node.toggleSelect();
        },
        onKeydown: function(node, event) {
            if (event.which == 32) {
                node.toggleSelect();
                return false;
            }
        },
        dnd: {
            onDragStart: function(node) {
                return true;
            },
            autoExpandMS: 1000,
            preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
            onDragEnter: function(node, sourceNode) {
                if (node.data.key == 0) {
                    return false;
                }
                return true;
            },
            onDragOver: function(node, sourceNode, hitMode) {
                if (hitMode == 'before' && node.data.key == 0) {
                    return false;
                }
                if (node.isDescendantOf(sourceNode))
                    return false;
            },
            onDrop: function(node, sourceNode, hitMode, ui, draggable) {
                sourceNode.move(node, hitMode);
                node.expand();
                if (hitMode == 'before' && node.data.key == 0) {
                    return false;
                }
                var dict = $("#category").dynatree("getTree");
                var parent_node = dict.getNodeByKey(sourceNode.parent.data.key);
                $(parent_node.childList).each(function(index, category) {
                    child_array.push(category.data.key);
                });
                parent_id = sourceNode.parent.data.key;
                if (xhr_b && xhr_b.readyState != 4) {
                    xhr_b.abort();
                }
                xhr_b = $.ajax({
                    type: "POST",
                    url: base_url + 'admin/category/update-order',
                    data: {
                        "child_data": child_array,
                        "parent_id": parent_id
                    },
                    complete: function(response_mesg) {
                        child_array = [];
                    }
                });
            }
        }

    });

    $("#category").dynatree("getRoot").visit(function(node) {
        node.expand(true);
    });

    $document.on('click', '#add_root_category', function() {
        $("#category").dynatree("getRoot").visit(function(node) {
            node.select(false);
        });
        $('#category_form').trigger('reset');
        $('span').removeClass('dynatree-active');
        $('#category_form').attr('action', manage_category);
        $("#category_form").find("input[name='parent_id']").val('');
        $("#category_form").find("input[name='url_id']").val('');
        $('#category_form').find("#description").text('');

    });
    $document.on('click', '#add_sub_category', function() {
        var active_node = $("#category").dynatree("getActiveNode");
        if (active_node == null) {
            $('.ajax-request-alert').find('.alert-message').text('Please select category');
            $('.ajax-request-alert').removeClass('hidden').addClass('alert-danger').fadeIn(1000);
            return false;
        }
        $("#category").dynatree("getRoot").visit(function(node) {
            node.select(false);
        });
        $('#category_form').trigger('reset');
        $('#category_form').attr('action', manage_category);
        $('#category_form').find("#description").text('');
        $("#category_form").find("input[name='parent_id']").val(active_node.data.key);
        $("#category_form").find("input[name='url_id']").val('');
    });
    $document.on('click', '#delete_category', function() {
        var active_node = $("#category").dynatree("getActiveNode");
        if (active_node == null) {
            $('.ajax-request-alert').find('.alert-message').text('Please select category');
            $('.ajax-request-alert').removeClass('hidden').addClass('alert-danger').fadeIn(1000);
            return false;
        }
        $('#confirm').modal({ backdrop: 'static', keyboard: false })
            .one('click', '#delete', function() {
                location.href = delete_category + active_node.data.key;
            });
    });
    /*$document.on('keyup keypress change', "#fr_category_name", function(e) {
        var clone_text = $("#fr_category_name").val();
        clone_text = $.trim(clone_text);
        clone_text = normalize_string(clone_text);
        clone_text = clone_text.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-').replace(/\_/g, '');
        $("#category_url").val(clone_text);
    });*/

});
