@extends('layouts.app')

@section('title','View Quote')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>View Quote</h4>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Quote List</h3>
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
                                        @foreach ($quotes as $key => $quote)
                                            <tr>
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
                                                
                                                <td>{{ $quote->getBookingCurrency->code.'-'.$quote->getBookingCurrency->name }}</td>
                                                <td>{!! $quote->booking_formated_status !!}</td>
                                                <td>{{ $quote->formated_booking_date }}</td>
                                                <td>{{ $quote->formated_created_at }}</td>
                                                
                                                <td width="10%" >
                                                  @if($quote->booking_status == 'quote')
                                                    <a href="{{route('quotes.edit', encrypt($quote->id)) }}" class="btn btn-outline-success btn-xs" data-title="Edit" data-target="#edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- <a onclick="return confirm('Are you sure you want to convert this Quotation to Booking?');" href="{{ route('convert-quote-to-booking', $quote->id) }}" class="btn btn-success btn-xs" data-title="" data-target="#"><span class="fa fa-check"></span></a> --}}
                                                  @else
                                                    {{-- <a target="_blank" href="{{ route('view-quote-detail', $quote->id) }}" class="btn btn-primary btn-xs" data-title="Delete" data-target="#delete"><span class="fa fa-eye"></span></a> --}}
                                                  @endif
                                                  
                                                  <a onclick="return confirm('Are you sure want to Delete {{ $quote->ref_no }}');" href="{{ route('quotes.delete', encrypt($quote->id)) }}" class="btn btn-outline-danger btn-xs" data-title="Delete" data-target="#delete"><span class="fa fa-trash-alt"></span></a>
                        
                                                </td>
                                                <tbody class="append" id="appendChild{{$quote->id}}" style="{{ $quote->quote_count > 1 ? 'background-color: #f9f9f9;' : null}}">
                                                  
                                                </tbody>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                                </div>

                            </div>

                            <div class="card-footer clearfix">
                               
                            </div>
                        </div>

                    </div>

                </div>



            </div>
        </section>

    </div>


@endsection