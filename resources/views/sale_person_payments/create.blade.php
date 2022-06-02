@extends('layouts.app')

@section('title',"Add Sale Person's Payment")

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h4>Add Sale Person's Payment</h4></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a>Home</a></li>
                    <li class="breadcrumb-item"><a>Pay Com. Management</a></li>
                    <li class="breadcrumb-item active">Sale Person's Payment</li>
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
                            <h3 class="card-title text-center">Sale Person's Payment Form</h3>
                        </div>

                        <form method="POST" id="store_sale_person_payment" action="{{ route('sale_person_payments.store') }}">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Sale Person</label>
                                    <select name="sale_person_id" id="sale_person_id" class="form-control select2single sale-person-id">
                                        <option value="">Select Sale Person </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" 
                                                data-sale_person_currency_id="{{ isset($user->currency_id) && !empty($user->currency_id) ? $user->currency_id : '' }}"
                                                data-sale_person_currency_code="{{ isset($user->getCurrency->code) && !empty($user->getCurrency->code) ? $user->getCurrency->code : '' }}"
                                                >
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" role="alert"></span>
                                </div>

                                <div class="form-group">
                                    <label>Sale Person Currency</label>
                                    <div class="input-group">
                                      <input type="text" name="sale_person_currency_id" value="" class="form-control sale-person-currency-id hide-arrows" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Balance Owed Amount <span style="color:red">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text sale-person-currency-code"></span>
                                        </div>
                                        <input type="text" name="balance_owed_amount" id="balance_owed_amount" data-type="currency" remove-zero-values class="form-control" placeholder="Balance Owed Amount">
                                    </div>
                                    <span class="text-danger" role="alert"></span>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('stations.index') }}" class="btn btn-danger float-right">Cancel</a>
                                <button type="submit" class="mr-2 btn btn-success float-right">Submit</button>
                            </div>
                        </form>

                        <div id="overlay" class=""></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('js')
  <script src="{{ asset('js/commission_management.js') }}" ></script>
@endpush