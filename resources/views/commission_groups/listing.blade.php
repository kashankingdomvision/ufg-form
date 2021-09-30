


@extends('layouts.app')

@section('title','View Commission Group')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>View Commission <x-add-new-button :route="route('commissions.commission-group.create')" /> </h4>
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Commission Managment</a></li>
            <li class="breadcrumb-item active">Commission Group</li>
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
  
  <x-page-filters :route="route('commissions.commission-group.index')">
    <div class="row">
      <div class="col">
        <div class="form-group">
            <label>Commission <span style="color:red">*</span></label>
            <select class="form-control select2single" name="commission_id">
                <option value="" selected>Select Commission</option>
                @foreach ($commissions as $commission)
                  <option value="{{ $commission->id }}" {{ (old('commission_id') == $commission->id )? 'selected': ((request()->get('commission_id') == $commission->id) ? 'selected' : null) }} > {{ $commission->name }}</option>
                @endforeach
            </select>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
            <label>Group <span style="color:red">*</span></label>
            <select class="form-control select2single" name="group_id">
              <option value="" selected>Select Group</option>
              @foreach ($groups as $group)
                <option value="{{ $group->id }}" {{ (old('group_id') == $group->id )? 'selected': ((request()->get('group_id') == $group->id) ? 'selected' : null) }} > {{ $group->name }}</option>
              @endforeach
            </select>
        </div>
      </div>

    </div>
  </x-page-filters>

  <section class="content p-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <a href="" id="delete_all" class="btn btn-danger  btn-sm ">
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
              <h3 class="card-title float-left">
                Commission Groups List
              </h3>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped  table-hover">
                  <thead>
                    <tr>
                      <th>
                        <div class="icheck-primary">
                          <input type="checkbox" class="parent">
                        </div>
                      </th>
                      <th>Commission Name</th>
                      <th>Group Name</th>
                      <th>Percentage</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($commission_groups && $commission_groups->count())
                    @foreach ($commission_groups as $commission_group)
                      <tr>
                        <td>
                          <div class="icheck-primary">
                            <input type="checkbox" class="child" value="{{$commission_group->id}}" >
                          </div>
                        </td>

                        <td>{{ isset($commission_group->getCommission->name) && !empty($commission_group->getCommission->name) ? $commission_group->getCommission->name : '' }}</td>
                        <td>{{ isset($commission_group->getGroup->name) && !empty($commission_group->getGroup->name) ? $commission_group->getGroup->name : '' }}</td>
                        <td>{{ $commission_group->percentage }}</td>
                       
                        <td>
                          <form method="post" action="{{ route('commissions.commission-group.destroy', encrypt($commission_group->id)) }}">
                            <a href="{{ route('commissions.commission-group.edit', encrypt($commission_group->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                            @csrf
                            @method('delete')
                            <button class="mr-2  btn btn-outline-danger btn-xs" title="Delete" onclick="return confirm('Are you sure want to Delete this record?');">
                              <span class="fa fa-trash"></span>
                            </button>
                          </form>
                        </td>

                      </tr>
                    @endforeach
                  @else
                    <tr align="center"><td colspan="100%">No record found.</td></tr>
                  @endif
                    
                  </tbody>
                </table>
              </div>
            </div>

            @include('includes.multiple_delete',['table_name' => 'commission_groups'])

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $commission_groups->links() }}
              </ul>
            </div>
            
          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
