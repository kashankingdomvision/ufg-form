$(document).ready(function() {
    /*
    |--------------------------------------------------------------------------------
    | Store Commission Criteria 
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#store_commission_criteria', function(event) {
        
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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}commission-criterias/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    
    /*
    |--------------------------------------------------------------------------------
    | Update Commission Criteria
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#update_commission_criteria', function(event) {       

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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}commission-criterias/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    $(document).on('change', '.getMultipleBrandtoHoliday', function() {

        let brand_ids = $(this).val();
        var options = '';
        var url = BASEURL + 'multiple/brand/to/holidays'
        
        $.ajax({
            type: 'get',
            url: url,
            data: { 'brand_ids': brand_ids },
            beforeSend: function() {
                $('.appendMultipleHolidayType').html(options);
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} (${value.brand_name}) </option>`;
                });

                $('.appendMultipleHolidayType').html(options);
            }
        });
 
    });
});