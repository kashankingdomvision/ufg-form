


@extends('layouts.app')

@section('title','View Currencies')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>View Currency</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Currency</li>
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
                <a href="{{ route('setting.currencies.create') }}" class="btn btn-secondary btn-sm  m-12 float-right">
                    <span class="fa fa-plus"></span>
                    <span>Add New</span>
                </a>
            </div>
          </div>
 
            <div class="card-body">
                <form method="get" action="{{ route('setting.currencies.index') }}">
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
                        <a href="{{ route('setting.currencies.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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
            <form method="POST" action="{{ route('currency.status') }}" id="currencyStatus">
                @csrf @method('post')
                <div class="dropdown show">
                    <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <button type="submit" name="active" class="dropdown-item btn-link active btnbulkClick">Active</button>
                        <button type="submit" name="inactive" class="dropdown-item btn-link inactive btnbulkClick">In-Active</button>
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
                Currency List
              </h3>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th width="8">
                        <div class="icheck-primary">
                            <input type="checkbox" class="parent">
                        </div>
                      </th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($currencies && $currencies->count())
                      @foreach ($currencies as $key => $value)
                        <tr>
                          <td>
                            <div class="icheck-primary">
                                <input type="checkbox" class="child" value="{{$value->id}}" >
                            </div>
                          </td>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->code }}</td>
                          <td>{{ $value->status == 1 ? 'Active' : 'Inactive' }}</td>
                          <td>
                            <a href="{{ route('setting.currencies.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
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

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $currencies->links() }}
              </ul>
            </div>
            
          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
