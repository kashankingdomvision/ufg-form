@extends('layouts.app')

@section('title','View Currency Rate')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>View Currency Rate</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">View Currency Rate</li>
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
              <h3 class="card-title">Currency Rate List</h3>
            </div>

            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Live Rate</th>
                    <th>Manual Rate</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($currency_conversions as $key => $value)
                    <tr>
                      <td>{{ $value->from }}   </td>
                      <td>{{ $value->to }}</td>
                      <td>{{ $value->live }}</td>
                      <td>{{ $value->manual }}</td>
                      <td>
                        <a href="{{ route('setting.currency_conversions.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  
                </tbody>
              </table>
            </div>

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $currency_conversions->links() }}
              </ul>
            </div>
            
          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
