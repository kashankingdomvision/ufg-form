<div class="modal fade" id="override_modal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form action="{{ route('update.override', encrypt($quote->id)) }}"  method="POST"  id="update-override">
                @csrf @method('put')
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="status" value="{{ $status }}">
        
                <div class="modal-header">
                    <h4 class="modal-title">Alert</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to override @if($status == 'quotes') Quote @elseif($status == 'bookings') Booking @endif Access? </p>
                </div>
                <div class="modal-footer">

                    <button class="btn btn-primary" type="submit" id="override_submit">
                        <span class="mr-2" role="status" aria-hidden="true"></span>
                        Override
                    </button>

                   
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(window).on('load', function() {
        $('#override_modal').modal('show');
    });
</script>