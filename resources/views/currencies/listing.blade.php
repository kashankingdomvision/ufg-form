


@extends('layouts.app')

@section('title','View Currencies')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>View Currency <x-add-new-button :route="route('currencies.create')" /> </h4>
          </div>
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
  
  <x-page-filters :route="route('currencies.index')">
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
              <h3 class="card-title float-left">
                Currency List
              </h3>
            </div>

            <!-- Multi Actions -->
            <div class="card-header">
              <div class="row">
                <form method="POST" id="currency_bulk_action" action="{{ route('currencies.bulk.action') }}" >
                  @csrf
                  <input type="hidden" name="bulk_action_type" value="">
                  <input type="hidden" name="bulk_action_ids" value="">

                  <div class="dropdown show btn-group">
                    <button type="button" class="btn btn-base btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Action
                    </button>
                    <div class="dropdown-menu">
                      <button type="button" data-action_type="active" class="dropdown-item currency-bulk-action-item">Active</button>
                      <button type="button" data-action_type="inactive" class="dropdown-item currency-bulk-action-item">Inactive</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- End Multi Actions -->

            <div class="card-body p-0" id="listing_card_body">
              <div class="table-responsive">
                <table class="table table-hover text-nowrap text-nowrap">
                  <thead>
                    <tr>
                      <th width="8">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="parent custom-control-input custom-control-input-success custom-control-input-outline" id="parent">
                          <label for="parent" class="custom-control-label"></label>
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
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" id="child_{{$value->id}}" value="{{$value->id}}" class="child custom-control-input custom-control-input-success custom-control-input-outline">
                              <label for="child_{{$value->id}}" class="custom-control-label"></label>
                            </div>
                          </td>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->code }}</td>
                          <td>{{ $value->status == 1 ? 'Active' : 'Inactive' }}</td>
                          <td>
                            <a href="{{ route('currencies.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
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

@push('js')
  <script src="{{ asset('js/setting.js') }}" ></script>
@endpush