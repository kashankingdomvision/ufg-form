@extends('layouts.app')

@section('title','Edit Group Owner')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <h4>Edit Group Owner </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item"><a>Supplier Managment</a></li>
              <li class="breadcrumb-item active">Group Owners</li>
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
              <h3 class="card-title text-center">Group Owner Form</h3>
            </div>

            <form method="POST" id="update_group_owner" action="{{ route('group_owners.update', encrypt($group_owners->id)) }}">
              @csrf @method('put')

              <div class="card-body">
                <div class="form-group">
                  <label>Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" value="{{ !empty(old('name')) ? old('name') : $group_owners->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name" >
                  <span class="text-danger" role="alert"></span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('group_owners.index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
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
  <script src="{{ asset('js/supplier_management.js') }}" ></script>
@endpush
