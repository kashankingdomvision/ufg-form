$(document).ready(function() {
    /*
    |--------------------------------------------------------------------------------
    | Store Brand 
    |--------------------------------------------------------------------------------
    */
    // $('.input-images-1').imageUploader();
    $(document).on('submit', '#store_brand', function(event) {
        
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
    | Update Brand
    |--------------------------------------------------------------------------------
    */

    $(document).on('submit', '#update_brand', function(event) {       

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

    $(document).on('click', '.brand-bulk-action-item', function() {

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
                        message    = 'You want to Delete Brands?';
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
                            url: $('#brand_bulk_action').attr('action'),
                            data: new FormData($('#brand_bulk_action')[0]),
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

    $(document).on('click', '.delete-brand', function(event) {

        event.preventDefault();
        let url = $(this).attr('action');
        message    = 'You want to Delete Brands?';
        buttonText = 'Delete';

        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: `Yes ${buttonText}!`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        printListingSuccessMessage(response);
                    },
                    error: function(response) {
                        Toast.fire({
                            icon: 'warning',
                            title: response.message
                        });
                    }
                });
            }
        })
    });

    $("#files").on("change", function(e) {
        $('.remove-logo').parent().remove();
        $('.delete_image').val('');
          var fileReader = new FileReader();
          fileReader.onload = (function(e) {
            var file = e.target;
            $("<div class=\"form-group new-image text-center mt-3\" id=\"old_logo\">" +
              "<img class=\"imageThumb\" width=\"100\" height=\"100\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
              "<br/><a href=\"javascript:void(0)\" class=\"remove-new-image remove-logo\">Remove image</a>" +
              "<input class=\"delete_image\" type=\"hidden\" name=\"delete_logo\" value=\"\">"+
              "</div>").insertAfter("#files");
            $(".remove-new-image").click(function(){
              $(this).parent(".new-image").remove();
              $('.delete_image').val('1');
              $('#files').val(null);
            });
          });
          fileReader.readAsDataURL(this.files[0]);
    });

    $('.remove-logo').on('click', function () {
        $(this).parent().remove();
        $('.delete_image').val('1');
    });
});