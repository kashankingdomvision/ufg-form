@extends('layouts.app')

@section('title', 'View Template')

@section('content')


    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex">
                            <h4>View Template <x-add-new-button :route="route('templates.create')" /> </h4>
                        </div>
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
        
        <x-page-filters :route="route('templates.index')">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Season</label>
                        <select class="form-control select2single" name="season">
                            <option value="">Search with Season</option>
                            @foreach ($seasons as $season)
                                <option value="{{ $season->name }}" {{ (old('season') == $season->name)? 'selected' :((request()->get('season') == $season->name)? 'selected' : null ) }}>{{ $season->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Created By</label>
                        <select class="form-control select2single" name="created_by">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->name }}" {{ (old('created_by') == $user->name)? 'selected' :((request()->get('created_by') == $user->name)? 'selected' : null ) }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Date Range</label>
                        <input type="text" name="dates" value="{{ request()->get('dates') }}" autocomplete="off" class="form-control date-range-picker">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Search</label>
                        <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="Search by Template Name and season">
                    </div>
                </div>
            </div>
        </x-page-filters>

        <section class="content p-2">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                    <a href="" id="delete_all" class="btn btn-danger btn-sm btn">
                        <span class="fa fa-trash"></span> &nbsp;
                        <span>Delete Selected Record</span>
                    </a>
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
                                    <table id="example1" class="table table-hover text-nowrap">
                                        <thead>
                                          <tr>
                                            <th>
                                                <div class="icheck-primary">
                                                  <input type="checkbox" class="parent">
                                                </div>
                                            </th>
                                              <th>Template Name</th>
                                              <th>Currency</th>
                                              <th>Currency Rate Type</th>
                                              <th>Markup Type</th>
                                              <th>Season</th>
                                              <th>Privacy Status</th>
                                              <th>Created By</th>
                                              <th>Created At</th>
                                              <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @if($templates && $templates->count())
                                            <tr class="text-center"><td colspan="10"><h4>Public Template</h4></td></tr>
                                            @foreach ($templates as $key => $template)
                                                <tr>
                                                    <td>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" class="child" value="{{$template->id}}" >
                                                        </div>
                                                    </td>
                                                    <td>{!! $template->title !!}</td>
                                                    <td>{{ isset($template->getCurrency->name) && !empty($template->getCurrency->name) ? $template->getCurrency->code.' - '.$template->getCurrency->name : '' }}</td>
                                                    <td> 
                                                        @if($template->rate_type == 'live')
                                                            Live Rate
                                                        @elseif($template->rate_type == 'manual')
                                                            Manual Rate
                                                        @endif
                                                    </td>
                                                    <td> 
                                                        @if($template->markup_type == 'itemised')
                                                            Itemised Markup 
                                                        @elseif($template->markup_type == 'whole')
                                                            Whole Markup
                                                        @endif
                                                    </td>
                                                    <td>{{ isset($template->getSeason->name) && !empty($template->getSeason->name) ? $template->getSeason->name : '' }}</td>
                                                    <td>{{ $template->privacy_status == 1 ? 'Public' : '' }} </td>
                                                    <td>{{ isset($template->getUser->name) && !empty($template->getUser->name) ? $template->getUser->name : '' }}</td>
                                                    <td>{{ $template->formated_created_at }}</td>
                                                    <td width="10%">
                                                    <a href="{{ route('templates.edit', encrypt($template->id)) }}" class="btn btn-outline-success btn-xs mr-2" title="Edit" data-title="Edit" data-target="#edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure you want to Delete Records?');" href="{{ route('templates.delete', encrypt($template->id)) }}" class="btn btn-outline-danger btn-xs" data-title="Delete" title="Delete" data-target="#delete"><span class="fa fa-trash-alt"></span></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif


                                        @if($private_templates && $private_templates->count())
                                            <tr class="text-center"><td colspan="10"><h4>Private Template</h4></td></tr>
                                            @foreach ($private_templates as $key => $template)
                                                <tr>
                                                    <td>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" class="child" value="{{$template->id}}" >
                                                        </div>
                                                    </td>
                                                    <td>{!! $template->title !!}</td>
                                                    <td>{{ isset($template->getCurrency->name) && !empty($template->getCurrency->name) ? $template->getCurrency->code.' - '.$template->getCurrency->name : '' }}</td>
                                                    <td> 
                                                        @if($template->rate_type == 'live')
                                                            Live Rate
                                                        @elseif($template->rate_type == 'manual')
                                                            Manual Rate
                                                        @endif
                                                    </td>
                                                    <td> 
                                                        @if($template->markup_type == 'itemised')
                                                            Itemised Markup 
                                                        @elseif($template->markup_type == 'whole')
                                                            Whole Markup
                                                        @endif
                                                    </td>
                                                    <td>{{ isset($template->getSeason->name) && !empty($template->getSeason->name) ? $template->getSeason->name : '' }}</td>
                                                    <td>{{ $template->privacy_status == 0 ? 'Private' : '' }} </td>
                                                    <td>{{ isset($template->getUser->name) && !empty($template->getUser->name) ? $template->getUser->name : '' }}</td>
                                                    <td>{{ $template->formated_created_at }}</td>
                                                    <td width="10%">
                                                    <a href="{{ route('templates.edit', encrypt($template->id)) }}" class="btn btn-outline-success btn-xs mr-2" title="Edit" data-title="Edit" data-target="#edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure you want to Delete Records?');" href="{{ route('templates.delete', encrypt($template->id)) }}" class="btn btn-outline-danger btn-xs" data-title="Delete" title="Delete" data-target="#delete"><span class="fa fa-trash-alt"></span></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        @if(!$private_templates->count() && !$templates->count())
                                            <tr align="center"><td colspan="100%">No record found.</td></tr>
                                        @endif

                                        </tbody>
                                      </table>
                                </div>
                            </div>

                            @include('includes.multiple_delete',['table_name' => 'templates'])

                            <div class="card-footer clearfix">
                                
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>


@endsection
