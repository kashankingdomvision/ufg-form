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

                                @if(isset($sale_person) && !is_null($sale_person))
                                    <div class="col-md-3 d-none">
                                        <div class="form-group">
                                            <label>Sale Person ID <span style="color:red">*</span></label>
                                            <input type="text" name="sale_person_id" id="sale_person_id" value="{{ $sale_person->id }}" class="form-control">
                                            <span class="text-danger" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 d-none">
                                        <div class="form-group">
                                            <label>Sale Person Currency ID <span style="color:red">*</span></label>
                                            <input type="text" name="sale_person_currency_id" id="sale_person_currency_id" value="{{ $sale_person->getCurrency->id }}" class="form-control">
                                            <span class="text-danger" role="alert"></span>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-3 d-none">
                                        <div class="form-group">
                                            <label>Send To Agent <span style="color:red">*</span></label>
                                            <input type="text" name="send_to_agent" value="{{ isset($send_to_agent) ? $send_to_agent : '' }}" id="pay_or_sent_to_agent" class="form-control">
                                            <span class="text-danger" role="alert"></span>
                                        </div>
                                    </div> --}}
    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Batch Name <span style="color:red">*</span></label>
                                            <input type="text" name="batch_name" id="batch_name" class="form-control">
                                            <span class="text-danger" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6"></div>

                                    @if(isset($sale_person_batch_exist) && $sale_person_batch_exist)
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
                            </div>
                        </div>

                        <div class="card-body p-0" id="listing_card_body">
                            <div class="row p-3 border-top d-flex align-items-center">
                                <button type="button" id="pay_deposit_amount" class="btn btn-outline-success btn-xs font-weight-bold">
                                <i class="fas fa-plus"></i>
                                    Pay Deposit Amount
                                </button>
                                
                                <button type="button" id="bonus_amount_btn" class="btn btn-outline-success btn-xs font-weight-bold ml-2">
                                <i class="fas fa-plus"></i>
                                    Bonus Amount
                                </button>
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
    
                                            <input type="text" name="sp_deposit_amount" id="sp_deposit_amount" class="form-control remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="pay_bonus_amount_row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group d-flex justify-content-center">
                                            <label>
                                                Bonus Amount
                                            </label>
                                        </div>

                                        <div class="input-group d-flex justify-content-center">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    USD
                                                </span>
                                            </div>
    
                                            <input type="text" name="batch_bonus_amount" id="batch_bonus_amount" class="form-control remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr class="border-top">
                                            <th></th>
                                            <th>Booking Ref #</th>
                                            <th>Com. Amount in Agent's Currency</th>
                                            <th>Total Paid Amount Yet</th>
                                            <th>Outstanding Amount Left</th>
                                            <th>Pay Commission Amount</th>
                                            
                                            @if(isset($sale_person_batch_exist) && $sale_person_batch_exist)
                                                <th style="min-width: 260px;">Deposited Amount Value</th>
                                                <th>Bank Amount Value</th>
                                            @endif

                                            <th style="min-width: 250px;">Total Paid Amount</th>
                                            <th>Total Outstanding Amount</th>
                                            <th>Agent's Bonus</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($sale_person) && !is_null($sale_person))
                                            @if(isset($bookings) && $bookings->count())
                                                @foreach($bookings as $key => $booking)
                                                    @php
                                                        $supplier_default_currency_code = isset($booking->getSalePerson->getCurrency->code) ? $booking->getSalePerson->getCurrency->code : '';
                                                    @endphp

                                                    <tr class="commission-row">
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="finance[{{$key}}][finance_child]" id="child_{{ $loop->index }}" value="0" class="finance-child zero-one-checkbox custom-control-input custom-control-input-success custom-control-input-outline">
                                                                <label for="child_{{ $loop->index }}" class="custom-control-label"></label>
                                                            </div>
                                                        </td>

                                                        <!-- Hidden feilds -->
                                                        <td class="d-none">
                                                            <input type="text" name="finance[{{$key}}][total_paid_amount_yet]" class="total-paid-amount-yet" value="{{ isset($booking->getLastSaleAgentCommissionBatchDetails->total_paid_amount) && !empty($booking->getLastSaleAgentCommissionBatchDetails->total_paid_amount) ?  $booking->getLastSaleAgentCommissionBatchDetails->total_paid_amount : Helper::number_format(0) }}">
                                                            <input type="text" name="finance[{{$key}}][commission_amount_in_sale_person_currency]" value="{{ Helper::number_format($booking->commission_amount_in_sale_person_currency)  }}">
                                                            <input type="text" name="finance[{{$key}}][outstanding_amount_left]" class="outstanding-amount-left remove-zero-values hide-arrows" value="{{ isset($booking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount) && !empty($booking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount) ? $booking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount : Helper::number_format($booking->commission_amount_in_sale_person_currency) }}" style="max-width: 100px;">
                                                            <input type="text" name="finance[{{$key}}][booking_id]" value="{{ $booking->id }}">
                                                            <input type="text" name="finance[{{$key}}][sale_person_currency_id]" value="{{ $booking->getSalePerson->getCurrency->id }}">
                                                            <input type="text" name="finance[{{$key}}][sale_person_id]" value="{{ $booking->sale_person_id }}">
                                                        </td>

                                                        <td>{{ $booking->ref_no }}</td>

                                                        <td>
                                                            {{ $supplier_default_currency_code }}
                                                            {{ Helper::number_format($booking->commission_amount_in_sale_person_currency) }}
                                                        </td>

                                                        <td>
                                                            {{ $supplier_default_currency_code }} {{ Helper::number_format(0) }}
                                                        </td> 

                                                        <td>
                                                            {{ $supplier_default_currency_code }} {{ Helper::number_format($booking->commission_amount_in_sale_person_currency) }}
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

                                                        @if(isset($sale_person_batch_exist) && $sale_person_batch_exist)
                                                            <td class="form-group">
                                                                <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $supplier_default_currency_code }}</span>
                                                                    </div>
                                                                    <input type="text" name="finance_detail[{{$key}}][deposit_amount_value]" id="finance_{{$key}}_deposit_amount_value" class="form-control deposit-amount-value remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;" readonly>
                                                                </div>
                                                                <small class="text-danger"></small>
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $supplier_default_currency_code }}</span>
                                                                    </div>
                                                                    <input type="text" name="finance_detail[{{$key}}][bank_amount_value]" id="finance_{{$key}}_bank_amount_value" class="form-control bank-amount-value remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;" readonly>
                                                                </div>
                                                                <small class="text-danger"></small>
                                                            </td>
                                                        @endif


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

                                                        <td>
                                                            @if($booking->sale_person_payment_status == 0)
                                                                <button type="button" 
                                                                    data-booking_id="{{ $booking->id }}"
                                                                    data-sale_agent_currency_code="{{ $supplier_default_currency_code }}"
                                                                    class="store-sale-person-bonus ml-1 btn btn-outline-info btn-xs" title="Add Bonus">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            @if(isset($sac_batch_trans_details) && $sac_batch_trans_details->count())
                                                @foreach($sac_batch_trans_details as $key => $sac_batch_trans_detail)
                                                
                                                    @php
                                                        $sa_currency = isset($sac_batch_trans_detail->getSalePerson->getCurrency) ? $sac_batch_trans_detail->getSalePerson->getCurrency : '';
                                                    @endphp

                                                    {{-- @if($sac_batch_trans_detail->type == 'bookings')
                                                        <tr class="commission-row">

                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" name="finance_detail[{{$key}}][finance_child]" id="child_{{ $loop->iteration }}" value="0" class="finance-child zero-one-checkbox custom-control-input custom-control-input-success custom-control-input-outline">
                                                                    <label for="child_{{ $loop->iteration }}" class="custom-control-label"></label>
                                                                </div>
                                                            </td>

                                                            <!-- Hidden feilds -->
                                                            <td class="d-none">
                                                                <input type="text" name="finance_detail[{{$key}}][type]" value="sac_batch_details">
                                                                <input type="text" name="finance_detail[{{$key}}][id]" value="{{ $sac_batch_trans_detail->sbd_id }}">

                                                                <input type="text" name="finance_detail[{{$key}}][total_paid_amount_yet]" class="total-paid-amount-yet" value="{{ isset($sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_paid_amount) && !empty($sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_paid_amount) ? $sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_paid_amount :  Helper::number_format(0) }}">
                                                                <input type="text" name="finance_detail[{{$key}}][commission_amount_in_sale_person_currency]" value="{{ Helper::number_format($sac_batch_trans_detail->commission_amount_in_sale_person_currency)  }}">
                                                                
                                                                
                                                                <input type="text" name="finance_detail[{{$key}}][outstanding_amount_left]" class="outstanding-amount-left remove-zero-values hide-arrows" value="{{ isset($sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount) && !empty($sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount) ? $sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount : Helper::number_format($sac_batch_trans_detail->getBooking->commission_amount_in_sale_person_currency) }}" style="max-width: 100px;">
                                                                <input type="text" name="finance_detail[{{$key}}][booking_id]" value="{{ $sac_batch_trans_detail->booking_id }}">
                                                                <input type="text" name="finance_detail[{{$key}}][sale_person_currency_id]" value="{{ $sac_batch_trans_detail->sac_batch_detail_sale_person_currency_id }}">
                                                                <input type="text" name="finance_detail[{{$key}}][sale_person_id]" value="{{ $sac_batch_trans_detail->sac_batch_detail_sale_person }}">
                                                            </td>


                                                            <td>{{ $sac_batch_trans_detail->getBooking->ref_no }}</td>

                                                            <td>
                                                                {{ $sa_currency->code }}
                                                                {{ Helper::number_format($sac_batch_trans_detail->getBooking->commission_amount_in_sale_person_currency) }}
                                                            </td>

                                                            <td>
                                                                {{ $sa_currency->code }}
                                                                {{ Helper::number_format(0) }}
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $sa_currency->code }}
                                                                {{ Helper::number_format($sac_batch_trans_detail->getBooking->commission_amount_in_sale_person_currency) }}
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $sa_currency->code }}</span>
                                                                    </div>
                                                                    <input type="text" name="finance_detail[{{$key}}][pay_commission_amount]" id="finance_{{$key}}_pay_commission_amount" class="form-control pay-commission-amount remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;">
                                                                </div>
                                                                <small class="text-danger"></small>
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $sa_currency->code }}</span>
                                                                    </div>
                                                                    <input type="text" name="finance_detail[{{$key}}][deposit_amount_value]" id="finance_{{$key}}_deposit_amount_value" class="form-control deposit-amount-value remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;" readonly>
                                                                </div>
                                                                <small class="text-danger"></small>
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $sa_currency->code }}</span>
                                                                    </div>
                                                                    <input type="text" name="finance_detail[{{$key}}][bank_amount_value]" id="finance_{{$key}}_bank_amount_value" class="form-control bank-amount-value remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;" readonly>
                                                                </div>
                                                                <small class="text-danger"></small>
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $sa_currency->code }}</span>
                                                                    </div>
                                                                <input type="text" name="finance_detail[{{$key}}][row_total_paid_amount]" class="form-control row-total-paid-amount remove-zero-values hide-arrows" value="0.00" style="max-width: 100px;" readonly>
                                                                </div>
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $sa_currency->code }}</span>
                                                                    </div>
                                                                <input type="text" name="finance_detail[{{$key}}][row_total_outstanding_amount]" class="form-control row-total-outstanding-amount remove-zero-values hide-arrows" value="0.00" style="max-width: 100px;" readonly>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif --}}

                                                    @if($sac_batch_trans_detail->type == 'sale_person_payments')

                                                        <tr class="commission-row">

                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" name="finance_detail[{{$key}}][finance_child]" id="child_{{ $loop->iteration }}" value="0" class="deposited-amount-payments zero-one-checkbox custom-control-input custom-control-input-success custom-control-input-outline">
                                                                    <label for="child_{{ $loop->iteration }}" class="custom-control-label"></label>
                                                                </div>
                                                            </td>

                                                            <td class="d-none">
                                                                <input type="text" name="finance_detail[{{$key}}][type]" value="sale_person_payments">
                                                                <input type="text" name="finance_detail[{{$key}}][id]" value="{{ $sac_batch_trans_detail->spp_id }}">
                                                                <input type="text" name="finance_detail[{{$key}}][sac_batch_trans_detail_id]" value="{{ $sac_batch_trans_detail->sac_batch_trans_detail_id }}">
                                                            </td>

                                                            <td>{{ $sac_batch_trans_detail->deposit_date }}</td>

                                                            <td colspan="3">
                                                                {{ $sa_currency->code }}
                                                                {{ Helper::number_format($sac_batch_trans_detail->total_deposited_amount)." - Deposit" }}
                                                            </td>

                                                            <td class="form-group d-none">
                                                                <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            {{ $sa_currency->code }}
                                                                        </span>
                                                                    </div>
                        
                                                                    <input type="text" 
                                                                        name="finance_detail[{{$key}}][current_deposited_total_outstanding_amount]" 
                                                                        value="{{ isset($sac_batch_trans_detail->current_deposited_total_outstanding_amount) && !empty($sac_batch_trans_detail->current_deposited_total_outstanding_amount) ? Helper::number_format($sac_batch_trans_detail->current_deposited_total_outstanding_amount) : '' }}"
                                                                        class="current-deposited-total-outstanding-amount form-control remove-zero-values hide-arrows"
                                                                        style="max-width: 100px;" readonly>
                                                                </div>
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            USD
                                                                        </span>
                                                                    </div>
                        
                                                                    <input type="text" name="finance_detail[{{$key}}][total_deposited_outstanding_amount]" class="total-deposited-outstanding-amount form-control remove-zero-values hide-arrows" data-type="currency" value="{{ isset($sac_batch_trans_detail->total_deposited_outstanding_amount) ? Helper::number_format($sac_batch_trans_detail->total_deposited_outstanding_amount) : '0.00' }}" style="max-width: 100px;" readonly>
                                                                </div>
                                                            </td>
                        
                                                            <td class="d-flex justify-content-end align-items-center">
                                                                <div class="input-group d-flex justify-content-end mx-sm-1">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            USD
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" 
                                                                    name="finance_detail[{{$key}}][total_deposit_amount]" 
                                                                    data-sale_person_currency_code="{{ $sa_currency->code }}" 
                                                                    class="form-control total-deposit-amount remove-zero-values hide-arrows" 
                                                                    data-type="currency"
                                                                    value="{{ isset($sac_batch_trans_detail->total_deposit_amount) && !empty($sac_batch_trans_detail->total_deposit_amount) ? Helper::number_format($sac_batch_trans_detail->total_deposit_amount) :  Helper::number_format(0) }}" 
                                                                    style="max-width: 100px;" readonly>
                                                                </div>
                                                        
                                                                <button type="button" class="adjust-deposited-amount btn btn-outline-success btn-xs" data-target="#edit" title="Adjust Deposit Amount">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>

                                                        </tr>
                                                    @endif
                        

                                                    @if($sac_batch_trans_detail->type == 'sac_batch_details')
                                                        <tr class="commission-row">
    
                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" name="finance_detail[{{$key}}][finance_child]" id="child_{{ $loop->iteration }}" value="0" class="finance-child zero-one-checkbox custom-control-input custom-control-input-success custom-control-input-outline">
                                                                    <label for="child_{{ $loop->iteration }}" class="custom-control-label"></label>
                                                                </div>
                                                            </td>

                                                            <!-- Hidden feilds -->
                                                            <td class="d-none">
                                                                <input type="text" name="finance_detail[{{$key}}][type]" value="sac_batch_details">
                                                                <input type="text" name="finance_detail[{{$key}}][id]" value="{{ $sac_batch_trans_detail->sbd_id }}">

                                                                <input type="text" name="finance_detail[{{$key}}][total_paid_amount_yet]" class="total-paid-amount-yet" value="{{ isset($sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_paid_amount) && !empty($sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_paid_amount) ? $sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_paid_amount :  Helper::number_format(0) }}">
                                                                <input type="text" name="finance_detail[{{$key}}][commission_amount_in_sale_person_currency]" value="{{ Helper::number_format($sac_batch_trans_detail->commission_amount_in_sale_person_currency)  }}">
                                                                
                                                                
                                                                <input type="text" name="finance_detail[{{$key}}][outstanding_amount_left]" class="outstanding-amount-left remove-zero-values hide-arrows" value="{{ isset($sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount) && !empty($sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount) ? $sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount : Helper::number_format($sac_batch_trans_detail->getBooking->commission_amount_in_sale_person_currency) }}" style="max-width: 100px;">
                                                                <input type="text" name="finance_detail[{{$key}}][booking_id]" value="{{ $sac_batch_trans_detail->booking_id }}">
                                                                <input type="text" name="finance_detail[{{$key}}][sale_person_currency_id]" value="{{ $sac_batch_trans_detail->sac_batch_detail_sale_person_currency_id }}">
                                                                <input type="text" name="finance_detail[{{$key}}][sale_person_id]" value="{{ $sac_batch_trans_detail->sac_batch_detail_sale_person }}">
                                                            </td>
                                                    

                                                            <td>{{ $sac_batch_trans_detail->getBooking->ref_no }}</td>

                                                            <td>
                                                                {{ $sa_currency->code }}
                                                                {{ Helper::number_format($sac_batch_trans_detail->commission_amount_in_sale_person_currency) }}
                                                            </td>

                                                            <td>
                                                                {{ $sa_currency->code }}
                                                                {{ Helper::number_format($sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_paid_amount) }}
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $sa_currency->code }}
                                                                {{ Helper::number_format($sac_batch_trans_detail->getBooking->getLastSaleAgentCommissionBatchDetails->total_outstanding_amount) }}
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $sa_currency->code }}</span>
                                                                    </div>
                                                                    <input type="text" name="finance_detail[{{$key}}][pay_commission_amount]" id="finance_{{$key}}_pay_commission_amount" class="form-control pay-commission-amount remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;">
                                                                </div>
                                                                <small class="text-danger"></small>
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $sa_currency->code }}</span>
                                                                    </div>
                                                                    <input type="text" name="finance_detail[{{$key}}][deposit_amount_value]" id="finance_{{$key}}_deposit_amount_value" class="form-control deposit-amount-value remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;" readonly>
                                                                </div>
                                                                <small class="text-danger"></small>
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group mx-sm-3 d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $sa_currency->code }}</span>
                                                                    </div>
                                                                    <input type="text" name="finance_detail[{{$key}}][bank_amount_value]" id="finance_{{$key}}_bank_amount_value" class="form-control bank-amount-value remove-zero-values hide-arrows" data-type="currency" value="0.00" style="max-width: 100px;" readonly>
                                                                </div>
                                                                <small class="text-danger"></small>
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $sa_currency->code }}</span>
                                                                    </div>
                                                                <input type="text" name="finance_detail[{{$key}}][row_total_paid_amount]" class="form-control row-total-paid-amount remove-zero-values hide-arrows" value="0.00" style="max-width: 100px;" readonly>
                                                                </div>
                                                            </td>

                                                            <td class="form-group">
                                                                <div class="input-group d-flex justify-content-center">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">{{ $sa_currency->code }}</span>
                                                                    </div>
                                                                    <input type="text" name="finance_detail[{{$key}}][row_total_outstanding_amount]" class="form-control row-total-outstanding-amount remove-zero-values hide-arrows" value="0.00" style="max-width: 100px;" readonly>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                @if(is_null($sac_batch_trans_detail->getBooking->sale_person_bonus_amount))
                                                                    -
                                                                @else
                                                                    {{ $sa_currency->code }} {{ Helper::number_format($sac_batch_trans_detail->getBooking->sale_person_bonus_amount) }}
                                                                @endif
                                                            </td>
    
                                                            <td>
                                                                @if(isset($sac_batch_trans_detail->getBooking->sale_person_payment_status) && $sac_batch_trans_detail->getBooking->sale_person_payment_status == 0)
                                                                    <button type="button" 
                                                                        data-booking_id="{{ $sac_batch_trans_detail->getBooking->id }}"
                                                                        data-sale_agent_currency_code="{{ $sa_currency->code }}"
                                                                        class="store-sale-person-bonus ml-1 btn btn-outline-info btn-xs" title="Add Bonus">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                @endif
                                                            </td>

                                                        </tr>

                                                    @endif
                                                @endforeach
                        

                                            @endif


                                            @if(isset($sac_batch_trans_details) && $sac_batch_trans_details->count() || isset($bookings) && $bookings->count())

                                                <tr class="border-top border-bottom">
                                                    <td colspan="5"></td>

                                                    <td class="font-weight-bold">
                                                        <span>{{ $sale_person->getCurrency->code }}</span>
                                                        <span class="total-pay-commission-amount">0.00</span>
                                                        <input type="hidden" name="total_pay_commission_amount" class="total-pay-commission-amount" value="">
                                                    </td>

                                                    @if(isset($sale_person_batch_exist) && $sale_person_batch_exist)
                                                        <td class="font-weight-bold">
                                                            <span>{{ $sale_person->getCurrency->code }}</span>
                                                            <span class="booking-commission-total-deposit-amount">0.00</span>
                                                            <input type="hidden" name="booking_commission_total_deposit_amount" class="booking-commission-total-deposit-amount" value="">
                                                        </td>

                                                        <td class="font-weight-bold">
                                                            <span>{{ $sale_person->getCurrency->code }}</span>
                                                            <span class="booking-commission-total-bank-amount">0.00</span>
                                                            <input type="hidden" name="booking_commission_total_bank_amount" class="booking-commission-total-bank-amount" value="">
                                                        </td>
                                                    @endif

                                                    <td class="font-weight-bold">
                                                        <span>{{ $sale_person->getCurrency->code }}</span>
                                                        <span class="booking-commission-total-paid-amount">0.00</span>
                                                        <input type="hidden" name="booking_commission_total_paid_amount" class="booking-commission-total-paid-amount" value="">
                                                    </td>

                                                    <td class="font-weight-bold">
                                                        <span>{{ $sale_person->getCurrency->code }}</span>
                                                        <span class="total-outstanding-amount">0.00</span>
                                                        <input type="hidden" name="total_outstanding_amount" class="total-outstanding-amount" value="">
                                                    </td>
                                     
                                                </tr>

                                                <tr class="border-top border-bottom">
                                                    <td colspan="4"></td>

                                                    <td class="d-flex justify-content-end">
                                                        <label>
                                                            Deposit Amount
                                                        </label>
                                                    </td>

                                                    <td class="font-weight-bold">
                                                        <span>{{ $sale_person->getCurrency->code }}</span>
                                                        <span class="sp-deposit-amount">0.00</span>
                                                        <input type="hidden" name="show_sp_deposit_amount" class="sp-deposit-amount" value="">
                                                    </td>

                                                    <td></td>
                                                </tr>

                                                <tr class="border-top border-bottom">
                                                    <td colspan="4"></td>

                                                    <td class="d-flex justify-content-end">
                                                        <label>
                                                            Total Paid Amount
                                                        </label>
                                                    </td>

                                                    <td class="font-weight-bold">
                                                        <span>{{ $sale_person->getCurrency->code }}</span>
                                                        <span class="deposit-and-pay-commission-total">0.00</span>
                                                        <input type="hidden" name="deposit_and_pay_commission_total" class="deposit-and-pay-commission-total" value="">
                                                    </td>

                                                    <td></td>
                                                </tr>

                                                @if(isset($sale_person_batch_exist) && $sale_person_batch_exist)
                                                    <tr class="border-top border-bottom">
                                                        <td colspan="4"></td>

                                                        <td class="d-flex justify-content-end">
                                                            <label>
                                                                Left to Allocate
                                                            </label>
                                                        </td>

                                                        <td class="font-weight-bold">
                                                            <span>{{ $sale_person->getCurrency->code }}</span>
                                                            <span class="total-deposit-amount-left-to-allocate">0.00</span>
                                                            <input type="hidden" name="total_deposit_amount_left_to_allocate" id="total_deposit_amount_left_to_allocate" class="total-deposit-amount-left-to-allocate" value="0.00">
                                                        </td>

                                                        <td></td>
                                                    </tr>
                                                @endif

                                                <tr class="mt-2">
                                                    <td colspan="8"></td>
                                                    <td class="d-flex justify-content-left">
                                                        <button type="submit" class="btn btn-success float-right mr-3"><span class="mr-2 "></span> {{ 'Save & Send to Agent' }} &nbsp; </button>
                                                        <a href="{{ route('pay_commissions.index') }}" class="btn btn-danger float-right ">Cancel</a>
                                                    </td>
                                                </tr>
                                            @endif

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
