@extends('layouts.app')
@section('title','Listing Supplier')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>View User</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item active">User Management</li>
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
                                <h3 class="card-title">User List</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact No</th>
                                                <th>Currency</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                          @foreach ($suppliers as $key => $supplier)
                                          <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $supplier->name }}</td>
                                            <td>{{ $supplier->email }}</td>
                                            <td>{{ $supplier->phone }}</td>
                                            <td>{{ $supplier->getCurrency->name??NULL }}</td>
                                            <td class="d-flex">
                                              <form method="post" action="{{ route('suppliers.destroy', encrypt($supplier->id)) }}">
                                              <a class="btn-link btn p-0" href="{{ route('suppliers.edit', encrypt($supplier->id)) }}" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                              <a class="btn-link btn p-0" href="{{ route('suppliers.show', encrypt($supplier->id)) }}" title="show"><i class="fa fa-fw fa-eye"></i></a>
                                                  @csrf
                                                  @method('delete')
                                                   <button class="btn-link p-0 btn text-danger" onclick="return confirm('Are you sure want to Delete this record?');">
                                                    <span class="fa fa-trash"></span>
                                                  </button>
                                              </form>
                                            </td>
                                          </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                  {{ $suppliers->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
