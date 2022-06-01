$(document).ready(function() {


    $(document).on('submit', '#store_sale_person_payment', function(event) {
        
        event.preventDefault();

        let url    = $(this).attr('action');
        let formID = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                removeFormValidationStyles();
                addFormLoadingStyles();
            },
            success: function(response) {

                removeFormLoadingStyles();
                printServerSuccessMessage(response, `#${formID}`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    $(document).on('submit', '#update_sale_person_payment', function(event) {
        
        event.preventDefault();

        let url    = $(this).attr('action');
        let formID = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                removeFormValidationStyles();
                addFormLoadingStyles();
            },
            success: function(response) {

                removeFormLoadingStyles();
                printServerSuccessMessage(response, `#${formID}`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    $(document).on('change', '.sale-person-id', function(event) {

        let salePersonCurrencyID = $(this).find(":selected").data('sale_person_currency_id');
        let salePersonCurrencyCode = $(this).find(":selected").data("sale_person_currency_code");

        $('.sale-person-currency-id').val(salePersonCurrencyID);
        $('.sale-person-currency-code').html(salePersonCurrencyCode);
    });

});
