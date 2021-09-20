@extends('layouts.app')
@section('title', 'Final Quote')
@section('content')
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
              <h4>View Final Quote</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item active">Quote Management</li>
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
                    <form id="quote_doc" method="POST" class="quote_documents" action="#">
                        @csrf @method('post')
                        <div class="row">
                            <div class="col-md-8">
                            @foreach ($quote_details as $key => $qd)
                                <h4><strong>{{ Helper::document_date_format($key) }}</strong></h4>
                                @foreach ($qd as $key => $quote_detial)
                                    <div class="card ">
                                        <div class=" p-2 card-body bg-secondary ">
                                            <a href="javaScript:void(0);" data-toggle="modal" data-target="#CallModal{{$quote_detial->id}}">
                                                <div class="d-flex bd-highlight">
                                                    <div class="p-2 w-100 bd-highlight"> 
                                                        {{$quote_detial->getCategory->name}} - {{$quote_detial->product_id}}
                                                    </div>
                                                    <div class="p-2 flex-shrink-1 bd-highlight">                                            
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade" data-backdrop="static" id="CallModal{{$quote_detial->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="quoteDetail[{{ $quote_detial->id }}]['id']" value="{{$quote_detial->id}}">
                                                    <div class="form-group">
                                                        <label>Images upload</label>
                                                        <input type="file" class="form-control" name="quoteDetail[{{ $quote_detial->id }}]['uploadimage']">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Notes: </label>
                                                        <textarea name="quoteDetail[{{ $quote_detial->id }}]['detials']"  class="form-control summernote">{{ old('about_us') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                               

                            <h4><strong>Trip Cost</strong></h4>
                            <div class="card">
                                <div class=" p-2 card-body bg-secondary ">
                                    <a href="#">
                                        <div class="d-flex bd-highlight">
                                            <div class="p-2 w-100 bd-highlight"> 
                                                Whats Included?
                                            </div>
                                            <div class="p-2 flex-shrink-1 bd-highlight">                                            
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class=" p-2 card-body bg-secondary ">
                                    <a href="#">
                                        <div class="d-flex bd-highlight">
                                            <div class="p-2 w-100 bd-highlight"> 
                                                Whats not Included?
                                            </div>
                                            <div class="p-2 flex-shrink-1 bd-highlight">                                            
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class=" p-2 card-body bg-secondary ">
                                    <a href="#">
                                        <div class="d-flex bd-highlight">
                                            <div class="p-2 w-100 bd-highlight"> 
                                               Booking Conditions
                                            </div>
                                            <div class="p-2 flex-shrink-1 bd-highlight">                                            
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                               
                            
                            </div>
                            <div class="col-md-4">
                                <div class="position-sticky mt-2">
                                    <div class="d-flex">
                                        <button class="btn btn-success col-5 ml-3 btn-sm" title="SAVE DOCUMENTS">SAVE</button>
                                        <a class="btn btn-outline-dark col-5 ml-3" href="#" title="WEB VIEW"><i class="fa fa-desktop" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="overlay" class=""></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
