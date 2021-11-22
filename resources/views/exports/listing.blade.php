<table>
    <tbody>
    
        <tr>
            <td></td>
            @foreach ($headings as $key => $bi) 
            <td style="width: 35px;" align="center"> {{$bi}} </td>
            @endforeach
        </tr>   
        <tr><td></td><td></td><td></td><td></td></tr>
  
        @foreach ($booking_information as $key => $bi) 
            <tr>
                <td style="width: 35px;"> {{$key}} </td>
                @foreach ($bi as $key => $bi) 
                    <td  align="center"> 
                        @if($bi == 'live')
                            Live Rate
                        @elseif($bi == 'manual')
                            Manual Rate
                        @elseif($bi == 'itemised')
                            Itemised Markup
                        @elseif($bi == 'whole')
                            Whole Markup
                        @else
                            {{ $bi }} 
                        @endif
                    </td>
               
                @endforeach

            </tr>   
        @endforeach

        <tr><td></td><td></td><td></td><td></td></tr>

        @foreach ($agency_information as $key => $bi) 
            <tr>
                <td> {{$key}} </td>
                @foreach ($bi as $key => $bi) 
                    <td align="center"> 
                        {{ !empty($bi) ? $bi : '-'  }} 
                    </td>
                @endforeach
            </tr>   
        @endforeach

        <tr><td></td><td></td><td></td><td></td></tr>

        @foreach ($lead_passenger_information as $key => $bi) 
            <tr>
                <td> {{$key}} </td>
                @foreach ($bi as $key => $bi) 
                    <td align="center"> 
                        {{ !empty($bi) ? $bi : '-'  }} 
                    </td>
                @endforeach
            </tr>   
        @endforeach

        <tr><td></td><td></td><td></td><td></td></tr>

        
        @foreach ($pax_details as $key => $rows) 

            @if(!empty($rows['rows']))
                @foreach ($rows['rows'] as $key1 => $columns) 
                    {{-- @php
                        $cols = count($columns)
                    @endphp --}}

                   

                    <tr>
                        <td>
                            @if($key1 == 0)
                            {{ $rows['label']}}
                            @endif
                        </td>
                    
                        @foreach ($columns as $col)  
                            <td align="center"> {{ $col }} </td>
                        @endforeach
                    </tr>
                    
                @endforeach
            @else
                <tr>

                    <td>
                        
                        {{ $rows['label']}}
                        
                    </td>
                    
                </tr>
            @endif
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
                        <td align="center"> {{ $col }} </td>
                    @endforeach
                </tr>
                <br>
            @endforeach

            {{-- <tr><td></td><td></td><td></td><td></td></tr> --}}

        @endforeach

        @foreach ($total_calculations as $key => $bi) 
            <tr>
                <td > {{$key}} </td>
                @foreach ($bi as $key => $bi) 
                    <td align="center"> 
                        {{ !empty($bi) ? $bi : '-'  }} 
                    </td>
                @endforeach
            </tr>   
        @endforeach

    </tbody>
</table>

