@extends('layouts.app')

@section('title','View Quote')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>View @if(isset($status) && $status == 'archive') Archive @endif Quote</h4>
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

        <section class="content">
            <div class="container-fluid">
                <div class="card card-default {{ (request()->has('search'))? '' : 'collapsed-card' }}">
                    <div class="card-header">
                        <h3 class="card-title"><b>Filters</b></h3>
    
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-{{ (request()->has('search'))? 'minus' : 'plus' }}"></i>
                            </button>
                        </div>
                    </div>
         
                    <div class="card-body">
                        <form method="get" action="{{ route('quotes.index') }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Search</label>
                                    <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
                                </div>
                            </div>
                        </div>
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
                                    <label>Status</label>
                                    <select class="form-control select2single" name="status">
                                        <option value="" selected>Select Status</option>
                                        <option {{ (old('search') == 'booked')? 'selected': ((request()->get('status') == 'booked')? 'selected' : null) }} value="booked" >Booked</option>
                                        <option {{ (old('search') == 'quote')? 'selected': ((request()->get('status') == 'quote')? 'selected' : null) }} value="quote" >Quote</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Booking Currency</label>
                                    <select class="form-control select2single" name="booking_currency">
                                        <option value="" selected >Select Booking Currency</option>
                                        @foreach ($currencies as $curren)
                                            <option value="{{ $curren->code }}" data-image="data:image/png;base64, {{$curren->flag}}" {{ (old('booking_currency') == $curren->code)? 'selected': ((request()->get('booking_currency') ==  $curren->code )? 'selected' : null) }}> &nbsp; {{$curren->code}} - {{$curren->name}} </option>
                                        @endforeach
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
                            
                            <div class="col">
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select class="form-control select2single" name="brand">
                                        <option value="" selected >Select Brand </option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}" {{ (old('brand') == $brand->name)? 'selected': ((request()->get('brand') == $brand->name)? 'selected' : null) }}>{{ $brand->name }} </option>
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

                        <div class="row mt-1">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Search</button>
                                <a href="{{ route('quotes.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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
                                <div class="table-responsive">
                                    <table id="example1" class="table" >
                                        <thead>
                                          <tr>
                                            <th></th>
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
                                                    @if($quote->quote_count > 1)
                                                        <button class="btn btn-sm addChild" id="show{{$quote->id}}" data-remove="#remove{{$quote->id}}" data-append="#appendChild{{$quote->id}}" data-ref="{{ $quote->ref_no }}" data-id="{{$quote->id}}">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                        <button class="btn btn-sm removeChild" id="remove{{$quote->id}}" data-show="#show{{$quote->id}}" data-append="#appendChild{{$quote->id}}" data-ref="{{ $quote->ref_no }}" data-id="{{$quote->id}}" style="display:none;" >
                                                            <span class="fa fa-minus"></span>
                                                        </button>
                                                    @endif
                                                    </td>
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
                                                            <a href="{{ route('quotes.edit', encrypt($quote->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="Edit" data-target="#edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form class="mr-2 " method="POST" action="{{ route('quotes.booked', encrypt($quote->id)) }}">
                                                                @csrf @method('patch')
                                                                <button type="submit" onclick="return confirm('Are you sure you want to convert this Quotation to Booking?');" class="btn btn-success btn-xs" data-title="" data-target="#"><span class="fa fa-check"></span></button>
                                                            </form>
                                                        @endif

                                                        <a href="{{ route('quotes.final', encrypt($quote->id)) }}" class="mr-2 btn btn-outline-info btn-xs" data-title="Final Quotation" data-target="#Final_Quotation">
                                                            <span class="fa fa-eye"></span>
                                                        </a>

                                                        @if($quote->booking_status == 'quote')
                                                            <a onclick="return confirm('Are you sure want to Delete {{ $quote->ref_no }} ?');" href="{{ route('quotes.delete', encrypt($quote->id)) }}" class="mr-2  btn btn-outline-danger btn-xs" data-title="Delete" data-target="#delete"><span class="fa fa-trash-alt"></span></a>
                                                        @endif

                                                        @if($quote->booking_status == 'booked')
                                                       
                                                                <form class="mr-2 " method="POST" action="{{ route('quotes.archive.store', encrypt($quote->id)) }}">
                                                                    @csrf @method('patch')
                                                                    @if(isset($status))
                                                                    <input type="hidden" value="true" name="status">
                                                                    @endif
                                                                    <input type="hidden" value="{{ $quote->is_archive }}" name="is_archive">
                                                                    <button type="submit" class="btn btn-outline-dark btn-xs" data-title="Archive" data-target="#archive">
                                                                        @if(isset($status) || $quote->is_archive == 1)
                                                                            <i class="fa fa-recycle" ></i>
                                                                        @else
                                                                            <i class="fa fa-archive" ></i>
                                                                        @endif
                                                                        </button>
                                                                </form>
                                                            
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
