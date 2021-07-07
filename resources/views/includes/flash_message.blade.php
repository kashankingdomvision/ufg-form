@if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissible text-center show " role="alert">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span  aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(Session::has('error_message'))
    <div class="alert alert-danger alert-dismissible text-center show " role="alert">
        {{ Session::get('success_message') }}asdasdasdasd
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span  aria-hidden="true">&times;</span>
        </button>
    </div>
@endif