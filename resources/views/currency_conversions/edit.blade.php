

@extends('layouts.app')

@section('title','Edit Currency Rate')

@section('content')
    <div class="content-wrapper">

      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
                <h4>Edit Currency Rate</h4>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a>Home</a></li>
                    <li class="breadcrumb-item"><a>Setting</a></li>
                    <li class="breadcrumb-item active">View Currency Rate</li>
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
                  <h3 class="card-title">Currency Form</h3>
                </div>

                <form method="POST" id="update_currency_conversion" action="{{ route('currency_conversions.update', encrypt($currency->id)) }}">
                  @csrf
                  @method('put')

                    <div class="card-body">

                      <div class="form-group">
                        <label>From <span class="text-danger">*</span></label>
                        <select name="from" class="form-control select2single  @error('currency') is-invalid @enderror" required disabled>
                          <option value="">Select Currency</option>
                          @foreach ($currencies as $curr)
                            <option value="{{$curr->code}}" data-image="data:image/png;base64, {{$curr->flag}}" {{ $curr->code == $currency->from ? 'selected' : '' }}> &nbsp; {{$curr->code}} - {{$curr->name}} {{ ($currency->isObsolete == 1) ? '(obsolete)' : '' }} </option>
                          @endforeach
                        </select>
                      </div> 
              
                      <div class="form-group">
                        <label>To <span class="text-danger">*</span></label>
                        <select name="to" class="form-control select2single  @error('currency') is-invalid @enderror" required disabled>
                          <option value="">Select Currency</option>
                          @foreach ($currencies as $curr)
                            <option value="{{$curr->code}}" data-image="data:image/png;base64, {{$curr->flag}}" {{ $curr->code == $currency->to ? 'selected' : '' }}> &nbsp; {{$curr->code}} - {{$curr->name}} {{ ($currency->isObsolete == 1) ? '(obsolete)' : '' }} </option>
                          @endforeach
                        </select>
                      </div> 

                      <div class="form-group">
                        <label>Manual Rate</label>
                          <input type="number" name="manual" id="manual" value="{{ $currency->manual }}" placeholder="0.00" step="any" min="0" step="any" class="form-control hide-arrows @error('manual') is-invalid @enderror">
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">Submit</button>
                    <a href="{{ route('currency_conversions.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
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

