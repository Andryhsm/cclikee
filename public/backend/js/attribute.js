jQuery(document).ready(function() {

    var $document = $(document);

    $('#add-attribute').click(function() {

        $('#attribute_form').validate({
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
        if ($('#attribute_form').valid()) {
            $('#attribute_form').submit();
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
                [0, "desc"]
            ],
            "lengthMenu": [20, 40, 60, 80, 100],
            "pageLength": 20,
            columns: [
                { searchable: true, sortable: true },
                { searchable: true, sortable: true },
                { searchable: false, sortable: true },
                { searchable: false, sortable: false }
            ],
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
    $document.on('click', '.add_option', function() {
        var row_count = parseInt($('.option_row:last').attr('id'));
        var attribute_type = $(".attribute_type_list").val();
        var row_index = row_count + 1;
        console.log("row_count : " + row_count);
        console.log("row_index : " + row_index);
        var input_type = $document.find('#input_type :selected').val();

        var html_data = $document.find('.master-option-container').clone();
        html_data.removeClass('master-option-container hidden').prop('id', row_index);
        html_data.find('.order_data');
        /*html_data.find('.option_name.english_input input').attr('name','options['+row_index+'][en_name]');*/
        html_data.find('.option_name.french_input input').attr('name', 'options[' + row_index + '][fr_name]');
        if (input_type == 1) {
            html_data.find('.option_value').remove();
            html_data.find('.color_picker').removeClass('hidden');
            html_data.find('.color_picker input').attr('name', 'options[' + row_index + '][value]');
        }
        else {
            html_data.find('.color_picker').remove();
            html_data.find('.option_value input').attr('name', 'options[' + row_index + '][value]');
        }
        // html_data.find('.option_value input').attr('name','attribute[option_value]['+row_index+']');
        html_data.find('.button :button').removeClass('btn-primary add_option').addClass('btn-danger remove_option').text("Effacer l'option");
        $(html_data).hide().appendTo("#option_list").animate({
            height: 'toggle'
        }, 500);
        $document.find(".colorpicker").colorpicker();
    });

    $document.on('click', '.remove_option', function() {
        $(this).parents('.form-group').remove();
    });

    $document.on('change', '#input_type', function() {
        var input_type = $(this).val();
        var $option_list = $('#option_list');
        $option_list.find('.form-group').not(':first').remove();
        var first_row = $option_list.find('.form-group');
        if (input_type == 1) {
            first_row.find('.color_picker input').attr('name', "options[1][value]");
            first_row.find('.option_value input').attr('name', "");
        }
        else {
            first_row.find('.color_picker input').attr('name', "");
            first_row.find('.option_value input').attr('name', "options[1][value]");
        }
        $option_list.find('.option_value').toggleClass('hidden', input_type == '1');
        $option_list.find('.color_picker').toggleClass('hidden', (input_type == '2' || input_type == ''));
    })

    $document.find(".colorpicker").colorpicker();

});

function up(u) {
    var wrapper = $(u).closest('.option_row')
    wrapper.insertBefore(wrapper.prev())
}

function down(d) {
    var wrapper = $(d).closest('.option_row')
    wrapper.insertAfter(wrapper.next())
}
