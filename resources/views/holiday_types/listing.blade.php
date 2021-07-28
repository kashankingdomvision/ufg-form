


@extends('layouts.app')

@section('title','View Holiday Types')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>View Holiday Type</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Holiday Type</li>
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
                <form method="get" action="{{ route('setting.holidaytypes.index') }}">
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
                        <a href="{{ route('setting.holidaytypes.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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
              <h3 class="card-title float-left">
                Holiday Type List
              </h3>

            </div>

            <div class="card-header">
              <h3 class="card-title float-left">
                <a href="" id="delete_all" class="btn btn-danger btn-xs btn-sm float-right">
                  <span class="fa fa-trash"></span> &nbsp;
                  <span>Delete Selected Record</span>
                </a>
              </h3>
              <a href="{{ route('setting.holidaytypes.create') }}" class="btn btn-secondary btn-sm float-right">
                <span class="fa fa-plus"></span>
                <span>Add New</span>
              </a>
            </div>

            <div class="card-body p-0">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>
                      <div class="icheck-primary">
                        <input type="checkbox" class="parent">
                      </div>
                    </th>
                    <th>Holiday Type</th>
                    <th>Brand</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if($holiday_types && $holiday_types->count())
                    @foreach ($holiday_types as $value)
                      <tr>
                        <td>
                          <div class="icheck-primary">
                            <input type="checkbox" class="child" value="{{$value->id}}" >
                          </div>
                        </td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->getBrand->name ?? NULL }}</td>
                        <td>
                          <form method="post" action="{{ route('setting.holidaytypes.destroy', encrypt($value->id)) }}">
                            <a href="{{ route('setting.holidaytypes.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
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

            @include('includes.multiple_delete',['table_name' => 'holiday_types'])

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $holiday_types->links() }}
              </ul>
            </div>
            
          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
