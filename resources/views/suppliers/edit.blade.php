@extends('layouts.app')
@section('title','Edit Supplier')
@section('content')
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
                <h4>Edit Supplier</h4>
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
                <form method="POST" action="{{ route('suppliers.update', encrypt($supplier->id) ) }}">
                  @csrf @method('put')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="">Name <span style="color:red">*</span></label>
                      <input type="text" name="username"  class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{$supplier->name}}" required>

                      @error('username')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Email</label>
                      <input type="email" name="email"  class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{$supplier->email}}" required>
                       
                      @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Phone Number</label>
                      <input type="tel" class="form-control phone phone0" type="tel" name="phone" placeholder="12345678" value="{{$supplier->phone}}">
                      <div class="alert-danger" style="text-align:center">{{$errors->first('phone')}}</div>
                      <span class="text-danger error_msg0 hide" role="alert"></span>
                      <span class="text-danger valid_msg0 hide" role="alert"></span>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="">Category <span style="color:red">*</span></label>
                      <select name="categories[]" class="form-control select2-multiple @error('categories') is-invalid @enderror" multiple required>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}"  {{ (in_array($category->id, $supplier->getCategories()->pluck('id')->toArray()))? 'selected' : NULL }}>{{ $category->name }}</option>
                          @endforeach
                      </select>

                      @error('categories')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
      
                    <div class="form-group">
                      <label for="inputEmail3" class=""> Products <span style="color:red">*</span></label>
                      <select name="products[]" class="form-control select2-multiple @error('products') is-invalid @enderror" multiple required>
                        @foreach ($products as $product)
                          <option value="{{$product->id}}" {{ (in_array($product->id, $supplier->getProducts()->pluck('id')->toArray()) )? 'selected' : NULL}} >{{$product->name}}</option>
                        @endforeach
                      </select>

                      @error('products')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
      
                    <div class="form-group">
                      <label for="inputEmail3" class="">Currecy</label>
                      <select name="currency" class="form-control  select2single  ">
                          <option value="">Select Currecy</option>
                          @foreach ($currencies as $currency)
                            <option value="{{$currency->id}}" {{ ($currency->id == $supplier->currency_id)? "selected" : ((old('currency') == $currency->id)? 'selected' : NULL) }}>{{ $currency->name }}</option>
                          @endforeach
                      </select>
                      <div class="alert-danger" style="text-align:center">{{$errors->first('currency')}}</div>
                    </div>
                    <div class="form-group">
                      <label  class="">Description :</label>
                      <textarea name="description"  class="form-control summernote">{{ $supplier->description }}</textarea>
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
