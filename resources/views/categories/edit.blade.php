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

          <div class="card card-secondary shadow-sm">
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

              <input type="hidden" id="preset_category_form_data" value="{{ isset($category->feilds) ? $category->feilds : ''  }}">
              <div id="update_category_form_builder_div"></div>
            </div>

            <div class="card-footer">
              <button type="button" id="update_category_submit" class="btn btn-success float-right">Submit</button>
              <a href="{{ route('categories.index') }}"><button type="button" class="btn btn-default float-right mr-2">Cancel</button></a>
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
<script src="{{ asset('js/supplier_management.js') }}" ></script>
<script>

window.onload = function() {







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
