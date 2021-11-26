@extends('layouts.app')

@section('title','Add Groups')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Add Group Quotes</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                  <li class="breadcrumb-item"><a>Quote Management</a></li>
                  <li class="breadcrumb-item active">Add Group Quotes</li>
              </ol>
          </div>
        </div>

          <div class="row d-flex justify-content-center">
              <div class="col-md-10 col-md-offset-3">
                  @include('includes.flash_message')
              </div>
          </div>

      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-secondary">
              <div class="card-header">
                  <h3 class="card-title text-center">Add Group Quote</h3>
              </div>

                <form action="{{ route('quotes.group-quote.store') }}" method="POST" class="add-new-group-quote">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name <span style="color:red">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Group Name" required id="name">
                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                    <div class="form-group">
                        <label for="quotes">Quotes (Select atleast Two Quotes) <span style="color:red">*</span></label>
                        <select class="form-control select2-multiple @error('quote_ids') is-invalid @enderror"
                                data-placeholder="Select Quotes" multiple id="quotes" name="quote_ids[]">
                            @foreach ($quotes as $quote)
                                <option
                                    value="{{ $quote->id }}"> {{ $quote->quote_ref }} - {{ $quote->ref_no }} - {{ $quote->getBookingCurrency->name }} </option>
                            @endforeach
                        </select>

                        @error('quote_ids')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary float-right">Submit</button>
                  <a href="{{ route('quotes.group-quote.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
@endsection
