@extends('layouts.app')
@section('title','View Supplier')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex">
                            <h4>View Wallet </h4>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item active">Wallet</li>
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
        
        {{-- <section class="content p-2">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                    <a href="" id="delete_all" class="btn btn-danger btn-sm ">
                        <span class="fa fa-trash"></span> &nbsp;
                        <span>Delete Selected Record</span>
                    </a>
                </div>
              </div>
            </div>
          </section> --}}
          
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Wallet List</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped  table-hover">
                                        <thead>
                                            <tr>
                                                {{-- <th>
                                                    <div class="icheck-primary">
                                                      <input type="checkbox" class="parent">
                                                    </div>
                                                </th> --}}
                                                <th>Supplier Name</th>
                                                <th>Wallet Amount</th>
                                                {{-- <th>Contact No</th>
                                                <th>Currency</th>
                                                <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($booking_transactions && $booking_transactions->count())
                                            @foreach ($booking_transactions as $key => $booking_transaction)
                                            <tr>
                                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                                {{-- <td>{{ $booking_transaction->booking_id }}</td>
                                                <td>{{ $booking_transaction->booking_detail_id }}</td> --}}
                                                <td>{{ isset($booking_transaction->getSupplier->name) && !empty($booking_transaction->getSupplier->name) ? $booking_transaction->getSupplier->name : '' }}</td>
                                                <td>{{ $booking_transaction->credit - $booking_transaction->debit }}</td>
                                                {{-- <td>{{ $booking_transaction->type }}</td> --}}
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
                                  {{-- {{ $booking_transactions->links() }} --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
