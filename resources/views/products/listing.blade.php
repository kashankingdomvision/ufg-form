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
            <div class="card-header">
                <h3 class="card-title"><b>Filters</b></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-{{ (request()->has('search'))? 'minus' : 'plus' }}"></i>
                    </button>
                </div>
            </div>
 
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
                        <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Search</button>
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
            <div class="card-body p-0">
             table-striped
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $key => $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="d-flex">
                      <a href="{{ route('products.edit', encrypt($product->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                      <form method="post" action="{{ route('products.destroy', encrypt($product->id)) }}">
                        @csrf
                        @method('delete')
                        <button class="mr-2  btn btn-outline-danger btn-xs" onclick="return confirm('Are you sure want to Delete this record?');">
                          <span class="fa fa-trash"></span>
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
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
