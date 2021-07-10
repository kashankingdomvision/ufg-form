@extends('layouts.app')

@section('title','Add Holiday Type')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Commissions</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Setting</a></li>
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

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title text-center">Commissions Form</h3>
              </div>

              <form method="POST" action="{{ route('setting.commissions.store') }}" >
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name <span style="color:red">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Commision Name" required>
                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                    <label>Percentage % <span style="color:red">*</span></label>
                    <input type="number" name="percentage" value="{{ old('percentage') }}" class="form-control @error('percentage') is-invalid @enderror" placeholder="Commision percentage %" required>
                    @error('percentage')
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
