jQuery(document).ready(function () {
    $('.save-form').click(function () {
        $('.validate_form').validate({
            rules:{
            },
            invalidHandler: function(e, validator){
                if(validator.errorList.length)
                    $('#myTab a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
            },
            errorPlacement: function (error, element) {
                var element_id = element.attr("id");
                if (element_id == "fileInput") {
                    return error.insertAfter(element.parent().parent().parent());
                }
                else if(element_id == "alphabet_letter")
                {
                    return error.insertAfter(element.next());
                }
                else {
                    return error.insertAfter(element);
                }
            }
        });
        if ($('.validate_form').valid()) {
            $('.validate_form').submit();
        }
    });

});
