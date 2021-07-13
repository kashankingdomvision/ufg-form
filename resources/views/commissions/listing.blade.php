


@extends('layouts.app')

@section('title','View Holiday Types')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>View commissions</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">commissions</li>
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
              <h3 class="card-title">commissions List</h3>
            </div>

            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Percentage</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($commissions as $commi)
                  <tr>
                    <td>{{ $commi->id }}</td>
                    <td>{{ $commi->name }}</td>
                    <td>{{ $commi->percentage }} %</td>
                    <td>
                      <form method="post" action="{{ route('setting.commissions.destroy', encrypt($commi->id)) }}">
                        <a href="{{ route('setting.commissions.edit', encrypt($commi->id)) }}" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                        @csrf
                        @method('delete')
                        <button class="btn btn-xs ml-0 text-danger" onclick="return confirm('Are you sure want to Delete this record?');">
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
                {{ $commissions->links() }}
              </ul>
            </div>
            
          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection