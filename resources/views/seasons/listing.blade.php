@extends('layouts.app')

@section('title','View Season')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h4>View Season <x-add-new-button :route="route('seasons.create')" /> </h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item"><a>Setting</a></li>
                        <li class="breadcrumb-item active">Seasons </li>
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

    <x-page-filters :route="route('seasons.index')">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Search</label>
                    <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
                </div>
            </div>
        </div>
    </x-page-filters>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Season List</h3>
                        </div>
                                    
                        <!-- Multi Actions -->
                        <div class="card-header">
                            <div class="row">
                            <form method="POST" id="season_bulk_action" action="{{ route('seasons.bulk.action') }}" >
                                @csrf
                                <input type="hidden" name="bulk_action_type" value="">
                                <input type="hidden" name="bulk_action_ids" value="">
            
                                <div class="dropdown show btn-group">
                                    <button type="button" class="btn btn-base btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <button type="button" data-action_type="delete" class="dropdown-item season-bulk-action-item">Delete</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        <!-- End Multi Actions -->
                        
                        <div class="card-body p-0" id="listing_card_body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="parent custom-control-input custom-control-input-success custom-control-input-outline" id="parent">
                                                    <label for="parent" class="custom-control-label"></label>
                                                </div>
                                            </th>
                                            <th>Season</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($seasons && $seasons->count())
                                        @foreach ($seasons as $key => $value)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="child_{{$value->id}}" value="{{$value->id}}" class="child custom-control-input custom-control-input-success custom-control-input-outline">
                                                        <label for="child_{{$value->id}}" class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $value->name }} &nbsp;
                                                    
                                                    @if ($value->default == 1)
                                                    <span class="btn btn-info badge">Default</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <form method="post" action="{{ route('seasons.destroy', encrypt($value->id)) }}">
                                                    <a href="{{ route('seasons.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
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
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $seasons->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
@push('js')
  <script src="{{ asset('js/setting.js') }}" ></script>
@endpush

{{-- <section class="content p-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <a href="" id="delete_all" class="btn btn-danger btn-sm">
                <span class="fa fa-trash"></span> &nbsp;
                <span>Delete Selected Record</span>
            </a>
        </div>
      </div>
    </div>
  </section> --}}
{{-- @include('includes.multiple_delete',['table_name' => 'seasons']) --}}
