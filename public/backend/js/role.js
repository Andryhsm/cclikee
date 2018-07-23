jQuery(document).ready(function () {

    var $document = $(document);

    $('#add-role').click(function () {
        $('#admin_role').validate({
            errorPlacement: function (error, element) {
                return error.insertAfter(element);
            }
        });
        if ($('#admin_role').valid()) {
            $('#admin_role').submit();
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
            "order": [[0, "desc"]],
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

    if ($("#permission").length > 0) {
        var selected_categories = $.parseJSON(selected_category);
        $("#permission").dynatree({
            checkbox: true,
            selectMode: 2,
            children: $.parseJSON(category_tree_data),
            onSelect: function (select, node) {
                // Display list of selected nodes
                var selNodes = node.tree.getSelectedNodes();
                var selected_category = $.map(selNodes, function (node) {
                    return node.data.key;
                });
                $("#permission_id").val(selected_category.join(", "));
            },
            onClick: function (node, event) {
                // We should not toggle, if target was "checkbox", because this
                // would result in double-toggle (i.e. no toggle)
                if (node.getEventTargetType(event) == "title")
                    node.toggleSelect();
            },
            onKeydown: function (node, event) {
                if (event.which == 32) {
                    node.toggleSelect();
                    return false;
                }
            }
        });
        $("#permission").dynatree("getRoot").visit(function (node) {
            node.expand(true);
        });
        $("#permission").dynatree("getRoot").visit(function (node) {
            if ($.inArray(parseInt(node.data.key), selected_categories) !== -1) {
                node.select(true);
            }
        });

    }
});