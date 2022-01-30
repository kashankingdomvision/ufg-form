$(document).ready(function() {

    /*
    |--------------------------------------------------------------------------------
    | Store Supplier Rate Sheet
    |--------------------------------------------------------------------------------
    */

    $("#store_supplier_rate_sheet").submit(function(event) {
        
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

                    if(data && data.status == 200){
                        alert(data.success_message);
                        window.location.href = REDIRECT_BASEURL + "supplier-rate-sheet";
                    }
                }, 200);
            },
            error: function(reject) {

                if (reject.status === 422) {

                    var errors = $.parseJSON(reject.responseText);

                    setTimeout(function() {
                        removeFormLoadingStyles();

                        jQuery.each(errors.errors, function(index, value) {

                            index = index.replace(/\./g, '_');
                            $(`#${index}`).addClass('is-invalid');
                            $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                        });

                    }, 200);

                }
            },
        });
    });

    
    /*
    |--------------------------------------------------------------------------------
    | Update Supplier Rate Sheet
    |--------------------------------------------------------------------------------
    */

    $("#update_supplier_rate_sheet").submit(function(event) {
                
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

                    if(data && data.status == 200){
                        alert(data.success_message);
                        window.location.href = REDIRECT_BASEURL + "supplier-rate-sheet";
                    }
                }, 200);
          
            },
            error: function(reject) {

                if (reject.status === 422) {

                    var errors = $.parseJSON(reject.responseText);

                    setTimeout(function() {
                        removeFormLoadingStyles();

                        jQuery.each(errors.errors, function(index, value) {

                            index = index.replace(/\./g, '_');
                            $(`#${index}`).addClass('is-invalid');
                            $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                        });

                    }, 200);

                }
            },
        });
    });

});