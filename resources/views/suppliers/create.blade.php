
@extends('layouts.app')
@section('title','Add Supplier')
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
                      <label for="inputEmail3" class="">Name <span style="color:red">*</span></label>
                      <input type="text" name="username"  class="form-control @error('username') is-invalid @enderror" placeholder="Name" value="{{old('username')}}" required>

                      @error('username')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Email <span style="color:red">*</span></label>
                      <input type="email" name="email"  class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}" required>
                      @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Phone Number</label>
                      <br />
                      <input type="tel"  name="phone" class="form-control phone phone0" value="{{old('phone')}}">
                      <div class="alert-danger" style="text-align:center">{{$errors->first('phone')}}</div>
                      <span class="text-danger error_msg0 hide" role="alert"></span>
                      <span class="text-success valid_msg0 hide" role="alert"></span>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Categories <span style="color:red">*</span></label>
                      <select name="categories[]" class="form-control select2-multiple @error('categories') is-invalid @enderror" multiple="multiple" required>
                          @foreach ($categories as $category)
                          <option value="{{$category->id}}" {{ in_array($category->id, old('categories') ?? []) ? 'selected' : '' }} >{{$category->name}}</option>
                          @endforeach
                      </select>
                      @error('categories')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="">Products <span style="color:red">*</span></label>
                      <select name="products[]" class="form-control select2-multiple @error('products') is-invalid @enderror" multiple="multiple" required>
                        @foreach ($products as $product)
                          <option value="{{$product->id}}" {{ in_array($product->id, old('products') ?? []) ? 'selected' : '' }} >{{$product->name}}</option>
                        @endforeach
                      </select>
                      @error('products')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="">Currency</label>
                      <select name="currency" class="form-control select2single" >
                          @foreach ($currencies as $currency)
                          <option value="{{$currency->id}}" data-image="data:image/png;base64, {{$currency->flag}}"  {{ (old("currency") == $currency->id ? "selected" : "") }} >{{ $currency->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label  class="">Description :</label>
                      <textarea name="description"  class="form-control summernote">{{ old('description') }}</textarea>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary buttonSumbit float-right">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection
