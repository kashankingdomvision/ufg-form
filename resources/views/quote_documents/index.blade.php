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
                        <div id="toolbar-container"></div>
                        <div id="editor">
                        @if(isset($doc))
                            {!! $doc !!}
                        @endif 
                            {{-- <header class="mb-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <img class="img-responsive" src="{{ asset('img/Unforgettable_Croatia_Logo_2020_Directory.png') }}" alt="Brand Logo" width="535" height="92">
                                        </div>   
                                    </div>
                                </div>
                            </header>
                            <section class="border-top border-dark">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center mb-300">
                                            <h1 class="display-5 mt-300"><strong> Signature Cruise Split to Dubrovnik </strong></h1>
                                            <h3 class="mt-5 mb-5">26th July 2021</h3>
                                            <h2>Mrs Susan Wehrli</h2>
                                            <h2>TBA</h2>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <footer class="border-top border-dark">
                                <hr class="mb-2">
                                <p class="m-0">Telephone Number: +442080042345 (UK & Australia) and +1 8448797838(United States)</p>
                                <p class="m-0">Email: info@unforgettablecroatia.com Web: www.unforgettablecroatia.com</p>
                                <div class="text-center">
                                    <small  >Company Registered in England Company Reg. 09738411. Vat Registeration No. GB267893051 | ATOL No. 7583</small>
                                </div>
                            </footer> --}}
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