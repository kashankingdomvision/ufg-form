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
                <div class="card-header">
                    <h3 class="card-title"><b>Filters</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-{{ (request()->has('search'))? 'minus' : 'plus' }}"></i>
                        </button>
                    </div>
                </div>
    
                <div class="card-body">
                    <form method="get" action="{{ route('bookings.index', encrypt($season_id)) }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Search</label>
                                <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select class="form-control" name="brand">
                                            <option value="">Search with Brand Name</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->name }}" {{ (old('search') == $brand->id)? 'selected' :((request()->get('brand') == $brand->id)? 'selected' : null ) }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Currencys</label>
                                        <select class="form-control" name="currency">
                                            <option value="">Search with Currency</option>
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->name }}" {{ (old('search') == $currency->id)? 'selected' :((request()->get('currency') == $currency->id)? 'selected' : null ) }}>{{ $currency->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>From</label>
                                        <input type="text" value="{{ (request()->get('date'))?request()->get('date')['from']: null }}" name="date[from]" class="form-control datepicker" >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>To</label>
                                        <input type="text" value="{{ (request()->get('date'))? request()->get('date')['to']: null }}" name="date[to]" class="form-control datepicker" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Search</button>
                            <a href="{{ route('bookings.index', encrypt($season_id)) }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Zoho Ref #</th>
                                            <th>Quote Ref #</th>
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
                                                <td>{{$booking->ref_no}}</td>
                                                <td>
                                                    <a href="{{ route('bookings.show', encrypt($booking->id)) }}"> {{$booking->quote_ref}} </a>
                                                </td>
                                                <td>{{$booking->lead_passenger}}</td>
                                                <td>{{$booking->getBrand->name??NULL}}</td>
                                                <td>{{$booking->getHolidayType->name??NULL}}</td>
                                                <td>{{$booking->sale_person}}</td>
                                                <td>{{$booking->agency_booking == 1 ? 'No' : 'Yes'}}</td>
                                                <td>{{!empty($booking->getCurrency->code) && !empty($booking->getCurrency->name) ? $booking->getCurrency->code.' - '.$booking->getCurrency->name : NULL }}</td>
                                                <td>{{$booking->pax_no}}</td>
                                                <td>{{$booking->dinning_preference}}</td>
                                                <td>{{$booking->bedding_preference}}</td>
                                                <td>{{$booking->formated_created_at}}</td>
                                                <td width="10%" class="d-flex" >
                                                    <a href="{{ route('bookings.edit', encrypt($booking->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" data-title="Edit" data-target="#edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('bookings.show', encrypt($booking->id)) }}" class="mr-2 btn btn-outline-info btn-xs" data-title="View Booking" data-target="#View_Booking">
                                                        <span class="fa fa-eye"></span>
                                                    </a>
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
