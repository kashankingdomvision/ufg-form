@extends('layouts.app')

@section('title','Edit User')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
            <h4>Edit {{ (isset($status) && $status == 'profile') ? 'Profile': 'User' }}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item active">{{ (isset($status) && $status == 'profile') ? 'Edit Profile': 'User Management' }}</li>
            </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card card-outline card-base">
            <div class="card-header">
              <h3 class="card-title">{{ (isset($status) && $status == 'profile')? 'Edit Profile': 'User Edit' }}</h3>
            </div>

            <form method="POST" id="update_user" action="{{ route('users.update', [encrypt($user->id), $status]) }}">
              @csrf
              
              <div class="card-body">
                <div class="form-group">
                  <label>Name <span style="color:red">*</span></label>
                  <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Email <span style="color:red">*</span></label>
                  <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="emample@mail.com" required>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                  <span class="text-danger" role="alert"></span>
                </div>

                @if(Auth::user()->isAdmin())
                  <div class="form-group">
                    <label>User Type <span style="color:red">*</span></label>
                    <select name="role_id" id="role_id" class="form-control select2single role-id">
                      <option value="">Select User Type</option>
                      @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ ($user->role_id == $role->id) ? 'selected' : ''}} data-role="{{ $role->name }}"> {{ $role->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger" role="alert"></span>
                  </div> 
                @endif

                <div class="form-group {{ $user->role_id == 2 ? '' : 'd-none' }}" id="supervisor_feild">
                  <label>Supervisor <span style="color:red">*</span></label>
                  <select name="supervisor_id" id="supervisor_id" class="form-control select2single supervisor-id  @error('supervisor_id') is-invalid @enderror" >
                    <option value="">Select Supervisor</option>
                    @foreach ($supervisors as $supervisor)
                      <option value="{{ $supervisor->id }}" {{ ($supervisor->id == $user->supervisor_id) ? 'selected' : ''}}> {{ $supervisor->name }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div> 

                <div class="form-group">
                  <label>Default Commision <span style="color:red">*</span></label>
                  <select name="commission_id" id="commission_id" class="form-control select2single @error('commission_id') is-invalid @enderror">
                    <option value="">Select Commission </option>
                    @foreach($commisions as $commision)
                      <option {{ (old('commission_id') == $commision->id) || ($user->commission_id == $commision->id) ? 'selected' : null }} value="{{ $commision->id }}">{{ $commision->name }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Commission Group <span style="color:red">*</span></label>
                  <select name="commission_group_id" id="commission_group_id" class="form-control select2single commission-group-id @error('commission_group_id') is-invalid @enderror">
                    <option value="">Select Commission Group</option>
                    @foreach ($commission_groups as $commission_group)
                      <option value="{{ $commission_group->id }}" {{  (old('commission_group_id') == $commission_group->id || $commission_group->id == $commission_group->id ) ? "selected" : ($user->commission_group_id == $commission_group->id ? 'selected' : '') }} >{{ $commission_group->name }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Default Currency</label>
                  <select name="currency" id="currency" class="form-control select2single">
                    <option selected value="">Select Currency</option>
                    @foreach ($currencies as $currency)
                      <option value="{{ $currency->id }}" {{  ($user->currency_id == $currency->id) ? 'selected' : '' }} data-image="data:image/png;base64, {{ $currency->flag }}"> &nbsp; {{ $currency->code }} - {{ $currency->name }} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Default Supplier Currency</label>
                  <select name="supplier_currency_id" class="form-control select2single">
                    <option selected value="">Select Currency</option>
                    @foreach ($currencies as $currency)
                      <option value="{{ $currency->id }}" {{ ($user->supplier_currency_id == $currency->id) ? 'selected' : '' }} data-image="data:image/png;base64, {{ $currency->flag }}"> &nbsp; {{ $currency->code }} - {{ $currency->name }} </option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Default Currency Rate Type</label>
                  <div class="d-flex flex-row">
                    <div class="custom-control custom-radio mr-1">
                      <input type="radio" name="rate_type" id="live_rate" class="rate-type custom-control-input custom-control-input-success custom-control-input-outline" value="live" {{ ($user->rate_type == 'live') ? 'checked': '' }}>
                      <label class="custom-control-label" for="live_rate">Live Rate</label>
                    </div>

                    <div class="custom-control custom-radio">
                      <input type="radio" name="rate_type" id="manual_rate" class="rate-type custom-control-input custom-control-input-success custom-control-input-outline" value="manual" {{ ($user->rate_type == 'manual') ? 'checked': '' }}>
                      <label class="custom-control-label" for="manual_rate">Manual Rate</label>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Markup Type</label>
                  <div class="d-flex flex-row">
                    <div class="custom-control custom-radio mr-1">
                      <input type="radio" name="markup_type" id="itemised" value="itemised" class="markup-type custom-control-input custom-control-input-success custom-control-input-outline" {{ ($user->markup_type == 'itemised') ? 'checked': '' }}>
                      <label class="custom-control-label" for="itemised">Itemised Markup </label>
                    </div>

                    <div class="custom-control custom-radio mr-1">
                      <input type="radio" name="markup_type" id="whole" value="whole" class="markup-type custom-control-input custom-control-input-success custom-control-input-outline" {{ ($user->markup_type == 'whole') ? 'checked': '' }} >
                      <label class="custom-control-label" for="whole">Whole Markup</label>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Default Brands</label>
                  <select name="brand" class="form-control select2single getBrandtoHoliday">
                    <option value="">Select Brands</option>
                    @foreach ($brands as $brand)
                      <option value="{{ $brand->id }}" {{ $user->brand_id == $brand->id ? 'selected' : (old('brand') == $brand->id ? 'selected' : null) }} >{{ $brand->name }}</option>
                    @endforeach
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>

                <div class="form-group">
                  <label>Holiday Type</label>
                  <select name="holiday_type" class="form-control select2single appendHolidayType">
                    <option value="">Select Holiday Type</option>
                    @if(isset($user->getBrand->getHolidayTypes))
                      @foreach ($user->getBrand->getHolidayTypes as $holiday_type)
                        <option value="{{ $holiday_type->id }}" {{ $user->holiday_type_id == $holiday_type->id ? 'selected' : '' }} >{{ $holiday_type->name }}</option>
                      @endforeach
                    @endif      
                  </select>
                  <span class="text-danger" role="alert"></span>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
                <a href="{{ route('users.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
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
  <script src="{{ asset('js/user_management.js') }}"></script>
@endpush
