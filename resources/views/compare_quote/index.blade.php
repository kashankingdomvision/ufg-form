@extends('layouts.app')

@section('title','View Payment Methods')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>Compare Quotes </h4>
          </div>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Quote Management</a></li>
                <li class="breadcrumb-item active">Compare Quote</li>
            </ol>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-md-offset-3">
          @include('includes.flash_message')

        </div>
      </div>
    </div>
  </section>


  <section class="content">
    <form method="POST" action="{{ route('quotes.compare.quote') }}">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    {{-- {{ (count(request()->all()) > 0) ? '' : 'collapsed-card' }} --}}
      
                    <div class="card card-default ">
                            <button type="button" class="btn btn-tool m-0 text-dark " data-card-widget="collapse">
                                <div class="card-header">
                                <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters &nbsp;<i class="fa fa-angle-down"></i></b></h3>
                                </div>
                            </button>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Quote Reference</label>
                                        <select class="form-control select2single" name="quote_ref_one">
                                            <option value="">Select Quote Reference </option>
                                            @foreach ($quotes as $quote)
                                                <option value="{{ $quote->id }}" {{ (old('quote_ref_one') == $quote->id) ? 'selected': ((request()->get('quote_ref_one') == $quote->id) ? 'selected' : null) }} >{{ $quote->quote_ref }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Quote Reference</label>
                                        <select class="form-control select2single" name="quote_ref_two">
                                            <option value="">Select Quote Reference </option>
                                            @foreach ($quotes as $quote)
                                                <option value="{{ $quote->id }}" {{ (old('quote_ref_two') == $quote->id) ? 'selected': ((request()->get('quote_ref_two') == $quote->id) ? 'selected' : null) }} >{{ $quote->quote_ref }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Quote Reference</label>
                                        <select class="form-control select2single" name="quote_ref_three">
                                            <option value="">Select Quote Reference </option>
                                            @foreach ($quotes as $quote)
                                                <option value="{{ $quote->id }}" {{ (old('quote_ref_three') == $quote->id) ? 'selected': ((request()->get('quote_ref_three') == $quote->id) ? 'selected' : null) }} >{{ $quote->quote_ref }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Quote Reference</label>
                                        <select class="form-control select2single" name="quote_ref_four">
                                            <option value="">Select Quote Reference </option>
                                            @foreach ($quotes as $quote)
                                                <option value="{{ $quote->id }}" {{ (old('quote_ref_four') == $quote->id) ? 'selected': ((request()->get('quote_ref_four') == $quote->id) ? 'selected' : null) }} >{{ $quote->quote_ref }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                                        <a href="{{ route('quotes.compare.quote') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>


<section class="content">
    <div class="container-fluid">

        @include('compare_quote.partials.booking')
        @include('compare_quote.partials.agency')
        @include('compare_quote.partials.lead_passenger')
        @include('compare_quote.partials.total_calculation')

    </div>
</section>
</div>
@endsection


