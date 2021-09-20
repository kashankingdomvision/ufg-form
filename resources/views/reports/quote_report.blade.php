@extends('layouts.app')
@section('title','View Quote Report')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4></h4>
                    <div class="d-flex">
                        <h4> Quote Report</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item active">Quote Management</li>
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
        <form method="get" action="">
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
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Client Type</label>
                                            <select class="form-control select2single" name="client_type">
                                                <option value="" selected>Select Client Type </option>
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

                                    <div class="col">
                                        <div class="form-group">
                                            <label>Quote Status</label>
                                            <select class="form-control select2single" name="status">
                                                <option value="" selected>Select Status</option>
                                                <option {{ (old('search') == 'booked')? 'selected': ((request()->get('status') == 'booked')? 'selected' : null) }} value="booked" >Booked</option>
                                                <option {{ (old('search') == 'quote')? 'selected': ((request()->get('status') == 'quote')? 'selected' : null) }} value="quote" >Quote</option>
                                                <option {{ (old('search') == 'cancelled')? 'selected': ((request()->get('status') == 'cancelled')? 'selected' : null) }} value="cancelled" >Cancelled</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label>Commission Type </label>
                                            <select class="form-control select2single" name="commission_type">
                                                <option selected value="" >Select Commission Type </option>
                                                @foreach ($commission_types as $commission_type)
                                                    <option value="{{ $commission_type->id }}" {{ (old('commission_type') == $commission_type->id) ? 'selected': ((request()->get('commission_type') == $commission_type->id) ? 'selected' : null) }}>{{ $commission_type->name }} ({{ $commission_type->percentage.' %' }})</option>
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
                                                    <option value="{{ $curren->id }}" data-image="data:image/png;base64, {{$curren->flag}}" {{ (old('booking_currency') == $curren->id)? 'selected': ( (!empty(request()->get('booking_currency')))? (((in_array($curren->id, request()->get('booking_currency'))))? 'selected' : null) : '') }}> &nbsp; {{$curren->code}} - {{$curren->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select class="form-control select2-multiple "  data-placeholder="Select Brands" multiple name="brand[]">
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ (in_array($brand->id,[old('brand')]))? 'selected': ( (!empty(request()->get('brand')))? ((in_array($brand->id, request()->get('brand')))? 'selected' : null): '') }}>{{ $brand->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label>Date Range</label>
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
                            
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                                            <a href="{{ route('reports.quote.report') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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
                            <h3 class="card-title">Quote List</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive ">
                                <table id="example1" class="table table-hover" >
                                    <thead>
                                      <tr>
                                  
                                        <th></th>
                                        <th>User</th>
                                        <th>Behalf</th>
                                        <th>Zoho Ref #</th>
                                        <th width="10">Quote Ref #</th>
                                        <th>Season</th>
                                        <th>Brand</th>
                                        <th>Booking Currency</th>
                                        <th>Currency Type</th>
                                        <th>Commission Type</th>
                                        <th>Pax No.</th>
                                        <th>Status</th>
                                        <th>Booking Date</th>
                                        <th>Created At</th>
                                        <th>Action</th>
   
                            
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $total_profit_percentage = 0; 
                                        @endphp
                                    @if($quotes && $quotes->count())
                                        @foreach ($quotes as $key => $quote)
                                            @php
                                                $total_profit_percentage    +=  $quote->profit_percentage;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <button class="btn btn-sm parent-row"  data-id="{{$quote->id}}">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </td>
                                           
                                                <td>{{ ($quote->user_id == 'sale_person_id')? '-' : $quote->getUser->name }}</td>
                                                <td width="8">{{ $quote->getSalePerson->name }}</td>
                                                <td>{{ $quote->ref_no }}</td>
                                                <td> <a href="{{ route('quotes.final', encrypt($quote->id)) }}">{{ $quote->quote_ref }}</a> </td>

                                                <td>{{ $quote->getSeason->name }}</td>
                                                <td>{{ (isset($quote->getBrand->name))? $quote->getBrand->name: NULL }}</td>

                                                <td>{{ $quote->getBookingCurrency->code.' - '.$quote->getBookingCurrency->name }}</td>
                                                <td> {{ $quote->rate_type == 'live' ? 'Live Rate' : 'Manual Rate' }}</td>

                                                <td> {{ $quote->getCommission->name }} ({{ $quote->getCommission->percentage.' %' }}) </td>
                                                <td> {{ $quote->pax_no }} </td>
                                                <td>{!! $quote->booking_formated_status !!}</td>
                                                <td>{{ $quote->formated_booking_date }}</td>
                                                <td>{{ $quote->formated_created_at }}</td>
                                                <td>
                                                    @if($quote->booking_status == 'quote' || $quote->booking_status == 'cancelled')
                                                        <a href="{{ route('quotes.final', encrypt($quote->id)) }}" title="View Quote" class="mr-2 btn btn-outline-info btn-xs" data-title="Final Quotation" data-target="#Final_Quotation">
                                                            <span class="fa fa-eye"></span>
                                                        </a>
                                                    @endif

                                                    @if($quote->booking_status == 'booked')
                                                        <a href="{{ route('bookings.show',encrypt($quote->getBooking->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="View Booking" title="View Booking" >
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <tbody class="child-row d-none" id="child-row-{{$quote->id}}" >
                                                    <tr>
                                                       <td colspan="12"></td>
                                                       <tH>Total Net Price</tH>
                                                       <td> {{ $quote->getBookingCurrency->code.' '.$quote->net_price}} </td>
                                                       <td></td>
                                                   </tr>
                                                    <tr>
                                                       <td colspan="12"></td>
                                                       <th>Total Markup Amount</th>
                                                       <td> {{ $quote->getBookingCurrency->code.' '.$quote->markup_amount}} </td>
                                                       <td> {{$quote->markup_percentage.' %' }} </td>
                                                    
                                                   </tr>
                                                    <tr>
                                                       <td colspan="12"></td>
                                                       <th>Total Selling Price</th>
                                                       <td> {{ $quote->getBookingCurrency->code.' '.$quote->selling_price}} </td>
                                                       <td></td>
                                                   </tr>
                                                    <tr>
                                                     
                                                       <td colspan="12"></td>
                                                       <th>Total Profit Percentage</th>
                                                       <td> {{$quote->profit_percentage.' %' }} </td>
                                                       <td></td>
                                                   </tr>
                                                    <tr>
                                                       <td colspan="12"></td>
                                                       <th>Potential Commission</th>
                                                       <td> {{ $quote->getBookingCurrency->code.' '.$quote->commission_amount }} </td>
                                                       <td></td>
                                                   </tr>
                                                    <tr>
                                                       <td colspan="12"></td>
                                                       <th> Amount Per Person</th>
                                                       <td> {{ $quote->getBookingCurrency->code.' '.$quote->amount_per_person }} </td>
                                                       <td></td>
                                                   </tr>
                                                </tbody>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="12"></td>
                                            <th>Total Profit Percentage</th>
                                            <td>{{ $total_profit_percentage.' %'}}</td>
                                        </tr>
                                    @else
                                        <tr align="center"><td colspan="100%">No record found.</td></tr>
                                    @endif
                                    </tbody>
                                  </table>
                            </div>

                        </div>

                        @include('includes.quote_multiple_delete')

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