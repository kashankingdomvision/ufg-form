@extends('layouts.app')

@section('title','View Booking')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>View Booking</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item">Booking</li>
                            <li class="breadcrumb-item active">Booking Season</li>
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
                                <h3 class="card-title">Booking List</h3>
                            </div>

                            <div class="card-body p-0">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Zoho Ref #</th>
                                                <th>Quote Ref #</th>
                                                <th>Lead Passenger</th>
                                                <th>Brand</th>
                                                <th>Type Of Holidays</th>
                                                <th>Sales Person</th>
                                                <th>Agency Booking</th>
                                                <th>Booking Currency</th>
                                                <th>Pax No.</th>
                                                <th>Dinning Preferences</th>
                                                <th>Bedding Preferences</th>
                                                {{-- <th>Transfer Info Responsible Person</th>
                                                <th>Transfer Organized Responsible Person</th>
                                                <th>Itinerary Finalised Responsible Person</th>
                                                <th>Travel Document Prepared Responsible Person</th>
                                                <th>Document Sent Responsible Person</th>
                                                <th>Asked For Transfer</th>
                                                <th>Transfer Organised</th>
                                                <th>Itinerary Finalised</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if($bookings && $bookings->count())
                                                @foreach ($bookings as $booking)
                                                    <tr>
                                                        <td>{{$booking->ref_no}}</td>
                                                        <td>{{$booking->quote_ref}}</td>
                                                        <td>{{$booking->lead_passenger}}</td>
                                                        <td>{{$booking->getBrand->name??NULL}}</td>
                                                        <td>{{$booking->getHolidayType->name??NULL}}</td>
                                                        <td>{{$booking->sale_person}}</td>
                                                        <td>{{$booking->agency_booking == 1 ? 'No' : 'Yes'}}</td>
                                                        <td>{{!empty($booking->getCurrency->code) && !empty($booking->getCurrency->name) ? $booking->getCurrency->code.' - '.$booking->getCurrency->name : NULL }}</td>
                                                        <td>{{$booking->pax_no}}</td>
                                                        <td>{{$booking->dinning_preference}}</td>
                                                        <td>{{$booking->bedding_preference}}</td>
                                                  

                                                        <td width="10%" class="d-flex" >
                                                            <a href="{{ route('bookings.edit', encrypt($booking->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" data-title="Edit" data-target="#edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form method="POST" action="{{ route("bookings.delete", encrypt($booking->id)) }}">
                                                                @csrf @method('delete')
                                                                <input type="hidden" value="{{ encrypt($booking->season_id) }}" name="season">
                                                                <button onclick="return confirm('Are you sure want to Delete this record?');" class="mr-2  btn btn-outline-danger btn-xs" data-title="Delete" data-target="#delete"><span class="fa fa-trash-alt"></span></button>
                                                            </form>
                                                        </td>

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
                                  {{-- {{ $seasons->links() }} --}}
                                </ul>
                            </div>

                        </div>

                    </div>

                </div>



            </div>
        </section>

    </div>


@endsection
