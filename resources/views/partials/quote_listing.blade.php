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
      {{-- @if($quote->qoute_to_booking_status == 0)
        <a href="{{ URL::to('edit-quote/'.$quote->id)}}" class="btn btn-primary btn-xs" data-title="Edit" data-target="#edit"><span class="fa fa-pencil"></span></a>
        <a onclick="return confirm('Are you sure you want to convert this Quotation to Booking?');" href="{{ route('convert-quote-to-booking', $quote->id) }}" class="btn btn-success btn-xs" data-title="" data-target="#"><span class="fa fa-check"></span></a>
      @endif --}}

      
      {{-- @if($quote->qoute_to_booking_status == 1)
      <a target="_blank" href="{{ route('view-quote-detail', $quote->id) }}" class="btn btn-primary btn-xs" data-title="Delete" data-target="#delete"><span class="fa fa-eye"></span></a>
      @endif --}}
      <a onclick="return confirm('Are you sure want to Delete {{ $quote->ref_no }}');" href="{{ route('quotes.delete', encrypt($quote->id)) }}" class="btn btn-danger btn-xs" data-title="Delete" data-target="#delete"><span class="fa fa-trash"></span></a>
    </td>
</tr>
@endforeach