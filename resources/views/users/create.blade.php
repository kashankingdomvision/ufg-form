@extends('layouts.app')

@section('title','Add User')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h4>Add User</h4></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active">User Management</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card card-secondary shadow-sm">
            <div class="card-header">
              <h3 class="card-title">User Form</h3>
            </div>

            <form method="POST" id="store_user" action="{{ route('users.store') }}">
              @csrf

              <div class="card-body">
                <div class="form-group">
                  <label>Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Email <span style="color:red">*</span></label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="emample@mail.com" >
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Password <span style="color:red">*</span></label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" >
                  <span class="text-danger" role="alert"></span>
                </div>

                @if(Auth::user()->hasAdmin())
                  <div class="form-group">
                    <label>User Type <span style="color:red">*</span></label>
                    <select name="role_id" id="role_id" class="form-control select2single role-id">
                      <option value="">Select User Type</option>
                      @foreach ($roles as $role)
                        <option value="{{ $role->id }}" data-role="{{ $role->name }}"> {{ $role->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" role="alert"></span>
                  </div> 
                @endif

                <div class="form-group d-none" id="supervisor_feild">
                  <label>Supervisor <span style="color:red">*</span></label>
                  <select name="supervisor_id" id="supervisor_id" class="form-control select2single supervisor-id">
                    <option value="">Select Supervisor</option>
                    @foreach ($supervisors as $supervisor)
                      <option value="{{ $supervisor->id }}" {{ ($supervisor->id == old('supervisor_id')) ? 'selected' : ''}} > {{ $supervisor->name }}</option>
                    @endforeach
                  </select>

                  <span class="text-danger" role="alert"></span>
                </div> 

                <div class="form-group">
                  <label>Default Commision <span style="color:red">*</span></label>
                  <select name="commission_id" id="commission_id" class="form-control select2single">
                    <option value="">Select Commission</option>
                    @foreach($commisions as $commision)
                      <option value="{{ $commision->id }}"> {{ $commision->name }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Default Commission Group <span style="color:red">*</span></label>
                  <select name="commission_group_id" id="commission_group_id" class="form-control select2single commission-group-id">
                    <option value="">Select Commission Group</option>
                    @foreach ($commission_groups as $commission_group)
                      <option value="{{ $commission_group->id }}"> {{ $commission_group->name }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Default Currency</label>
                  <select name="currency" id="currency" class="form-control select2single">
                    <option selected value="">Select Currency</option>
                    @foreach ($currencies as $currency)
                      <option value="{{ $currency->id }}" data-image="data:image/png;base64, {{ $currency->flag }}"> &nbsp; {{ $currency->code }} - {{ $currency->name }} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Default Currency Rate Type</label>
                  <div>
                    <input type="radio" name="rate_type" id="live_rate" value="live" class="rate-type" checked>
                    <label class="radio-inline mr-1" for="live_rate">Live Rate</label>

                    <input type="radio" name="rate_type" id="manual_rate" value="manual" class="rate-type">
                    <label class="radio-inline mr-1" for="manual_rate">Manual Rate</label>
                  </div>
                </div>

                <div class="form-group">
                  <label>Markup Type</label>
                  <div>
                    <input type="radio" name="markup_type" id="markup_type_itemised" value="itemised" class="rate-type">
                    <label class="radio-inline mr-1" for="markup_type_itemised">Itemised Markup</label>
                    
                    <input type="radio" name="markup_type" id="markup_type_whole" value="whole" class="rate-type" checked>
                    <label class="radio-inline mr-1" for="markup_type_whole">Whole Markup</label>
                  </div>
                </div>

                <div class="form-group">
                  <label>Default Brands</label>
                  <select name="brand" id="brand" class="form-control select2single getBrandtoHoliday @error('brand') is-invalid @enderror">
                    <option value="">Select Brands</option>
                    @foreach ($brands as $brand)
                      <option value="{{ $brand->id }}"> {{ $brand->name }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Holiday Type</label>
                  <select name="holiday_type" id="holiday_type" class="form-control select2single appendHolidayType">
                    <option value="">Select Holiday Type</option>
                    @if(isset($user->getBrand->getHolidayTypes))
                      @foreach ($user->getBrand->getHolidayTypes as $holiday_type)
                        <option value="{{ $holiday_type->id }}" {{ $user->holiday_type_id == $holiday_type->id ? 'selected' : (old('brand') == $holiday_type->id ? 'selected' : null) }} >{{ $holiday_type->name }}</option>
                      @endforeach
                    @endif      
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('users.index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
              </div>
            </form>

            <div id="overlay" class=""></div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

@endsection

@push('js')
  <script src="{{ asset('js/user_management.js') }}" ></script>
@endpush