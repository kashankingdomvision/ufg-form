


@extends('layouts.app')

@section('title','View Supplier Bulk Payment')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>View Supplier Bulk Payment </h4>
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Supplier Managment</a></li>
            <li class="breadcrumb-item active">Supplier Rate Sheet </li>
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
    <form method="get" action="{{ route('supplier-bulk-payments.index') }}">
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
                                    <label>Supplier</label>
                                    <select class="form-control select2single" name="supplier_id">
                                        <option value="">Select Supplier </option>
                                        @foreach ($suppliers as $supplier)
                                          <option value="{{ $supplier->id }}" {{ request()->get('supplier_id') == $supplier->id  ? 'selected' : ''   }}>
                                            {{ $supplier->name }} - 
                                            {{ $supplier->getCurrency->code }}
                                          </option>
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                          
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Booking Season</label>
                                    <select class="form-control select2single" name="season_id" required>
                                        <option value="">Select Season </option>
                                        @foreach ($booking_seasons as $booking_season)
                                          <option value="{{ $booking_season->id }}" {{ (request()->get('season_id') == $booking_season->id || $booking_season->default == 1  ) ? 'selected' : '' }}>{{ $booking_season->name }}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                            </div>

                           
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                                        <a href="{{ route('supplier-bulk-payments.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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

<form action="{{ route('supplier-bulk-payments.store') }}" id="bulk_payment">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title float-left">
                Supplier Bulk Payment List
              </h3>
            </div>
            <div class="row {{ isset($supplier_id) && !empty($supplier_id) ? '' : 'd-none' }}">

              <div class="col-md-10 mt-1 d-flex justify-content-end">
                <div class="form-group" style="max-width: 15rem;">
                  <label>Payment Method</label>
                  <select  name="payment_method_id" class="form-control payment-method-id select2single">
                    <option value="">Select Payment Method</option>
                    @foreach ($payment_methods as $payment_method)
                      <option value="{{ $payment_method->id }}" > {{ $payment_method->name }} </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-2 mt-1 d-flex justify-content-end">
                <div class="form-group form-inline">
                  <label for="inputPassword6">Total Paid Amount: </label>
                  <div class="input-group mx-sm-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text sbp-payment">
                        {{ isset($selected_supplier_currency) && !empty($selected_supplier_currency) ? $selected_supplier_currency : '' }}
                      </span>
                    </div>
                    <input type="number" step="any" name="total_paid_amount" class="form-control total-paid-amount hide-arrows" min="0.00" step="any" >
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table  table-hover">
                  <thead>
                    <tr class="border-top">
                      <th>
                        <div class="icheck-primary">
                          <input type="checkbox" class="sbp-parent">
                        </div>
                      </th>
                      <th>Zoho Ref #</th>
                      <th>Quote Ref #	</th>
                      <th>Actual Cost</th>
                      <th>Outstanding Amount Left</th>
                      <th>Paid Amount</th>
                      <th >Credit Note Amount</th>
                      <th>Total Paid Amount</th>
                    </tr>
                  </thead>
                  <tbody>

                  

                    @if($bookings && $bookings->count())

                      @foreach ($bookings as $key => $booking )

                        <tr class="credit-row">
                          <td>
                            <div class="icheck-primary">
                              <input type="checkbox" class="sbp-child credit" value="{{$booking->outstanding_amount_left}}" id="{{$booking->id}}" data-id="{{$booking->id}}" data-currencyCode="{{ $booking->getCurrency->code }}" data-currencyID="{{ $booking->getCurrency->code }}" >
                            </div>
                          </td>

                          <td> {{ $booking->ref_no }} </td>
                          <td> {{ $booking->quote_ref }} </td>
                          <td> {{ $booking->getCurrency->code }} {{ $booking->actual_cost_bc }} </td>
                          <td> {{ $booking->getCurrency->code }} {{$booking->outstanding_amount_left}} </td>

                          <td class="d-none">

                            <input type="hidden" name="finance[{{$key}}][booking_detail_id]" value="{{ $booking->id }}" >
                            <input type="hidden" name="finance[{{$key}}][booking_detail_outstanding_amount_left]" value="{{ $booking->outstanding_amount_left }}" >

                          </td>
                    
                          <td class="{{$booking->id}}">
                            <div class="input-group mx-sm-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text sbp-payment">
                                  {{ isset($selected_supplier_currency) && !empty($selected_supplier_currency) ? $selected_supplier_currency : '' }}
                                </span>
                              </div>
                              <input type="text" name="finance[{{$key}}][deposit][deposit_amount]" class="form-control row-paid-amount sbp-paid-amount-{{$booking->id}} remove-zero-values hide-arrows"  id="" value="0.00" style="max-width: 100px;">
                            </div>
                          </td>

                          <td>
                            <div class="input-group mx-sm-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text sbp-payment">
                                  {{ isset($selected_supplier_currency) && !empty($selected_supplier_currency) ? $selected_supplier_currency : '' }}
                                </span>
                              </div>
                              <input type="text" name="finance[{{$key}}][credit][credit_note]" class="form-control row-credit-note-amount remove-zero-values hide-arrows"  id="" value="0.00" style="max-width: 100px;">
                            </div>
                          </td>

                          <td>
                            <div class="input-group mx-sm-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text sbp-payment">
                                  {{ isset($selected_supplier_currency) && !empty($selected_supplier_currency) ? $selected_supplier_currency : '' }}
                                </span>
                              </div>
                              <input type="text" name="finance[{{$key}}][total_deposit_amount]" class="form-control row-total-paid-amount remove-zero-values hide-arrows"  id="" value="0.00" style="max-width: 100px;">
                            </div>
                          </td>

                        </tr>

                      @endforeach
                    @else
                      <tr align="center"><td colspan="100%">No record found.</td></tr>
                    @endif

                    @if($bookings && $bookings->count())
      
                      <tr class="border-top border-bottom">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Current Credit Amount</th>
                        <th>Remaining Credit Amount</th>
                      </tr>
                      <tr class="border-bottom">
                        <td colspan="6">
                          <div class="icheck-primary">
                            <input type="hidden" class="total-credit-amount" data-type="debit" name="total_credit_amount" value="{{$total_wallet->amount}}">
                            <input type="hidden" class="remaining-credit-amount"  name="remaining_credit_amount" value="{{$total_wallet->amount}}">
                            <input type="hidden" name="currency_id" value="{{ isset($currency_id) && !empty($currency_id) ? $currency_id : '' }}">
                          </div>
                        </td>
                        <td>- <span>{{ \Helper::number_format($total_wallet->amount) }}</span> </td>
                        <td class="remaining-credit-amount">{{ \Helper::number_format($total_wallet->amount) }}</span></td>
                      </tr>

                      <tr class="mt-2">
                        <td colspan="7"></td>
                        <td class="d-flex justify-content-left">
                          <button type="submit" class="btn btn-success bulk-payment float-right mr-3">Pay</button>
                          <button type="button" class="btn btn-danger float-right ">Cancel</button>
                        </td>
                      </tr>
                    @endif

                  </form>

                  </tbody>
                </table>
              </div>
            </div>

            @include('includes.multiple_delete',['table_name' => 'supplier_rate_sheets'])

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
