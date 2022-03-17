@extends('layouts.app')

@section('title','Add Commissions')

@section('content')

<style>
    /* #category_form_detail {
        padding: 0;
        margin: 10px 0;
        background: #f2f2f2 url('https://formbuilder.online/assets/img/noise.png');
    } */
</style>

  <div class="content-wrapper">

    @include('includes.print_errors')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Commission Criteria</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Commission Managment</a></li>
                <li class="breadcrumb-item active">Commission Criteria</li>
              </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content" id="category_form_detail">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-outline card-base">
                <div class="card-header">
                    <h3 class="card-title text-center">Category Detail Form</h3>
                </div>

                <div class="card-body">
                  <div id="build-wrap"></div>
                  <div class="render-wrap"></div>
                </div>

           
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
@endsection

@push('js')
 
<script src='https://formbuilder.online/assets/js/form-render.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script src='https://formbuilder.online/assets/js/form-builder.min.js'></script>


  {{-- <script src="{{ asset('js/category/jquery-ui.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/category/formRender.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/category/formBuilder.js') }}"></script> --}}

<script>
  jQuery(function ($) {
    var fbTemplate = document.getElementById("build-wrap");
    var options = {
      onSave: function (evt, formData) {

     
        // var url = `${window.location.origin}/ufg-form/public/categories/store`
        
        $.ajax({
          type: 'POST',
          url: url,
          data: formData,
          beforeSend: function() {
            $("#overlay").addClass('overlay');
            $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
          },
          success: function(data) {
              $("#overlay").removeClass('overlay').html('');
              
              setTimeout(function() {

                if(data && data.status == 200){
                  alert(data.success_message);
                  window.location.href = REDIRECT_BASEURL + "quotes/index";
                }
              }, 200);
          },
          error: function(reject) {

            if (reject.status === 422) {

              var errors = $.parseJSON(reject.responseText);

              setTimeout(function() {

                $("#overlay").removeClass('overlay').html('');

                jQuery.each(errors.errors, function(index, value) {

                  index = index.replace(/\./g, '_');

                  $(`#${index}`).addClass('is-invalid');
                  $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                });
              }, 400);
            }
          },
        });


        console.log(url);


      }
    };
    $(fbTemplate).formBuilder(options);
  });

</script>
@endpush
