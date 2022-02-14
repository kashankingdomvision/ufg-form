$(document).ready(function() {
    /*
    |--------------------------------------------------------------------------------
    | Store Supplier
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#store_supplier', function(event) {
        
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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}suppliers/index`);
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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}suppliers/index`);
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
});