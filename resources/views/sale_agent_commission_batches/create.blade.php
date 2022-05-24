@extends('layouts.app')
@section('title','Pay Commision')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h4>Pay Commission </h4>
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
    <form method="get" action="{{ route('pay_commissions.create') }}">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sales Person</label>
                                        <select class="form-control select2single" name="sale_person_id">
                                            <option value="">Select User </option>
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ request()->get('sale_person_id') == $user->id  ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Season</label>
                                        <select class="form-control select2single" name="season">
                                            <option value="">Select Supplier </option>
                                            @foreach ($seasons as $season)
                                                <option value="{{ $season->id }}" {{ (request()->get('season_id') == $season->id || $season->default == 1  ) ? 'selected' : '' }}>{{ $season->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                                        <a href="{{ route('pay_commissions.create') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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

<form action="{{ route('pay_commissions.store') }}" id="store_pay_commission">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title float-left">
                                Pay Commision List
                            </h3>
                        </div>

                        <div class="card-body pl-4">
                            <div class="row">

                                @if(isset($sale_person_id) && !empty($sale_person_id))
                                    <div class="col-md-3 d-none">
                                        <div class="form-group">
                                            <label>Sale Person ID <span style="color:red">*</span></label>
                                            <input type="text" name="sale_person_id" id="sale_person_id" value="{{ $sale_person_id }}" class="form-control">
                                            <span class="text-danger" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 d-none">
                                        <div class="form-group">
                                            <label>Sale Person Currency ID <span style="color:red">*</span></label>
                                            <input type="text" name="sale_person_currency_id" id="sale_person_currency_id" value="{{ $sale_person_currency_id }}" class="form-control">
                                            <span class="text-danger" role="alert"></span>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Batch Name <span style="color:red">*</span></label>
                                        <input type="text" name="batch_name" id="batch_name" class="form-control">
                                        <span class="text-danger" role="alert"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group" >
                                        <label>Payment Method <span style="color:red">*</span></label>
                                        <select name="payment_method_id" id="payment_method_id" class="form-control payment-method-id select2single">
                                            <option value="">Select Payment Method</option>
                                            @foreach ($payment_methods as $payment_method)
                                                <option value="{{ $payment_method->id }}" > {{ $payment_method->name }} </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" role="alert"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr class="border-top">
                                            <th>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="finance-parent custom-control-input custom-control-input-success custom-control-input-outline" id="parent">
                                                    <label for="parent" class="custom-control-label"></label>
                                                </div>
                                            </th>
                                            {{-- <th style="min-width: 200px;">feilds</th> --}}
                                            <th>Booking Ref #</th>
                                            <th>Com. Amount</th>
                                            <th>Com. Amount in Agent's Currency</th>
                                            <th>Total Paid Amount Yet</th>
                                            <th>Outstanding Amount Left</th>
                                            <th>Pay Commission Amount</th>
                                            <th style="min-width: 250px;">Total Paid Amount</th>
                                            <th>Total Outstanding Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($bookings) && $bookings->count())
                                            @foreach($bookings as $key => $booking)
                                                @php
                                                    $supplier_default_currency_code = isset($booking->getSalePerson->getCurrency->code) ? $booking->getSalePerson->getCurrency->code : '';
                                                @endphp

                                                <tr class="commission-row">
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="finance[{{$key}}][finance_child]" id="child_{{ $loop->iteration }}" value="0" class="finance-child zero-one-checkbox custom-control-input custom-control-input-success custom-control-input-outline">
                                                            <label for="child_{{ $loop->iteration }}" class="custom-control-label"></label>
                                                        </div>
                                                    </td>

                                                    <!-- Hidden feilds -->
                                                    <td class="d-none">
                                                        <input type="text" name="finance[{{$key}}][total_paid_amount_yet]" class="total-paid-amount-yet" value="{{ is_null($booking->getLastSaleAgentCommissionBatchDetails) ? Helper::number_format(0) : $booking->getLastSaleAgentCommissionBatchDetails->total_paid_amount }}">
                                                        <input type="text" name="finance[{{$key}}][commission_amount_in_sale_person_currency]" value="{{ Helper::number_format($booking->commission_amount_in_sale_person_currency)  }}">
                                                        <input type="text" name="finance[{{$key}}][outstanding_amount_left]" class="outstanding-amount-left remove-zero-values hide-arrows" value="{{ is_null($booking->getLastSaleAgentCommissionBatchDetails) ? Helper::number_format($booking->commission_amount_in_sale_person_currency) : $booking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount }}" style="max-width: 100px;">
                                                        <input type="text" name="finance[{{$key}}][booking_id]" value="{{ $booking->id }}">
                                                        <input type="text" name="finance[{{$key}}][sale_person_currency_id]" value="{{ $booking->getSalePerson->getCurrency->id }}">
                                                        <input type="text" name="finance[{{$key}}][sale_person_id]" value="{{ $booking->sale_person_id }}">
                                                    </td>

                                                    <td>{{ $booking->ref_no }}</td>
                                                    <td>{{ isset($booking->getCurrency->code) ? $booking->getCurrency->code : '' }} {{ Helper::number_format($booking->commission_amount) }}</td>
                                                    <td>{{ $supplier_default_currency_code }} {{ Helper::number_format($booking->commission_amount_in_sale_person_currency) }} </td>

                                                    <td>
                                                        @if(is_null($booking->getLastSaleAgentCommissionBatchDetails))
                                                            {{ $supplier_default_currency_code }} {{ Helper::number_format(0) }}
                                                        @else
                                                            {{ Helper::number_format($booking->getLastSaleAgentCommissionBatchDetails->total_paid_amount) }}
                                                        @endif
                                                    </td> 

                                                    <td>
                                                        @if(is_null($booking->getLastSaleAgentCommissionBatchDetails))
                                                            {{ $supplier_default_currency_code }} {{ Helper::number_format($booking->commission_amount_in_sale_person_currency) }}
                                                        @else
                                                            {{ Helper::number_format($booking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount) }}
                                                        @endif
                                                    </td> 

                                                    <td class="form-group">
                                                        <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">{{ $supplier_default_currency_code }}</span>
                                                            </div>
                                                            <input type="text" name="finance[{{$key}}][pay_commission_amount]" id="finance_{{$key}}_pay_commission_amount" class="form-control pay-commission-amount remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;">
                                                        </div>
                                                        <small class="text-danger"></small>
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="input-group mx-sm-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">{{ $supplier_default_currency_code }}</span>
                                                            </div>
                                                          <input type="text" name="finance[{{$key}}][row_total_paid_amount]" class="form-control row-total-paid-amount remove-zero-values hide-arrows" value="0.00" style="max-width: 100px;" readonly>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="input-group mx-sm-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">{{ $supplier_default_currency_code }}</span>
                                                            </div>
                                                          <input type="text" name="finance[{{$key}}][row_total_outstanding_amount]" class="form-control row-total-outstanding-amount remove-zero-values hide-arrows" value="0.00" style="max-width: 100px;" readonly>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach

                                            <tr class="border-top border-bottom">
                                                <td colspan="7"></td>
                                                
                                                <td class="font-weight-bold">
                                                    <span>{{ $supplier_default_currency_code }}</span>
                                                    <span class="total-paid-amount">0.00</span>
                                                    <input type="hidden" name="total_paid_amount" class="total-paid-amount" value="">
                                                </td>

                                                <td class="font-weight-bold">
                                                    <span>{{ $supplier_default_currency_code }}</span>
                                                    <span class="total-outstanding-amount">0.00</span>
                                                    <input type="hidden" name="total_outstanding_amount" class="total-outstanding-amount" value="">
                                                </td>
                                            </tr>

                                            <tr class="mt-2">
                                                <td colspan="8"></td>
                                                <td class="d-flex justify-content-left">
                                                  <button type="submit" class="btn btn-success bulk-payment float-right mr-3"><span class="mr-2 "></span> Save & Send to Agent &nbsp; </button>
                                                  <a href="{{ route('pay_commissions.index') }}" class="btn btn-danger float-right ">Cancel</a>
                                                </td>
                                            </tr>

                                        @else
                                            <tr align="center"><td colspan="100%">No record found.</td></tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right"></ul>
                        </div>
                    
                    </div>

                </div>

            </div>
        </div>
    </section>
</form>

</div>
@endsection
@push('js')
  <script src="{{ asset('js/commission_management.js') }}"></script>
@endpush
