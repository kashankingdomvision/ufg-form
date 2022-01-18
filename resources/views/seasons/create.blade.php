@extends('layouts.app')

@section('title','Add Season')

@section('content')
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Season</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item active">Season Management</li>
              </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Season Form</h3>
              </div>

              <form method="POST" action="{{ route('seasons.store') }}">
                @csrf

                <div class="card-body">

                  <div class="form-group">
                    <label>Season <span style="color:red">*</span></label>
                    <input type="text" name="name" id="seasons" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter the Season" >
                    
                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Start Date <span style="color:red">*</span></label>
                    <input type="date" name="start_date" value="{{old('start_date')}}" class="form-control  @error('start_date') is-invalid @enderror" placeholder="{{ date("d/m/Y") }}" autocomplete="off">

                    @error('start_date')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>End Date <span style="color:red">*</span></label>
                    <input type="date" name="end_date" value="{{old('end_date')}}" class="form-control date-picker @error('end_date') is-invalid @enderror" placeholder="{{ date("d/m/Y") }}" autocomplete="off">

                    @error('end_date')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                  <div class="form-group clearfix">
                    <label>Default Season <span style="color:red">*</span></label><br>
                    <div class="icheck-primary d-inline mr-1">
                      <input type="radio" id="yes" name="default" value="1">
                      <label for="yes">Yes</label>
                    </div>

                    <div class="icheck-primary  d-inline">
                      <input type="radio" id="no" name="default" value="0" checked>
                      <label for="no">No</label>
                    </div>
                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                <a href="{{ route('seasons.index') }}" class="btn btn-outline-danger buttonSumbit float-right mr-3">Cancel</a>
                  
                </div>

              </form>

            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
@endsection
