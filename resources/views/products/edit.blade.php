@extends('layouts.app')
@section('title','Add Products')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Edit Products</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Setting</a></li>
                <li class="breadcrumb-item active">Products</li>
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
                <h3 class="card-title text-center">Product Form</h3>
              </div>
              <form method="POST" action="{{ route('products.update', encrypt($product->id)) }}" > @csrf
                @method('put')     
                <div class="card-body">
                  <div class="form-group">
                    <label>Product Code<span style="color:red">*</span></label>
                    <input type="text" name="code" value="{{ old('code')??$product->code }}" class="form-control @error('code') is-invalid @enderror" placeholder="Product Code" required>
                    @error('code')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="name" value="{{ old('name')??$product->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Product Name" >
                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control summernote" rows="3">{{ old('description')??$product->description }}</textarea>
                    @error('description')
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
