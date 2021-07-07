

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
          <div class="row">
            <div class="offset-md-2 col-md-8">

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Currency Form</h3>
                </div>

                <form method="POST" action="{{ route('setting.currency_conversions.update', encrypt($currency->id)) }}">
                  @csrf
                  @method('put')

                    <div class="card-body">
                      <div class="form-group">
                        <label>From <span class="text-danger">*</span></label>
                        <select name="from" class="form-control currencyImage @error('currency') is-invalid @enderror" required disabled>
                          <option value="">Select Currency</option>
                          @foreach ($currencies as $curr)
                            <option value="{{$curr->code}}" data-image="data:image/png;base64, {{$curr->flag}}" {{ $curr->code == $currency->from ? 'selected' : '' }}> &nbsp; {{$curr->code}} - {{$curr->name}} {{ ($currency->isObsolete == 1) ? '(obsolete)' : '' }} </option>
                          @endforeach
                        </select>
                      </div> 
              
                      <div class="form-group">
                        <label>To <span class="text-danger">*</span></label>
                        <select name="to" class="form-control currencyImage @error('currency') is-invalid @enderror" required disabled>
                          <option value="">Select Currency</option>
                          @foreach ($currencies as $curr)
                            <option value="{{$curr->code}}" data-image="data:image/png;base64, {{$curr->flag}}" {{ $curr->code == $currency->to ? 'selected' : '' }}> &nbsp; {{$curr->code}} - {{$curr->name}} {{ ($currency->isObsolete == 1) ? '(obsolete)' : '' }} </option>
                          @endforeach
                        </select>
                      </div> 

           
                      <div class="form-group">
                        <label>Manual Rate</label>
                        <div class="input-group">
                          <input type="number" name="manual" value="{{ $currency->manual }}" placeholder="0.00" step="any" min="0" step="any" class="form-control hide-arrows @error('manual') is-invalid @enderror">
                        </div>

                        @error('manual')
                          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
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
