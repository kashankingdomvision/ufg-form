@extends('layouts.app')

@section('title','Commission Review')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">

        <div class="col-sm-6">
          <div class="d-flex">
            <h4>
              Commission Review
              <x-add-new-button :route="route('pay_commissions.create')"></x-add-new-button>
            </h4>
          </div>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Pay Com. Management</a></li>
            <li class="breadcrumb-item active">Commission Review</li>
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

  <x-page-filters :route="route('pay_commissions.index')">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Search</label>
          <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
        </div>
      </div>
    </div>
  </x-page-filters>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title float-left">
                Commission Review List
              </h3>
            </div>

            <div class="card-body p-0" id="listing_card_body">
              <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Batch Name</th>
                      <th>Sale Person</th>
                      <th>Sale Person Currency</th>
                      <th>Status</th>
                      <th>Total Paid Amount</th>
                      <th>Total Outstanding Amount</th>
                      <th>Deposit Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @if($sac_batch && $sac_batch->count())
                      @foreach ($sac_batch as $key => $sac_batch)
                        <tr>
                          <td>
                            <button class="btn btn-sm parent-row" data-id="{{$sac_batch->id}}">
                              <span class="fa fa-plus"></span>
                            </button>
                          </td>
                          <td>{{ $sac_batch->name }}</td>
                          <td>{{ isset($sac_batch->getSalePerson->name) && !empty($sac_batch->getSalePerson->name) ? $sac_batch->getSalePerson->name : '' }}</td>
                          <td>{{ !is_null($sac_batch->getSalePersonCurrency) ? $sac_batch->getSalePersonCurrency->code.' - '.$sac_batch->getSalePersonCurrency->name : '' }}</td>
                          <td>{!! $sac_batch->formatted_status !!}</td>
                          <td>
                            {{ !is_null($sac_batch->getSalePersonCurrency) ? $sac_batch->getSalePersonCurrency->code : '' }}
                            {{ Helper::number_format($sac_batch->total_paid_amount) }}
                          </td>
                          <td>
                            {{ !is_null($sac_batch->getSalePersonCurrency) ? $sac_batch->getSalePersonCurrency->code : '' }}
                            {{ Helper::number_format($sac_batch->total_outstanding_amount) }}
                          </td>
                          <td>
                            {{ !is_null($sac_batch->getSalePersonCurrency) ? $sac_batch->getSalePersonCurrency->code.' '.Helper::number_format($sac_batch->sp_deposit_amount) : '' }}
                          </td>
                          <td>
                            @if($sac_batch->status == 'confirmed')
                              <button type="button" class="pay-batch btn btn-outline-info btn-xs mr-2" data-batch_id="{{ $sac_batch->id }}" title="Pay Batch"><i class="fa fa-money-bill-alt"></i></button>
                            @endif
                          </td>
                          
                          <tbody class="child-row d-none" id="child-row-{{$sac_batch->id}}">
                            <tr>
                              <th></th>
                              <th>Booking Ref #</th>
                              <th>Booking Currency</th>
                              <th>Brand</th>
                              <th>Holiday Type</th>
                              <th>Season</th>
                              <th>Com. Amount in Agent's Currency</th>
                              <th>Total Paid Amount Yet</th>
                              <th>Outstanding Amount Left</th>
                              <th>Pay Commission Amount</th>
                              <th style="min-width: 210px;">Total Paid Amount</th>
                              <th>Total Outstanding Amount</th>
                              <th>Status</th>
                              <th>Dispute Detail</th>
                              <th>Bonus Amount</th>
                              <th>Action</th>
                            </tr>
                            @foreach($sac_batch->getSaleAgentCommissionBatchDetails as $sacb_details)
                              <tr>
                                <td></td>
                                <td> {{ !is_null($sacb_details->getBooking->ref_no) ? $sacb_details->getBooking->ref_no : '' }} </td>
                                <td> {{ !is_null($sacb_details->getBooking->getCurrency) ? $sacb_details->getBooking->getCurrency->code.' - '.$sacb_details->getBooking->getCurrency->name : '' }} </td>
                                <td> {{ !is_null($sacb_details->getBooking->getBrand) ? $sacb_details->getBooking->getBrand->name : '' }} </td>
                                <td> {{ !is_null($sacb_details->getBooking->getHolidayType) ? $sacb_details->getBooking->getHolidayType->name : '' }} </td>
                                <td> {{ !is_null($sacb_details->getBooking->getSeason) ? $sacb_details->getBooking->getSeason->name : '' }} </td>
                                <td> {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} {{ Helper::number_format($sacb_details->commission_amount_in_sale_person_currency) }} </td>
                                <td> {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} {{ Helper::number_format($sacb_details->total_paid_amount_yet) }} </td>
                                <td> {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} {{ Helper::number_format($sacb_details->outstanding_amount_left) }} </td>
                                <td> {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} {{ Helper::number_format($sacb_details->pay_commission_amount) }} </td>
                                <td> {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} {{ Helper::number_format($sacb_details->total_paid_amount) }} </td>
                                <td> {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} {{ Helper::number_format($sacb_details->total_outstanding_amount) }} </td>
                                <td> {!! $sacb_details->formatted_status !!} </td>
                                <td>
                                  @if(!empty($sacb_details->dispute_detail))
                                    <a href="javascript:void(0)" data-details="{{ $sacb_details->dispute_detail }}" class="mr-2 btn btn-outline-info btn-xs view-dispute-detail" title="View Dispute Details">
                                      <span class="fa fa-eye"></span>
                                    </a> 
                                    @else
                                      -
                                  @endif
                                </td>
                                <td>
                                  @if(isset($sacb_details->getBooking->sale_person_bonus_amount) && !empty($sacb_details->getBooking->sale_person_bonus_amount) && !is_null($sac_batch->getSalePersonCurrency))
                                    {{ $sac_batch->getSalePersonCurrency->code }}
                                    {{ Helper::number_format($sacb_details->getBooking->sale_person_bonus_amount) }}
                                  @else
                                    -
                                  @endif
                                </td>
                                <td>
                                  @if($sacb_details->status == 'dispute')
                                    <button type="button" data-batch_id="{{$sac_batch->id}}" data-booking_currency_code="{{ $sacb_details->getBooking->getCurrency->code }}" data-booking_ID="{{ $sacb_details->booking_id }}" data-sale_agent_currency_code="{{ $sac_batch->getSalePersonCurrency->code }}" data-sale_agent_commission_amount="{{ $sacb_details->commission_amount_in_sale_person_currency }}" class="adjust-booking-commission btn btn-outline-info btn-xs float-right mr-2" title="Adjust Commission"><i class="fa fa-adjust"></i></button>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
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
                {{-- {{ $sac_batch->links() }} --}}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

  @include('sale_agent_commission_batches.includes.pay_batch_modal', $payment_methods)
  @include('sale_agent_commission_batches.includes.dispute_detail_modal')
  @include('sale_agent_commission_batches.includes.adjust_booking_commission_modal')
@endsection

@push('js')
  <script src="{{ asset('js/commission_management.js') }}" ></script>
@endpush

{{-- <section class="content p-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <a href="" id="delete_all" class="btn btn-danger  btn-sm ">
          <span class="fa fa-trash"></span> &nbsp;
          <span>Delete Selected Record</span>
        </a>
      </div>
    </div>
  </div>
</section> --}}
{{-- <a id="collapse-anchor-{{$group->id}}" data-toggle="collapse" href="#collapse{{$group->id}}">
    <span class="text-secondary fa fa-eye"></span>
</a> --}}
{{-- <th >Total Commission Amount</th> --}}
{{-- <td>{{ \Helper::number_format($group->total_commission_amount).' '.$booking_currency }}</td> --}}
{{-- <th>Commission Amount</th> --}}
                                {{-- <td>{{ \Helper::number_format($q->commission_amount).' '.$booking_currency }} </td> --}}

{{-- id="collapse{{$group->id}}" class="panel-collapse collapse" style="background-color:transparent" --}}

{{-- @include('includes.multiple_delete',['table_name' => 'groups']) --}}
