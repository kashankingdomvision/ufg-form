$(document).ready(function() {
    /*
    |--------------------------------------------------------------------------------
    | Store Preset Comment 
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#store_preset_comment', function(event) {
        
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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}preset-comments/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    
    /*
    |--------------------------------------------------------------------------------
    | Update Preset Comment
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#update_preset_comment', function(event) {       

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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}preset-comments/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });
});