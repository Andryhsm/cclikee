jQuery(document).ready(function() {

    var $document = $(document);
    if (typeof selected_country_id != 'undefined' && selected_country_id != '' && selected_state_id != '') {
        get_state(selected_country_id, selected_state_id)
    }

    $('#add-store').click(function() {

        $('#store_form').validate({
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
        if ($('#add-store').valid()) {
            $('#store_form').submit();
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
            "order": [
                [4, "desc"]
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
                { searchable: true, sortable: true },
                { searchable: true, sortable: true },
                { searchable: true, sortable: true },
                { searchable: true, sortable: true },
                { searchable: true, sortable: true },
                { searchable: false, sortable: false }
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


    console.log($(".textarea").length);
    if ($(".textarea").length > 0) {
        $(".textarea").wysihtml5();
    }

    $document.on('click', '.add_user', function() {
        var row_count = parseInt($document.find('.master_manager:last').attr('id'));
        var row_index = row_count + 1;
        var master_div = $(this).parents('.master_manager').clone();
        master_div.attr('id', row_index);
        master_div.find('#last_name').val('').attr('name', "manager[" + row_index + "][last_name]");
        master_div.find('#first_name').val('').attr('name', "manager[" + row_index + "][first_name]");
        master_div.find('#sms').val('').attr('name', "manager[" + row_index + "][sms]");
        master_div.find('#email').val('').attr('name', "manager[" + row_index + "][email]");
        master_div.find('#password').val('').removeClass('password1').addClass('password' + row_index + '').attr('name', "manager[" + row_index + "][password]").attr('onkeyup', "confirmPassword('" + row_index + "');");
        master_div.find('#confirm_password').val('').removeClass('confirm_password1').addClass('confirm_password' + row_index + '').attr('onkeyup', "confirmPassword('" + row_index + "');");
        master_div.find('#global_manager').prop('checked', false).attr('name', "manager[" + row_index + "][global_manager]");
        master_div.find('#compte_principle').prop('checked', false).attr('name', "manager[" + row_index + "][compte_principle]");
        master_div.find('#receive_request').prop('checked', false).attr('name', "manager[" + row_index + "][receive_request]");
        master_div.find('#reply_request').prop('checked', false).attr('name', "manager[" + row_index + "][reply_request]");
        master_div.find('#manager_id').val('').attr('name', "manager[" + row_index + "][manager_id]");
        master_div.find('.add-user button').removeClass('add_user btn-primary').addClass('remove_user btn-danger').text("Effacer l'utilisateur");
        master_div.insertAfter($document.find('.master_manager:last'));
    });

    $document.on('click', '.remove_user ', function() {
        $(this).parents('.master_manager').remove();
    });
    $document.on('change', '#country', function() {
        var country_id = $(this).val();
        get_state(country_id, '', $(this).parents('.tab-pane'));

    });

    function get_state(country_id, state_id, parent) {
        if (typeof parent != 'undefined') {
            var $state_dropdown = parent.find('#state');
        }
        else {
            var $state_dropdown = $document.find('#state');
        }
        $.ajax({
            type: "GET",
            url: base_url + 'admin/get-state/' + country_id,
            data: "",
            beforeSend: function() {
                $state_dropdown.html('');
            },
            complete: function(response) {
                var states = $.parseJSON(response.responseText);
                $state_dropdown.append($("<option/>", {
                    value: '',
                    text: 'Select State'
                }));
                $.each(states, function(state_key, state_val) {
                    $state_dropdown.append($("<option/>", {
                        value: state_val.id,
                        text: state_val.name
                    }).prop('selected', (state_val.id == state_id)));
                });
            }
        });
    }
    if ($document.find('#all_brands').length > 0) {
        // $document.find('#all_brands').DualListBox('',$.parseJSON(selected_brand_array));
        $document.find('#all_brands').bootstrapDualListbox({
            nonSelectedListLabel: 'Marques disponibles',
            selectedListLabel: 'Marques sélectionnées',
            preserveSelectionOnMove: 'moved',
            selectorMinimalHeight: 300,
            moveOnSelect: false,
        });
    }

    $document.on('click', '#confirm_position', function() {
        var button = $(this);
        button.attr("disabled", true);
        var parent_element = $(this).parents('.tab-pane');
        var address1 = parent_element.find("#address1").val();
        var address2 = parent_element.find("#address2").val();
        var city = parent_element.find("#city").val();
        var zip = parent_element.find("#zip").val();
        var country = parent_element.find("#country option:selected").text();
        var state = parent_element.find("#state option:selected").text();
        $.ajax({
            type: "POST",
            url: base_url + 'admin/get-coordinates',
            data: "address1=" + address1 + "&address2=" + address2 + "&city=" + city + "&zip=" + zip + "&country=" + country + "&state=" + state,
            beforeSend: function() {
                $.show_notification();
            },
            complete: function(response) {
                $.hide_notification();
                button.attr("disabled", false);
                var result = response.responseJSON;
                if (result.status) {
                    parent_element.find("#latitude").val(result.latitude);
                    parent_element.find("#longitude").val(result.longitude);
                }
                else {
                    $('.ajax-request-alert').removeClass('hidden').addClass('alert-danger');
                    $('.alert-message').text(result.msg);
                    scroll_top('.ajax-request-alert')
                }
            }
        });
    });

    $document.on('click', '.brand-tag-btn', function() {
        var parent_element = $(this).parents('.tab-pane');
        var tag_id = [];
        $(this).toggleClass('active');
        parent_element.find('#tag_container .brand-tag-btn.active').each(function() {
            tag_id.push($(this).attr('id'));
        })
        $.ajax({
            type: "get",
            url: base_url + 'admin/get-brand-by-tag',
            data: "tags=" + tag_id,
            beforeSend: function() {
                $.show_notification();
            },
            complete: function(response) {
                $.hide_notification();
                parent_element.find(".all_brands").empty();
                parent_element.find(".all_brands").trigger('bootstrapDualListbox.refresh', true);
                var result = response.responseJSON;
                $.each(result, function(brand_key, brand_val) {
                    parent_element.find(".all_brands").append("<option value=" + brand_val.brand_id + ">" + ((brand_val.parent_id == null) ? brand_val.brand_name : brand_val.parent.brand_name + ' ' + brand_val.brand_name) + "</option>");
                });
                parent_element.find(".all_brands").trigger('bootstrapDualListbox.refresh', true);
            }
        });
    })

    $document.on('click', '#add_new_store', function(e) {
        var nextTab = parseInt($('#tabs li:last a').attr('id')) + 1;
        $.ajax({
            type: "get",
            url: base_url + 'admin/store/get-html/' + nextTab,
            data: "",
            beforeSend: function() {
                $.show_notification();
            },
            complete: function(response) {
                $.hide_notification();
                var html = response.responseText;
                $('<li><a href="#tab_' + nextTab + '" data-toggle="tab" id="' + nextTab + '">Store ' + nextTab + '</a><span class="remove_tab" title="Remove">x</span></li></li>').appendTo('#tabs');
                $(html).appendTo('.tab-content');
                $(".tab-content #tab_" + nextTab).find(".all_brands").bootstrapDualListbox({
                    nonSelectedListLabel: 'Available Brands',
                    selectedListLabel: 'Selected Brands',
                    preserveSelectionOnMove: 'moved',
                    selectorMinimalHeight: 300,
                    moveOnSelect: false,
                });
                $(".textarea").wysihtml5();

            }
        });
        // make the new tab active
        $('#tabs a:last').tab('show');

    });

    $document.on('click', '.remove_tab', function() {
        var index = $(this).parent('li').find('a').attr('id');
        $("#tabs li").find("#" + index).parent('li').remove();
        $(".tab-content").find("#tab_" + index).remove();
        $('#tabs a:first').tab('show');
    })

});

function confirmPassword(cle) {

    var confirm_password = '.confirm_password' + cle;
    var password = '.password' + cle;

    if ($(confirm_password).val() != $(password).val()) {
        $(confirm_password).css({
            borderColor: 'red',
            color: 'red'
        });
        $(password).css({
            borderColor: 'red',
            color: 'red'
        });
    }
    else {
        $(confirm_password).css({
            borderColor: '#78809a',
            color: '#78809a'
        });
        $(password).css({
            borderColor: '#78809a',
            color: '#78809a'
        });
    }
}
