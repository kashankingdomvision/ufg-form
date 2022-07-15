@extends('layouts.app')

@section('title','View Booking Commissions')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <h4>
                            View Booking Commission
                        </h4>
                    </div>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item"><a>Quote Management</a></li>
                        <li class="breadcrumb-item active">Booking Commissions</li>
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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title float-left">
                                Booking Commissions List
                            </h3>
                        </div>

                        <div class="card-body p-0" id="listing_card_body">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Zoho Ref #</th>
                                            <th>Quote Ref #</th>
                                            <th>Brand</th>
                                            <th>Type Of Holidays</th>
                                            <th>Sales Person</th>
                                            <th>Agency Booking</th>
                                            <th>Booking Currency</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if($bookings && $bookings->count())
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td>
                                                        <button class="btn btn-sm parent-row" data-id="{{$booking->id}}">
                                                        <span class="fa fa-plus"></span>
                                                        </button>
                                                    </td>

                                                    <td>{{ $booking->ref_no }}</td>
                                                    <td>{{ $booking->quote_ref }}</td>
                                                    <td>{{ $booking->getBrand->name }}</td>
                                                    <td>{{ $booking->getHolidayType->name??NULL}}</td>
                                                    <td>{{ $booking->getSalePerson->name}}</td>
                                                    <td>{{ $booking->agency_booking}}</td>
                                                    <td>{{!empty($booking->getCurrency->code) && !empty($booking->getCurrency->name) ? $booking->getCurrency->code.' - '.$booking->getCurrency->name : NULL }}</td>
                                                    <td>{{ $booking->pax_no}}</td>
                                                
                                                    <tbody class="child-row d-none" id="child-row-{{$booking->id}}">
                                                            <tr>
                                                                <th></th>
                                                                <th>Com. Amount in Agent's Currency	</th>
                                                                <th>Total Paid Amount Yet</th>
                                                                <th>Pay Commission Amount </th>
                                                                <th>Outstanding Amount</th>
                                                            </tr>
                                                            @foreach($booking->getCommissionDetails as $bcdetails)
                                                                <tr>
                                                                    <td></td>
                                                                    <td>{{ $bcdetails->getSalePersonCurrency->code }} {{ Helper::number_format($bcdetails->commission_amount_in_sale_person_currency) }}</td>
                                                                    <td>
                                                                        {{ $bcdetails->getSalePersonCurrency->code }}
                                                                        {{ Helper::number_format($bcdetails->total_paid_amount_yet) }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $bcdetails->getSalePersonCurrency->code }}
                                                                        {{ Helper::number_format($bcdetails->pay_commission_amount) }}
                                                                    </td>

                                                                    <td>
                                                                        {{ $bcdetails->getSalePersonCurrency->code }}
                                                                        {{ Helper::number_format($bcdetails->total_outstanding_amount) }}
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
                                {{-- {{ $bookings->links() }} --}}
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
  <script src="{{ asset('js/commission_management.js') }}" ></script>
@endpush