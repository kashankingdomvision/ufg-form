$(document).on('click', ".view-detail", function(event) {

    event.preventDefault();

    let bookingID = $(this).data('booking_id');

    let modal = $('#view_detail_modal');
    modal.find('#commission_detail').val(bookingID);

    $.ajax({
        type: 'POST',
        url:`${REDIRECT_BASEURL}pay-commissions/view-commission-detail/${bookingID}`,
        data: {
            'booking_id' : bookingID
        },
        success: function(response) {

            if(response.status && response.hasOwnProperty('html')){
                modal.modal('show');
                $('#view_detail_modal .modal-body').html(response.html);
            }
            
        },
        error:  function(error) {

            console.log(error);
             
         },
    });
});

