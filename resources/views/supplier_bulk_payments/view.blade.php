@extends('layouts.app')
@section('title','View Supplier Bulk Payment')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex">
                            {{-- <h4>View User <x-add-new-button :route="route('users.create')" /> </h4> --}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item"><a>Supplier Bulk Payments</a></li>
                            <li class="breadcrumb-item active">Add Supplier Bulk Payments </li>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Supplier Bulk Payment List</h3>
                            </div>

                           
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center">Supplier</th>
                                                <th class="text-center">Payment Date</th>
                                                <th class="text-center" style="width: 145px;">Payment Method</th>
                                                <th class="text-center">Pay By</th>
                                                <th class="text-center">Season</th>
                                                <th class="text-center">Currency</th>
                                                <th class="text-center">Credit Amount</th>
                                                <th class="text-center" style="width: 175px;">Remaining Credit Amount</th>
                                                <th class="text-center" style="width: 205px;">Total Used Credit Amount</th>
                                                <th class="text-center">Total Paid Amount</th>
                                                <th class="text-center" style="width: 120px;">Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($supplier_bulk_payments && $supplier_bulk_payments->count())
                                            @foreach ($supplier_bulk_payments as $key => $sb_payment)
                                            <tr>

                                                @php
                                                    $currency_code = isset($sb_payment->getCurrency->code) && !empty($sb_payment->getCurrency->code) ? $sb_payment->getCurrency->code : '';
                                                @endphp
                                                <td>
                                                    <button class="btn btn-sm parent-row"  data-id="{{$sb_payment->id}}">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </td>
                                                <td class="text-center">{{ isset($sb_payment->getSupplier->name) && !empty($sb_payment->getSupplier->name) ? $sb_payment->getSupplier->name : ''  }}</td>
                                                <td class="text-center">{{ !is_null($sb_payment->payment_date) ? Carbon\Carbon::parse($sb_payment->payment_date)->format('d/m/Y') : ''  }}</td>
                                                <td class="text-center">{{ isset($sb_payment->getPaymentMethod->name) && !empty($sb_payment->getPaymentMethod->name) ? $sb_payment->getPaymentMethod->name : '' }}</td>
                                                <td class="text-center">{{ isset($sb_payment->getUser->name) && !empty($sb_payment->getUser->name) ? $sb_payment->getUser->name : '' }}</td>
                                                <td class="text-center">{{ isset($sb_payment->getSeason->name) && !empty($sb_payment->getSeason->name) ? $sb_payment->getSeason->name : '' }}</td>
                                                <td class="text-center">{{ isset($sb_payment->getCurrency->name) && !empty($sb_payment->getCurrency->name) ? $currency_code.' - '.$sb_payment->getCurrency->name : '' }} </td>
                                                <td class="text-center">{{ $currency_code.' '.\Helper::number_format($sb_payment->current_credit_amount) }}</td>
                                                <td class="text-center">{{ $currency_code.' '.\Helper::number_format($sb_payment->remaining_credit_amount) }}</td>
                                                <td class="text-center">{{ $currency_code.' '.\Helper::number_format($sb_payment->total_used_credit_amount) }} </td>
                                                <td class="text-center">{{ $currency_code.' '.\Helper::number_format($sb_payment->total_paid_amount) }}</td>
                                                <td class="text-center">{{ $sb_payment->created_at->format('d/m/Y H:i:s')  }}</td>
                                            </tr>

                                            <tbody class="child-row d-none" id="child-row-{{$sb_payment->id}}">

                                                <tr>
                                                    <th></th>
                                                    <th class="text-center" style="width: 10px;">Booking Ref #</th>
                                                    <th class="text-center">Date of Service</th>
                                                    <th class="text-center">Category</th>
                                                    <th >Product</th>
                                                    <th class="text-center" style="width: 120px;">Actual Cost</th>
                                                    <th class="text-center" style="width: 100px;">Outstanding Amount Left</th>
                                                    <th class="text-center">Paid Amount</th>
                                                    <th class="text-center">Credit Note Amount</th>
                                                    <th class="text-center">Total Paid Amount</th>
                                          
                                                </tr>

                                                @foreach($sb_payment->getPaymentDetail as $key => $sb_payment_detail)
                                                    @php
                                                        $currency_code = isset($sb_payment->getCurrency->code) && !empty($sb_payment->getCurrency->code) ? $sb_payment->getCurrency->code : '';
                                                    @endphp
                                           
                                                    <tr>
                                                        <td></td>
                                                        <td class="text-center">
                                                            <a href="{{ route('bookings.show', encrypt($sb_payment_detail->getBooking->id)) }}"> {{ isset($sb_payment_detail->getBooking->quote_ref) && !empty($sb_payment_detail->getBooking->quote_ref) ? $sb_payment_detail->getBooking->quote_ref : ''  }} </a>
                                                        </td>
                                                        <td class="text-center" >{{ isset($sb_payment_detail->getBookingDetail->date_of_service) && !empty($sb_payment_detail->getBookingDetail->date_of_service) ? $sb_payment_detail->getBookingDetail->date_of_service : '' }} - {{ isset($sb_payment_detail->getBookingDetail->end_date_of_service) && !empty($sb_payment_detail->getBookingDetail->end_date_of_service) ? $sb_payment_detail->getBookingDetail->end_date_of_service : '' }} </td>
                                                        <td class="text-center">{{ isset($sb_payment_detail->getBookingDetail->getCategory->name) && !empty($sb_payment_detail->getBookingDetail->getCategory->name) ? $sb_payment_detail->getBookingDetail->getCategory->name : ''   }}</td>
                                                        <td class="text-center">{{ isset($sb_payment_detail->getBookingDetail->product_id) && !empty($sb_payment_detail->getBookingDetail->product_id) ? $sb_payment_detail->getBookingDetail->product_id : ''  }}</td>
                                                        <td class="text-center">{{ $currency_code.' '.\Helper::number_format($sb_payment_detail->actual_cost) }}</td>
                                                        <td class="text-center">{{ $currency_code.' '.\Helper::number_format($sb_payment_detail->outstanding_amount_left) }}</td>
                                                        <td class="text-center">{{ $currency_code.' '.\Helper::number_format($sb_payment_detail->paid_amount) }}</td>
                                                        <td class="text-center">{{ $currency_code.' '.\Helper::number_format($sb_payment_detail->credit_note_amount) }}</td>
                                                        <td class="text-center">{{ $currency_code.' '.\Helper::number_format($sb_payment_detail->row_total_paid_amount) }}</td>
                                                    </tr>

                                                @endforeach
                                            </tbody>
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
                                  {{-- {{ $users->links() }} --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
