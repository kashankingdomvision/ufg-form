@extends('layouts.app')

@section('title','View Pay Commission')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">

        <div class="col-sm-6">
          <div class="d-flex">
            <h4>
              View Pay Commission
              <x-add-new-button :route="route('pay_commissions.create')"></x-add-new-button>
            </h4>
          </div>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Quote Management</a></li>
            <li class="breadcrumb-item active">Group Quote</li>
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
                Pay Commission List
              </h3>
            </div>

            <div class="card-body p-0" id="listing_card_body">
              <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Batch Name</th>
                      <th>Payment Mehtod</th>
                      <th>Total Paid Amount</th>
                      <th>Total Outstanding Amount</th>
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
                          <td>{{ $sac_batch->getPaymentMethod->name }}</td>
                          <td>{{ Helper::number_format($sac_batch->total_paid_amount) }}</td>
                          <td>{{ Helper::number_format($sac_batch->total_outstanding_amount) }}</td>
                          
                          <tbody class="child-row d-none" id="child-row-{{$sac_batch->id}}">
                            <tr>
                              <th></th>
                              <th>Booking Ref #</th>
                              <th>Sales Agent</th>
                              <th>Com. Amount in Agent's Currency</th>
                              <th>Total Paid Amount Yet</th>
                              <th>Outstanding Amount Left</th>
                              <th>Pay Commission Amount</th>
                              <th style="min-width: 210px;">Total Paid Amount</th>
                              <th>Total Outstanding Amount</th>
                              <th></th>
                            </tr>
                            @foreach($sac_batch->getSaleAgentCommissionBatchDetails as $sacb_details)
                              <tr>
                                <td></td>
                                <td> {{ $sacb_details->getBooking->ref_no }} </td>
                                <td> {{ isset($sacb_details->getBooking->getSalePerson->name) ? $sacb_details->getBooking->getSalePerson->name : ''  }} </td>
                                <td> {{ isset($sacb_details->getCurrency->code) ? $sacb_details->getCurrency->code : ''  }} {{ Helper::number_format($sacb_details->commission_amount_in_default_currency) }} </td>
                                <td> {{ isset($sacb_details->getCurrency->code) ? $sacb_details->getCurrency->code : ''  }} {{ Helper::number_format($sacb_details->total_paid_amount_yet) }} </td>
                                <td> {{ isset($sacb_details->getCurrency->code) ? $sacb_details->getCurrency->code : ''  }} {{ Helper::number_format($sacb_details->outstanding_amount_left) }} </td>
                                <td> {{ isset($sacb_details->getCurrency->code) ? $sacb_details->getCurrency->code : ''  }} {{ Helper::number_format($sacb_details->pay_commission_amount) }} </td>
                                <td> {{ isset($sacb_details->getCurrency->code) ? $sacb_details->getCurrency->code : ''  }} {{ Helper::number_format($sacb_details->total_paid_amount) }} </td>
                                <td> {{ isset($sacb_details->getCurrency->code) ? $sacb_details->getCurrency->code : ''  }} {{ Helper::number_format($sacb_details->total_outstanding_amount) }} </td>
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
@endsection

@push('js')
  <script src="{{ asset('js/quote_management.js') }}" ></script>
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
