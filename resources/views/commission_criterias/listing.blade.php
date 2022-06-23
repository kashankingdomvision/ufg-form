@extends('layouts.app')

@section('title','View Commission Criteria')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>View Commission Criteria
              <x-add-new-button :route="route('commission_criterias.create')" />
            </h4>
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Commission Managment</a></li>
            <li class="breadcrumb-item active">Commission Criteria</li>
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

  <x-page-filters :route="route('commission_criterias.index')">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Holiday Types</label>
          <select class="form-control select2single" name="holiday_type">
            <option value="" selected>Select Holiday Types</option>
            @foreach ($holiday_types as $holidays)
            <option value="{{ $holidays->name }}" {{ (old('holiday_type') == $holidays->name)? 'selected': ((request()->get('holiday_type') == $holidays->name)? 'selected' : null) }}>{{ $holidays->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
            <label>Booking Season</label>
            <select class="form-control select2single" name="booking_season">
                <option value="" selected >Select Booking Season</option>
                @foreach ($booking_seasons as $seasons)
                    <option value="{{ $seasons->name }}" {{ (old('booking_season') == $seasons->name)? 'selected': ((request()->get('booking_season') == $seasons->name)? 'selected' : null) }}>{{ $seasons->name }}</option>
                @endforeach
            </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
            <label>Booking Currency</label>
            <select class="form-control select2-multiple "  data-placeholder="Select Booking Currency" multiple name="booking_currency[]">
                @foreach ($currencies as $curren)
                    <option value="{{ $curren->id }}" data-image="data:image/png;base64, {{$curren->flag}}" {{ (old('booking_currency') == $curren->id)? 'selected': ( (!empty(request()->get('booking_currency')))? (((in_array($curren->id, request()->get('booking_currency'))))? 'selected' : null) : '') }}> &nbsp; {{$curren->code}} - {{$curren->name}} </option>
                @endforeach
            </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
            <label>Brand</label>
            <select class="form-control select2-multiple "  data-placeholder="Select Brands" multiple name="brand[]">
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ (in_array($brand->id,[old('brand')]))? 'selected': ( (!empty(request()->get('brand')))? ((in_array($brand->id, request()->get('brand')))? 'selected' : null): '') }}>{{ $brand->name }} </option>
                @endforeach
            </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
            <label>Search</label>
            <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="Search by Name">
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
                Commission Criteria List
              </h3>
            </div>
            <!-- Multi Actions -->
            <div class="card-header">
              <div class="row">
                <form method="POST" id="commission_criteria_bulk_action" action="{{ route('commission_criterias.bulk.action') }}">
                  @csrf
                  <input type="hidden" name="bulk_action_type" value="">
                  <input type="hidden" name="bulk_action_ids" value="">

                  <div class="dropdown show btn-group">
                    <button type="button" class="btn btn-base btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Action
                    </button>
                    <div class="dropdown-menu">
                      <button type="button" data-action_type="delete" class="dropdown-item commission-criteria-bulk-action-item"><i class="fa fa-trash text-red mr-2"></i>Delete</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- End Multi Actions -->

            <div class="card-body p-0" id="listing_card_body">
              <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="parent custom-control-input custom-control-input-success custom-control-input-outline" id="parent">
                          <label for="parent" class="custom-control-label"></label>
                        </div>
                      </th>
                      <th>Name</th>
                      {{-- <th>Commission</th> --}}
                      {{-- <th>Commission Group</th> --}}
                      <th>Percentage</th>
                      <th>Booking Currency</th>
                      <th>Brand</th>
                      <th>Holiday Type</th>
                      <th>Seasons</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($commission_criterias && $commission_criterias->count())
                    @foreach ($commission_criterias as $commission_criteria)
                    <tr>
                      <td>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" id="child_{{$commission_criteria->id}}" value="{{$commission_criteria->id}}" class="child custom-control-input custom-control-input-success custom-control-input-outline">
                          <label for="child_{{$commission_criteria->id}}" class="custom-control-label"></label>
                        </div>
                      </td>
                      <td>{{ $commission_criteria->name }}</td>
                      {{-- <td>{{ isset($commission_criteria->getCommission->name) && !empty($commission_criteria->getCommission->name) ? $commission_criteria->getCommission->name : '' }}</td> --}}
                      {{-- <td>
                          @if($commission_criteria->getCommissionGroups && $commission_criteria->getCommissionGroups->count())
                            @foreach ($commission_criteria->getCommissionGroups as $group)
                              <span class="badge badge-info">{{ $group->name }}</span>
                      @endforeach
                      @endif
                      </td> --}}
                      <td>{{ $commission_criteria->percentage }} %</td>
                      <td>
                        @if($commission_criteria->getCurrencies && $commission_criteria->getCurrencies->count())
                        @foreach ($commission_criteria->getCurrencies as $currency)
                        <span class="badge badge-info">{{ $currency->code.' - '.$currency->name }}</span>
                        @endforeach
                        @endif
                      </td>
                      <td>
                        @if($commission_criteria->getBrands && $commission_criteria->getBrands->count())
                        @foreach ($commission_criteria->getBrands as $brand)
                        <span class="badge badge-info">{{ $brand->name }}</span>
                        @endforeach
                        @endif
                      </td>
                      <td>
                        @if($commission_criteria->getHolidayTypes && $commission_criteria->getHolidayTypes->count())
                        @foreach ($commission_criteria->getHolidayTypes as $holiday_type)
                        <span class="badge badge-info">{{ $holiday_type->name }}</span>
                        @endforeach
                        @endif
                      </td>
                      <td>
                        @foreach ($commission_criteria->getSeasons as $season)
                        <span class="badge badge-info">{{ $season->name }}</span>
                        @endforeach
                      </td>
                      <td class="d-flex justify-content-center ml-2">
                        <a href="{{ route('commission_criterias.edit', encrypt($commission_criteria->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                        <form method="post" action="{{ route('commission_criterias.destroy', encrypt($commission_criteria->id)) }}" class="delete-commission-criteria">
                          @csrf
                          @method('delete')
                          <button class="mr-2  btn btn-outline-danger btn-xs" title="Delete">
                            <span class="fa fa-trash"></span>
                          </button>
                        </form>
                      </td>

                    </tr>
                    @endforeach
                    @else
                    <tr align="center">
                      <td colspan="100%">No record found.</td>
                    </tr>
                    @endif

                  </tbody>
                </table>
              </div>
            </div>

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $commission_criterias->links() }}
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
<script src="{{ asset('js/commission_management.js') }}"></script>
@endpush
{{-- @include('includes.multiple_delete',['table_name' => 'commission_criterias']) --}}
{{--
<section class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <a href="" id="delete_all" class="btn btn-danger btn-sm ">
          <span class="fa fa-trash"></span> &nbsp;
          <span>Delete Selected Record</span>
        </a>
      </div>
    </div>
  </div>
</section> --}}