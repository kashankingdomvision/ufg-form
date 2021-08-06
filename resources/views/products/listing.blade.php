@extends('layouts.app')
@section('title','View Products')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>View Products</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Supplier Managment</a></li>
 
          </ol>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-md-offset-3">
          @include('includes.flash_message')
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
        <div class="card card-default {{ (request()->has('search'))? '' : 'collapsed-card' }}">
          <button type="button" class="btn btn-tool m-0 text-dark" data-card-widget="collapse">
            <div class="card-header">
              <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters</b></h3>
              <div class="card-tools">
                  <i class="fas fa-{{ (request()->has('search'))? 'minus' : 'plus' }}"></i>
              </div>
            </div>
          </button>
 
            <div class="card-body">
                <form method="get" action="{{ route('products.index') }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Search</label>
                            <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
                    </div>
                </div>

            </form>
            </div>
        </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Products List</h3>
            </div>

            <div class="card-header">
              <h3 class="card-title float-left">
                <a href="" id="delete_all" class="btn btn-danger btn-xs btn-sm float-right">
                  <span class="fa fa-trash"></span> &nbsp;
                  <span>Delete Selected Record</span>
                </a>
              </h3>
              <a href="{{ route('products.create') }}" class="btn btn-secondary btn-sm float-right">
                <span class="fa fa-plus"></span>
                <span>Add New</span>
              </a>
            </div>


            <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-responsive table-hover">
                <thead>
                  <tr>
                    <th>
                      <div class="icheck-primary">
                        <input type="checkbox" class="parent">
                      </div>
                    </th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @if($products && $products->count())
                  @foreach ($products as $key => $product)
                  <tr>
                    <td>
                      <div class="icheck-primary">
                        <input type="checkbox" class="child" value="{{$product->id}}" >
                      </div>
                    </td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="d-flex">
                      <a href="{{ route('products.edit', encrypt($product->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                      <form method="post" action="{{ route('products.destroy', encrypt($product->id)) }}">
                        @csrf
                        @method('delete')
                        <button class="mr-2  btn btn-outline-danger btn-xs" title="Delete" onclick="return confirm('Are you sure want to Delete this record?');">
                          <span class="fa fa-trash"></span>
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                @else
                  <tr align="center"><td colspan="100%">No record found.</td></tr>
                @endif
                </tbody>
              </table>
            </div>
            </div>

            @include('includes.multiple_delete',['table_name' => 'products'])

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $products->links() }}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
