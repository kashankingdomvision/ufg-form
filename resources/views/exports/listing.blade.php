<table>
    <thead>
    <tr>
    
    </tr>
    </thead>
    <tbody>
    
        {{-- <tr>
            <td></td>
            @foreach ($headings as $key => $bi) 
            <td> {{$bi}} </td>
            @endforeach
        </tr>   
        <tr><td></td><td></td><td></td><td></td></tr> --}}
  
        @foreach ($booking_information as $key => $bi) 
            <tr>
                <td> {{$key}} </td>
                @foreach ($bi as $key => $bi) 
                    <td class="text-center"> 
                        @if($bi == 'live')
                            Live Rate
                        @elseif($bi == 'manual')
                            Manual Rate
                        @else
                            {{ $bi }} 
                        @endif
                    </td>
               
                @endforeach

            </tr>   
        @endforeach

        <tr><td></td><td></td><td></td><td></td></tr>

    @foreach ($service_details as $key => $rows) 
        @foreach ($rows['rows'] as $key1 => $columns) 
            @php
                $cols = count($columns)
            @endphp

            <tr>
                <td>
                    @if($key1 == 0)
                    {{ $rows['label']}}
                    @endif
                </td>
            
                @foreach ($columns as $col)  
                    <td> {{ $col }} </td>
                @endforeach
            </tr>
            <br>
        @endforeach

        <tr><td></td><td></td><td></td><td></td></tr>

    @endforeach

    </tbody>
</table>

