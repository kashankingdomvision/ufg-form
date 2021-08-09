@extends('layouts.app')
@section('title','View Booking')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>View Booking</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item">Booking</li>
                        <li class="breadcrumb-item active">Booking Season</li>
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
                        <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters &nbsp;<i class="fa fa-angle-down"></i></b></h3>
                        <div class="card-tools">
                            <i class="fas fa-{{ (request()->has('search'))? 'minus' : 'plus' }}"></i>
                        </div>
                    </div>
                </button>
                <div class="card-body">
                    <form method="get" action="{{ route('bookings.index') }}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Client Type</label>
                                <select class="form-control select2single" name="client_type">
                                    <option value="" selected>Select Client Type</option>
                                    <option {{ (old('client_type') == 'client')? 'selected': ((request()->get('client_type') == 'client')? 'selected' : null) }} value="client" >Client</option>
                                    <option {{ (old('client_type') == 'agency')? 'selected': ((request()->get('client_type') == 'agency')? 'selected' : null) }} value="agency" >Agency</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Agent / Staff</label>
                                <select class="form-control select2single" name="staff">
                                    <option value="" selected>Select Agent / Staff </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->name }}" {{ (old('staff') == $user->name)? 'selected': ((request()->get('staff') == $user->name)? 'selected' : null) }} >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
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
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Booking Currency</label>
                                <select class="form-control select2-multiple "  data-placeholder="Select Booking Currency" multiple name="booking_currency[]">
                                    @foreach ($currencies as $curren)
                                        <option value="{{ $curren->code }}" data-image="data:image/png;base64, {{$curren->flag}}" {{ (old('booking_currency') == $curren->code)? 'selected': ( (!empty(request()->get('booking_currency')))? (((in_array($curren->code, request()->get('booking_currency'))))? 'selected' : null) : '') }}> &nbsp; {{$curren->code}} - {{$curren->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group"> 
                                <label>Brand</label>
                                <select class="form-control select2-multiple "  data-placeholder="Select Brands" multiple name="brand[]">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}" {{ (in_array($brand->name,[old('brand')]))? 'selected': ( (!empty(request()->get('brand')))? ((in_array($brand->name, request()->get('brand')))? 'selected' : null): '') }}>{{ $brand->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col">
                            <label><u> Created Date</u></label>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>From</label>
                                        <input type="text" value="{{ (request()->get('created_date'))?request()->get('created_date')['from']: null }}" name="created_date[from]" class="form-control datepicker" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>To</label>
                                        <input type="text" value="{{ (request()->get('created_date'))? request()->get('created_date')['to']: null }}" name="created_date[to]" class="form-control datepicker" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Search</label>
                                <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="Search by Client Name, Zoho Ref, Quote Ref, Email Address">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                            <a href="{{ route('bookings.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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
                            <h3 class="card-title">Booking List</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="8"></th>
                                            <th style="width: 7rem;">Zoho Ref #</th>
                                            <th style="width: 7rem;">Quote Ref #</th>
                                            <th>Lead Passenger</th>
                                            <th>Brand</th>
                                            <th>Type Of Holidays</th>
                                            <th>Sales Person</th>
                                            <th>Agency Booking</th>
                                            <th>Booking Currency</th>
                                            <th>Pax No.</th>
                                            <th>Dinning Preferences</th>
                                            <th>Bedding Preferences</th>
                                            <th>Created</th>
                                            {{-- <th>Transfer Info Responsible Person</th>
                                            <th>Transfer Organized Responsible Person</th>
                                            <th>Itinerary Finalised Responsible Person</th>
                                            <th>Travel Document Prepared Responsible Person</th>
                                            <th>Document Sent Responsible Person</th>
                                            <th>Asked For Transfer</th>
                                            <th>Transfer Organised</th>
                                            <th>Itinerary Finalised</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($bookings && $bookings->count())
                                        @foreach ($bookings as $booking)
                                            <tr>
                                                <td width="8">{!! $booking->has_user_edit !!}</td>
                                                <td>{{$booking->ref_no}}</td>
                                                <td>
                                                    <a href="{{ route('bookings.show', encrypt($booking->id)) }}"> {{$booking->quote_ref}} </a>
                                                </td>
                                                <td>{{$booking->lead_passenger_name}}</td>
                                                <td>{{$booking->getBrand->name??NULL}}</td>
                                                <td>{{$booking->getHolidayType->name??NULL}}</td>
                                                <td>{{$booking->sale_person}}</td>
                                                <td>{{$booking->agency_booking == 1 ? 'Yes' : 'No'}}</td>
                                                <td>{{!empty($booking->getCurrency->code) && !empty($booking->getCurrency->name) ? $booking->getCurrency->code.' - '.$booking->getCurrency->name : NULL }}</td>
                                                <td>{{$booking->pax_no}}</td>
                                                <td>{{$booking->lead_passenger_dinning_preference}}</td>
                                                <td>{{$booking->lead_passenger_bedding_preference}}</td>
                                                <td>{{$booking->formated_created_at}}</td>
                                                <td width="10%" class="d-flex" >
                                                    <a href="{{ route('bookings.edit', encrypt($booking->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" data-title="Edit" title="Edit" >
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('bookings.show',encrypt($booking->id)) }}" class="mr-2 btn btn-outline-info btn-xs" data-title="View Booking" title="View Booking" >
                                                        <span class="fa fa-eye"></span>
                                                    </a>
                                                    <a href="{{ route('bookings.show', [ 'id' => encrypt($booking->id), 'status' => 'payment' ] ) }}" class="mr-2 btn btn-outline-info btn-xs" data-title="View Booking" title="Add Payment" >
                                                        <span class="fa fa-money-bill-alt"></span>
                                                    </a>
                                                    {{-- @if(empty($booking->cancel_date)) --}}
                                                    {{-- {{ route('bookings.cancel', encrypt($booking->id)) }} --}}
                                                        <a href="#" class="mr-2 btn btn-outline-danger btn-xs" data-title="Cancel Booking" title="Booking Canceled">
                                                            <span class="fa fa-times"></span>
                                                        </a>
                                                    {{-- @else --}}
                                                    {{-- @endif --}}
                                                    {{-- <form method="POST" action="{{ route("bookings.delete", encrypt($booking->id)) }}">
                                                        @csrf @method('delete')
                                                        <input type="hidden" value="{{ encrypt($booking->season_id) }}" name="season">
                                                        <button onclick="return confirm('Are you sure want to Delete this record?');" class="mr-2  btn btn-outline-danger btn-xs" data-title="Delete" data-target="#delete"><span class="fa fa-trash-alt"></span></button>
                                                    </form> --}}
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
                            {{ $bookings->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
