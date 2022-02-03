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

              <form method="POST" id="store_commission_group" action="{{ route('commission_group.store') }}" >
                @csrf

                <div class="card-body">
                  <div class="form-group">
                    <label>Group Name <span style="color:red">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Group Name" >
                    <span class="text-danger" role="alert"></span>
                  </div>
                </div> 

                <div class="card-footer">
                  <button type="submit" class="btn btn-success float-right">Submit</button>
                  <a href="{{ route('commission_group.index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
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
  <script src="{{ asset('js/commission_management.js') }}" ></script>
@endpush