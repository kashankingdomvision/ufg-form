@extends('layouts.app')

@section('title','View Season')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>View Season</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item active">Booking</li>
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
        {{-- <section class="content">
            <div class="container-fluid">
                <div class="card card-default {{ (request()->has('seasons'))? '' : 'collapsed-card' }}">
                    <button type="button" class="btn btn-tool m-0 text-dark" data-card-widget="collapse">
                        <div class="card-header">
                          <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters &nbsp;<i class="fa fa-angle-down"></i></b></h3>
                          <div class="card-tools">
                              <i class="fas fa-{{ (request()->has('search'))? 'minus' : 'plus' }}"></i>
                          </div>
                        </div>
                    </button>
         
                    <div class="card-body">
                        <form method="get" action="{{ route('bookings.view.seasons') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Seasons</label>
                                    <select class="form-control select2single" name="seasons">
                                        <option value="" selected >Select booking season</option>
                                        @foreach ($booking_seasons as $season)
                                            <option value="{{ $season->name }}" {{ (old('seasons') == $season->name)? 'selected': ((request()->get('seasons') == $season->name)? 'selected' : null) }}>{{ $season->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4  offset-md-4">
                                <a href="{{ route('bookings.view.seasons') }}" class="float-right btn btn-md btn-outline-dark mt-4">Reset<span class="fa fa-repeats"></span></a>
                                <button type="submit" class=" float-right btn btn-outline-success mr-2 mt-4">Filter</button>
                            </div>
                        </div>
                       
        
                    </form>
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
                                <h3 class="card-title">Season List</h3>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Season</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($seasons && $seasons->count())
                                                @foreach ($seasons as $key => $value)
                                                <tr>
                                                    <td class="inline-flex">
                                                    <a href="{{ route('bookings.index', encrypt($value->id)) }}" >
                                                        <h5><span class="btn btn-primary badge"> {{ $value->name }} &nbsp;</span></h5>
                                                    </a>

                                                    <h5>
                                                        @if ($value->default == 1)
                                                        <span class="ml-2 btn btn-light badge"> Default &nbsp;</span></h5>
                                                        @endif
                                                    </h5>
                                                    </td>

                                                    {{-- <td>
                                                    <a href="{{ route('bookings.index', encrypt($value->id)) }}" class="btn btn-outline-info btn-xs"><i class="fa fa-eye nav-icon"></i></a>
                                                    </td> --}}
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
                                    {{ $seasons->links() }}
                                </ul>
                            </div>

                        </div>

                    </div>

                </div>



            </div>
        </section>

    </div>


@endsection
