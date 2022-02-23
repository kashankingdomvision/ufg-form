$(document).ready(function() {
    /*
    |--------------------------------------------------------------------------------
    | Store Supplier
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#store_supplier', function(event) {
        
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
    | Update Supplier
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#update_supplier', function(event) {       

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

    $(document).on('change', '.getCountryToLocation', function() {
        
        var supplier_country_ids = $(this).val();
        var url         = BASEURL + 'country/to/location';
        var options     = '';

        $.ajax({
            type: 'get',
            url: url,
            data: { 'supplier_country_ids': supplier_country_ids },
            beforeSend: function() {
                $('.appendCountryLocation').html(options);
            },
            success: function(response) {

                $.each(response, function(key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} (${value.country_name}) </option>`;
                });

                $('.appendCountryLocation').html(options);
            }
        });
    
    });

    $(document).on('click', '.supplier-bulk-action-item', function() {

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
                        message    = 'You want to Delete Suppliers?';
                        buttonText = 'Delete';
                        break;
                }
    
                Swal.fire({
                    title: 'Are you sure?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: `Yes, ${buttonText} it !`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: $('#supplier_bulk_action').attr('action'),
                            data: new FormData($('#supplier_bulk_action')[0]),
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