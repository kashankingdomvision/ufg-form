

@extends('layouts.app')

@section('title','Edit Currency')

@section('content')
    <div class="content-wrapper">

      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
                <h4>Edit Currency</h4>
              </div>
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
          <div class="row">
            <div class="offset-md-2 col-md-8">

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Currency Form</h3>
                </div>

                <form method="POST" action="{{ route('setting.currencies.update', encrypt($currency->id)) }}">
                  @csrf
                  @method('put')

                    <div class="card-body">
                      <div class="form-group">
                        <label>Currencies <span style="color:red">*</span></label>
                        <select name="currency" class="form-control select2single currencyImage @error('currency') is-invalid @enderror" required disabled>
                          <option value="">Select Currency</option>
                          @foreach ($currencies as $curr)
                            <option value="{{$curr->code}}" data-image="data:image/png;base64, {{$curr->flag}}" {{ $curr->code == $currency->code ? 'selected' : '' }}> &nbsp; {{$curr->code}} - {{$curr->name}} {{ ($currency->isObsolete == 1) ? '(obsolete)' : '' }} </option>
                          @endforeach
                        </select>

                        @error('currency')
                          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
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
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                  </div>

                </form>
              </div>


            </div>

          </div>
        </div>
      </section>

    </div>
@endsection
