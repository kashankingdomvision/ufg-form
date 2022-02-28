@extends('layouts.app')

@section('title','View Quote')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4></h4>
                    <div class="d-flex">
                        <h4>View @if(isset($status) && $status == 'archive') Archive @endif Quote
                            <x-add-new-button :route="route('quotes.create')" />
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item active">Quote Management</li>
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

    <x-page-filters :route="route('quotes.index')">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Client Type</label>
                    <select class="form-control select2single" name="client_type">
                        <option value="" selected>Select Client Type </option>
                        <option {{ (old('client_type') == 'client')? 'selected': ((request()->get('client_type') == 'client')? 'selected' : null) }} value="client" >Client</option>
                        <option {{ (old('client_type') == 'agency')? 'selected': ((request()->get('client_type') == 'agency')? 'selected' : null) }} value="agency" >Agency</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label>Agent / Staff</label>
                    <select class="form-control select2single" name="staff">
                        <option value="" selected>Select Agent / Staff </option>
                        @foreach ($users as $user)
                            <option value="{{ $user->name }}" {{ (old('staff') == $user->name)? 'selected': ((request()->get('staff') == $user->name)? 'selected' : null) }} >{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control select2single" name="status">
                        <option value="" selected>Select Status</option>
                        <option {{ (old('search') == 'booked')? 'selected': ((request()->get('status') == 'booked')? 'selected' : null) }} value="booked" >Booked</option>
                        <option {{ (old('search') == 'quote')? 'selected': ((request()->get('status') == 'quote')? 'selected' : null) }} value="quote" >Quote</option>
                        <option {{ (old('search') == 'cancelled')? 'selected': ((request()->get('status') == 'cancelled')? 'selected' : null) }} value="cancelled" >Cancelled</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label>Booking Season</label>
                    <select class="form-control select2single" name="booking_season">
                        <option value="" selected >Select Booking Season</option>
                        @foreach ($booking_seasons as $seasons)
                            <option value="{{ $seasons->name }}" {{ (old('booking_season') == $seasons->name)? 'selected': ((request()->get('booking_season') == $seasons->name)? 'selected' : null) }}>{{ $seasons->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Booking Currency</label>
                    <select class="form-control select2-multiple "  data-placeholder="Select Booking Currency" multiple name="booking_currency[]">
                        @foreach ($currencies as $curren)
                            <option value="{{ $curren->code }}" data-image="data:image/png;base64, {{$curren->flag}}" {{ (old('booking_currency') == $curren->code)? 'selected': ( (!empty(request()->get('booking_currency')))? (((in_array($curren->code, request()->get('booking_currency'))))? 'selected' : null) : '') }}> &nbsp; {{$curren->code}} - {{$curren->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Brand</label>
                    <select class="form-control select2-multiple "  data-placeholder="Select Brands" multiple name="brand[]">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->name }}" {{ (in_array($brand->name,[old('brand')]))? 'selected': ( (!empty(request()->get('brand')))? ((in_array($brand->name, request()->get('brand')))? 'selected' : null): '') }}>{{ $brand->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Date Range</label>
                    <input type="text" name="dates" value="{{ request()->get('dates') }}" autocomplete="off" class="form-control date-range-picker">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Search</label>
                    <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="Search by Client Name, Zoho Ref, Quote Ref, Email Address">
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
                            <h3 class="card-title">@if(isset($status) && $status == 'archive') Archived @endif Quote List</h3>
                        </div>
                        <!-- Multi Actions -->
                        <div class="card-header">
                            <div class="row">
                                <form method="POST" id="quote_bulk_action" action="{{ route('quotes.bulk.action') }}" >
                                    @csrf
                                    <input type="hidden" name="bulk_action_type" value="">
                                    <input type="hidden" name="bulk_action_ids" value="">

                                    <div class="dropdown show btn-group">
                                        <button type="button" class="btn btn-base btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Select Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" data-action_type="cancel" class="dropdown-item quote-bulk-action-item"><i class="fa fa-times text-red mr-2"></i>Cancel</button>
                                            <button type="button" data-action_type="revert_cancel" class="dropdown-item quote-bulk-action-item"><i class="fa fa-undo-alt text-green mr-2"></i>Revert Cancel</button>
                                            <button type="button" data-action_type="archive" class="dropdown-item quote-bulk-action-item"><i class="fa fa-archive text-dark mr-2"></i>Archive</button>
                                            <button type="button" data-action_type="unarchive" class="dropdown-item quote-bulk-action-item"><i class="fa fa-recycle text-secondary mr-2"></i>Unarchive</button>

                                            <div class="dropdown-divider"></div>
                                            <button type="button" data-action_type="store_group_quote" class="dropdown-item quote-bulk-action-item"><i class="fa fa-plus text-green mr-2"></i>Create Group Quote</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                            <!-- End Multi Actions -->

                        <div class="card-body p-0" id="listing_card_body">
                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                        <th width="8">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="parent custom-control-input custom-control-input-success custom-control-input-outline" id="parent">
                                                <label for="parent" class="custom-control-label"></label>
                                            </div>

                                        </th>
                                        <th></th>
                                        <th width="8"></th>
                                        <th>Zoho Ref #</th>
                                        <th>Quote Ref #</th>
                                        <th>Lead Passenger</th>
                                        <th>Season</th>
                                        <th>Brand</th>
                                        <th>Booking Currency</th>
                                        <th>Status</th>
                                        <th>Booking Date</th>
                                        <th>Created At</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($quotes && $quotes->count())
                                            @foreach ($quotes as $key => $quote)
                                                <tr class="{{ $quote->quote_count > 1 ? 'tbody-highlight' : ''}}">

                                                    <td>
                                                        @if($quote->booking_status != 'booked')
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" id="child_{{$quote->id}}" value="{{$quote->id}}" data-booking_currency="{{$quote->getBookingCurrency->code}}" class="child custom-control-input custom-control-input-success custom-control-input-outline">
                                                                <label for="child_{{$quote->id}}" class="custom-control-label"></label>
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td width="8">
                                                        @if($quote->quote_count > 1)
                                                            <button class="btn btn-sm addChild" id="show{{$quote->id}}" data-remove="#remove{{$quote->id}}" data-append="#appendChild{{$quote->id}}" data-ref="{{ $quote->ref_no }}" data-id="{{$quote->id}}">
                                                                <span class="fa fa-plus"></span>
                                                            </button>
                                                            <button class="btn btn-sm removeChild" id="remove{{$quote->id}}" data-show="#show{{$quote->id}}" data-append="#appendChild{{$quote->id}}" data-ref="{{ $quote->ref_no }}" data-id="{{$quote->id}}" style="display:none;" >
                                                                <span class="fa fa-minus"></span>
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td>{!! $quote->has_user_edit !!}</td>
                                                    <td>{{ $quote->ref_no }}</td>
                                                    @if($quote->booking_status != 'booked')
                                                        <td> <a href="{{ route('quotes.final', encrypt($quote->id)) }}">{{ $quote->quote_ref }}</a> </td>
                                                    @endif
                                                    @if($quote->booking_status == 'booked')
                                                        <td> <a href="{{ route('bookings.show', encrypt($quote->getBooking->id)) }}">{{ $quote->quote_ref }}</a> </td>
                                                    @endif
                                                    <td>{{ $quote->lead_passenger_name }}</td>
                                                    <td>{{ $quote->getSeason->name }}</td>
                                                    <td>{{ (isset($quote->getBrand->name))? $quote->getBrand->name: NULL }}</td>
                                                    <td>{{ $quote->getBookingCurrency->code.' - '.$quote->getBookingCurrency->name }}</td>
                                                    <td>{!! $quote->booking_formated_status !!}</td>
                                                    <td>{{ $quote->formated_booking_date }}</td>
                                                    <td>{{ $quote->formated_created_at }}</td>
                                                    <td>{{ isset($quote->getCreatedBy->name) && !empty($quote->getCreatedBy->name) ? $quote->getCreatedBy->name : '' }}</td>
                                                    <td width="10%" class="d-flex">
                                                        @if($quote->booking_status == 'quote')
                                                            <a href="{{ route('quotes.edit', encrypt($quote->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="Edit" data-target="#edit" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>

                                                            <button type="button" class="multiple-alert btn btn-outline-success btn-xs float-right mr-2" data-action_type="booked_quote" data-action="{{ route('quotes.multiple.alert', ['booked_quote', encrypt($quote->id)]) }}" data-quote_id="{{encrypt($quote->id)}}" title="Convert to Booking"><i class="fa fa-check"></i></button>
                                                        @endif

                                                        @if(in_array($quote->booking_status, ['quote', 'cancelled']))
                                                            <a href="{{ route('quotes.final', encrypt($quote->id)) }}" title="View Quote" class="mr-2 btn btn-outline-info btn-xs" data-title="Final Quotation" data-target="#Final_Quotation">
                                                                <span class="fa fa-eye"></span>
                                                            </a>
                                                        @endif

                                                        @if($quote->booking_status == 'booked')
                                                            <a href="{{ route('bookings.show',encrypt($quote->getBooking->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="View Booking" title="View Booking" >
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endif

                                                        @if($quote->booking_status == 'quote')
                                                            <button type="button" class="multiple-alert btn btn-outline-danger btn-xs float-right mr-2" data-action_type="cancel_quote" data-action="{{ route('quotes.multiple.alert', ['cancel_quote', encrypt($quote->id)]) }}" title="Cancel Quote"><i class="fa fa-times"></i></button>
                                                        @endif

                                                        @if($quote->booking_status == 'cancelled')
                                                            <button type="button" class="multiple-alert btn btn-outline-success btn-xs float-right mr-2" data-action_type="restore_quote" data-action="{{ route('quotes.multiple.alert', ['restore_quote', encrypt($quote->id)]) }}" title="Restore Quote"><i class="fa fa-undo-alt"></i></button>
                                                        @endif

                                                        @if($quote->is_archive == 0)
                                                            <button type="button" class="multiple-alert btn btn-outline-dark btn-xs mr-2" data-action_type="archive_quote" data-action="{{ route('quotes.multiple.alert', ['archive_quote', encrypt($quote->id)]) }}" title="Archive Quote"><i class="fa fa-archive nav-icon"></i></button>
                                                        @endif

                                                        @if($quote->is_archive == 1)
                                                            <button type="button" class="multiple-alert btn btn-outline-dark btn-xs mr-2" data-action_type="unarchive_quote" data-action="{{ route('quotes.multiple.alert', ['unarchive_quote', encrypt($quote->id)]) }}" title="Unarchive Quote"><i class="fa fa-recycle"></i></button>
                                                        @endif

                                                        @if($quote->booking_status == 'quote')
                                                            <button type="button" class="multiple-alert btn btn-outline-secondary btn-xs mr-2" title="Quote Clones" data-action_type="clone_quote" data-action="{{ route('quotes.multiple.alert', ['clone_quote', encrypt($quote->id)]) }}" data-target="#clone_quote"><i class="fa fa-clone"></i></button>
                                                        @endif

                                                        @if($quote->booking_status == 'quote')
                                                            <a class="mr-2 float-right" href="{{ route('quotes.export', encrypt($quote->id)) }}">
                                                                <button type="button" class="btn btn-outline-secondary btn-xs" data-title="" data-target="#" title="Export in Excel"><i class="fa fa-file-export"></i></button>
                                                            </a>
                                                        @endif

                                                        @if($quote->booking_status == 'quote')
                                                            <a href="{{ route('quotes.quote.documment',encrypt($quote->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="View Quote Document" title="View Quote Document" >
                                                                <i class="fas fa-file"></i>
                                                            </a>
                                                        @endif

                                                    </td>
                                                    <tbody class="append {{ $quote->quote_count > 1 ? 'tbody-highlight' : ''}}" id="appendChild{{$quote->id}}">
                                                    </tbody>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr align="center"><td colspan="100%">No record found.</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal -->
                            @include("quotes.includes.store_group_modal")
                            <!-- Modal -->
                        </div>


                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $quotes->links() }}
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

{{-- 
<div class="icheck-primary">
    <input type="checkbox" class="parent">
</div> --}}

{{-- <div class="icheck-primary">
    <input type="checkbox" class="child" value="{{$quote->id}}" data-booking_currency="{{$quote->getBookingCurrency->code}}">
</div> --}}

{{-- @if($quote->booking_status == 'booked')
    <form class="mr-2 " method="POST" action="{{ route('quotes.archive.store', encrypt($quote->id)) }}">
        @csrf @method('patch')
        @if(isset($status))
        <input type="hidden" value="true" name="status">
        @endif
        <input type="hidden" value="{{ $quote->is_archive }}" name="is_archive">
        <button type="submit" class="btn btn-outline-dark btn-xs" data-title="Archive" title="{{ (isset($status) || $quote->is_archive == 1) ? 'Unarchive' : 'Archive' }}" data-target="#archive">
            @if(isset($status) || $quote->is_archive == 1)
                <i class="fa fa-recycle" ></i>
            @else
                <i class="fa fa-archive" ></i>
            @endif
        </button>
    </form>
@endif --}}

{{-- @include('includes.quote_multiple_delete') --}}

{{-- <section class="content p-2">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('bulk.action') }}" class="bulk-action">
                @csrf @method('PUT')
                <input  type="hidden" name="table" value="quotes" >
                <div class="dropdown show">
                    <a class="btn btn-base btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <button type="submit" name="cancel" class="dropdown-item btn-link btnbulkClick">Cancel</button>
                        <button type="submit" name="quote" class="dropdown-item btn-link btnbulkClick">Revert Cancel</button>
                        <button type="submit"  name="{{ (isset($status) && $status == 'archive')? 'unarchive': 'archive' }}" class="dropdown-item btn-link btnbulkClick">{{ (isset($status) && $status == 'archive')? 'Unarchive': 'Archive' }}</button>
                        <div class="border-top my-2"></div>
                        <a href="javascript:void(0)" name="group_quote" class="dropdown-item btn-link createGroupQuote">Create Group Quote</a>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</section> --}}

{{-- <td width="8">{{ $quote->getSalePerson->name }}</td> --}}

{{-- <a href="{{ route('quotes.document', encrypt($quote->id)) }}" title="View" class="mr-2 btn btn-outline-info btn-xs" data-title="Document Quotation" data-target="#Document_Quotation">
    <i class="fas fa-file"></i>
</a> --}}
