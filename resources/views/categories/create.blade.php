@extends('layouts.app')

@section('title','Add Category')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Category</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Supplier Management</a></li>
              </ol>
          </div>
        </div>
      </div>
    </section>
    {{-- <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title text-center">Category Form</h3>
              </div>
              <form method="POST" action="{{ route('categories.store') }}" >
                @csrf 
                <div class="card-body">
                  <div class="form-group">
                    <label>Category Name <span style="color:red">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Category Name" required>
                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                  <a href="{{ route('categories.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section> --}}

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center">Category Form</h3>
              </div>

              <div class="card-body">
                <div class="form-group">
                  <label>Category Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" class="form-control name" placeholder="Category Name" required>
                  <span class="text-danger" role="alert"></span>
                </div>
                
                <div id="build-wrap"></div>
              </div>

              <div id="overlay" class=""></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@push('js')
 
  <script src="{{ asset('js/category/jquery-ui.js') }}"></script>
  <script src="{{ asset('js/category/formRender.js') }}"></script>
  <script src="{{ asset('js/category/formBuilder.js') }}"></script>

<script>

  jQuery(function ($) {
    var fbTemplate = document.getElementById("build-wrap");
    var options = {
      onSave: function (evt, formData) {

        var categoryName = $('.name').val();
        var url          = '{{route('categories.store')}}';

        // console.log(formData);
        // console.log(url);

        if(formData == '[]'){
          formData = '';
        }

        var data = {
          name : categoryName,
          feilds : formData,
          "_token": "{{ csrf_token() }}",
        };

        // console.log(data);

        $.ajax({
          type: 'POST',
          url: url,
          data: data,
          beforeSend: function() {
            $('input, select').removeClass('is-invalid');
            $('.text-danger').html('');
            $("#overlay").addClass('overlay');
            $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
          },
          success: function(data) {
            $("#overlay").removeClass('overlay').html('');
            
            setTimeout(function() {

              if(data && data.status == true){
                alert(data.success_message);
                window.location.href = '{{route('categories.index')}}';
              }
            }, 200);
          },
          error: function(reject) {

            if (reject.status === 422) {

              var errors = $.parseJSON(reject.responseText);
              var flag = true;

              setTimeout(function() {

                $("#overlay").removeClass('overlay').html('');

                jQuery.each(errors.errors, function(index, value) {

                  index = index.replace(/\./g, '_');

                  $(`#${index}`).addClass('is-invalid');
                  $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                  if(flag){
                    $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                    flag = false;
                  }

                });
              }, 400);
            }
            
          },
        });
      }
    };
    $(fbTemplate).formBuilder(options);
  });

</script>
@endpush
