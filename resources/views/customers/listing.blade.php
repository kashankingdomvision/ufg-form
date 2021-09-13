@extends('layouts.app')

@section('title','View Customers')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex"></div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item active">Customers</li>
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
            <form method="get" action="{{ route('customers.index') }}">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default {{ (request()->has('search'))? '' : 'collapsed-card' }}">
                                <button type="button" class="btn btn-tool m-0 text-dark " data-card-widget="collapse">
                                    <div class="card-header">
                                    <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters &nbsp;<i class="fa fa-angle-down"></i></b></h3>
                                    </div>
                                </button>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Search</label>
                                                <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="Enter Customer Name or Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                                                <a href="{{ route('customers.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Customers List</h3>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Customer Email</th>
                                                <th>Quotes</th>
                                                <th>Bookings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($customers) && !empty($customers))
                                                @foreach ($customers as $key => $value)
                                                <tr>
                                                    <td>{{ $value['name'] }} </td>
                                                    <td>{{ $value['email'] }}</td>
                                                    <td>
                                                        @if( $value['quotes'] > 0)
                                                            <a href="{{ route('customers.quote.listing', encrypt($value['email']) ) }}" title="View Quotes">{{ $value['quotes'] }}</a>
                                                        @else
                                                            {{$value['quotes']}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if( $value['booking'] > 0)
                                                            <a href="{{ route('customers.booking.listing', encrypt($value['email']) ) }}" title="View Bookings">{{ $value['booking'] }}</a>
                                                        @else
                                                            {{$value['booking']}}
                                                        @endif
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
                                    {{ $customers->links() }}
                                </ul>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>
    </div>


@endsection
