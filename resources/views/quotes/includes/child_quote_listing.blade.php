@foreach ($quotes as $key => $quote)
<tr>
  <td>
    @if($quote->booking_status == 'quote')
        <div class="icheck-primary">
            <input type="checkbox" class="child" value="{{$quote->id}}" >
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
  {{-- <td>{{ $quote->getSalePerson->name }}</td> --}}
  {{-- <td>{{ ($quote->user_id == 'sale_person_id')? '-' : $quote->getCreatedBy->name }}</td> --}}
  <td>{{ $quote->ref_no }}</td>

  @if($quote->booking_status != 'booked')
    <td> <a href="{{ route('quotes.final', encrypt($quote->id)) }}">{{ $quote->quote_ref }}</a> </td>
  @endif

  @if($quote->booking_status == 'booked')
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
    @if($quote->booking_status == 'quote')
        <a href="{{ route('quotes.edit', encrypt($quote->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="Edit" data-target="#edit" title="Edit">
            <i class="fas fa-edit"></i>
        </a>
        <form class="mr-2 " method="POST" action="{{ route('quotes.booked', encrypt($quote->id)) }}">
            @csrf @method('patch')
            <button type="submit" onclick="return confirm('Are you sure you want to convert this Quotation to Booking?');" class="btn btn-outline-success btn-xs" data-title="" data-target="#" title="Convert to Booking"><span class="fa fa-check"></span></button>
        </form>
    @endif
    @if($quote->booking_status == 'quote' || $quote->booking_status == 'cancelled')
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
        <a onclick="return confirm('Are you sure you want to Cancel this Quote?');" href="{{ route('quotes.cancelled', encrypt($quote->id)) }}" class="mr-2 btn btn-outline-danger btn-xs" data-title="Cancel" title="Cancel Quote" data-target="#Cancel"><span class="fa fa-times "></span></a>
    @endif

    @if($quote->booking_status == 'cancelled')
        <a onclick="return confirm('Are you sure you want to Restore this Quote?');" href="{{ route('quotes.restore', encrypt($quote->id)) }}" class="mr-2 btn btn-success btn-xs" title="Restore" data-title="Restore" data-target="#Restore"><span class="fa fa-undo-alt"></span></a>
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


    @if($quote->booking_status == 'quote')
        <form class="" method="POST" action="{{ route('quotes.clone', encrypt($quote->id)) }}">
            @csrf @method('patch')
            <button type="submit" title="Quote Clone"  onclick="return confirm('Are you sure you would like to Clone this Quote?');" class="mr-2 btn btn-outline-secondary btn-xs" data-title="Clone Quotation" data-target="#clone_quote">
                <i class="fa fa-clone"></i>
            </button>
        </form>
    @endif

    @if($quote->booking_status == 'quote')
        <form class="" method="POST" action="{{ route('quotes.export', encrypt($quote->id)) }}">
            @csrf
            <button type="submit" title="Export in Excel"  onclick="return confirm('Are you sure you would like to Export this Quote?');" class="mr-2 btn btn-outline-secondary btn-xs" data-title="Clone Quotation" data-target="#clone_quote">
                <i class="fa fa-file-export"></i>
            </button>
        </form>
    @endif

    @if($quote->booking_status == 'quote')
        <a href="{{ route('quotes.quote.documment',encrypt($quote->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="View Quote Document" title="View Quote Document" >
            <i class="fas fa-file"></i>
        </a>
    @endif

</td>
</tr>
@endforeach