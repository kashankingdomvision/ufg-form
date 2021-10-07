@extends('layouts.app')

@section('title','Add Commission Group')

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
                <li class="breadcrumb-item"><a>Commission Managment</a></li>
                <li class="breadcrumb-item active">Commission Group</li>
              </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center">Commission Group Form</h3>
              </div>

              <form method="POST" action="{{ route('commissions.commission-group.store') }}" >
                @csrf

                <div class="card-body">

                  <div class="form-group">
                    <label>Group Name <span style="color:red">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Group Name" >
                    
                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                </div> 

                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary float-right">Submit</button>
                  <a href="{{ route('commissions.commission-group.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
@endsection
