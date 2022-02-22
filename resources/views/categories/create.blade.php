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

    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-md-10">
            <div class="card card-outline card-base">
              <div class="card-header">
                <h3 class="card-title text-center">Category Form</h3>
              </div>

              <div class="card-body">
                <form method="POST" action="{{ route('categories.store') }}" id="store_category" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                    <label>Category Name <span style="color:red">*</span></label>
                    <input type="text" name="name" id="name" class="form-control name" placeholder="Category Name" >
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label>Sort Order <span style="color:red">*</span></label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control sort-order" placeholder="Sort Order" >
                    <span class="text-danger" role="alert"></span>
                  </div>

                  <div class="form-group">
                    <label>Appeared In <span style="color:red">*</span></label>
                    <br>
                    <input type="hidden" name="quote" class="quote" value="0"><input id="quote"  type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"><label for="quote"> &nbsp; Quote</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="hidden" name="booking" class="booking" value="0"><input id="booking"  type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"><label for="booking"> &nbsp; Booking</label>
                  </div>

                  <div class="form-row parent">
                    <div class="col-md-12">
                      <label>Hide/Show First Time Feild <span style="color:red">*</span></label>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="d-flex flex-row">

                          <div class="custom-control custom-radio mr-1">
                            <input type="radio" name="show_tf" id="show_tf_hide" value="0" class="show-tf custom-control-input custom-control-input-success custom-control-input-outline" checked>
                            <label class="custom-control-label" for="show_tf_hide">Hide</label>
                          </div>
  
                          <div class="custom-control custom-radio mr-1">
                            <input type="radio" name="show_tf" id="show_tf_show" value="1" class="show-tf custom-control-input custom-control-input-success custom-control-input-outline">
                            <label class="custom-control-label" for="show_tf_show">Show</label>
                          </div>
                        </div>
                    
                      </div>
                    </div>

                    <div class="col-md-4 label-of-time-col d-none">
                      <div class="form-group">
                        <label>Set First Label of Time Feild <span style="color:red">*</span></label>
                        <input type="text" name="label_of_time" id="label_of_time" class="form-control label-of-time" placeholder="First Label Name" >
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

                        <div class="d-flex flex-row">
                          <div class="custom-control custom-radio mr-1">
                            <input type="radio" name="second_tf" id="second_tf_hide" value="0" class="show-tf custom-control-input custom-control-input-success custom-control-input-outline" checked>
                            <label class="custom-control-label" for="second_tf_hide"> Hide </label>
                          </div>
  
                          <div class="custom-control custom-radio mr-1">
                            <input type="radio" name="second_tf" id="second_tf_show" value="1" class="show-tf custom-control-input custom-control-input-success custom-control-input-outline">
                            <label class="custom-control-label" for="second_tf_show">Show </label>
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="col-md-4 label-of-time-col d-none">
                      <div class="form-group">
                        <label>Set Second Label of Time Feild <span style="color:red">*</span></label>
                        <input type="text" name="second_label_of_time" id="second_label_of_time" class="form-control second-label-of-time" placeholder="Second Label Name" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="hidden" name="set_end_date_of_service" class="set_end_date_of_service" value="0"><input id="set_end_date_of_service"  type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"><label for="set_end_date_of_service"> &nbsp; Set End Date of Serive</label>
                  </div>

                </form>
                
                <div id="store_category_form_builder_div"></div>
              </div>

              <div class="card-footer">
                <button type="button" id="store_category_submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('categories.index') }}"><button type="button" class="btn btn-danger float-right mr-2">Cancel</button></a>
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
@endpush

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
                <a href="{{ route('categories.index') }}" class="btn btn-danger float-right  mr-2">Cancel</a>
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
