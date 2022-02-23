


@extends('layouts.app')

@section('title','View Commission Report')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>View Commission Report </h4>
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Reports</a></li>
            <li class="breadcrumb-item active">Commission Report</li>
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
    <form method="get" action="{{ route('reports.commission.report') }}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  <div class="card card-default ">
                    <button type="button" class="btn btn-tool m-0 text-dark " data-card-widget="collapse">
                      <div class="card-header">
                        <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters &nbsp;<i class="fa fa-angle-down"></i></b></h3>
                      </div>
                    </button>

                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Commision </label>
                                <select class="form-control select2single" name="commission_id">
                                    <option value="">Select Commision</option>
                                    @foreach ($commissions as $commission)
                                        <option value="{{ $commission->id }}" {{ (old('commission_id') == $commission->id)? 'selected': ((request()->get('commission_id') == $commission->id)? 'selected' : null) }} >{{ $commission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Commission Group </label>
                                <select class="form-control select2single" name="commission_group_id">
                                    <option value="">Select Commission Group</option>
                                    @foreach ($commission_groups as $commission_group)
                                        <option value="{{ $commission_group->id }}" {{ (old('commission_group_id') == $commission_group->id)? 'selected': ((request()->get('commission_group_id') == $commission_group->id)? 'selected' : null) }} >{{ $commission_group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Booking Currency</label>
                                <select class="form-control select2-multiple "  data-placeholder="Select Booking Currency" multiple name="booking_currency[]">
                                    @foreach ($currencies as $curren)
                                        <option value="{{ $curren->id }}" data-image="data:image/png;base64, {{$curren->flag}}" {{ (old('booking_currency') == $curren->id)? 'selected': ( (!empty(request()->get('booking_currency')))? (((in_array($curren->id, request()->get('booking_currency'))))? 'selected' : null) : '') }}> &nbsp; {{$curren->code}} - {{$curren->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sales Person</label>
                                <select class="form-control select2single" name="sale_person_id">
                                    <option value="">Select Sales Person</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"  {{ (old('sale_person_id') == $user->id) ? 'selected': ((request()->get('sale_person_id') == $user->id) ? 'selected' : null) }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Brand</label>
                                <select class="form-control select2single getBrandtoHoliday" name="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ (old('brand_id') == $brand->id) ? 'selected': ((request()->get('brand_id') == $brand->id) ? 'selected' : null) }}>{{ $brand->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                
                        <div class="col-md-3">
                            <div class="form-group">
                              <label>Type Of Holiday </label>
                              <select name="holiday_type_id" id="holiday_type_id" class="form-control select2single appendHolidayType holiday-type-id">
                                <option value="">Select Type Of Holiday</option>
                              </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Booking Season</label>
                                <select class="form-control select2single" name="season_id">
                                    <option value="" selected >Select Booking Season</option>
                                    @foreach ($booking_seasons as $seasons)
                                        <option value="{{ $seasons->id }}" {{ (old('season_id') == $seasons->id)? 'selected': ((request()->get('season_id') == $seasons->id)? 'selected' : null) }}>{{ $seasons->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      </div>

                      <div class="row mt-1">
                        <div class="col-md-12">
                          <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                            <a href="{{ route('reports.commission.report') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
            </div>
        </div>
    </form>
</section>
 

  <section class="content p-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('reports.commission.report.export') }}">
                @csrf
                @php
                    $currParams = [
                      'commission_id' => request()->get('commission_id'),
                      'commission_group_id' => request()->get('commission_group_id'),
                      'booking_currency' => request()->get('booking_currency'),
                      'sale_person_id' => request()->get('sale_person_id'),
                      'brand_id' => request()->get('brand_id'),
                      'holiday_type_id' => request()->get('holiday_type_id'),
                      'season_id' => request()->get('season_id'),
                      'dates' => request()->get('dates'),
                      'month' => request()->get('month'),
                      'year' => request()->get('year')
                    ];
                @endphp
                <input type="hidden" name="params" value="{{ json_encode($currParams, TRUE) }}">
                <div class="dropdown show">
                    <a class="btn btn-base btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <button type="submit" class="dropdown-item btn-link">Export</button>
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
                Commission Report List
              </h3>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                        <th>Booking Ref #	</th>
                        <th>Quote Ref #	</th>
                        <th>Commission</th>
                        <th>Commission Group</th>
                        <th>Commission Amount</th>
                        <th>Sales Person</th>
                        <th>Booking Currency</th>
                        <th>Brand</th>
                        <th>Holiday Type</th>
                        <th>Seasons</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($bookings && $bookings->count())
                    @foreach ($bookings as $booking)
                        <tr>
                            <td> {{ $booking->ref_no }} </td>
                            <td> {{ $booking->quote_ref }} </td>
                            <td> {{ \Helper::issetAndNotEmpty($booking->getCommission->name) }} </td>
                            <td> {{ \Helper::issetAndNotEmpty($booking->getCommissionGroup->name)   }} </td>
                            <td> {{ \Helper::issetAndNotEmpty($booking->getCurrency->code) }} {{ $booking->commission_amount }}   </td>
                            <td> {{ \Helper::issetAndNotEmpty($booking->getSalePerson->name) }} </td>
                            <td> {{ \Helper::issetAndNotEmpty($booking->getCurrency->code).' - '.\Helper::issetAndNotEmpty($booking->getCurrency->name) }} </td>
                            <td> {{ \Helper::issetAndNotEmpty($booking->getBrand->name) }} </td>
                            <td> {{ \Helper::issetAndNotEmpty($booking->getHolidayType->name) }} </td>
                            <td> {{ \Helper::issetAndNotEmpty($booking->getSeason->name) }} </td>
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
              </ul>
            </div>
            
          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
