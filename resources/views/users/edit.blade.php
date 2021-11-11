@extends('layouts.app')

@section('title','Edit User')

@section('content')
    <div class="content-wrapper">
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
                <h4>Edit {{ (isset($status) && $status == 'profile')? 'Profile': 'User' }}</h4>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a>Home</a></li>
                  <li class="breadcrumb-item active">{{ (isset($status) && $status == 'profile')? 'Edit Profile': 'User Management' }}</li>
                </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="offset-md-2 col-md-8">

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{ (isset($status) && $status == 'profile')? 'Edit Profile': 'User Edit' }}</h3>
                </div>

                <form method="POST" action="{{ route('users.update', [encrypt($user->id), $status]) }}">
                  @csrf

                  <div class="card-body">

                    <input type="hidden" name="id" value="{{ encrypt($user->id) }}">

                    <div class="form-group">
                      <label>Name <span style="color:red">*</span></label>
                      <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required>

                      @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Email <span style="color:red">*</span></label>
                      <input type="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="emample@mail.com" required>
                      @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" value="" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                      @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>
                    @if(Auth::user()->hasAdmin())
                    <div class="form-group">
                      <label>User Type <span style="color:red">*</span></label>
                      <select class="form-control select2single role @error('role') is-invalid @enderror" name="role">
                        <option value="">Select User Type</option>
                        @foreach ($roles as $role)
                          <option value="{{ $role->id }}" {{ ($user->role_id == $role->id) ? 'selected' : ''}} data-role="{{ $role->name }}"> {{ $role->name }}</option>
                        @endforeach
                      </select>

                      @error('role')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
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

                      @error('supervisor_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div> 

                    <div class="form-group">
                      <label>Default Commision <span style="color:red">*</span></label>
                      <select name="commission_id" class="form-control select2single @error('commission_id') is-invalid @enderror">
                        <option value="">Select Commission </option>
                        @foreach($commisions as $commision)
                          <option {{ (old('commission_id') == $commision->id) || ($user->commission_id == $commision->id) ? 'selected' : null }} value="{{ $commision->id }}">{{ $commision->name }}</option>
                        @endforeach
                      </select>

                      @error('commission_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Commission Group <span style="color:red">*</span></label>
                      <select name="commission_group_id" id="commission_group_id" class="form-control select2single commission-group-id @error('commission_group_id') is-invalid @enderror">
                        <option value="">Select Commission Group</option>
                        @foreach ($commission_groups as $commission_group)
                          <option value="{{ $commission_group->id }}" {{  (old('commission_group_id') == $commission_group->id || $commission_group->id == $commission_group->id ) ? "selected" : ($user->commission_group_id == $commission_group->id ? 'selected' : '') }} >{{ $commission_group->name }}</option>
                        @endforeach
                      </select>
  
                      @error('commission_group_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Default Currency</label>
                      <select class="form-control select2single @error('currency') is-invalid @enderror" name="currency">
                        <option selected value="">Select Currency</option>
                        @foreach ($currencies as $currency)
                          <option value="{{ $currency->id }}" {{ (old('currency') == $currency->id) || ($user->currency_id == $currency->id) ? 'selected' : null }} data-image="data:image/png;base64, {{ $currency->flag }}"> &nbsp; {{ $currency->code }} - {{ $currency->name }} </option>
                        @endforeach
                      </select>

                      @error('currency')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Default Currency Rate Type</label>
                      <div>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="rate_type" value="live" class="rate-type" {{($user->rate_type == 'live')? 'checked': ''}} >
                          <span>&nbsp;Live Rate</span>
                        </label>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="rate_type" value="manual" class="rate-type" {{($user->rate_type == 'manual')? 'checked': ''}}>
                          <span>&nbsp;Manual Rate</span>
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Markup Type</label>
                      <div>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="markup_type" value="itemised" {{($user->markup_type == 'itemised')? 'checked': ''}} class="rate-type">
                          <span>&nbsp;Itemised Markup </span>
                        </label>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="markup_type" value="whole" {{($user->markup_type == 'whole')? 'checked': ''}} class="rate-type">
                          <span>&nbsp;Whole Markup</span>
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Default Brands</label>
                      <select class="form-control select2single getBrandtoHoliday @error('brand') is-invalid @enderror" name="brand">
                        <option value="">Select Brands</option>
                        @foreach ($brands as $brand)
                          <option value="{{ $brand->id }}" {{ $user->brand_id == $brand->id ? 'selected' : (old('brand') == $brand->id ? 'selected' : null) }} >{{ $brand->name }}</option>
                        @endforeach
                      </select>

                      @error('brand')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Holiday Type</label>
                      <select class="form-control select2single appendHolidayType @error('holiday_type') is-invalid @enderror" name="holiday_type">
                        <option value="">Select Holiday Type</option>
                        @if(isset($user->getBrand->getHolidayTypes))
                          @foreach ($user->getBrand->getHolidayTypes as $holiday_type)
                            <option value="{{ $holiday_type->id }}" {{ $user->holiday_type_id == $holiday_type->id ? 'selected' : (old('brand') == $holiday_type->id ? 'selected' : null) }} >{{ $holiday_type->name }}</option>
                          @endforeach
                        @endif      
                      </select>

                      @error('holiday_type')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

       

                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-danger buttonSumbit float-right mr-3">Cancel</a>
                    
                  </div>

                </form>
              </div>


            </div>

          </div>
        </div>
      </section>

    </div>
@endsection
