$(document).ready(function() {
    /*
    |--------------------------------------------------------------------------------
    | Store Payment Method 
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#store_payment_method', function(event) {
        
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
    | Update Payment Method
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#update_payment_method', function(event) {       

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

    $(document).on('click', '.payment-method-bulk-action-item', function() {

        let checkedValues  = $('.child:checked').map((i, e) => e.value ).get();
        let bulkActionType = $(this).data('action_type');
        let message        = "";
        let buttonText     = "";
    
        if(['delete'].includes(bulkActionType)){

            if(checkedValues.length > 0){
    
                $('input[name="bulk_action_type"]').val(bulkActionType);
                $('input[name="bulk_action_ids"]').val(checkedValues);
    
                switch(bulkActionType) {
                    case "delete":
                        message    = 'You want to Delete Payment Methods?';
                        buttonText = 'Delete';
                        break;
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
                            url: $('#payment_method_bulk_action').attr('action'),
                            data: new FormData($('#payment_method_bulk_action')[0]),
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