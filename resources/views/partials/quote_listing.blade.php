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
  <td>{{ $quote->ref_no }}</td>
  <td> <a href="{{ route('quotes.final', encrypt($quote->id)) }}">{{ $quote->quote_ref }}</a> </td>
  <td>{{ $quote->getSeason->name }}</td>
  <td>{{ (isset($quote->getBrand->name))? $quote->getBrand->name: NULL }}</td>
  
  <td>{{ $quote->getBookingCurrency->code.'-'.$quote->getBookingCurrency->name }}</td>
  <td>{!! $quote->booking_formated_status !!}</td>
  <td>{{ $quote->formated_booking_date }}</td>
  <td>{{ $quote->formated_created_at }}</td>
  
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

    <a href="{{ route('quotes.final', encrypt($quote->id)) }}" title="View" class="mr-2 btn btn-outline-info btn-xs" data-title="Final Quotation" data-target="#Final_Quotation">
      <span class="fa fa-eye"></span>
    </a>

    @if($quote->booking_status == 'quote' && $quote->deleted_at == null )
      <a onclick="return confirm('Are you sure want to Delete {{ $quote->ref_no }} ?');" href="{{ route('quotes.delete', encrypt($quote->id)) }}" class="mr-2  btn btn-outline-danger btn-xs" data-title="cancel" title="Cancel" data-target="#cancel"><span class="fa fa-times "></span></a>
      @elseif ( $quote->deleted_at != null)
      <a onclick="return confirm('Are you sure want to restore {{ $quote->ref_no }} ?');" href="{{ route('quotes.restore', encrypt($quote->id)) }}" class="mr-2  btn btn-success btn-xs" title="Restore" data-title="Restore" data-target="#Restore"><span class="fa fa-undo-alt"></span></a>
      
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
    <a href="{{ route('quotes.document', encrypt($quote->id)) }}" title="View" class="mr-2 btn btn-outline-info btn-xs" data-title="Document Quotation" data-target="#Document_Quotation">
      <i class="fas fa-file"></i>
  </a>
  </td>
</tr>
@endforeach