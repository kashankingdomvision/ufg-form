

@extends('layouts.app')

@section('title','Edit Currency')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Edit Currency</h4></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item"><a>Setting</a></li>
              <li class="breadcrumb-item active">Currency</li>
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
              <h3 class="card-title">Currency Form</h3>
            </div>

            <form method="POST" id="update_currency" action="{{ route('currencies.update', encrypt($currency->id)) }}">
              @csrf @method('put')

              <div class="card-body">
                <div class="form-group">
                  <label>Currency <span style="color:red">*</span></label>
                  <select name="currency" id="currency" class="form-control select2single" disabled>
                    <option value="">Select Currency</option>
                    @foreach ($currencies as $curr)
                      <option value="{{$curr->code}}" data-image="data:image/png;base64, {{$curr->flag}}" {{ $curr->code == $currency->code ? 'selected' : '' }}> &nbsp; {{$curr->code}} - {{$curr->name}} {{ ($currency->isObsolete == 1) ? '(obsolete)' : '' }} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div> 

                <div class="form-group clearfix">
                  <label>Status <span style="color:red">*</span></label><br>
                  <div class="icheck-primary d-inline mr-1">
                    <input type="radio" id="active" name="status" value="1" {{ $currency->status == 1 ? "checked" : "" }}>
                    <label for="active">Active</label>
                  </div>

                  <div class="icheck-primary d-inline">
                    <input type="radio" id="inactive" name="status" value="0" {{ $currency->status == 0 ? "checked" : "" }}>
                    <label for="inactive">Inactive</label>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('currencies.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
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