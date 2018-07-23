jQuery(document).ready(function () {

    var $document = $(document);
    $('#admin_user_form').validate({
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

    $('#add-admin').click(function () {
        if ($('#admin_user_form').valid()) {
            $('#admin_user_form').submit();
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

});
