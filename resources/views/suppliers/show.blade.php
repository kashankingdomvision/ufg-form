@extends('layouts.app')
@section('title','Show Supplier')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Show Supplier</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item active">Supplier Management</li>
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
                                <h3 class="card-title">Supplier List</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                  <table class="table">
                                    <tbody>
                                      <tr>
                                        <th class="w-50">Supplier Name: </th>
                                        <td>{{ $supplier->name }}</td>
                                      </tr>
                                      
                                      <tr>
                                        <th >Supplier Email: </th>
                                        <td>{{ $supplier->email }}</td>
                                      </tr>
                                      
                                      <tr>
                                        <th class="w-50"> Supplier Phone: </th>
                                        <td>{{ $supplier->phone }}</td>
                                      </tr>
                                      
                                      <tr>
                                        <th class="w-50">Supplier Currency: </th>
                                        <td>{{ (isset($supplier->getCurrency))? $supplier->getCurrency->name : NULL }}</td>
                                      </tr>
                                      
                                      <tr>
                                        <th class="w-50"> Supplier Categories: </th>
                                        <td class="td">
                                            @foreach ($supplier->getCategories as $cate)
                                            <span class="badge badge-pill badge-primary ">{{ $cate['name'] }}</span>  
                                            @endforeach
                                        </td>
                                      </tr>
                                      <tr>
                                        <th class="w-50"> Supplier Products: </th>
                                        <td>
                                            @foreach ($supplier->getProducts as $prod)
                                            <span class="badge badge-pill badge-primary">{{ $prod['name'] }}</span>  
                                            @endforeach
                                        </td>
                                      </tr>
                                      <tr>
                                        <th class="w-50"> Description: </th>
                                        <td >
                                            <div class="border border-dark">
                                                {!! $supplier->description !!}
                                            </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
