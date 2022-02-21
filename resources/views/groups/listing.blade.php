@extends('layouts.app')

@section('title','View Group Quotes')

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">

        <div class="col-sm-6">
          <div class="d-flex">
            <h4>
              View Group Quotes
              <x-add-new-button :route="route('groups.create')"></x-add-new-button>
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

  <x-page-filters :route="route('groups.index')">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Search</label>
          <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
        </div>
      </div>
    </div>
  </x-page-filters>

  <section class="content p-2">
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
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title float-left">
                Group List
              </h3>
            </div>

            <!-- Multi Actions -->
            <div class="card-header">
              <div class="row">
                <form method="POST" id="group_bulk_action" action="{{ route('groups.bulk.action') }}" >
                  @csrf
                  <input type="hidden" name="bulk_action_type" value="">
                  <input type="hidden" name="bulk_action_ids" value="">

                  <div class="dropdown show btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Action
                    </button>
                    <div class="dropdown-menu">
                      <button type="button" data-action_type="delete" class="dropdown-item group-bulk-action-item">Delete</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- End Multi Actions -->

            <div class="card-body p-0" id="listing_card_body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="parent custom-control-input custom-control-input-success custom-control-input-outline" id="parent">
                          <label for="parent" class="custom-control-label"></label>
                        </div>
                      </th>
                      <th></th>
                      <th>Group Name</th>
                      <th>Total Net Price</th>
                      <th>Total Markup Amount (Gross Margin)</th>
                      <th>Total Markup %</th>
                      <th>Total Selling Price</th>
                      <th>Total Profit Percentage</th>
                      <th style="width: 160px;">Booking Currency</th>
                      <th>Action</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    @if($groups && $groups->count())
                      @foreach ($groups as $group)
                        @php
                          $booking_currency = isset($group->getBookingCurrency->code) && !empty($group->getBookingCurrency->code) ? $group->getBookingCurrency->code : '';
                        @endphp

                        <tr>
                          <td>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" id="child_{{$group->id}}" value="{{$group->id}}" class="child custom-control-input custom-control-input-success custom-control-input-outline">
                              <label for="child_{{$group->id}}" class="custom-control-label"></label>
                            </div>
                          </td>

                          <td>
                            <button class="btn btn-sm parent-row" data-id="{{$group->id}}">
                              <span class="fa fa-plus"></span>
                            </button>
                          </td>
                          <td>{{ $group->name }}</td>
                          <td>{{ \Helper::number_format($group->total_net_price).' '.$booking_currency }}</td>
                          <td>{{ \Helper::number_format($group->total_markup_amount).' '.$booking_currency }}</td>
                          <td>{{ \Helper::number_format($group->total_markup_percentage).' %' }}</td>
                          <td>{{ \Helper::number_format($group->total_selling_price).' '.$booking_currency }}</td>
                          <td>{{ \Helper::number_format($group->total_profit_percentage).' %' }}</td>
                          <td>{{ isset($group->getBookingCurrency->name) && !empty($group->getBookingCurrency->name) ? $group->getBookingCurrency->code.' - '.$group->getBookingCurrency->name : '' }}</td>
                          <td colspan="2">
                            <form method="post" action="{{ route('groups.destroy', encrypt($group->id)) }}">
                              <a href="{{ route('groups.edit', encrypt($group->id)) }}" class="btn btn-outline-success btn-xs mr-2" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                              @csrf
                              @method('delete')
                              <button class="btn btn-outline-danger btn-xs" title="Delete" onclick="return confirm('Are you sure want to Delete this record?');">
                                <span class="fa fa-trash"></span>
                              </button>
                            </form>
                          </td>
                          
                          <tbody class="child-row d-none" id="child-row-{{$group->id}}">
                            <tr>
                            <th></th>
                            <th></th>
                                <th>Quote Ref #</th>
                                <th>Net Price</th>
                                <th>Markup Amount</th>
                                <th>Markup %</th>
                                <th>Selling Price</th>
                                <th>Profit Percentage</th>
                                <th style="width: 165px;">Booking Currency</th>
                                <th colspan="2"></th>
                            </tr>
                            @foreach($group->quotes as $q)
                              @php
                                $booking_currency = isset($q->getBookingCurrency->code) && !empty($q->getBookingCurrency->code) ?  $q->getBookingCurrency->code : '';
                              @endphp
      
                              <tr>
                                <td></td>
                                <td></td>

                                @if($q->booking_status != 'booked')
                                  <td> <a href="{{ route('quotes.final', encrypt($q->id)) }}">{{ $q->quote_ref }}</a></td>
                                @endif
        
                                @if($q->booking_status == 'booked')
                                  <td> <a 
                                    href="{{ route('bookings.show', encrypt($q->getBooking->id)) }}">{{ $q->quote_ref }}</a> </td>
                                @endif

                                <td>{{ \Helper::number_format($q->net_price).' '.$booking_currency }}</td>
                                <td>{{ \Helper::number_format($q->markup_amount).' '.$booking_currency }}</td>
                                <td>{{ \Helper::number_format($q->markup_percentage).' %' }}</td>
                                <td>{{ \Helper::number_format($q->selling_price).' '.$booking_currency }}</td>
                                <td>{{ \Helper::number_format($q->profit_percentage).' %' }}</td>
                                <td>{{ isset($q->getBookingCurrency->name) && !empty($q->getBookingCurrency->name) ? $q->getBookingCurrency->code.' - '.$q->getBookingCurrency->name : '' }}</td>
                                <td colspan="2">
                                  @if($q->booking_status == 'quote')
                                    <a href="{{ route('quotes.final', encrypt($q->id)) }}" title="View Quote" class="mr-2 btn btn-outline-info btn-xs" data-title="Final Quotation" data-target="#Final_Quotation">
                                      <span class="fa fa-eye"></span>
                                    </a>
                                  @endif
        
                                  @if($q->booking_status == 'booked')
                                    <a href="{{ route('bookings.show',encrypt($q->getBooking->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="View Booking" title="View Booking" >
                                      <i class="fas fa-eye"></i>
                                    </a>
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
                {{ $groups->links() }}
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

{{-- <a id="collapse-anchor-{{$group->id}}" data-toggle="collapse" href="#collapse{{$group->id}}">
    <span class="text-secondary fa fa-eye"></span>
</a> --}}
{{-- <th >Total Commission Amount</th> --}}
{{-- <td>{{ \Helper::number_format($group->total_commission_amount).' '.$booking_currency }}</td> --}}
{{-- <th>Commission Amount</th> --}}
                                {{-- <td>{{ \Helper::number_format($q->commission_amount).' '.$booking_currency }} </td> --}}

{{-- id="collapse{{$group->id}}" class="panel-collapse collapse" style="background-color:transparent" --}}

{{-- @include('includes.multiple_delete',['table_name' => 'groups']) --}}
