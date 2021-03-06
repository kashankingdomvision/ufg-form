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
                    <li class="breadcrumb-item"><a>Pay Com. Management</a></li>
                    <li class="breadcrumb-item active">Pay Commission</li>
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
                                            <option value="">Select Season </option>
                                            @foreach ($seasons as $season)
                                                <option value="{{ $season->id }}" {{ (request()->get('season_id') == $season->id || $season->default == 1  ) ? 'selected' : '' }}>{{ $season->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Departure Date</label>
                                        <input type="text" name="departure_date" value="{{ request()->departure_date }}" autocomplete="off" class="form-control date-range-picker">
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

                                    <div class="col-md-3 d-none">
                                        <div class="form-group">
                                            <label>Send To Agent <span style="color:red">*</span></label>
                                            <input type="text" name="send_to_agent" value="{{ isset($send_to_agent) ? $send_to_agent : '' }}" id="pay_or_sent_to_agent" class="form-control">
                                            <span class="text-danger" role="alert"></span>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Batch Name <span style="color:red">*</span></label>
                                            <input type="text" name="batch_name" id="batch_name" class="form-control">
                                            <span class="text-danger" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6"></div>

                                    @if(isset($sale_person) && !is_null($sale_person->getSalePersonPayment))
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group d-flex justify-content-center">
                                                    <label>
                                                        Amount Paid
                                                    </label>
                                                </div>

                                                <div class="input-group d-flex justify-content-center">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            USD
                                                        </span>
                                                    </div>
                                                    <input type="text" name="bank_total_amount_paid" id="bank_total_amount_paid" class="form-control remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 150px;" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endif

                                @if(isset($send_to_agent) && $send_to_agent == 1)
                                    <div class="col-md-3">
                                        <div class="form-group">
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
                                @endif

                            </div>
                        </div>

           

                        <div class="card-body p-0" id="listing_card_body">
                   
                            @if(isset($sale_person_id) && !empty($sale_person_id))

                                @if(isset($sale_person) && is_null($sale_person->getSalePersonPayment))
                                    <div class="row p-3 border-top d-flex align-items-center">
                                        <div class="col-md-12">
                                            <button type="button" id="pay_deposit_amount" class="btn btn-outline-success btn-xs font-weight-bold">
                                            <i class="fas fa-plus"></i>
                                                Pay Deposit Amount
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row" id="pay_deposit_amount_row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group d-flex justify-content-center">
                                                    <label>
                                                        Deposit Amount
                                                    </label>
                                                </div>
    
                                                <div class="input-group d-flex justify-content-center">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            USD
                                                        </span>
                                                    </div>
            
                                                    <input type="text" name="sp_deposit_amount" id="sp_deposit_amount" class="form-control remove-zero-values hide-arrows" data-type="currency" value="" style="max-width: 150px;">
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                @endif

                                @if(isset($sale_person) && !is_null($sale_person->getSalePersonPayment))
                                    <table class="table table-hover text-nowrap mb-0">
                                        <thead>
                                            <tr class="border-top">
                                                <th></th>
                                                <th>Deposited On</th>
                                                <th>Reference</th>
                                                <th>Total Dep Amount</th>
                                                <th hidden>Current Total O/S Amount</th>
                                                <th>Outstanding Amount</th>
                                                <th>Total Paid Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="deposited_amount_payments" id="deposited_amount_payments" value="0" class="deposited-amount-payments zero-one-checkbox custom-control-input custom-control-input-success custom-control-input-outline">
                                                        <label for="deposited_amount_payments" class="custom-control-label"></label>
                                                    </div>
                                                </td>
            
                                                <td>
                                                    {{ 
                                                        isset($sale_person->getSalePersonPayment->deposit_date) && !empty($sale_person->getSalePersonPayment->deposit_date) ? $sale_person->getSalePersonPayment->deposit_date : ''
                                                    }}
                                                </td>
            
                                                <td>
                                                    {{
                                                        isset($sale_person->getSalePersonPayment->getSalePersonCurrency->code) && !empty($sale_person->getSalePersonPayment->getSalePersonCurrency->code) ? $sale_person->getSalePersonPayment->getSalePersonCurrency->code : ''
                                                    }}

                                                    {{
                                                        isset($sale_person->getSalePersonPayment->total_deposited_amount) && !empty($sale_person->getSalePersonPayment->total_deposited_amount) ? Helper::number_format($sale_person->getSalePersonPayment->total_deposited_amount).' - Deposited' : ''
                                                    }}
                                                   
                                                </td>
                                                
                                                <td class="form-group">
                                                    <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                {{
                                                                    isset($sale_person->getSalePersonPayment->getSalePersonCurrency->code) && !empty($sale_person->getSalePersonPayment->getSalePersonCurrency->code) ? $sale_person->getSalePersonPayment->getSalePersonCurrency->code : ''
                                                                }}
                                                            </span>
                                                        </div>
                                                        
                                                        <input type="text" name="total_deposited_amount" id="total_deposited_amount" class="form-control total-deposited-amount remove-zero-values hide-arrows" data-type="currency" value="{{ isset($sale_person->getSalePersonPayment->total_deposited_amount) && !empty($sale_person->getSalePersonPayment->total_deposited_amount) ? Helper::number_format($sale_person->getSalePersonPayment->total_deposited_amount) : '' }}" style="max-width: 100px;" readonly>
                                                    </div>
                                                </td>
            
                                                <td class="form-group" hidden>
                                                    <div class="input-group d-flex justify-content-center">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                {{
                                                                    isset($sale_person->getSalePersonPayment->getSalePersonCurrency->code) && !empty($sale_person->getSalePersonPayment->getSalePersonCurrency->code) ? $sale_person->getSalePersonPayment->getSalePersonCurrency->code : ''
                                                                }}
                                                            </span>
                                                        </div>
            
                                                        <input type="text" name="current_deposited_total_outstanding_amount" id="current_deposited_total_outstanding_amount" value="{{ isset($sale_person->getSalePersonPayment->current_deposited_total_outstanding_amount) && !empty($sale_person->getSalePersonPayment->current_deposited_total_outstanding_amount) ? Helper::number_format($sale_person->getSalePersonPayment->current_deposited_total_outstanding_amount) : '' }}" class="form-control currect-total-outstanding-amount remove-zero-values hide-arrows" style="max-width: 100px;" readonly>
                                                    </div>
                                                </td>
            
                                                <td class="form-group">
                                                    <div class="input-group d-flex justify-content-center">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                USD
                                                            </span>
                                                        </div>
            
                                                        <input type="text" name="total_deposited_outstanding_amount" id="total_deposited_outstanding_amount" class="form-control remove-zero-values hide-arrows" data-type="currency" value="{{ isset($sale_person->getSalePersonPayment->total_deposited_outstanding_amount) && !empty($sale_person->getSalePersonPayment->total_deposited_outstanding_amount) ? Helper::number_format($sale_person->getSalePersonPayment->total_deposited_outstanding_amount) : '' }}" style="max-width: 100px;" readonly>
                                                    </div>
                                                </td>
            
                                                <td class="d-flex">
                                                    <div class="input-group d-flex justify-content-center">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                USD
                                                            </span>
                                                        </div>
                                                        <input type="text" name="total_deposit_amount" id="total_deposit_amount" data-sale_person_currency_code="USD" class="form-control total-deposit-amount remove-zero-values hide-arrows" data-type="currency" value="{{ isset($sale_person->getSalePersonPayment->total_deposit_amount) && !empty($sale_person->getSalePersonPayment->total_deposit_amount) ? Helper::number_format($sale_person->getSalePersonPayment->total_deposit_amount) : '' }}" style="max-width: 100px;" readonly>
                                                    </div>
            
                                                    <div class="d-flex align-items-center">
                                                        <button type="button" class="adjust-deposited-amount btn btn-outline-success btn-xs" data-target="#edit" title="Adjust Deposit Amount">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif

                            @endif


                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr class="border-top">
                                            <th>
                                                {{-- <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="finance-parent custom-control-input custom-control-input-success custom-control-input-outline" id="parent">
                                                    <label for="parent" class="custom-control-label"></label>
                                                </div> --}}
                                            </th>
                                            {{-- <th style="min-width: 200px;">feilds</th> --}}
                                            <th>Booking Ref #</th>
                                            {{-- <th>Booking Currency</th> --}}
                                            {{-- <th>Brand</th> --}}
                                            {{-- <th>Holiday Type</th> --}}
                                            {{-- <th>Season</th> --}}
                                            {{-- <th>Com. Criteria</th> --}}
                                            {{-- <th>Departure Date</th> --}}
                                            {{-- <th>Selling Price</th> --}}
                                            {{-- <th>Total Markup Amount</th> --}}
                                            {{-- <th>Total Markup Percentage</th> --}}
                                            {{-- <th>Com. Amount</th> --}}
                                            <th>Com. Amount in Agent's Currency</th>
                                            <th>Total Paid Amount Yet</th>
                                            <th>Outstanding Amount Left</th>
                                            @if(isset($sale_person) && !is_null($sale_person->getSalePersonPayment))
                                                <th>Deposited Amount Value</th>
                                                <th>Bank Amount Value</th>
                                            @endif
                                            <th>Pay Commission Amount</th>
                                            <th style="min-width: 250px;">Total Paid Amount</th>
                                            <th>Total Outstanding Amount</th>
                                            <th>Agent's Bonus</th>
                                            @if(isset($send_to_agent) && $send_to_agent == 0)
                                                <th>Action</th>
                                            @endif
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

                                                    {{-- <td>
                                                        {{ !is_null($booking->getCurrency) ? $booking->getCurrency->code.' - '.$booking->getCurrency->name : '' }}
                                                    </td> --}}

                                                    {{-- <td>
                                                        {{ !is_null($booking->getBrand) ? $booking->getBrand->name : '' }}
                                                    </td> --}}

                                                    {{-- <td>
                                                        {{ !is_null($booking->getHolidayType) ? $booking->getHolidayType->name : '' }}
                                                    </td> --}}

                                                    {{-- <td>
                                                        {{ !is_null($booking->getSeason) ? $booking->getSeason->name : '' }}
                                                    </td> --}}

                                                    {{-- <td>
                                                        <h5>
                                                            <span class="badge badge-info" title="Commission Name">{{ !is_null($booking->getCommissionCriteria) ? $booking->getCommissionCriteria->name : '' }}</span>
                                                            <span class="badge badge-info" title="Commission Percentage">{{ !is_null($booking->getCommissionCriteria) ? $booking->getCommissionCriteria->percentage.' %' : '' }}</span>
                                                        </h5>
                                                    </td> --}}

                                                    {{-- <td> {{ $booking->departure_date }} </td> --}}

                                                    {{-- <td>
                                                        {{ !is_null($booking->getCurrency) ? $booking->getCurrency->code : '' }} 
                                                        {{ Helper::number_format($booking->selling_price) }}
                                                    </td> --}}
                                                    {{-- 
                                                    <td>
                                                        {{ !is_null($booking->getCurrency) ? $booking->getCurrency->code : '' }}
                                                        {{ Helper::number_format($booking->markup_amount) }}
                                                    </td>

                                                    <td>
                                                        {{ Helper::number_format($booking->markup_percentage).' %' }}
                                                    </td> --}}

                                                    {{-- <td>{{ isset($booking->getCurrency->code) ? $booking->getCurrency->code : '' }} {{ Helper::number_format($booking->commission_amount) }}</td> --}}
                                                    <td>
                                                        {{ $supplier_default_currency_code }}
                                                        {{ Helper::number_format($booking->commission_amount_in_sale_person_currency) }}
                                                    </td>

                                                    <td>
                                                        @if(is_null($booking->getLastSaleAgentCommissionBatchDetails))
                                                            {{ $supplier_default_currency_code }} {{ Helper::number_format(0) }}
                                                        @else
                                                            {{ $supplier_default_currency_code }} {{ Helper::number_format($booking->getLastSaleAgentCommissionBatchDetails->total_paid_amount) }}
                                                        @endif
                                                    </td> 

                                                    <td>
                                                        @if(is_null($booking->getLastSaleAgentCommissionBatchDetails))
                                                            {{ $supplier_default_currency_code }} {{ Helper::number_format($booking->commission_amount_in_sale_person_currency) }}
                                                        @else
                                                            {{ $supplier_default_currency_code }} {{ Helper::number_format($booking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount) }}
                                                        @endif
                                                    </td> 


                                                    @if(isset($sale_person) && !is_null($sale_person->getSalePersonPayment))

                                                        <td class="form-group">
                                                            <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">{{ $supplier_default_currency_code }}</span>
                                                                </div>
                                                                <input type="text" name="finance[{{$key}}][deposited_amount_value]" id="finance_{{$key}}_deposited_amount_value" class="form-control deposited-amount-value remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;" readonly>
                                                            </div>
                                                            <small class="text-danger"></small>
                                                        </td>

                                                        <td class="form-group">
                                                            <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">{{ $supplier_default_currency_code }}</span>
                                                                </div>
                                                                <input type="text" name="finance[{{$key}}][bank_amount_value]" id="finance_{{$key}}_bank_amount_value" class="form-control bank-amount-value remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;" readonly>
                                                            </div>
                                                            <small class="text-danger"></small>
                                                        </td>

                                                    @endif


                                                    <td class="form-group">
                                                        <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">{{ $supplier_default_currency_code }}</span>
                                                            </div>
                                                            <input type="text" name="finance[{{$key}}][pay_commission_amount]" id="finance_{{$key}}_pay_commission_amount" class="form-control pay-commission-amount remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;">
                                                        </div>
                                                        <small class="text-danger"></small>
                                                    </td>

                                                    <td class="form-group">
                                                        <div class="input-group d-flex justify-content-center">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">{{ $supplier_default_currency_code }}</span>
                                                            </div>
                                                          <input type="text" name="finance[{{$key}}][row_total_paid_amount]" class="form-control row-total-paid-amount remove-zero-values hide-arrows" value="0.00" style="max-width: 100px;" readonly>
                                                        </div>
                                                    </td>

                                                    <td class="form-group">
                                                        <div class="input-group d-flex justify-content-center">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">{{ $supplier_default_currency_code }}</span>
                                                            </div>
                                                          <input type="text" name="finance[{{$key}}][row_total_outstanding_amount]" class="form-control row-total-outstanding-amount remove-zero-values hide-arrows" value="0.00" style="max-width: 100px;" readonly>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        @if(is_null($booking->sale_person_bonus_amount))
                                                            -
                                                        @else
                                                            {{ $supplier_default_currency_code }} {{ Helper::number_format($booking->sale_person_bonus_amount) }}
                                                        @endif
                                                    </td>

                                                    @if(isset($send_to_agent) && $send_to_agent == 0)
                                                        <td>
                                                            @if($booking->sale_person_payment_status == 0)
                                                                <button type="button" 
                                                                    data-booking_id="{{ $booking->id }}" 
                                                                    data-sale_agent_currency_code="{{ $supplier_default_currency_code }}"
                                                                    data-sale_agent_commission_amount="{{ $booking->commission_amount_in_sale_person_currency }}"
                                                                    class="update-booking-commission ml-2 btn btn-outline-success btn-xs" title="Edit Commission"
                                                                >
                                                                    <i class="fas fa-edit"></i>
                                                                </button>

                                                                <button type="button" 
                                                                    data-booking_id="{{ $booking->id }}"
                                                                    data-sale_agent_currency_code="{{ $supplier_default_currency_code }}"
                                                                    class="store-sale-person-bonus ml-1 btn btn-outline-info btn-xs" title="Add Bonus">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            @endif
                                                        </td>
                                                    @endif

                                                </tr>

                                            @endforeach

                                            <tr class="border-top border-bottom">
                                                <td colspan="{{ isset($sale_person) && !is_null($sale_person->getSalePersonPayment) ? 7 : 5 }}"></td>

                                                <td class="font-weight-bold">
                                                    <span>{{ $supplier_default_currency_code }}</span>
                                                    <span class="total-pay-commission-amount">0.00</span>
                                                    <input type="hidden" name="total_pay_commission_amount" class="total-pay-commission-amount" value="">
                                                </td>
                                                
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

                                            @if(isset($sale_person) && !is_null($sale_person->getSalePersonPayment))
                                                <tr>
                                                    <td colspan="4"></td>
                                                    <td class="font-weight-bold">
                                                        <span class="pr-1">Left to Allocate</span>
                                                        <span>{{ $supplier_default_currency_code }}</span>
                                                        <span class="total-deposit-amount-left-to-allocate">0.00</span>
                                                        <input type="hidden" name="total_deposit_amount_left_to_allocate" id="total_deposit_amount_left_to_allocate" class="total-deposit-amount-left-to-allocate" value="">
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr class="mt-2">
                                                <td colspan="8"></td>
                                                <td class="d-flex justify-content-left">
                                                    <button type="submit" class="btn btn-success float-right mr-3"><span class="mr-2 "></span> {{ isset($send_to_agent) && $send_to_agent == 0 ? 'Save & Send to Agent' : 'Pay' }} &nbsp; </button>
                                                    <a href="{{ route('pay_commissions.index') }}" class="btn btn-danger float-right ">Cancel</a>
                                                </td>
                                            </tr>
                                        @else
                                            <tr align="center"><td colspan="100%">No record found.</td></tr>
                                        @endif

                                        @if(isset($sac_batch_trans_details) && $sac_batch_trans_details->count())

                                        <tr>
                                            
                                        </tr>

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

    @include('sale_agent_commission_batches.includes.update_sale_person_commission_modal')
    @include('sale_agent_commission_batches.includes.store_sale_person_bonus_modal')
    @include('sale_agent_commission_batches.includes.adjust_deposited_amount')

    {{-- @include('sale_agent_commission_batches.includes.pay_deposit_amount') --}}


</div>
@endsection
@push('js')
  <script src="{{ asset('js/commission_management.js') }}"></script>
@endpush
