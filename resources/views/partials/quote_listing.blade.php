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
    <td width="8">{!! $quote->has_user_edit !!}</td>
    <td>{{ $quote->ref_no }}</td>
    <td>{{ $quote->quote_ref }}</td>
    <td>{{ $quote->getSeason->name }}</td>
    <td>{{ (isset($quote->getBrand->name))? $quote->getBrand->name: NULL }}</td>
    
    <td>{{ $quote->getBookingCurrency->code.'-'.$quote->getBookingCurrency->name }}</td>
    <td>{!! $quote->booking_formated_status !!}</td>
    <td>{{ $quote->formated_booking_date }}</td>
    <td>{{ $quote->formated_created_at }}</td>
    
    <td width="10%" class="d-flex" >
      @if($quote->booking_status == 'quote')
        <a href="{{ route('quotes.edit', encrypt($quote->id)) }}" class="mr-2 btn btn-outline-success btn-xs" data-title="Edit" data-target="#edit">
          <i class="fas fa-edit"></i>
        </a>
        <form class="mr-2" method="POST" action="{{ route('quotes.booked', encrypt($quote->id)) }}">
          @csrf @method('patch')
          <button type="submit" onclick="return confirm('Are you sure you want to convert this Quotation to Booking?');" class="btn btn-outline-success btn-xs" data-title="" data-target="#"><span class="fa fa-check"></span></button>
        </form>
      @else
      <a href="{{ route('quotes.final', encrypt($quote->id)) }}" class="mr-2 btn btn-outline-info btn-xs" data-title="Final Quotation" data-target="#Final_Quotation">
          <span class="fa fa-eye"></span>
      </a>
      
      @endif
      
      
      <a onclick="return confirm('Are you sure want to Delete {{ $quote->ref_no }}');" href="{{ route('quotes.delete', encrypt($quote->id)) }}" class="mr-2  btn btn-outline-danger btn-xs" data-title="Delete" data-target="#delete"><span class="fa fa-trash-alt"></span></a>

      </td>
</tr>
@endforeach