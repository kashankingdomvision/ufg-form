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
            <div class="container-fluid ">
                <div class="card card-default {{ (request()->get('search') == '')? 'collapsed-card': '' }}">
                    <button type="button" class="btn btn-tool text-dark" data-card-widget="collapse">
                    <div class="card-header ">
                        <h3 class="card-title display-2"><strong>Filters</strong></h3>
                        <div class="card-tools">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </button>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Search</label>
                                    <select class="form-control" name="status">
                                        <option {{ (old('search') == 'all')? 'selected': ((request()->get('status') == 'all')? 'selected' : null) }} value="all" selected>All Status</option>
                                        <option {{ (old('search') == 'booked')? 'selected': ((request()->get('status') == 'booked')? 'selected' : null) }} value="booked" >Booked</option>
                                        <option {{ (old('search') == 'quote')? 'selected': ((request()->get('status') == 'quote')? 'selected' : null) }} value="quote" >Quote</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>From</label>
                                            <input type="text" value="{{ (request()->get('date'))?request()->get('date')['from']: null }}" name="date[from]" class="form-control datepicker" >
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input type="text" value="{{ (request()->get('date'))? request()->get('date')['to']: null }}" name="date[to]" class="form-control datepicker" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex flex-row-reverse bd-highlight">
                                    <div class="col-md-2 ">
                                        <button type="submit" class="btn btn-outline-success btn-block">Search</button>
                                    </div>
                                    <a href="{{ route('quotes.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
                                </div>
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
                                                    <td>{{ $quote->quote_ref }}</td>
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
                                                            <a onclick="return confirm('Are you sure want to Delete {{ $quote->ref_no }} ?');" href="{{ route('quotes.delete', encrypt($quote->id)) }}" class="mr-2  btn btn-outline-danger btn-xs" data-title="Delete" data-target="#delete"><span class="fa fa-trash-alt"></span></a>
                                                        @endif

                                                        @if($quote->booking_status == 'booked')
                                                            <a href="{{ route('quotes.final', encrypt($quote->id)) }}" class="mr-2 btn btn-outline-info btn-xs" data-title="Final Quotation" data-target="#Final_Quotation">
                                                                <span class="fa fa-eye"></span>
                                                            </a>
                                                          
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
