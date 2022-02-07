$(document).ready(function() {
    
    /*
    |--------------------------------------------------------------------------------
    | Update CurrencyConversion
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#update_currency_conversion', function(event) {       

        event.preventDefault();

        let url = $(this).attr('action');

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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}currency-conversions/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });
});