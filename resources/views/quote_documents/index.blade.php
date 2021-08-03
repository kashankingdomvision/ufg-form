@extends('layouts.app')

@section('title','Dashboard')

@section('content')


<style>
.mt-300{
    margin-top: 300px;
}

.mb-300{
    margin-bottom: 300px;
}

</style>
<div class="content-wrapper">
                    {{-- <a href="{{ route('pdf') }}" class="btn btn-dark">pdf</a> --}}
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid bd-dark">
        <div class="container">
            <form method="POST" action="{{ route('quotes.document.pdf', $quote_id) }}" id="generate-pdf">
            @csrf
     
                <div class="row">
                    <div class="col-md-12" >
                        <div id="document-editor__toolbar"></div>
                        <div id="toolbar-container"></div>
                        <div id="editor">
                            {{-- @if(isset($doc))
                                {!! $doc['data'] !!}
                            @endif  --}}
                            @foreach ($quote_details as $key => $details)
                            <h2><strong>{{ date('D d M Y', strtotime($details->date_of_service)) }}</strong></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td >Transfer To: </td>
                                            <td >{{ $details->getProduct->name }}</td>
                                        </tr>
                                        @if($details->getCategory->slug == 'accommodation')
                                        <tr>
                                            <td >Accommodation:</td>
                                            <td >{{ $details->getProduct->name }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td >Check in: </td>
                                            <td >{{ date('D-m-Y', strtotime($details->date_of_service)).' '. $details->time_of_service }}</td>
                                        </tr>
                                        <tr>
                                            <td >No. of Days: </td>
                                            <td >[Calculate until the next service, related to Accommodation]</td>
                                        </tr>
                                        <tr>
                                            <td >Transfer to </td>
                                            <td >{{  $details->getProduct->name.'  at '. $details->time_of_service }}</td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <button type="submit" class="btn btn-block btn-outline-dark">Genereate PDF</button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection