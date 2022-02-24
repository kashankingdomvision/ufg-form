@extends('layouts.app')

@section('title','Wallet Report')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4></h4>
                        <div class="d-flex">
                            <h4>Wallet Report</h4>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item">Reports</li>
                            <li class="breadcrumb-item active">Wallet Report</li>
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
            <form method="get" action="{{ route('reports.wallet.report') }}">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">
                                <button type="button" class="btn btn-tool m-0 text-dark " data-card-widget="collapse">
                                    <div class="card-header">
                                        <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters &nbsp;<i class="fa fa-angle-down"></i></b></h3>
                                    </div>
                                </button>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="supplier">Supplier</label>
                                                <select class="form-control select2single" name="supplier" id="supplier">
                                                    <option value="">Select Supplier</option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}"  {{ (old('search') == $supplier->id)? 'selected' :((request()->get('supplier') == $supplier->id)? 'selected' : null ) }}> {{ucfirst($supplier->name)}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="type">Type</label>
                                                <select class="form-control select2single" name="type" id="type">
                                                    <option value="">Select Type</option>
                                                    <option value="credit" {{ (old('type') == "credit")? 'selected' :((request()->get('type') == "credit")? 'selected' : null ) }} >Credit</option>
                                                    <option value="debit" {{ (old('type') == "debit")? 'selected' :((request()->get('type') == "debit")? 'selected' : null ) }} >Debit</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dateRange">Date Range</label>
                                                <input type="text" name="dates" value="{{ request()->get('dates') }}" autocomplete="off" class="form-control date-range-picker" id="dateRange">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="month">Month</label>
                                                <select class="form-control select2single" name="month" id="month">
                                                    <option value="">Select Month</option>
                                                    <option value="01" {{ (old('month') == "01")? 'selected' :((request()->get('month') == "01")? 'selected' : null ) }} >January</option>
                                                    <option value="02" {{ (old('month') == "02")? 'selected' :((request()->get('month') == "02")? 'selected' : null ) }} >February</option>
                                                    <option value="03" {{ (old('month') == "03")? 'selected' :((request()->get('month') == "03")? 'selected' : null ) }} >March</option>
                                                    <option value="04" {{ (old('month') == "04")? 'selected' :((request()->get('month') == "04")? 'selected' : null ) }} >April</option>
                                                    <option value="05" {{ (old('month') == "05")? 'selected' :((request()->get('month') == "05")? 'selected' : null ) }} >May</option>
                                                    <option value="06" {{ (old('month') == "06")? 'selected' :((request()->get('month') == "06")? 'selected' : null ) }} >June</option>
                                                    <option value="07" {{ (old('month') == "07")? 'selected' :((request()->get('month') == "07")? 'selected' : null ) }} >July</option>
                                                    <option value="08" {{ (old('month') == "08")? 'selected' :((request()->get('month') == "08")? 'selected' : null ) }} >August</option>
                                                    <option value="09" {{ (old('month') == "09")? 'selected' :((request()->get('month') == "09")? 'selected' : null ) }} >September</option>
                                                    <option value="10" {{ (old('month') == "10")? 'selected' :((request()->get('month') == "10")? 'selected' : null ) }} >October</option>
                                                    <option value="11" {{ (old('month') == "11")? 'selected' :((request()->get('month') == "11")? 'selected' : null ) }} >November</option>
                                                    <option value="12" {{ (old('month') == "12")? 'selected' :((request()->get('month') == "12")? 'selected' : null ) }} >December</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="year">Year</label>
                                                <select class="form-control select2single" name="year" id="year">
                                                    <option value="">Select Year</option>
                                                    @for ($i = date("Y")-5 ; $i < date("Y")+5 ; $i++)
                                                        <option value="{{ $i }}" {{ (old('year') == $i) ? 'selected' :((request()->get('year') == $i) ? 'selected' : null ) }}> {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                                                <a href="{{ route('reports.wallet.report') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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

        <section class="content p-2">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('reports.wallet.report.export') }}">
                        @csrf
                        @php
                            $currParams = [
                                'supplier' => request()->get('supplier'),
                                'type' => request()->get('type'),
                                'currency' => request()->get('currency'),
                                'dates' => request()->get('dates'),
                                'month' => request()->get('month'),
                                'year' => request()->get('year')
                            ];
                        @endphp
                        <input type="hidden" name="params" value="{{ json_encode($currParams, TRUE) }}">
                        <div class="dropdown show">
                            <a class="btn btn-base btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select Action
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <button type="submit" class="dropdown-item btn-link">Export</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Wallet List</h3>
                                {{-- <a href="">
                                    <button class="btn btn-dark btn-sm float-right">Export in Excel</button>
                                </a> --}}
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-hover text-nowrap">
                                        {{-- <thead>
                                            <th colspan="7">
                                                <a href="">
                                                    <button class="btn btn-dark btn-sm float-right">Export in Excel</button>
                                                </a>
                                            </th>
                                        </thead> --}}
                                        <thead>
                                        <tr>
                                            <th>Booking Reference</th>
                                            <th>Supplier Name</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($wallets && $wallets->count())
                                            @foreach ($wallets as $key => $wallet)
                                                <tr>
                                                    <td>{{ isset($wallet->getBooking->ref_no) && !empty($wallet->getBooking->ref_no) ? ucfirst($wallet->getBooking->ref_no) : '---'  }}</td>
                                                    <td>{{ isset($wallet->getSupplier->name) && !empty($wallet->getSupplier->name) ? ucfirst($wallet->getSupplier->name) : '---'  }}</td>
                                                    <td>{{ isset($wallet->amount) && !empty($wallet->amount) ? $wallet->amount : '---' }}</td>
                                                    <td>{{ isset($wallet->type) && !empty($wallet->type) ? ucfirst($wallet->type) : '---' }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="text-center">
                                                <td colspan="100%">No record found.</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">

                                </ul>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

    </div>

@endsection
