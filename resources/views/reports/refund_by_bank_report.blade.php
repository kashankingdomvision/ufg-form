@extends('layouts.app')

@section('title','Refund By Bank Report')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4></h4>
                        <div class="d-flex">
                            <h4>Refund By Bank Report</h4>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item">Reports</li>
                            <li class="breadcrumb-item active">Refund By Bank Report</li>
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
            <form method="get" action="{{ route('reports.refund.by.bank.report') }}">
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
                                                        <label>Bank</label>
                                                        <select class="form-control select2single" name="bank">
                                                            <option value="">Select Bank</option>
                                                            @foreach ($banks as $bank)
                                                                <option value="{{ $bank->id }}" {{ (old('bank') == $bank->id)? 'selected': ((request()->get('bank') == $bank->id)? 'selected' : null) }} >{{ $bank->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Refund Confirmed By</label>
                                                        <select class="form-control select2single" name="refund_confirmed_by">
                                                            <option value="">Select User</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}" {{ (old('user') == $user->id)? 'selected': ((request()->get('user') == $user->id)? 'selected' : null) }} >{{ $user->name }}</option>
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
                                                            @for ($i = date("Y")-5 ; $i < date("Y")+5 ; $i++)
                                                                <option value="{{ $i }}" {{ (old('year') == $i) ? 'selected' :((request()->get('year') == $i) ? 'selected' : null ) }}> {{ $i }}</option>
                                                            @endfor
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
                                                <a href="{{ route('reports.refund.by.bank.report') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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
                    <form method="POST" action="{{ route('reports.refund.by.bank.report.export') }}">
                        @csrf
                        @php
                            $currParams = [
                                'bank' => request()->get('bank'),
                                'refund_confirmed_by' => request()->get('refund_confirmed_by'),
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
                                <h3 class="card-title">Refund By Bank Report List</h3>
                                {{-- <a href="">
                                    <button class="btn btn-dark btn-sm float-right">Export in Excel</button>
                                </a> --}}
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-hover text-nowrap">
                                        {{-- <thead>
                                            <th colspan="7">
                                                <a href="">
                                                    <button class="btn btn-dark btn-sm float-right">Export in Excel</button>
                                                </a>
                                            </th>
                                        </thead> --}}
                                        <thead>
                                            <tr>
                                                <th>Booking Ref # </th>
                                                <th>Refund Amount</th>
                                                <th>Refund Date</th>
                                                <th>Bank </th>
                                                <th>Refund Confirmed By</th>
                                                <th>Refund Recieved</th>
                                                <th>Refund Recieved Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($booking_refund_payments && $booking_refund_payments->count())
                                                @foreach ($booking_refund_payments as $key => $booking_refund_payment)

                                                <tr>
                                                    <td>
                                                        @if(isset($booking_refund_payment->getBookingDetail->getBooking->quote_ref))
                                                            <a href="{{ route('bookings.show', encrypt($booking_refund_payment->getBookingDetail->getBooking->id)) }}"> {{$booking_refund_payment->getBookingDetail->getBooking->quote_ref}} </a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $booking_refund_payment->getCurrency->code.' '.$booking_refund_payment->refund_amount }}</td>
                                                    <td>{{ !is_null($booking_refund_payment->refund_date) ?  Carbon\Carbon::parse($booking_refund_payment->refund_date)->format('d/m/Y') : '' }}</td>
                                                    <td>{{ isset($booking_refund_payment->getBank->name) && !empty($booking_refund_payment->getBank->name) ? $booking_refund_payment->getBank->name : '' }}</td>
                                                    <td>{{ isset($booking_refund_payment->getUser->name) && !empty($booking_refund_payment->getUser->name) ? $booking_refund_payment->getUser->name : '' }}</td>
                                                    <td>{{ ($booking_refund_payment->refund_recieved == 0 || $booking_refund_payment->refund_recieved == null) ? 'No' : 'Yes' }}</td>
                                                    <td> {{ !is_null($booking_refund_payment->refund_recieved_date) ?  Carbon\Carbon::parse($booking_refund_payment->refund_recieved_date)->format('d/m/Y') : '' }}  </td>
                                                </tr>
                                              
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
