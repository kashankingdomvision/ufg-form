<table class="table table-hover text-nowrap" >
    <thead>
        <tr>
            <th></th>
            <th data-column="Zoho_Reference">Zoho Reference</th>
            <th data-column="Quote_Ref_#">Quote Ref # </th>
            <th data-column="Season">Season</th>
            <th data-column="Lead_Passenger_Name">Lead Passenger Name </th>
            <th data-column="Pax_No.">Pax No.</th>
            <th data-column="Start_Date_of_Service">Start Date of Service</th>
            <th data-column="End_Date_of_Service">End Date of Service</th>
            <th data-column="Number_of_Nights">Number of Nights</th>
            <th data-column="Time_of_Service">Time of Service</th>
            <th data-column="Category">Category </th>
            <th data-column="Supplier_Location">Supplier Location</th>
            <th data-column="Supplier">Supplier</th>
            <th data-column="Product_Location">Product Location</th>
            <th data-column="Product">Product</th>
            <th data-column="Payment_Type">Payment Type</th>
            <th data-column="Supplier_Currency">Supplier Currency</th>
            <th data-column="Estimated_Cost">Estimated Cost </th>
            <th data-column="Actual_Cost">Actual Cost </th>
            <th data-column="Markup_Amount">Markup Amount </th>
            <th data-column="Markup_%">Markup % </th>
            <th data-column="Selling_Price">Selling Price</th>
            <th data-column="Profit_%">Profit %</th>
            {{-- <th>Actual Cost in Booking Currency</th> --}}
            {{-- <th>Markup Amount in Booking Currency </th> --}}
            {{-- <th>Selling Price in Booking Currency </th> --}}
            <th data-column="Service_Details">Service Details</th>
            <th data-column="Internal_Comments">Internal Comments </th>
            <th data-column="Status">Status</th>
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
                <td data-column="Zoho_Reference">
                    @if(isset($booking_detail->getBooking->ref_no))
                        {{$booking_detail->getBooking->ref_no}}
                    @endif
                </td>
                <td data-column="Quote_Ref_#">
                    @if(isset($booking_detail->getBooking->quote_ref))
                        <a href="{{ route('bookings.show', encrypt($booking_detail->getBooking->id)) }}" target="_blank"> {{$booking_detail->getBooking->quote_ref}} </a>
                    @endif
                </td>
                <td data-column="Season">{{ isset($booking_detail->getBooking->getSeason->name) && !empty($booking_detail->getBooking->getSeason->name) ? $booking_detail->getBooking->getSeason->name : '' }}</td>
                <td data-column="Lead_Passenger_Name">{{ isset($booking_detail->getBooking->lead_passenger_name) && !empty($booking_detail->getBooking->lead_passenger_name) ? $booking_detail->getBooking->lead_passenger_name : ''  }}</td>
                <td data-column="Pax_No.">{{ isset($booking_detail->getBooking->pax_no) && !empty($booking_detail->getBooking->pax_no) ? $booking_detail->getBooking->pax_no : ''  }}</td>
                <td data-column="Start_Date_of_Service">{{ $booking_detail->date_of_service }}</td>
                <td data-column="End_Date_of_Service">{{ $booking_detail->end_date_of_service }}</td>
                <td data-column="Number_of_Nights">{{ $booking_detail->number_of_nights }}</td>
                <td data-column="Time_of_Service">{{ $booking_detail->time_of_service }}</td>
                <td data-column="Category">{{ isset($booking_detail->getCategory->name)  && !empty($booking_detail->getCategory->name) ? $booking_detail->getCategory->name : ''  }}</td>
                <td data-column="Supplier_Location">{{ isset($booking_detail->getSupplierLocation->name) && !empty($booking_detail->getSupplierLocation->name) ? $booking_detail->getSupplierLocation->name : ''  }}</td>
                <td data-column="Supplier">{{ isset($booking_detail->getSupplier->name) && !empty($booking_detail->getSupplier->name) ? $booking_detail->getSupplier->name : '' }}</td>
                <td data-column="Product_Location">{{ isset($booking_detail->getProductLocation->name) && !empty($booking_detail->getProductLocation->name) ? $booking_detail->getProductLocation->name : ''  }}</td>
                <td data-column="Product">{{ isset($booking_detail->getProduct->name)   && !empty($booking_detail->getProduct->name) ? $booking_detail->getProduct->name : ''  }}</td>
                <td data-column="Payment_Type">{{ isset($booking_detail->getBookingType->name)   && !empty($booking_detail->getBookingType->name) ? $booking_detail->getBookingType->name : ''  }}</td>
                <td data-column="Supplier_Currency">{{ isset($booking_detail->getSupplierCurrency->name)   && !empty($booking_detail->getSupplierCurrency->name) ? $booking_detail->getSupplierCurrency->name : ''  }}</td>
                <td data-column="Estimated_Cost">{{ \Helper::number_format($booking_detail->estimated_cost).' '.$booking_detail->getSupplierCurrency->code }}</td>
                <td data-column="Actual_Cost">{{ \Helper::number_format($booking_detail->actual_cost).' '.$booking_detail->getSupplierCurrency->code }}</td>
                <td data-column="Markup_Amount">{{ \Helper::number_format($booking_detail->markup_amount).' '.$booking_detail->getSupplierCurrency->code }}</td>
                <td data-column="Markup_%">{{ \Helper::number_format($booking_detail->markup_percentage).' %' }}</td>
                <td data-column="Selling_Price">{{ \Helper::number_format($booking_detail->selling_price).' '.$booking_detail->getSupplierCurrency->code }}</td>
                <td data-column="Profit_%">{{ \Helper::number_format($booking_detail->profit_percentage).' %' }}</td>
                {{-- <td>{{ \Helper::number_format($booking_detail->actual_cost_bc).' '.$booking_detail->getSupplierCurrency->code }}</td> --}}
                {{-- <td>{{ \Helper::number_format($booking_detail->markup_amount_in_booking_currency).' '.$booking_detail->getSupplierCurrency->code }}</td> --}}
                {{-- <td>{{ \Helper::number_format($booking_detail->selling_price_in_booking_currency).' '.$booking_detail->getSupplierCurrency->code }}</td> --}}
                <td data-column="Service_Details">{{ $booking_detail->service_details }}</td>
                <td data-column="Internal_Comments">{{ $booking_detail->comments }}</td>
                <td data-column="Status">
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