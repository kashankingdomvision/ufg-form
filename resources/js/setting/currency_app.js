$(document).ready(function() {
    /*
    |--------------------------------------------------------------------------------
    | Store Currency 
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#store_currency', function(event) {
        
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

    
    /*
    |--------------------------------------------------------------------------------
    | Update Currency
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#update_currency', function(event) {       

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

    $(document).on('click', '.currency-bulk-action-item', function() {

        let checkedValues  = $('.child:checked').map((i, e) => e.value ).get();
        let bulkActionType = $(this).data('action_type');
        let message        = "";
        let buttonText     = "";
    
        if(['active', 'inactive'].includes(bulkActionType)){

            if(checkedValues.length > 0){
    
                $('input[name="bulk_action_type"]').val(bulkActionType);
                $('input[name="bulk_action_ids"]').val(checkedValues);
    
                switch(bulkActionType) {
                    case "active":
                        message    = 'You want to Active currencies?';
                        buttonText = 'Active';
                        break;
                    case "inactive":
                        message    = 'You want to Inactive currencies?';
                        buttonText = 'Inactive';
                }
    
                Swal.fire({
                    title: 'Are you sure?',
                    text: message,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: `Yes, ${buttonText} it !`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: $('#currency_bulk_action').attr('action'),
                            data: new FormData($('#currency_bulk_action')[0]),
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(response) {
                                printListingSuccessMessage(response);
                            }
                        });
                    }
                })
            } else {

                printListingErrorMessage("Please Check Atleast One Record.");
            }
        }

    });
});