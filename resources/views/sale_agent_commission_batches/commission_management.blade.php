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
              Com. Management
              {{-- <x-add-new-button :route="route('pay_commissions.create')"></x-add-new-button> --}}
            </h4>
          </div>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Pay Com. Management</a></li>
            <li class="breadcrumb-item active">Com. Management</li>
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
                Com. Management List
              </h3>
            </div>

            <!-- Multi Actions -->
            <div class="card-header">
              <div class="row">
                <form method="POST" id="sale_person_commission_bulk_action" action="{{ route('pay_commissions.sale_person_commission_bulk_action') }}" >
                  @csrf
                  <input type="hidden" name="bulk_action_type" value="">
                  <input type="hidden" name="bulk_action_ids" value="">
                  <input type="hidden" name="batch_ids" value="">

                  <div class="dropdown show btn-group">
                    <button type="button" class="btn btn-base btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Action
                    </button>
                    <div class="dropdown-menu">
                      <button type="button" data-action_type="confirmed" class="dropdown-item sale-person-commission-bulk-action-item"><i class="fa fa-check text-green mr-2"></i>Confirm</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- End Multi Actions -->

              {{-- <div>
                  <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Pending</a></li>
                      <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Partials</a></li>
                      <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Confirmed</a></li>
                  </ul>
              </div> --}}

            <div class="card-body p-0" id="listing_card_body">
              <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Batch Name</th>
                      <th>Payment Method</th>
                      <th>Status</th>
                      <th>Total Paid Amount</th>
                      <th>Total Outstanding Amount</th>
                    </tr>
                  </thead>
                  <tbody>

                    @if($sac_batch && $sac_batch->count())
                      @foreach ($sac_batch as $key => $sac_batch)
                        <tr>
                          <td class="d-flex  align-items-center">
                            <button class="btn btn-sm parent-row" data-id="{{$sac_batch->id}}">
                              <span class="fa fa-plus"></span>
                            </button>

                            @if($sac_batch->status != 'paid')
                              <div class="custom-control custom-checkbox ml-2">
                                <input type="checkbox" id="child_{{$sac_batch->id}}" value="{{$sac_batch->id}}" data-batch_id="{{ $sac_batch->id }}" class="batch-parent custom-control-input custom-control-input-success custom-control-input-outline">
                                <label for="child_{{$sac_batch->id}}" class="custom-control-label"></label>
                              </div>
                            @endif

                          </td>
                          <td>{{ $sac_batch->name }}</td>
                          <td>{{ isset($sac_batch->getPaymentMethod->name) && !empty($sac_batch->getPaymentMethod->name) ? $sac_batch->getPaymentMethod->name : '' }}</td>
                          <td>{!! $sac_batch->formatted_status !!}</td>
                          <td>{{ isset($sac_batch->getSalePersonCurrency->code) && !empty($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : '' }} {{ Helper::number_format($sac_batch->total_paid_amount) }}</td>
                          <td>{{ isset($sac_batch->getSalePersonCurrency->code) && !empty($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : '' }} {{ Helper::number_format($sac_batch->total_outstanding_amount) }}</td>
                          
                          <tbody class="child-row d-none" id="child-row-{{$sac_batch->id}}">
                            <tr>
                              <th>
                              </th>
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
                              <th style="width: 50%">Dispute Detail</th>
                              <th>Action</th>
                            </tr>
                            @foreach($sac_batch->getSaleAgentCommissionBatchDetails as $sacb_details)
                              <tr>
                                <td> 
                                  @if($sac_batch->status != 'paid')
                                    <div class="custom-control custom-checkbox d-flex justify-content-end">
                                      <input type="checkbox" id="child_{{sprintf("%04s", $sacb_details->id)}}" value="{{$sacb_details->id}}" class="batch-child batch-child-{{ $sac_batch->id }} custom-control-input custom-control-input-success custom-control-input-outline">
                                      <label for="child_{{sprintf("%04s", $sacb_details->id)}}" class="custom-control-label"></label>
                                    </div>
                                  @endif
                                </td>
                                <td> {{ !is_null($sacb_details->getBooking->ref_no) ? $sacb_details->getBooking->ref_no : '' }} </td>
                                <td> {{ !is_null($sacb_details->getBooking->getCurrency) ? $sacb_details->getBooking->getCurrency->code.' - '.$sacb_details->getBooking->getCurrency->name : '' }} </td>
                                <td> {{ !is_null($sacb_details->getBooking->getBrand) ? $sacb_details->getBooking->getBrand->name : '' }} </td>
                                <td> {{ !is_null($sacb_details->getBooking->getHolidayType) ? $sacb_details->getBooking->getHolidayType->name : '' }} </td>
                                <td> {{ !is_null($sacb_details->getBooking->getSeason) ? $sacb_details->getBooking->getSeason->name : '' }} </td>
                                <td> {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} {{ Helper::number_format($sacb_details->commission_amount_in_sale_person_currency) }} </td>
                                <td> {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} {{ Helper::number_format($sacb_details->total_paid_amount_yet) }}</td>
                                <td> {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} {{ Helper::number_format($sacb_details->outstanding_amount_left) }} </td>
                                <td> {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} {{ Helper::number_format($sacb_details->pay_commission_amount) }} </td>
                                <td> 
                                  @if($sacb_details->status != 'dispute') 
                                    <a href="javascript:void(0)" class="view-detail" data-booking_id="{{$sacb_details->booking_id}}"> 
                                    {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} 
                                      {{ Helper::number_format($sacb_details->total_paid_amount) }}
                                    </a>
                                  @else
                                    {{ !is_null($sac_batch->getSalePersonCurrency->code) ? $sac_batch->getSalePersonCurrency->code : ''  }} 
                                    {{ Helper::number_format($sacb_details->total_paid_amount) }}
                                  @endif
                               </td>
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

                                <td class="d-flex">
                                  @if($sacb_details->status != 'paid' && $sacb_details->total_paid_amount_yet == 0)
                                    <button type="button" class="commission-status btn btn-outline-success btn-xs float-right mr-2" data-action="{{ route('pay_commissions.commission_action', ['confirmed', encrypt($sacb_details->sac_batch_id), encrypt($sacb_details->id)]) }}" data-action_type="confirmed" title="Confirm Commission"><i class="fa fa-check"></i></button>
                                    <button type="button" class="commission-status btn btn-outline-danger btn-xs float-right mr-2" data-action="{{ route('pay_commissions.commission_action', ['dispute', encrypt($sacb_details->sac_batch_id), encrypt($sacb_details->booking_id)]) }}" data-action_type="dispute" title="Dispute Commission"><i class="fa fa-times"></i></button>
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

            <div id="overlay" class=""></div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

  @include('sale_agent_commission_batches.includes.add_dispute_modal')
  @include('sale_agent_commission_batches.includes.dispute_detail_modal')
  @include('sale_agent_commission_batches.includes.view_detail_modal')

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
