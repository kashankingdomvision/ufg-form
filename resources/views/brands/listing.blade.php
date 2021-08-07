


@extends('layouts.app')

@section('title','View Brands')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>View Brands</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Brands</li>
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
          <div class="row">
            <button type="button" class="btn btn-tool m-0 text-dark  col-md-10" data-card-widget="collapse">
                <div class="card-header">
                  <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters</b></h3>
                </div>
            </button>

            <div class="float-right col-md-2">
                <a href="{{ route('setting.brands.create') }}" class="btn btn-secondary btn-sm  m-12 float-right">
                    <span class="fa fa-plus"></span>
                    <span>Add New</span>
                </a>
            </div>
          </div>
            <div class="card-body">
                <form method="get" action="{{ route('setting.brands.index') }}">
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
                        <a href="{{ route('setting.brands.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
                    </div>
                </div>

            </form>
            </div>
        </div>
    </div>
  </section>
  <section class="content p-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <a href="" id="delete_all" class="btn btn-danger btn-sm  ">
            <span class="fa fa-trash"></span> &nbsp;
            <span>Delete Selected Record</span>
          </a>
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
              <h3 class="card-title float-left">
                Brands List
              </h3>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>
                        <div class="icheck-primary">
                          <input type="checkbox" class="parent">
                        </div>
                      </th>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Address</th>
                      <th>Phone Number</th>
                      <th>Logo</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($brands && $brands->count())
                    @foreach ($brands as $key => $value)
                      <tr>
                        <td>
                          <div class="icheck-primary">
                            <input type="checkbox" class="child" value="{{$value->id}}" >
                          </div>
                        </td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->address  }}</td>
                        <td>{{ $value->phone  }}</td>
                        <td>@if($value->logo)<img src="{{ $value->image_path }}" width="30" height="30" alt="brand logo" /> @endif</td>
                        <td>
                          <form method="post" action="{{ route('setting.brands.destroy', encrypt($value->id)) }}">
                            <a href="{{ route('setting.brands.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
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

            @include('includes.multiple_delete',['table_name' => 'brands'])

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $brands->links() }}
              </ul>
            </div>
            
          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
