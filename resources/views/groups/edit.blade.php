@extends('layouts.app')

@section('title','Edit Groups')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Edit Group Quotes</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a>Home</a></li>
                  <li class="breadcrumb-item"><a>Quote</a></li>
                  <li class="breadcrumb-item active">Edit Group Quotes</li>
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
                <h3 class="card-title text-center">Edit Group Quote</h3>
              </div>

              <form action="{{ route('group-quote.update', encrypt($group->id)) }}" method="POST">
                @csrf @method('put')

                <div class="card-body">

                  <div class="form-group">
                    <label for="name">Name <span style="color:red">*</span></label>
                    <input type="text" id="name" name="name" value="{{ $group->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Commission Name" required>

                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                  </div>

                    <div class="form-group">
                        <label for="quotes">Quotes <span style="color:red">*</span></label>
                        <select class="form-control select2-multiple"  data-placeholder="Select Quotes" multiple id="quotes" name="quote_ids[]">
                                @foreach ($quotes as $quote)
                                        <option value="{{ $quote->id }}" {{ $group->quotes->contains('id', $quote->id) ? 'selected' : null }}>{{ $quote->quote_title }}</option>
                                @endforeach
                        </select>
                    </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary float-right">Submit</button>
                  <a href="{{ route('group-quote.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>

                </div>

              </form>
            </div>




        </div>
      </div>
    </section>

  </div>
@endsection
