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