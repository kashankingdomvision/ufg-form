{{-- @extends('content_layout.default')

@section('content') 
<div class="content-wrapper">
  <section class="content-header">
      <h1> Add New Category </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ route('categories.index') }}" class="btn btn-primary btn-xs" ><span class="fa fa-eye">View All Categories</span></a>
        </li>
      </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="col-sm-6 col-sm-offset-3">
            @if(Session::has('success_message'))
            <li> <div class="alert alert-success">{{Session::get('success_message')}}</div> </li>
            @endif
          </div>
          <form method="POST" action="{{ route('categories.store') }}"> @csrf
            <div class="box-body">
              <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                  <label for="inputEmail3" class="">Category Name <span style="color:red">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Name','required'=>'true']) !!}
                  </div>
                  <div class="alert-danger" style="text-align:center">{{$errors->first('name')}}</div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              {!! Form::submit('Submit',['required' => 'required','class'=>'btn btn-info pull-right']) !!}
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection --}}


@extends('layouts.app')
@section('title','Add Products')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Category</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Setting</a></li>
                <li class="breadcrumb-item active">Category</li>
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
                <h3 class="card-title text-center">Category Form</h3>
              </div>
              <form method="POST" action="{{ route('categories.store') }}" >
                @csrf 
                <div class="card-body">
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Product Name" >
                    @error('name')
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
