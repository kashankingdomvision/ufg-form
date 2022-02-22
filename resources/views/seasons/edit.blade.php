@extends('layouts.app')

@section('title','Edit Season')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-6"><h4>Edit Season</h4></div>
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
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card card-outline card-base">
            <div class="card-header">
              <h3 class="card-title text-center">Season Form</h3>
            </div>

            <form method="POST" id="update_season" action="{{ route('seasons.update',  encrypt($season->id)) }}">
              @csrf @method('put')

              <div class="card-body">
                <div class="form-group">
                  <label>Season Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" value="{{$season->name}}" class="form-control" maxlength="9" autocomplete="off" placeholder="Enter the Season Name">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Start Date <span style="color:red">*</span></label>
                  <input type="date" name="start_date" id="start_date" value="{{$season->start_date}}" class="form-control date-picker" placeholder="{{ date("d/m/Y") }}" autocomplete="off">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>End Date <span style="color:red">*</span></label>
                  <input type="date" name="end_date" id="end_date" value="{{$season->end_date}}" class="form-control date-picker" placeholder="{{ date("d/m/Y") }}" autocomplete="off">
                  <span class="text-danger" role="alert"></span>
                </div>


                <div class="form-group">
                  <label>Default Season <span style="color:red">*</span></label><br>
                  <div class="d-flex flex-row">
                    <div class="custom-control custom-radio mr-1">
                      <input type="radio" id="yes" name="default" class="custom-control-input custom-control-input-success custom-control-input-outline" value="1" {{ $season->default == "1" ? "checked" : "" }}>
                      <label class="custom-control-label" for="yes">Yes</label>
                    </div>

                    <div class="custom-control custom-radio mr-1">
                      <input type="radio" id="no" name="default" class="custom-control-input custom-control-input-success custom-control-input-outline" value="0" {{ $season->default == "0" ? "checked" : "" }}>
                      <label class="custom-control-label" for="no">No</label>
                    </div>
                  </div>
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('seasons.index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
              </div>
            </form>

            <div id="overlay" class=""></div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection

@push('js')
  <script src="{{ asset('js/setting.js') }}" ></script>
@endpush