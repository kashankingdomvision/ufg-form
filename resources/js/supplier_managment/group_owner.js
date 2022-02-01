$(document).ready(function() {
    /*
    |--------------------------------------------------------------------------------
    | Store Supplier Rate Sheet
    |--------------------------------------------------------------------------------
    */

    $("#store_group_owner").submit(function(event) {
        
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
            success: function(data) {

                removeFormLoadingStyles();

                setTimeout(function() {

                    if(data && data.status){
                        alert(data.success_message);
                        window.location.href = `${REDIRECT_BASEURL}group-owners/index`;
                    }
                }, 200);
            },
            error: function(response) {
                
                if (response.status === 422) {

                    let errors = response.responseJSON;
                    printServerValidationErrors(errors);
                }
            },
        });
    });

    
    /*
    |--------------------------------------------------------------------------------
    | Update Supplier Rate Sheet
    |--------------------------------------------------------------------------------
    */

    $("#update_group_owner").submit(function(event) {
                
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
            success: function(data) {

                removeFormLoadingStyles();

                setTimeout(function() {

                    if(data && data.status){
                        alert(data.success_message);
                        window.location.href = `${REDIRECT_BASEURL}group-owners/index`
                    }
                }, 200);
          
            },
            error: function(response) {

                if (response.status === 422) {
                    
                    let errors = response.responseJSON;
                    printServerValidationErrors(errors);
                }
            },
        });
    });
});