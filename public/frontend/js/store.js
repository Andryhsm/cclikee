jQuery(document).ready(function() {
    var $document = $(document);

    // title_brands_select = "MARQUES RÉPERTORIÉES DANS NOTRE SYSTÈME";
    var lang = {};

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


    $document.on('change', '#country', function() {
        var country_id = $(this).val();
        get_state(country_id, '', '');
    });

    function get_state(country_id, state_id, parent) {
        var $state_dropdown = $document.find('#state');
        /*alert(base_url);*/
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
        $document.find('#all_brands').bootstrapDualListbox({
            nonSelectedListLabel: false,
            selectedListLabel: false,
            preserveSelectionOnMove: 'moved',
            selectorMinimalHeight: 300,
            moveOnSelect: false,
            infoText: '{0}' + lang['infoTextSelect'],
            infoTextEmpty: lang['infoTextEmptySelect'],
            infoTextFiltered: false
        });
    }
    $document.on('click', '#confirm_position', function() {
        var button = $(this);
        button.attr("disabled", true);
        var parent_element = $(document);
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
            beforeSend: function() {},
            complete: function(response) {
                button.attr("disabled", false);
                var result = response.responseJSON;
                if (result.status) {
                    parent_element.find("#latitude").val(result.latitude);
                    parent_element.find("#longitude").val(result.longitude);
                }
                else {
                    $('.ajax-request-alert').removeClass('hidden').addClass('alert-danger');
                    $('.alert-message').text(result.msg);
                }
            }
        });
    });

    $document.on('click', '.brand-tag-btn', function() {
        var parent_element = $(document);
        var tag_id = [];
        $(this).toggleClass('active');
        parent_element.find('#tag_container .brand-tag-btn.active').each(function() {
            tag_id.push($(this).attr('id'));
        })
        $.ajax({
            type: "get",
            url: base_url + 'admin/get-brand-by-tag',
            data: "tags=" + tag_id,
            complete: function(response) {
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
        master_div.find('#global_manager').prop('checked', true).attr('name', "manager[" + row_index + "][global_manager]");
        master_div.find('#compte_principle').prop('checked', true).attr('name', "manager[" + row_index + "][compte_principle]");
        master_div.find('#receive_request').prop('checked', true).attr('name', "manager[" + row_index + "][receive_request]");
        master_div.find('#reply_request').prop('checked', true).attr('name', "manager[" + row_index + "][reply_request]");
        master_div.find('#manager_id').val('').attr('name', "manager[" + row_index + "][manager_id]");
        master_div.find('.add-user button').removeClass('add_user btn-primary').addClass('remove_user btn-danger').text('Remove User');
        master_div.find('.line-separator').removeClass('hidden');
        if (language_code == 'fr') {
            master_div.find('.title-master-manager>span').html('Compte #' + row_index + '&nbsp;&nbsp;&nbsp;&nbsp; <a class="remove_user"><i class="fa fa-trash-o" aria-hidden="true"></i></a>');
        }
        else {
            master_div.find('.title-master-manager>span').html('Account #' + row_index + '&nbsp;&nbsp;&nbsp;&nbsp; <a class="remove_user"><i class="fa fa-trash-o" aria-hidden="true"></i></a>');
        }

        master_div.insertAfter($document.find('.master_manager:last'));
    });

    $document.on('click', '.call_add_user', function() {
        $('.add_user').trigger('click');
    });

    $document.on('click', '.remove_user ', function() {
        $(this).parents('.master_manager').remove();
    });


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
