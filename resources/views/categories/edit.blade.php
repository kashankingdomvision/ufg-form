@extends('layouts.app')
@section('title','Edit Category')
@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Edit Category</h4>
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
              <form method="POST" action="{{ route('categories.update', encrypt($category->id)) }}" >
                @method('put') @csrf 
                <div class="card-body">
                  <div class="form-group">
                    <label>Category Name <span style="color:red">*</span></label>
                    <input type="text" name="name" value="{{ old('name')??$category->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Category Name" required>
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

              {{-- {{ dd($category->feilds) }} --}}

              <div class="card-body">
                <input type="hidden" name="id" value="{{ encrypt($category->id) }}" class="form-control id">
                <input type="hidden" name="category_id" value="{{ $category->id }}" class="form-control category-id">
                <input type="hidden" name="category_slug" value="{{ $category->slug }}" class="form-control category-slug">

                <div class="form-group">
                  <label>Category Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control name" placeholder="Category Name" >
                  <span class="text-danger" role="alert"></span>
                </div>

                
                <div class="form-group">
                  <label>Sort Order <span style="color:red">*</span></label>
                  <input type="number" name="sort_order" value="{{$category->sort_order}}" id="sort_order" class="form-control sort-order" placeholder="Sort Order" >
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Appeared In <span style="color:red">*</span></label>
                  <br>
                  <input type="hidden" name="quote" class="quote" value="{{$category->quote}}"><input id="quote"  type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($category->quote == 1) ? 'checked': '' }}><label for="quote"> &nbsp; Quote</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="hidden" name="booking" class="booking" value="{{$category->booking}}"><input id="booking"   type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($category->booking == 1) ? 'checked': '' }}><label for="booking" > &nbsp; Booking</label>
                </div>

                <div class="form-row parent">
                  <div class="col-md-12">
                    <label>Hide/Show First Time Feild <span style="color:red">*</span></label>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="radio-inline mr-1">
                        <input type="radio" name="show_tf" value="0" class="show-tf" {{ ($category->show_tf == 0) ? 'checked' : '' }}>
                        <span>&nbsp;Hide</span>
                      </label>
                      <label class="radio-inline mr-1">
                        <input type="radio" name="show_tf" value="1" class="show-tf" {{ ($category->show_tf == 1) ? 'checked' : '' }}>
                        <span>&nbsp;Show</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-4 label-of-time-col {{ $category->show_tf == 1 ? '' : 'd-none' }} ">
                    <div class="form-group">
                      <label>Set First Label of Time Feild <span style="color:red">*</span></label>
                      <input type="text" name="label_of_time" id="label_of_time" value="{{ $category->label_of_time }}" class="form-control label-of-time" placeholder="Label Name" >
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                </div>

                <div class="form-row parent">
                  <div class="col-md-12">
                    <label>Hide/Show Second Time Feild <span style="color:red">*</span></label>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="radio-inline mr-1">
                        <input type="radio" name="second_tf" value="0" class="show-tf" {{ ($category->second_tf == 0) ? 'checked' : '' }}>
                        <span>&nbsp;Hide</span>
                      </label>
                      <label class="radio-inline mr-1">
                        <input type="radio" name="second_tf" value="1" class="show-tf" {{ ($category->second_tf == 1) ? 'checked' : '' }}>
                        <span>&nbsp;Show</span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-4 label-of-time-col {{ $category->second_tf == 1 ? '' : 'd-none' }} ">
                    <div class="form-group">
                      <label>Set Second Label of Time Feild <span style="color:red">*</span></label>
                      <input type="text" name="second_label_of_time" value="{{ $category->second_label_of_time }}" id="second_label_of_time" class="form-control second-label-of-time" placeholder="Second Label Name" >
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <input type="hidden" name="set_end_date_of_service" class="set_end_date_of_service" value="{{$category->set_end_date_of_service}}"><input id="set_end_date_of_service" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" {{ ($category->set_end_date_of_service == 1) ? 'checked': '' }}><label for="set_end_date_of_service"> &nbsp; Set End Date of Serive</label>
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
<script src="{{ asset('js/category_app.js') }}" ></script>
<script>

window.onload = function() {
  var presetData = {!! json_encode($category->feilds, JSON_HEX_TAG) !!};

  $(document).on('change', '.show-tf', function(){

    var value = $(this).val();

    if(value == 1){

      $(this).closest('.parent').find('.label-of-time-col').removeClass('d-none');

    }else{

      $(this).closest('.parent').find('.label-of-time-col').addClass('d-none');
    }
  });

  $(document).on("click", ".del-button",function() {

    var parentLI    = $(this).closest('li');
    var elementName = parentLI.find('.frm-holder .form-elements .name-wrap .input-wrap .form-control').val();
    var id          = $('input[name=id]').val();

    var data = {
      'id'            : id,
      'element_name'  : elementName,
      "_token"        : "{{ csrf_token() }}",
    };

    $.ajax({
      type: 'GET',
      url: `${window.location.origin}/ufg-form/public/json/remove-form-buidler-feild`,
      data: {
        'id'            : id,
        'element_name'  : elementName,
        "_token"        : "{{ csrf_token() }}",
      },
      success: function(data){
        if(data && data.status == true){
          alert(data.success_message);
          return;
        }

        parentLI.remove();
      },
      error: function(reject) {

        if(reject.status === 422) {
          var errors = $.parseJSON(reject.responseText);
        }
      },
    });
    
  });

  jQuery(function($) {
    
    var currFieldData;
    var fbTemplate = document.getElementById('build-wrap'),
      options = {
        // fieldRemoveWarn: true,
        // disabledActionButtons: ['clear','data'],
        disableFields: ['file','hidden','button'],
        disabledAttrs: [
          'className',
          'description',
          'maxlength',
          'name',
          'other',
          'required',
          'rows',
          'step',
          'style',
          'access',
          'accept',
          // 'value',
        ],
        formData: presetData,
        typeUserAttrs: {
          autocomplete: {
              data: {
                  label: 'Type',
                  /* options keys should be related table name */ 
                  options: {
                    'airport_codes' : 'Airport Codes',
                    'harbours'      : 'Harbours, Train and Points of Interest',
                    'hotels'        : 'Hotels',
                    'all'           : 'All',
                    'group_owners'  : 'Group Owner',
                    'none'          : 'None',
                  },
              },
          }
        },
        onAddField: function(fieldId, fieldData) {
          getFieldData(fieldData);
        },
        onOpenFieldEdit: function(field, fieldData) {
          if(currFieldData.type == "autocomplete")
          {
            var currFieldId = document.querySelectorAll(`#`+field.id+` SELECT`)[0].id;

            var elem = document.querySelector(`#`+field.id+` .field-options`);
            elem.classList.add("d-none");

            emptyLi(`#`+field.id+` .sortable-options LI`);

            $('#'+currFieldId).on('change', function()
            {
              if($(this).val() === "none")
              {
                elem.classList.remove("d-none");
              } else {
                elem.classList.add("d-none");
                emptyLi(`#`+field.id+` .sortable-options LI`);
              }
            });
          }
        },
        onSave: function (evt, formData) {

          var categoryName             = $('.name').val();
          var id                       = $('.id').val();
          var quote                    = $('.quote').val();
          var booking                  = $('.booking').val();
          var sort_order               = $('.sort-order').val();
          var set_end_date_of_service  = $('.set_end_date_of_service').val();
          var show_tf                 = $("input[name=show_tf]:checked").val();
          var label_of_time           = $(".label-of-time").val();
          var second_tf               = $("input[name=second_tf]:checked").val();
          var second_label_of_time    = $(".second-label-of-time").val();
          var url                      = '{{route('categories.update' )}}';

          if(formData == '[]'){
            formData = '';
          }

          var data = {
            id         : id,
            name       : categoryName,
            feilds     : formData,
            quote      : quote,
            booking    : booking,
            sort_order : sort_order,
            set_end_date_of_service : set_end_date_of_service,
            show_tf : show_tf,
            label_of_time : label_of_time,
            second_tf : second_tf,
            second_label_of_time : second_label_of_time,
            "_token"   : "{{ csrf_token() }}",
          };

          $.ajax({
            type: "POST",
            url: url,
            data: JSON.stringify(data),
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
            dataType: 'json',
            headers: {
                'Content-Type':'application/json'
            }
          });


          // $.ajax({
          //   type: 'POST',
          //   url: url,
          //   data: data,
          //   beforeSend: function() {
          //     $('input, select').removeClass('is-invalid');
          //     $('.text-danger').html('');
          //     $("#overlay").addClass('overlay');
          //     $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
          //   },
          //   success: function(data) {
          //     $("#overlay").removeClass('overlay').html('');
              
          //     setTimeout(function() {

          //       if(data && data.status == true){
          //         alert(data.success_message);
          //         window.location.href = '{{route('categories.index')}}';
          //       }
          //     }, 200);
          //   },
          //   error: function(reject) {

          //     if (reject.status === 422) {

          //       var errors = $.parseJSON(reject.responseText);
          //       var flag = true;

          //       setTimeout(function() {

          //         $("#overlay").removeClass('overlay').html('');

          //         jQuery.each(errors.errors, function(index, value) {

          //           index = index.replace(/\./g, '_');

          //           $(`#${index}`).addClass('is-invalid');
          //           $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

          //           if(flag){
          //             $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
          //             flag = false;
          //           }

          //         });
          //       }, 400);
          //     }
              
          //   },
          //   headers: {
          //     'Content-Type':'application/json'
          //   }
          // });

        }
      };

      $(fbTemplate).formBuilder(options);

      function emptyLi(fvalue)
      {
        const elemLi = document.querySelectorAll(fvalue);
        for (const remElemLi of elemLi) {
          remElemLi.parentNode.removeChild(remElemLi);
        }
      }
      
      function getFieldData(fieldData)
      {
        currFieldData = fieldData;
      }
      
    });

} // end window onload

</script>
@endpush
