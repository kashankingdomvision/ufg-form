@extends('layouts.app')

@section('title','View Harbour')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>View Harbours, Train and Points of Interest <x-add-new-button :route="route('setting.harbours.create')" /> </h4>
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Harbours, Train and Points of Interest</li>
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
  
  <x-page-filters :route="route('setting.harbours.index')">
      <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                  <label>Search</label>
                  <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
              </div>
          </div>
      </div>
  </x-page-filters>
  
  <section class="content p-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <a href="" id="delete_all" class="btn btn-danger btn btn-sm">
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
                Harbours, Train and Points of Interest List
              </h3>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped  table-hover">
                  <thead>
                    <tr>
                      <th>
                        <div class="icheck-primary">
                          <input type="checkbox" class="parent">
                        </div>
                      </th>
                      <th>Port ID</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($harbours && $harbours->count())
                    @foreach ($harbours as $key => $value)
                    <tr>
                      <td>
                        <div class="icheck-primary">
                          <input type="checkbox" class="child" value="{{$value->id}}" >
                        </div>
                      </td>
                      <td>{{ $value->port_id }}</td>
                      <td>{{ $value->name }}</td>
                      <td>
                        <form method="post" action="{{ route('setting.harbours.destroy', encrypt($value->id)) }}">
                        <a href="{{ route('setting.harbours.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
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

            @include('includes.multiple_delete',['table_name' => 'harbours'])

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $harbours->links() }}
              </ul>
            </div>

          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
