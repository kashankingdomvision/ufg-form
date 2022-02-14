$(document).ready(function() {
    /*
    |--------------------------------------------------------------------------------
    | Store User
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#store_user', function(event) {
        
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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}users/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    
    /*
    |--------------------------------------------------------------------------------
    | Update User
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#update_user', function(event) {       

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
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}users/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            }
        });
    });

    $(document).on('change', '.role-id', function() {

        var role = $(this).find('option:selected').data('role');
        var supervisor = $('#supervisor_feild');

        if (role == 'Sales Agent' || role == 2) {

            $(supervisor).removeClass("d-none");
            $('#supervisor_id').attr("required", true).removeAttr('disabled');

        } else {

            $(supervisor).addClass("d-none");
            $('#selectSupervisor').attr("required", false).attr('disabled', 'disabled');
        }

    });

    $(document).on('change', '.getBrandtoHoliday', function() {
        let brand_id = $(this).val();
        var options = '';
        var url = BASEURL + 'brand/to/holidays'
        $.ajax({
            type: 'get',
            url: url,
            data: { 'brand_id': brand_id },
            success: function(response) {
                options += '<option value="">Select Type Of Holiday</option>';
                $.each(response, function(key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} </option>`;
                });
                $('.appendHolidayType').html(options);
            }
        });

    });
});