@extends('layouts.app')

@section('title','View Booking Method')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>View Booking Method</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">Booking Method</li>
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
              <h3 class="card-title">Booking Method List</h3>
            </div>

            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Booking Method</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($booking_methods as $key => $value)
                  <tr>
                    <td>{{ $value->name }}</td>
                    <td>
                      <form method="post" action="{{ route('setting.booking_methods.destroy', encrypt($value->id)) }}">
                      <a href="{{ route('setting.booking_methods.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                        @csrf
                        @method('delete')
                        <button class="mr-2  btn btn-outline-danger btn-xs" onclick="return confirm('Are you sure want to Delete this record?');">
                          <span class="fa fa-trash"></span>
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
            </div>

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $booking_methods->links() }}
              </ul>
            </div>

          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
