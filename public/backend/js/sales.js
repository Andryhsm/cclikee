jQuery(document).ready(function () {
    if (jQuery('#sales_order').length > 0) {
        jQuery('#sales_order').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": base_url+"admin/sales/get-data/"+status_id,
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
                {data: 'order_id', name:'order_id',searchable: true, sortable: true},
                {data: 'order_date', name:'order_date',searchable: true, sortable: true},
                {data: 'customer', name:'customer',searchable: true, sortable: true},
                {data: 'order_total', name:'order_total',searchable: true, sortable: true},
                {data: 'products_name', name:'products_name',searchable: true, sortable: true},
                {data: 'action', name:'action',searchable: false, sortable: false},
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

    if (jQuery('.dataTables_filter').length > 0) {
        jQuery('.dataTables_filter').find('input').addClass('form-control')
    }

    $(document).on("change","#order_status",function () {
        $("#update_order").removeClass('hidden');
    })
});
