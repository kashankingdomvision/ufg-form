$(document).ready(function() {

    /*
    |--------------------------------------------------------------------------------
    | Store Group
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#store_group', function(event) {
        
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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}groups/index`);
            },
            error: function(response) {

                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    /*
    |--------------------------------------------------------------------------------
    | Update Group
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#update_group', function(event) {
        
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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}groups/index`);
            },
            error: function(response) {

                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

});
