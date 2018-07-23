jQuery(document).ready(function () {

    var $document = $(document);
    if (typeof selected_country_id != 'undefined' && selected_country_id != '' && selected_state_id != '') {
        get_state(selected_country_id, selected_state_id)
    }
    $('#account_form').validate({
        rules: {
            confirm_password: {
                required: {
                    depends: function (e) {
                        return ($('#password').val()!='');
                    }
                },
                equalTo: "#password"
            },
            first_name:{
                required:true
            },
            last_name:{
                required:true
            },
            email:{
                required:true
            }
        },
        errorPlacement: function (error, element) {
            return error.insertAfter(element);
        }
    });

    $('#add-account').click(function () {
        if ($('#account_form').valid()) {
            $('#account_form').submit();
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
            "order": [[4, "desc"]],
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
                {searchable: true, sortable: true},
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
    if ($(".textarea").length > 0) {
        $(".textarea").wysihtml5();
    }

    $document.on('change', '#country', function () {
        var country_id = $(this).val();
        get_state(country_id, '');
    });

    function get_state(country_id, state_id) {
        var $state_dropdown = $document.find('#state');
        $.ajax({
            type: "GET",
            url: base_url + 'admin/get-state/' + country_id,
            data: "",
            beforeSend: function () {
                $state_dropdown.html('');
            },
            complete: function (response) {
                var states = $.parseJSON(response.responseText);
                $state_dropdown.append($("<option/>", {
                    value: '',
                    text: 'Select State'
                }));
                $.each(states, function (state_key, state_val) {
                    $state_dropdown.append($("<option/>", {
                        value: state_val.id,
                        text: state_val.name
                    }).prop('selected', (state_val.id == state_id)));
                });
            }
        });
    }

});
