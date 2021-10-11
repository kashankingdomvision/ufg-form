@if($currency_conversions && $currency_conversions->count())
    @foreach ($currency_conversions as $key => $value)
    <tr class="tr-bottom-border-color">
        <td class="text-center">{{ $value->from }}</td>
        <td class="text-center">{{ $value->to }}</td>
        <td class="text-center">{{ $value->live }}</td>
        <td class="text-center">{{ $value->manual }}</td>
    </tr>
    @endforeach
@else
    <tr align="center"><td colspan="100%">No record found.</td></tr>
@endif