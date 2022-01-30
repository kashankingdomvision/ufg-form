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
  
  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title text-center">Category Form</h3>
            </div>

            <div class="card-body">
              <form method="POST" id="update_category" action="{{ route('categories.update') }}">
                @csrf

                <input type="hidden" name="id" value="{{ encrypt($category->id) }}" class="form-control id">
                
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
              </form>

              <div id="form_builder_div"></div>
            </div>

            <div class="card-footer">
              <button type="button" id="update_category_submit" class="btn btn-primary float-right">Submit</button>
              <a href="{{ route('categories.index') }}"><button type="button" class="btn btn-default float-right mr-2">Cancel</button></a>
            </div>

            <input type="hidden" id="preset_form_data" value="{{ isset($category->feilds) ? $category->feilds : ''  }}">
            
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

  $(document).on('change', '.show-tf', function(){

    let value          = $(this).val();
    let relavantColumn = $(this).closest('.parent').find('.label-of-time-col');

    if(value == 1){
      relavantColumn.removeClass('d-none');
    }else{
      relavantColumn.addClass('d-none');
    }
  });

  $(document).on("click", ".del-button",function() {

    let parentLI    = $(this).closest('li');
    let elementName = parentLI.find('.frm-holder .form-elements .name-wrap .input-wrap .form-control').val();
    let categoryID  = $('input[name=id]').val();

    let data = {
      'id'            : categoryID,
      'element_name'  : elementName,
      "_token"        : CSRFTOKEN,
    };

    $.ajax({
      type: 'GET',
      url: `${BASEURL}remove-form-buidler-feild`,
      data: data,
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


  /* formbuilder function */
  var presetFormData = $('#preset_form_data').val();

  /* formbuilder function */
  var options = {
    disabledActionButtons: ['clear','data','save'],
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
      'toggle',
      // 'value',
    ],
    formData: presetFormData,
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
        }
      },
    },
    onAddField: function(fieldId, fieldData) {
      setFieldData(fieldData);
    },
    onOpenFieldEdit: function(field) {
      if(currentFieldData.type == "autocomplete"){

        /* By default hide options & remove child li */ 
        hideOptionsAndRemoveChildLI(field.id);

        let selector = `#${field.id} .form-elements .data-wrap .input-wrap select`;
        $(selector).on('change', function(){

          if($(this).val() === "none"){

            /* display options li */ 
            showOptions(field.id);
          } else {
            hideOptionsAndRemoveChildLI(field.id);
          }
        });

      } /* end if condition*/
      
    },
  }; /* options */

  var formBuilderDiv = $('#form_builder_div');
  var formBuilder    = $(formBuilderDiv).formBuilder(options);

  function setFieldData(fieldData){
    currentFieldData = fieldData;
  }
  
  function hideOptionsAndRemoveChildLI(fieldID){
    $(`#${fieldID} .field-options`).addClass("d-none");
    $(`#${fieldID} .sortable-options li`).remove();
  }

  function showOptions(fieldID){
    $(`#${fieldID} .field-options`).removeClass("d-none");
  }
  /* End formbuilder function */

  $(document).on('click', '#update_category_submit', function(){

    let formData       = formBuilder.actions.getData('json')
    let url            = $('#update_category').attr('action');
    let updateCategory = new FormData($('#update_category')[0]);
    formData           = (formData == '[]') ? '' : formData;
    updateCategory.append('feilds', formData);

    $.ajax({
      type: 'POST',
      url: url,
      data: updateCategory,
      processData: false,
      contentType: false,
      cache: false,
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
    }); /* end ajax*/

  });
}
</script>
@endpush

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
