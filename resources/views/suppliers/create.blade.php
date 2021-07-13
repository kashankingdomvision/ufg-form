
@extends('layouts.app')
@section('title','Create Supplier')
@section('content')
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
                <h4>Add Supplier</h4>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a>Home</a></li>
                  <li class="breadcrumb-item active">Supplier Management</li>
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
                  <h3 class="card-title">Supplier Form</h3>
                </div>
                <form method="POST" action="{{ route('suppliers.store') }}">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="">Name <span class="text-danger">*</span></label>
                      <input type="text" name="username"  class="form-control" placeholder="Name" value="{{old('username')}}" required>
                      <div class="alert-danger" style="text-align:center">{{$errors->first('username')}}</div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Email</label>
                      <input type="email" name="email"  class="form-control" placeholder="Email" value="{{old('email')}}" >
                      <div class="alert-danger" style="text-align:center">{{$errors->first('email')}}</div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Phone Number</label>
                      <input class="form-control" name="phone" placeholder="12345678" value="{{old('phone')}}">
                      <div class="alert-danger" style="text-align:center">{{$errors->first('phone')}}</div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Category  <span style="color:red">*</span></label>
                      <select name="categories[]" class="form-control select2" multiple="multiple" required>
                          <option  value="">Select Category</option>
                          @foreach ($categories as $category)
                          <option value="{{$category->id}}" {{ in_array($category->id, old('categories') ?? []) ? 'selected' : '' }} >{{$category->name}}</option>
                          @endforeach
                      </select>
                      <div class="alert-danger" style="text-align:center">{{$errors->first('categories')}}</div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Product</label>
                      <select name="products[]" class="form-control  " multiple >
                          @foreach ($products as $product)
                          <option value="{{$product->id}}" {{ in_array($product->id, old('products') ?? []) ? 'selected' : '' }} >{{$product->name}}</option>
                          @endforeach
                      </select>
                      <div class="alert-danger" style="text-align:center">{{$errors->first('products')}}</div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Currency</label>
                      <select name="currency" class="form-control ">
                          @foreach ($currencies as $currency)
                          <option value="{{$currency->id}}"  {{ (old("currency") == $currency->id ? "selected" : "") }} >{{ $currency->name }}</option>
                          @endforeach
                      </select>
                      <div class="alert-danger" style="text-align:center">{{$errors->first('currency')}}</div>
                    </div>
                    <div class="form-group">
                      <label  class="">Description :</label>
                      <textarea name="description"  class="form-control summernote">{{ old('description') }}</textarea>
                      <div class="alert-danger" style="text-align:center">{{$errors->first('email')}}</div>
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
