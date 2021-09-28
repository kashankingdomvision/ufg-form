@extends('layouts.app')
@section('title', 'Documents Quote')
@section('content')
<style>
  .css-none div{margin: 0 !important; padding: 0 !important; line-height: 0 !important;}
</style>
  <div class="content-wrapper">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="content-header">
      <div class="container-fluid">


        <div class="row">
          <div class="col-sm-6">
              <h4>View Documents Quote</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item active">Quote Documents</li>
              </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content " >
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center card-title-style">Quote Documents</h3>
                <a href="{{ route('quotes.index') }}" class="btn btn-outline-dark btn-md float-right" data-title="Final Quotation" data-target="#Final_Quotation">
                  Back
                </a>
              </div>

                <div class="card-body">
                    
                      <div class="row">
                        <div class="col-md-8" id="quote_doc">
                          <section class="logo">
                              <div class="text-center">
                                <img src="{{ asset('images/logo.png') }}">
                              </div>
                          </section>
                          <hr />
                          <section class="heading ml-2">
                            <div class="card bg-dark p-2">
                                <h3 class="text-center"><strong>{{ $startdate }}&nbsp;&nbsp; - &nbsp;&nbsp; {{$enddate}}</strong></h3>
                            </div>
                            <h2 class="text-center"><strong>{{$title}}</strong></h2>
                            <h3 class="text-center">{{$person_name}} - {{ $created_at }}</h3>
                            <hr />
                          </section>
                          
                          <section class="details m-5">
                            @foreach ($quote_details as $key => $qd)
                            <div class="row mt-1">
                              <div class="col-md-6">
                                  <h4 class="text-right mr-3">{{ Helper::document_date_format($key) }}</h4>
                              </div>
                              <div class="col-md-6">
                                  @foreach ($qd as $key => $quote_detial)
                                  <h5>
                                    <a href="#category{{$quote_detial->category_id}}" class="ml-5 ">  {{$quote_detial->getCategory->name}}</a>
                                  </h5>
                                  @endforeach 
                              </div>
                            </div>
                          @endforeach
                          </section>


                          @if($brand_about && !empty($brand_about))
                          <section class="about-brand ml-2">
                            <h4><strong>About Us:</strong></h4>
                            {!! $brand_about !!}
                          </section>
                          @endif
                      
                          <section class="ml-2 mt-3">
                            @foreach ($quote_details as $key => $qd)
                              <div class="card bg-dark ">
                                  <h3 class="m-2"><strong>{{ Helper::document_date_format($key) }}</strong></h3>
                              </div>

                              @foreach ($qd as $key => $quote_del)
                                <section id="category{{$quote_del->category_id}}">
                                  <div class="mt-2 mb-2">
                                      <img src="{{ $quote_del->image }}" class="img-fluid" height="200px">
                                      <h4 class="mt-1"><strong>{{$quote_del->getCategory->name}} - {{$quote_del->product_id}} </strong></h4>
                                      <h5><strong class="mr-2">No. Of Nights: </strong> {{  Helper::date_difference(Helper::db_date_format($quote_del->date_of_service),Helper::db_date_format($quote_del->end_date_of_service))}}</h5>
                                      <div>
                                          {!! $quote_del->service_details !!}
                                      </div>
                                      <div>
                                        {!! ($quote_del->getStoredText)? $quote_del->getStoredText->stored_text : '' !!}
                                      </div>
                                  </div>
                                </section>         
                              @endforeach
                            @endforeach
                              <section>
                                  <table cellpadding="0" cellspacing="0" bgcolor="#ddd" width="100%">
                                      <tr>
                                          <td width="30px" bgcolor="#2952a3">&nbsp;</td>
                                          <td class="pl-5 pt-3"><h3>Trip Cost</h3></td>
                                      </tr>
                                      <tr>
                                          <td width="30px" bgcolor="#2952a3">&nbsp;</td>
                                          <td class="pb-1 pl-5">Total Selling Price  -  {{ $selling_amount }}</td>
                                      </tr>
                                      <tr>
                                          <td width="30px" bgcolor="#2952a3">&nbsp;</td>
                                          <td class="pb-1 pl-5">Deposit Per Person - US ${{ $booking_amount_person }}</td>
                                      </tr>
                                      <tr>
                                          <td width="30px" bgcolor="#2952a3">&nbsp;</td>
                                          <td class="pb-1 pl-5">Remaining balance due 90 days prior to the departure</td>
                                      </tr>
                                      <tr>
                                          <td width="30px" bgcolor="#2952a3">&nbsp;</td>
                                          <td class="pb-1 pl-5">&nbsp;</td>
                                      </tr>
                                  </table>
                              </section>
                              <!-- @if(isset($storetexts) && count($storetexts) > 0)
                                @foreach ($storetexts as $text)
                                <section>
                                  <h4 class="text-center pt-4"><strong>{{$text->page_title}}</strong></h4>
                                  <hr />
                                  <div class="">{!! $text->description !!}</div>
                                </section>
                                @endforeach
                              @endif -->
                          </section>     
                        </div>
                        <div class="col-md-4">
                            <div class="sticky-top" style="top:40px">
                                <div class="d-flex">
                                    <!-- <button class="btn btn-success col-5 ml-3 btn-sm" title="SAVE DOCUMENTS">SAVE</button> -->
                                    <a href="{{ route('quotes.document.pdf', encrypt($quote_id)) }}" class="btn btn-dark col-2 ml-3" href="#" title="Generate PDF "><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                      </div>
                    
                </div>
                <div id="overlay" class=""></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
