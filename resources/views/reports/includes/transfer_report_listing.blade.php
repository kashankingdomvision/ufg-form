<table class="table table-hover">
    <thead>
        <tr>
            <th></th>
            <th>Booking Ref # </th>
            <th>Season</th>
            <th>Start Date of Service</th>
            <th>End Date of Service</th>
            <th>Time of Service</th>
            <th>Supplier</th>
            <th>Lead Passenger Name </th>
            <th>Pax No.</th>
            <th>Category </th>
            <th>Product</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if($booking_details && $booking_details->count())
            @foreach ($booking_details as $key => $booking_detail)

            <tr>
                <td>
                    @if($booking_detail->getCategoryDetailFeilds && $booking_detail->getCategoryDetailFeilds->count())
                        <button class="btn btn-sm parent-row"  data-id="{{$booking_detail->id}}">
                            <span class="fa fa-plus"></span>
                        </button>
                    @endif
                </td>
                <td>
                    @if(isset($booking_detail->getBooking->quote_ref))
                        <a href="{{ route('bookings.show', encrypt($booking_detail->getBooking->id)) }}" target="_blank"> {{$booking_detail->getBooking->quote_ref}} </a>
                    @endif
                </td>
                <td>{{ isset($booking_detail->getBooking->getSeason->name) && !empty($booking_detail->getBooking->getSeason->name) ? $booking_detail->getBooking->getSeason->name : '' }}</td>
                <td>{{ $booking_detail->date_of_service }}</td>
                <td>{{ $booking_detail->end_date_of_service }}</td>
                <td>{{ $booking_detail->time_of_service }}</td>
                <td>{{ isset($booking_detail->getSupplier->name) && !empty($booking_detail->getSupplier->name) ? $booking_detail->getSupplier->name : '' }}</td>
                <td>{{ isset($booking_detail->getBooking->lead_passenger_name) && !empty($booking_detail->getBooking->lead_passenger_name) ? $booking_detail->getBooking->lead_passenger_name : ''  }}</td>
                <td>{{ isset($booking_detail->getBooking->pax_no) && !empty($booking_detail->getBooking->pax_no) ? $booking_detail->getBooking->pax_no : ''  }}</td>
                <td>{{ isset($booking_detail->getCategory->name)  && !empty($booking_detail->getCategory->name) ? $booking_detail->getCategory->name : ''  }}</td>
                <td>{{ isset($booking_detail->getProduct->name)   && !empty($booking_detail->getProduct->name) ? $booking_detail->getProduct->name : ''  }}</td>
                <td>
                    @if($booking_detail->status == 'active')
                        <h5><span class="badge badge-success">Booked</span></h5>
                    @elseif($booking_detail->status == 'cancelled')
                        <h5><span class="badge badge-danger">Cancelled</span></h5>
                    @endif
                </td>

                <tbody class="child-row d-none" id="child-row-{{$booking_detail->id}}">
                    @if($booking_detail->getCategoryDetailFeilds && $booking_detail->getCategoryDetailFeilds->count())
                        <tr>
                            <td colspan="9"></td>
                            <th class="border-bottom">
                                <h5>
                                    Transfer Details
                                </h5>
                            </th>
                            <td class="border-bottom"></td>
                            <td class="border-bottom"></td>
                        </tr>
                        @foreach ($booking_detail->getCategoryDetailFeilds as $item)
                            <tr>
                                <td colspan="9"></td>
                                <th>{{ $item->label }}</th>
                                <td>
                                    @if($item->type == 'checkbox-group' ||  ($item->type == 'select' && $item->multiple == 'true') )
                                        @php
                                            $values = json_decode($item->value, true)
                                        @endphp
                                        {{ implode(", ",$values ) }}
                                    @else
                                        {{ $item->value }}
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>


            </tr>
            
            @endforeach
        @else
            <tr align="center"><td colspan="100%">No record found.</td></tr>
        @endif
    </tbody>
</table>