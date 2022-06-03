@extends('layouts.app')

@section('title',"View Sale Person's Payment")

@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">

        <div class="col-sm-6">
          <div class="d-flex">
            <h4>
                Sale Person's Payment
                <x-add-new-button :route="route('sale_person_payments.create')"></x-add-new-button>
            </h4>
          </div>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Pay Com. Management</a></li>
            <li class="breadcrumb-item active">Pay Commission</li>
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

  <x-page-filters :route="route('sale_person_payments.index')">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Search</label>
          <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
        </div>
      </div>
    </div>
  </x-page-filters>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title float-left">
                Sale Person's Payment List
              </h3>
            </div>

            <div class="card-body p-0" id="listing_card_body">
              <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Sale Person</th>
                      <th>Sale Person Currency</th>
                      <th>Balance Owed</th>
                      <th>Outstanding Amount</th>
                      <th>Paid Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @if($sp_payments && $sp_payments->count())
                      @foreach ($sp_payments as $key => $sp_payment)
                        <tr>
                          <td>
                            {{ isset($sp_payment->getSalePerson->name) && !empty($sp_payment->getSalePerson->name) ? $sp_payment->getSalePerson->name : '' }}
                          </td>

                          <td>
                            {{ isset($sp_payment->getSalePersonCurrency->name) && !empty($sp_payment->getSalePersonCurrency->name) ? $sp_payment->getSalePersonCurrency->code.' - '. $sp_payment->getSalePersonCurrency->name : '' }}
                          </td>

                          <td>
                            {{ isset($sp_payment->getSalePersonCurrency->code) && !empty($sp_payment->getSalePersonCurrency->code) ? $sp_payment->getSalePersonCurrency->code : '' }}
                            {{ Helper::number_format($sp_payment->balance_owed_amount) }}
                          </td>

                          <td>
                            {{ isset($sp_payment->getSalePersonCurrency->code) && !empty($sp_payment->getSalePersonCurrency->code) ? $sp_payment->getSalePersonCurrency->code : '' }}
                            {{ Helper::number_format($sp_payment->balance_owed_outstanding_amount) }}
                          </td>

                          <td>
                            {{ isset($sp_payment->getSalePersonCurrency->code) && !empty($sp_payment->getSalePersonCurrency->code) ? $sp_payment->getSalePersonCurrency->code : '' }}
                            {{ Helper::number_format($sp_payment->balance_owed_total_paid_amount) }}
                          </td>

                          <td>
                            <a href="{{ route('sale_person_payments.edit', encrypt($sp_payment->id)) }}" class="mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="{{ route('sale_person_payments.account_allocation', [encrypt($sp_payment->id), encrypt($sp_payment->sale_person_id)]) }}" class="mr-2 btn btn-outline-success btn-xs" title="Account Allocation"><i class="fa fa-fw fa-tasks"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr align="center"><td colspan="100%">No record found.</td></tr>
                    @endif

                  </tbody>
                </table>
              </div>
            </div>

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{-- {{ $sac_batch->links() }} --}}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection

@push('js')
  <script src="{{ asset('js/quote_management.js') }}" ></script>
@endpush