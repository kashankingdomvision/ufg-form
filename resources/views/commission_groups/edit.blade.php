@extends('layouts.app')

@section('title','Edit Commission Group')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
              <h4>Edit Commission Group</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item"><a>Commission Managment</a></li>
                <li class="breadcrumb-item active">Commission Group</li>
              </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="offset-md-2 col-md-8">

            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center">Commissions Form</h3>
              </div>

              <form action="{{ route('commissions.commission-group.update', encrypt($commission_group->id)) }}" method="POST">
                @csrf @method('put')

                <div class="card-body">

                    <div class="form-group">
                        <label>Commission <span style="color:red">*</span></label>
                        <select name="commission_id" id="commission_id" value="{{ old('commission_id') }}" class="form-control select2single commission-id  @error('commission_id') is-invalid @enderror" disabled>
                            <option value="">Select Commission</option>
                            @foreach ($commissions as $commission)
                                <option value="{{ $commission->id }}" {{ old('commission_id') == $commission->id || $commission_group->commission_id == $commission->id ? 'selected' : '' }}> {{ $commission->name }}</option>
                            @endforeach
                        </select>

                        @error('commission_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div> 

                    <div class="form-group">
                        <label>Group <span style="color:red">*</span></label>
                        <select name="group_id" id="group_id" value="{{ old('group_id') }}" class="form-control select2single group-id  @error('group_id') is-invalid @enderror" disabled>
                          <option value="">Select Group</option>
                          @foreach ($groups as $group)
                            <option value="{{ $group->id }}" {{ (old('group_id') == $group->id )? 'selected': ((request()->get('group_id') == $group->id) ? 'selected' : null) }} > {{ $group->name }}</option>
                          @endforeach
                        </select>
  
                        @error('group_id')
                          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Percentage % <span style="color:red">*</span></label>
                        <input type="number" name="percentage" value="{{ $commission_group->percentage }}" class="form-control @error('percentage') is-invalid @enderror" placeholder="Commission Percentage %" required>

                        @error('percentage')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-secondary float-right">Submit</button>
                  <a href="{{ route('commissions.commission-group.index') }}" class="btn btn-outline-danger float-right  mr-2">Cancel</a>
                  
                </div>

              </form>
            </div>


       

        </div>
      </div>
    </section>

  </div>
@endsection