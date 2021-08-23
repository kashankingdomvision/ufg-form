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
                <div class="col">
                    <div class="form-group">
                        <label>Booking Currency</label>
                        <select class="form-control select2-multiple "  data-placeholder="Select Booking Currency" multiple name="booking_currency[]">
                            @foreach ($currencies as $curren)
                                <option value="{{ $curren->code }}" data-image="data:image/png;base64, {{$curren->flag}}" {{ (old('booking_currency') == $curren->code)? 'selected': ( (!empty(request()->get('booking_currency')))? (((in_array($curren->code, request()->get('booking_currency'))))? 'selected' : null) : '') }}> &nbsp; {{$curren->code}} - {{$curren->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group"> 
                        <label>Brand</label>
                        <select class="form-control select2-multiple "  data-placeholder="Select Brands" multiple name="brand[]">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->name }}" {{ (in_array($brand->name,[old('brand')]))? 'selected': ( (!empty(request()->get('brand')))? ((in_array($brand->name, request()->get('brand')))? 'selected' : null): '') }}>{{ $brand->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col">
                    <label><u> Created Date</u></label>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>From</label>
                                <input type="text" value="{{ (request()->get('created_date'))?request()->get('created_date')['from']: null }}" name="created_date[from]" class="form-control datepicker" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>To</label>
                                <input type="text" value="{{ (request()->get('created_date'))? request()->get('created_date')['to']: null }}" name="created_date[to]" class="form-control datepicker" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Search</label>
                        <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="Search by Client Name, Zoho Ref, Quote Ref, Email Address">
                    </div>
                </div>
            </div>
        </x-page-filters>
        
        <section class="content p-2">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('bulk.delete') }}" class="bulkDeleteData">
                        @csrf @method('delete')
                        <input  type="hidden" name="tab" value="quotes" >
                        <div class="dropdown show">
                            <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select Action
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <button type="submit" name="quote delete" class="dropdown-item btn-link btnbulkClick">Cancel</button>
                                <button type="submit"  name="{{ (isset($status) && $status == 'archive')? 'unarchive': 'archive' }}" class="dropdown-item btn-link btnbulkClick">{{ (isset($status) && $status == 'archive')? 'Unarchive': 'Archive' }}</button>
                            </div>
                        </div>
                    </form>
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
                                <h3 class="card-title">Quote @if(isset($status) && $status == 'archive') Archive @endif List</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive ">
                                    <table id="example1" class="table table-hover" >
                                        <thead>
                                          <tr>
                                            <th width="8">
                                                <div class="icheck-primary">
                                                    <input type="checkbox" class="parent">
                                                </div>
                                            </th>
                                            <th></th>
                                            <th width="8"></th>
                                            <th>User</th>
                                            <th>Behalf</th>
                                            <th>Zoho Ref #</th>
                                            <th>Quote Ref #</th>
                                            <th>Season</th>
                                            <th>Brand</th>
                                            <th>Booking Currency</th>
                                            <th>Status</th>
                                            <th>Booking Date</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @if($quotes && $quotes->count())
                                            @foreach ($quotes as $key => $quote)
                                                <tr class="{{ $quote->quote_count > 1 ? 'tbody-highlight' : ''}}">
                                                
                                                    <td>
                                                        @if($quote->booking_status == 'quote')
                                                            <div class="icheck-primary">
                                                                <input type="checkbox" class="child" value="{{$quote->id}}" >
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
                                                    <td >{!! $quote->has_user_edit !!}</td>
                                                    <td>{{ ($quote->user_id == 'sale_person_id')? '-' : $quote->getUser->name }}</td>
                                                    <td width="8">{{ $quote->getSalePerson->name }}</td>
                                                    <td>{{ $quote->ref_no }}</td>
                                                    <td> <a href="{{ route('quotes.final', encrypt($quote->id)) }}">{{ $quote->quote_ref }}</a> </td>
                                                    <td>{{ $quote->getSeason->name }}</td>
                                                    <td>{{ (isset($quote->getBrand->name))? $quote->getBrand->name: NULL }}</td>
                                                    
                                                    <td>{{ $quote->getBookingCurrency->code.' - '.$quote->getBookingCurrency->name }}</td>
                                                    <td>{!! $quote->booking_formated_status !!}</td>
                                                    <td>{{ $quote->formated_booking_date }}</td>
                                                    <td>{{ $quote->formated_created_at }}</td>
                                                    <td width="10%" class="d-flex">
                                                        @if($quote->booking_status == 'quote')
                                                            <a href="{{ route('quotes.edit', encrypt($quote->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="Edit" data-target="#edit" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form class="mr-2 " method="POST" action="{{ route('quotes.booked', encrypt($quote->id)) }}">
                                                                @csrf @method('patch')
                                                                <button type="submit" onclick="return confirm('Are you sure you want to convert this Quotation to Booking?');" class="btn btn-outline-success btn-xs" data-title="" data-target="#" title="Convert to Booking"><span class="fa fa-check"></span></button>
                                                            </form>
                                                        @endif

                                                        <a href="{{ route('quotes.final', encrypt($quote->id)) }}" title="View" class="mr-2 btn btn-outline-info btn-xs" data-title="Final Quotation" data-target="#Final_Quotation">
                                                            <span class="fa fa-eye"></span>
                                                        </a>
                                                      
                                                        @if($quote->booking_status == 'quote' && $quote->deleted_at == null)
                                                            <a onclick="return confirm('Are you sure want to cancel {{ $quote->ref_no }} ?');" href="{{ route('quotes.delete', encrypt($quote->id)) }}" class="mr-2  btn btn-outline-danger btn-xs" data-title="Cancel" title="Cancel" data-target="#Cancel"><span class="fa fa-times "></span></a>
                                                            @elseif($quote->deleted_at != null)
                                                            <a onclick="return confirm('Are you sure want to restore {{ $quote->ref_no }} ?');" href="{{ route('quotes.restore', encrypt($quote->id)) }}" class="mr-2  btn btn-success btn-xs" title="Restore" data-title="Restore" data-target="#Restore"><span class="fa fa-undo-alt"></span></a>
                                                            
                                                        @endif
                                                        @if($quote->booking_status == 'booked')
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
                                                        @endif
                                                        {{-- <a href="{{ route('quotes.document', encrypt($quote->id)) }}" title="View" class="mr-2 btn btn-outline-info btn-xs" data-title="Document Quotation" data-target="#Document_Quotation">
                                                            <i class="fas fa-file"></i>
                                                        </a> --}}
                                                        <form class="mr-2 " method="POST" action="{{ route('quotes.clone', encrypt($quote->id)) }}">
                                                            @csrf @method('patch')
                                                            <button type="submit" title="quote clone"  onclick="return confirm('Are you sure you would like to clone this quote?');" class="mr-2 btn btn-outline-secondary btn-xs" data-title="Clone Quotation" data-target="#clone_quote">
                                                                <i class="fa fa-clone"></i>
                                                            </button>
                                                        </form>
                                                        @if ($quote->getBooking != NULL)
                                                            <a href="{{ route('bookings.show',encrypt($quote->getBooking->id)) }}" class="m-0 btn btn-outline-success btn-xs" data-title="View Booking" title="View Booking" >
                                                                <i class="fas fa-book"></i>
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

                            </div>

                            @include('includes.quote_multiple_delete')

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
