@extends('layouts.app')

@section('title','Edit Commissions')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6"><h4>Edit Commissions</h4></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item"><a>Commission Managment</a></li>
              <li class="breadcrumb-item active">Commissions</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">
            <div class="card card-outline card-base">
              <div class="card-header">
                <h3 class="card-title text-center">Commissions Form</h3>
              </div>

              <form method="POST" id="update_commission" action="{{ route('commissions.update', encrypt($commission->id)) }}" >
                @csrf @method('put')

                <div class="card-body">
                  <div class="form-group">
                    <label>Name <span style="color:red">*</span></label>
                    <input type="text" name="name" id="name" value="{{ $commission->name }}" class="form-control" placeholder="Commission Name">
                    <span class="text-danger" role="alert"></span>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success float-right">Submit</button>
                  <a href="{{ route('commissions.index') }}" class="btn btn-danger float-right  mr-2">Cancel</a>
                </div>
              </form>

              <div id="overlay" class=""></div>
            </div>
        </div>
      </div>
    </section>

  </div>
@endsection

@push('js')
  <script src="{{ asset('js/commission_management.js') }}" ></script>
@endpush

{{-- <div class="form-group">
<label>Percentage % <span style="color:red">*</span></label>
<input type="number" name="percentage" value="{{ $commission->percentage }}" class="form-control @error('percentage') is-invalid @enderror" placeholder="Commission Percentage %" required>

@error('percentage')
<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
@enderror
</div> --}}
