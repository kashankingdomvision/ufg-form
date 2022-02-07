$(document).ready(function() {
    /*
    |--------------------------------------------------------------------------------
    | Store Store Text 
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#store_store_text', function(event) {
        
        event.preventDefault();

        var url = $(this).attr('action');

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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}store-texts/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    
    /*
    |--------------------------------------------------------------------------------
    | Update Store Text
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#update_store_text', function(event) {       

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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}store-texts/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });
});