@extends('layouts.app')

@section('title','Transfer Report')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4></h4>
                        <div class="d-flex">
                            <h4>Transfer Report</h4>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item">Reports</li>
                            <li class="breadcrumb-item active">Transfer Report</li>
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
            <form method="get" action="{{ route('reports.transfer.report') }}">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">
                                    <button type="button" class="btn btn-tool m-0 text-dark " data-card-widget="collapse">
                                        <div class="card-header">
                                        <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters &nbsp;<i class="fa fa-angle-down"></i></b></h3>
                                        </div>
                                    </button>
                                <div class="card-body">
                                    <div class="row">
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="row">

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Booking Refrence</label>
                                                        <select class="form-control select2single" name="quote_ref">
                                                            <option value="">Select Booking Refrence</option>
                                                            @foreach ($booking as $booking)
                                                                <option value="{{ $booking->id }}" {{ (old('quote_ref') == $booking->id)? 'selected': ((request()->get('quote_ref') == $booking->id) ? 'selected' : null) }} >{{ $booking->quote_ref }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Transfer Supplier</label>
                                                        <select class="form-control select2single" name="supplier">
                                                            <option value="">Select User</option>
                                                            @foreach ($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}" {{ (old('supplier') == $supplier->id)? 'selected': ((request()->get('supplier') == $supplier->id) ? 'selected' : null) }} >{{ $supplier->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Service Date Range</label>
                                                        <input type="text" name="dates" value="{{ request()->get('dates') }}" autocomplete="off" class="form-control date-range-picker">
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Month</label>
                                                        <select class="form-control select2single" name="month">
                                                            <option value="">Select Month</option>
                                                            <option value="01" {{ (old('month') == "01")? 'selected' :((request()->get('month') == "01")? 'selected' : null ) }} >January</option>
                                                            <option value="02" {{ (old('month') == "02")? 'selected' :((request()->get('month') == "02")? 'selected' : null ) }} >February</option>
                                                            <option value="03" {{ (old('month') == "03")? 'selected' :((request()->get('month') == "03")? 'selected' : null ) }} >March</option>
                                                            <option value="04" {{ (old('month') == "04")? 'selected' :((request()->get('month') == "04")? 'selected' : null ) }} >April</option>
                                                            <option value="05" {{ (old('month') == "05")? 'selected' :((request()->get('month') == "05")? 'selected' : null ) }} >May</option>
                                                            <option value="06" {{ (old('month') == "06")? 'selected' :((request()->get('month') == "06")? 'selected' : null ) }} >June</option>
                                                            <option value="07" {{ (old('month') == "07")? 'selected' :((request()->get('month') == "07")? 'selected' : null ) }} >July</option>
                                                            <option value="08" {{ (old('month') == "08")? 'selected' :((request()->get('month') == "08")? 'selected' : null ) }} >August</option>
                                                            <option value="09" {{ (old('month') == "09")? 'selected' :((request()->get('month') == "09")? 'selected' : null ) }} >September</option>
                                                            <option value="10" {{ (old('month') == "10")? 'selected' :((request()->get('month') == "10")? 'selected' : null ) }} >October</option>
                                                            <option value="11" {{ (old('month') == "11")? 'selected' :((request()->get('month') == "11")? 'selected' : null ) }} >November</option>
                                                            <option value="12" {{ (old('month') == "12")? 'selected' :((request()->get('month') == "12")? 'selected' : null ) }} >December</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Year</label>

                                                        <select class="form-control select2single" name="year">
                                                            <option value="">Select Year</option>
                                                            <option value="{{date("Y")}}" {{ (old('year') == date("Y")) ? 'selected' :((request()->get('year') == date("Y")) ? 'selected' : null ) }}>This Year</option>
                                                            <option value="{{date("Y")-1}}" {{ (old('year') == date("Y")-1) ? 'selected' :((request()->get('year') == date("Y")-1) ? 'selected' : null ) }}>Last Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                            
                                        </div>
                                    </div>
                                   
                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                                                <a href="{{ route('reports.transfer.report') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Transfer Report List</h3>
                                <a href="">
                                    <button class="btn btn-dark btn-sm float-right">Export in Excel</button>
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Booking Ref # </th>
                                                <th>Start Date of Service</th>
                                                <th>End Date of Service</th>
                                                <th>Time of Service</th>
                                                <th>Supplier</th>
                                                <th>Lead Passenger Name </th>
                                                <th>Pax No.</th>
                                                <th>Category </th>
                                                <th>Product</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($booking_details && $booking_details->count())
                                                @foreach ($booking_details as $key => $booking_detail)

                                                <tr>
                                                    <td>
                                                        @if(isset($booking_detail->getBooking->quote_ref))
                                                            <a href="{{ route('bookings.show', encrypt($booking_detail->getBooking->id)) }}"> {{$booking_detail->getBooking->quote_ref}} </a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $booking_detail->date_of_service }}</td>
                                                    <td>{{ $booking_detail->end_date_of_service }}</td>
                                                    <td>{{ $booking_detail->time_of_service }}</td>
                                                    <td>{{ $booking_detail->getSupplier->name }}</td>
                                                    <td>{{ $booking_detail->getBooking->lead_passenger_name }}</td>
                                                    <td>{{ $booking_detail->getBooking->pax_no }}</td>
                                                    <td>{{ $booking_detail->getCategory->name }}</td>
                                                    <td>{{ $booking_detail->product_id }}</td>
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
