@extends('layouts.app')

@section('title', 'View Template')

@section('content')


    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>View Template</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a>Home</a></li>
                            <li class="breadcrumb-item active">Template Management</li>
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
                                <h3 class="card-title">Template List</h3>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="example1" class="table" >
                                        <thead>
                                          <tr>
                                              <th>Template Name</th>
                                              <th>Season</th>
                                              {{-- <th>Status</th> --}}
                                              <th>Created At</th>
                                              <th>Created By</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($templates as $key => $template)
                                            <tr>
                                                <td>{!! $template->title !!}</td>
                                                <td>{{ isset($template->getSeason->name) && !empty($template->getSeason->name) ? $template->getSeason->name : '' }}</td>
                                                {{-- <td>{!! $template->formated_status !!}</td> --}}
                                                <td>{{ $template->formated_created_at }}</td>
                                                <td>{{ isset($template->getUser->name) && !empty($template->getUser->name) ? $template->getUser->name : '' }}</td>
                                                 <td width="10%" >
                                                   <a href="{{route('templates.edit', encrypt($template->id)) }}" class="btn btn-outline-success btn-xs" data-title="Edit" data-target="#edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                  <a onclick="return confirm('Are you sure want to Delete {{ $template->name }}');" href="{{ route('templates.delete', encrypt($template->id)) }}" class="btn btn-outline-danger btn-xs" data-title="Delete" data-target="#delete"><span class="fa fa-trash-alt"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                {{$templates->links()}}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>


@endsection
