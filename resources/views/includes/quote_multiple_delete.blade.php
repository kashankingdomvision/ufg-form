<div class="modal fade" id="multiple_delete_modal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form action="" method="POST"  id="update-override">
                @csrf   @method('delete')
                <input type="hidden" name="action_name" class="action_name" value="">
        
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to Delete Records?</p>
                </div>
                <div class="modal-footer">

                    <button class="" type="submit" id="quote_multiple_action">
                        <span class="mr-2" role="status" aria-hidden="true"></span>
                        Delete
                    </button>

                   
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>