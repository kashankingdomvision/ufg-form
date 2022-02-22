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
            <li class="breadcrumb-item"><a>Quote Management</a></li>
            <li class="breadcrumb-item active">Edit Group Quotes</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card card-outline card-base">
            <div class="card-header">
              <h3 class="card-title text-center">Edit Group Quote</h3>
            </div>

            <form  method="POST" id="update_group" action="{{ route('groups.update', encrypt($group->id)) }}">
              @csrf @method('put')

              <div class="card-body">

                <div class="form-group">
                  <label for="name">Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" value="{{ $group->name }}" class="form-control" placeholder="Group Name">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label for="quotes">Quotes <span class="h6">(Select Atleast Two Quotes)</span> <span style="color:red">*</span></label>
                  <select  name="quote_ids[]" id="quote_ids" class="form-control select2-multiple" data-placeholder="Select Quotes" multiple>
                    @foreach ($quotes as $quote)
                      <option value="{{ $quote->id }}" {{ $group->quotes->contains('id', $quote->id) ? 'selected' : '' }}> {{ $quote->quote_ref }} - {{ $quote->ref_no }} - {{ $quote->getBookingCurrency->name }} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('groups.index') }}" class="btn btn-danger float-right  mr-2">Cancel</a>
              </div>
            </form>

            <div id="overlay" class=""></div>
          </div>
      </div>
    </div>
  </section>
</div>
@endsection

@push('js')
  <script src="{{ asset('js/quote_management.js') }}" ></script>
@endpush