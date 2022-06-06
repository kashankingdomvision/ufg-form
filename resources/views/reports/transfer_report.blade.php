@extends('layouts.app')

@section('title','Transfer Report')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4></h4>
                        <div class="d-flex">
                            <h4>Transfer Report</h4>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item">Reports</li>
                            <li class="breadcrumb-item active">Transfer Report</li>
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

            <form id="filter" novalidate>
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

                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label>Booking Reference</label>
                                                <select class="form-control select2-multiple"  data-placeholder="Select Booking Reference" multiple name="quote_ref[]">
                                                    @foreach ($bookings as $booking)
                                                        <option value="{{ $booking->id }}" {{ (in_array($booking->id,[old('quote_ref')]))? 'selected': ( (!empty(request()->get('quote_ref')))? ((in_array($booking->id, request()->get('quote_ref')))? 'selected' : null): '') }}>{{ $booking->quote_ref }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Booking Season</label>
                                                <select class="form-control select2single" name="booking_season">
                                                    <option value="" selected >Select Booking Season</option>
                                                    @foreach ($booking_seasons as $seasons)
                                                        <option value="{{ $seasons->id }}" {{ (old('booking_season') == $seasons->id)? 'selected': ((request()->get('booking_season') == $seasons->id)? 'selected' : null) }}>{{ $seasons->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Transfer Supplier</label>
                                                <select class="form-control select2single" name="supplier">
                                                    <option value="">Select User</option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}" {{ (old('supplier') == $supplier->id)? 'selected': ((request()->get('supplier') == $supplier->id) ? 'selected' : null) }} >{{ $supplier->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Service Date Range</label>
                                                <input type="text" name="dates" value="{{ request()->get('dates') }}" autocomplete="off" class="form-control date-range-picker">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Month</label>
                                                <select class="form-control select2single" name="month">
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
                                                <label>Year</label>
                                                <select class="form-control select2single" name="year">
                                                    <option value="">Select Year</option>
                                                    @for ($i = date("Y")-5 ; $i < date("Y")+5 ; $i++)
                                                        <option value="{{ $i }}" {{ (old('year') == $i) ? 'selected' :((request()->get('year') == $i) ? 'selected' : null ) }}> {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control select2single" name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="active">Booked</option>
                                                    <option value="cancelled">Cancelled</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row custom-filter-row">
                                        {{-- <div class="col-md-2" >
                                            <div class="form-group">
                                                <div class="d-flex bd-highlight">
                                                    <div class="w-100 bd-highlight"><label>Transfer Details</label></div>
                                                </div>
                                                <select class="form-control select2single transfer-detail-feild" name="transfer_detail_feild" bid="transfer_detail_feild" >
                                                    <option value="">Select Feild</option>
                                                    @foreach ($booking_category_details as $booking_category_detail)
                                                        <option value="{{ $booking_category_detail->label }}" data-name="{{$booking_category_detail->label}}" {{ (old('transfer_detail_feild') == $booking_category_detail->label)? 'selected': ((request()->get('transfer_detail_feild') == $booking_category_detail->label) ? 'selected' : null) }} >{{ $booking_category_detail->label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-3" id="more_filter">
                                            <div class="form-group">
                                                <div class="d-flex bd-highlight">
                                                    <div class="w-100 bd-highlight"><label>More Filters</label></div>
                                                </div>

                                                <select class="form-control select2single transfer-detail-feild" name="transfer_detail_feild" bid="transfer_detail_feild" >
                                                    <option value="">Select Feild</option>
                                                    @foreach ($booking_category_details as $booking_category_detail)
                                                        <option value="{{ $booking_category_detail->label }}" data-optionLable="{{$booking_category_detail->label}}" data-optionType="{{$booking_category_detail->type}}" data-optionData="{{$booking_category_detail->data}}" {{ (old('transfer_detail_feild') == $booking_category_detail->label)? 'selected': ((request()->get('transfer_detail_feild') == $booking_category_detail->label) ? 'selected' : null) }} >{{ $booking_category_detail->label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                   

                                        {{-- <div class="col-md-2 {{ !request()->get('search') || !request()->get('transfer_detail_feild') ? 'd-none' : '' }}" id="search_transfer_detail">
                                            <div class="form-group">
                                                <label>Search Transfer Details</label>
                                                <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
                                            </div>
                                        </div> --}}
                                    </div>
                                   
                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                                                <a href="{{ route('reports.transfer.report') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
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
                    <form method="POST" action="{{ route('reports.transfer.report.export') }}">
                        @csrf
                        @php
                            $currParams = [
                                'quote_ref' => request()->get('quote_ref'),
                                'supplier' => request()->get('supplier'),
                                'booking_season' => request()->get('booking_season'),
                                'dates' => request()->get('dates'),
                                'month' => request()->get('month'),
                                'year' => request()->get('year'),
                                'status' => request()->get('status'),
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
                                <h3 class="card-title">Transfer Report List</h3>
                                    <a href="javascript:void(0)" class="btn btn-dark btn-sm float-right transfer-modal rounded"><i class="fas fa-edit"></i></a>
                                {{-- <a href="">
                                    <button class="btn btn-dark btn-sm float-right">Export in Excel</button>
                                </a> --}}
                            </div>
                            <div class="card-body p-0" id="card_body">
                                <div class="table-responsive" id="table_parent">
                                    @include('reports.includes.transfer_report_listing', ['booking_details' => $booking_details ])
                                </div>
                            </div>

                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                           
                                </ul>
                            </div>

                            <div id="overlay" class=""></div>
                        </div>

                    </div>

                </div>

            </div>
            
        </section>

    </div>
    @include('reports.includes.transfer_column_modal')
@endsection

@push('js')
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var defaultColumnsPreferences = {
            'Zoho_Reference'        : true, 
            'Quote_Ref_#'           : true, 
            'Season'                : true,
            'Lead_Passenger_Name'   : true,
            'Pax_No.'               : true,
            'Start_Date_of_Service' : true,
            'End_Date_of_Service'   : true,
            'Number_of_Nights'      : true,
            'Time_of_Service'       : true,
            'Category'              : true,
            'Supplier_Location'     : true,
            'Supplier'              : true,
            'Product_Location'      : true,
            'Product'               : true,
            'Payment_Type'          : true,
            'Supplier_Currency'     : true,
            'Estimated_Cost'        : true,
            'Actual_Cost'           : true,
            'Markup_Amount'         : true,
            'Markup_%'              : true,
            'Selling_Price'         : true,
            'Profit_%'              : true,
            'Service_Details'       : true,
            'Internal_Comments'     : true,
            'Status'                : true,
        };
        
        var col = {!! json_encode(Auth::user()->column_preferences, JSON_HEX_TAG) !!};
        var colJson = (col == null) ? defaultColumnsPreferences : JSON.parse(col);

        Object.keys(colJson).forEach(function(key, val) {
            $('#transfer_column_modal_body').append(`<div>
                <input type="hidden" name="${key}" value="${ colJson[key] ? true : false }"><input type="checkbox" id="${key}" ${ colJson[key] ? 'checked' : ''}  >
                <label for="${key}"> &nbsp; ${key.replace(/_/g," ")}</label>
            </div>`);
        });

        $('input[type=checkbox]').click(function(){
            (this.checked) ? $(this).prev().val('true') : $(this).prev().val('false');
        });

        $('th, td').each(function(e){
            var _key = $(this).attr('data-column');

            if(colJson[_key]) {
                $(`[data-column="${_key}"]`).removeClass('d-none');
            }
            else {
                $(`[data-column="${_key}"]`).addClass('d-none');
            }
        });

        $(document).on('submit', '.transfer-column-form', function(e){
            e.preventDefault();

            disabledFeild(".transfer-column-form [name=_token]");

            $.ajax({
                type: "POST",
                url:  $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend: function() {
                    $("#transfer_column_save_btn").find('span').addClass('spinner-border spinner-border-sm');
                },
                success: function (data) {
                    $("#transfer_column_save_btn").find('span').removeClass('spinner-border spinner-border-sm');
                    jQuery('.transfer-column-modal').modal('hide');

                    setTimeout(function() {
                        if(data && data.status == true){
                            alert(data.success_message);
                            location.reload();
                        }
                    }, 400);
                 
                },
                error: function(reject) {
                    $("#transfer_column_save_btn").find('span').removeClass('spinner-border spinner-border-sm');
                },
            });
        });

        function disabledFeild(p) {
            $(p).attr("disabled", true);
        }

        $(document).on('submit', '#filter', function(e){

            e.preventDefault();
            load_records()
        });

        $(document).on('click', '.transfer-modal', function(e){
            e.preventDefault();
            jQuery('.transfer-column-modal').modal('show');
        });

        function load_records(url){
    
            var form = $('#filter').serialize();
            var url  = `{{ route('reports.transfer.report.listing') }}?${form}`;

            $.ajax({
                type: "GET",
                url: url,
                beforeSend: function() {
                    $("#overlay").addClass('overlay');
                    $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
                },
                success: function(response){
                    $("#overlay").removeClass('overlay').html('');
                    $('#table_parent').html(response);
                }
            });
        }

    });
</script>
@endpush