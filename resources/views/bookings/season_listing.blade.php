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
                            <li class="breadcrumb-item active">Season Management</li>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Season List</h3>
                            </div>

                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Season</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($seasons as $key => $value)
                                        <tr>

                                          <td>
                                            {{ $value->name }} &nbsp;
                                            
                                            @if ($value->default == 1)
                                              <span class="btn btn-primary badge">Default</span>
                                            @endif
                                          </td>

                                          <td>

                                            <a href="{{ route('bookings.index', encrypt($value->id)) }}" class="btn btn-outline-info btn-xs"><i class="fa fa-eye nav-icon"></i></a>
                                            {{-- <form method="post" action="{{ route('seasons.destroy', encrypt($value->id)) }}">
                                              
                                              @csrf
                                              @method('delete')
                                              <button class="btn btn-xs ml-0 text-danger" onclick="return confirm('Are you sure want to Delete this record?');">
                                                <span class="fa fa-trash"></span>
                                              </button>
                                            </form> --}}
                                          </td>

                                        </tr>
                                      @endforeach
                                     
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                  {{-- {{ $seasons->links() }} --}}
                                </ul>
                            </div>

                        </div>

                    </div>

                </div>



            </div>
        </section>

    </div>


@endsection