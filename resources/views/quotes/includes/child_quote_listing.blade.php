@foreach ($quotes as $key => $quote)
<tr>
    <td>
        @if($quote->status != 'booked')
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="child_{{$quote->id}}" value="{{$quote->id}}" data-booking_currency="{{$quote->getBookingCurrency->code}}" class="child custom-control-input custom-control-input-success custom-control-input-outline">
                <label for="child_{{$quote->id}}" class="custom-control-label"></label>
            </div>
        @endif
    </td>
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
    <td width="8">{!! $quote->has_user_edit !!}</td>

    <td>{{ $quote->ref_no }}</td>

    @if($quote->status != 'booked')
        <td> <a href="{{ route('quotes.final', encrypt($quote->id)) }}">{{ $quote->quote_ref }}</a> </td>
    @endif

    @if($quote->status == 'booked')
        <td> <a href="{{ route('bookings.show',encrypt($quote->getBooking->id)) }}">{{ $quote->quote_ref }}</a> </td>
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

        @if($quote->status == 'quote')
            <a href="{{ route('quotes.edit', encrypt($quote->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="Edit" data-target="#edit" title="Edit">
                <i class="fas fa-edit"></i>
            </a>

            <button type="button" class="multiple-alert btn btn-outline-success btn-xs float-right mr-2" data-action_type="booked_quote" data-action="{{ route('quotes.multiple.alert', ['booked_quote', encrypt($quote->id)]) }}" data-quote_id="{{encrypt($quote->id)}}" title="Confirm Booking"><i class="fa fa-check"></i></button>
        @endif

        @if(in_array($quote->status, ['quote', 'cancelled']))
            <a href="{{ route('quotes.final', encrypt($quote->id)) }}" title="View Quote" class="mr-2 btn btn-outline-info btn-xs" data-title="Final Quotation" data-target="#Final_Quotation">
                <span class="fa fa-eye"></span>
            </a>
        @endif

        @if($quote->status == 'booked')
            <a href="{{ route('quotes.final', encrypt($quote->id)) }}" title="View Quote" class="mr-2 btn btn-outline-info btn-xs" data-title="Final Quotation" data-target="#Final_Quotation">
                <span class="fa fa-eye"></span>
            </a>
            {{-- <a href="{{ route('bookings.show',encrypt($quote->getBooking->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="View Booking" title="View Booking" >
                <i class="fas fa-eye"></i>
            </a> --}}
        @endif

        @if($quote->status == 'quote')
            <button type="button" class="multiple-alert btn btn-outline-danger btn-xs float-right mr-2" data-action_type="cancel_quote" data-action="{{ route('quotes.multiple.alert', ['cancel_quote', encrypt($quote->id)]) }}" title="Cancel Quote"><i class="fa fa-times"></i></button>
        @endif

        @if($quote->status == 'cancelled')
            <button type="button" class="multiple-alert btn btn-outline-success btn-xs float-right mr-2" data-action_type="restore_quote" data-action="{{ route('quotes.multiple.alert', ['restore_quote', encrypt($quote->id)]) }}" title="Restore Quote"><i class="fa fa-undo-alt"></i></button>
        @endif

        @if($quote->is_archive == 0)
            <button type="button" class="multiple-alert btn btn-outline-dark btn-xs mr-2" data-action_type="archive_quote" data-action="{{ route('quotes.multiple.alert', ['archive_quote', encrypt($quote->id)]) }}" title="Archive Quote"><i class="fa fa-archive nav-icon"></i></button>
        @endif

        @if($quote->is_archive == 1)
            <button type="button" class="multiple-alert btn btn-outline-dark btn-xs mr-2" data-action_type="unarchive_quote" data-action="{{ route('quotes.multiple.alert', ['unarchive_quote', encrypt($quote->id)]) }}" title="Unarchive Quote"><i class="fa fa-recycle"></i></button>
        @endif

        @if($quote->status == 'quote')
            <button type="button" class="multiple-alert btn btn-outline-secondary btn-xs mr-2" title="Clone Quote" data-action_type="clone_quote" data-action="{{ route('quotes.multiple.alert', ['clone_quote', encrypt($quote->id)]) }}" data-target="#clone_quote"><i class="fa fa-clone"></i></button>
        @endif

        @if($quote->status == 'quote')
            <a class="mr-2 float-right" href="{{ route('quotes.export', encrypt($quote->id)) }}">
                <button type="button" class="btn btn-outline-secondary btn-xs" data-title="" data-target="#" title="Export in Excel"><i class="fa fa-file-export"></i></button>
            </a>
        @endif

        @if($quote->status == 'quote')
            <a href="{{ route('quotes.quote.documment',encrypt($quote->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="View Quote Document" title="View Quote Document" >
                <i class="fas fa-file"></i>
            </a>
        @endif

    </td>
</tr>
@endforeach

{{-- <a href="{{ route('quotes.document', encrypt($quote->id)) }}" title="View" class="mr-2 btn btn-outline-info btn-xs" data-title="Document Quotation" data-target="#Document_Quotation">
    <i class="fas fa-file"></i>
</a> --}}

{{-- <td>{{ $quote->getSalePerson->name }}</td> --}}
{{-- <td>{{ ($quote->user_id == 'sale_person_id')? '-' : $quote->getCreatedBy->name }}</td> --}}