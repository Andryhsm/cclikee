jQuery(document).ready(function () {

    var $document = $(document);
    var commission_percentage = 3.9;
    $('#add-attribute').click(function () {

        $('#attribute_form').validate({
            errorPlacement: function (error, element) {
                var element_id = element.attr("id");
                if (element_id == "fileInput") {
                    return error.insertAfter(element.parent().parent().parent());
                }
                else if(element_id == "alphabet_letter"){
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

    if (jQuery('table#invoice_list').length > 0) {
        jQuery('table#invoice_list').DataTable({
            "responsive"   : true,
            "bPaginate"    : true,
            "bLengthChange": true,
            "bFilter"      : true,
            "bInfo"        : true,
            "bAutoWidth"   : false,
            "order"        : [[4, "desc"]],
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
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: false, sortable: false}
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


    if (jQuery('table#merchant-lists').length > 0) {
        jQuery('table#merchant-lists').DataTable({
            "responsive"   : true,
            "bPaginate"    : true,
            "bLengthChange": true,
            "bFilter"      : true,
            "bInfo"        : true,
            "bAutoWidth"   : false,
            "order"        : [[2, "desc"]],
            "lengthMenu"   : [20, 40, 60, 80, 100],
            "pageLength"   : 20,
            columns        : [
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: false, sortable: false}
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
    
    $document.on('click','#select-merchant',function () {
        var data = $(this).data();
        $document.find('#merchant_name').val(data.name);
        $document.find('#store_name').val(data.store_name);
        $document.find('#merchant_email').val(data.email);
        $document.find('#merchant_address_1').val(data.address_1);
        $document.find('#merchant_address_2').val(data.address_2);
        $document.find('#city').val(data.city);
        $document.find('#merchant_postcode').val(data.zip);
        $document.find('#merchant_phone').val(data.phone);
        $document.find('#merchant_id').val(data.id);
        $document.find('#store_id').val(data.store_id);
        $('#merchant-modal').modal('hide');
    });

    $document.on("click",'#close_item_popup',function () {
        $('#items-modal').modal('hide');
    });

    $document.on("click","#select_item",function () {
        var price = $("#item_dropdown").find(":selected").data("price");
        var name = $("#item_dropdown").find(":selected").data("name");
        var item_id = $("#item_dropdown").val();
        var commission = (parseFloat(price)*3.9/100).toFixed(2);

        var html = `<tr>
                                        <td>
                                            <div class="form-group form-group-sm  no-margin-bottom">
                                                <a href="javascript:void(0)" class="btn btn-danger btn-xs delete-row" id="remove_row"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                                <input type="text" class="form-control form-group-sm item-input invoice_product" value="`+name+`" disabled="">
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control calculate-sub" name="item_price[]" id="invoice_product_sub" value="`+price+`"  readonly>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control calculate-sub" name="item_commission[]" id="invoice_product_commission" value="`+commission+`"  readonly>
                                            </div>
                                        </td>

                                        <input type="hidden" name="item_ids[]" value="`+item_id+`">
                                    </tr>`;

        $document.find("#items_table tbody").append(html);

        var total = $("#invoice_subtotal").val();
        var final_total = parseFloat(total)+parseFloat(commission);
        $(".invoice-sub-total").text(final_total.toFixed(2));
        $("#invoice_subtotal").val(final_total.toFixed(2));
        $(".invoice-total").text(final_total.toFixed(2));
        $("#invoice_total").val(final_total.toFixed(2));

        $('#items-modal').modal('hide');
    })

    $document.on("click","#remove_row",function () {
        var price = $(this).parents('tr').find("#invoice_product_commission").val();
        var total = $("#invoice_total").val();
        var final_total = parseFloat(total)-parseFloat(price);
        $(".invoice-sub-total").text(final_total.toFixed(2));
        $("#invoice_subtotal").val(final_total.toFixed(2));
        $(".invoice-total").text(final_total.toFixed(2));
        $("#invoice_total").val(final_total.toFixed(2));
        $(this).parents('tr').remove();
    })

});
