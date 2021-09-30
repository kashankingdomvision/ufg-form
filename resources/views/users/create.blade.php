@extends('layouts.app')

@section('title','Add User')

@section('content')
    <div class="content-wrapper">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
                <h4>Add User</h4>
              </div>
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
          <div class="row">
            <div class="offset-md-2 col-md-8">

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">User Form</h3>
                </div>

                <form method="POST" action="{{ route('users.store') }}">
                  @csrf

                  <div class="card-body">

                    <div class="form-group">
                      <label>Name <span style="color:red">*</span></label>
                      <input type="text" name="name" value="" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required>

                      @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Email <span style="color:red">*</span></label>
                      <input type="email" name="email" value="" class="form-control @error('email') is-invalid @enderror" placeholder="emample@mail.com" required>

                      @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Password <span style="color:red">*</span></label>
                      <input type="password" name="password" value="" class="form-control @error('password')  @enderror" placeholder="Password" required>

                      @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    @if(Auth::user()->hasAdmin())
                    <div class="form-group">
                      <label>User Type <span style="color:red">*</span></label>
                      <select name="role" class="form-control select2single role  @error('role') is-invalid @enderror" required>
                        <option value="">Select User Type</option>
                        @foreach ($roles as $role)
                          <option value="{{ $role->id }}" data-role="{{ $role->name }}"> {{ $role->name }}</option>
                        @endforeach
                      </select>

                      @error('role')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div> 
                    @endif

                    <div class="form-group d-none" id="supervisor_feild">
                      <label>Supervisor <span style="color:red">*</span></label>
                      <select name="supervisor_id" id="supervisor_id" class="form-control select2single supervisor-id  @error('supervisor_id') is-invalid @enderror" >
                        <option value="">Select Supervisor</option>
                        @foreach ($supervisors as $supervisor)
                          <option value="{{ $supervisor->id }}" > {{ $supervisor->name }}</option>
                        @endforeach
                      </select>

                      @error('supervisor_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div> 

                    <div class="form-group">
                      <label>Default Commision</label>
                      <select name="commission" class="form-control select2single">
                        <option value="">Select Commission</option>
                        @foreach($commisions as $commision)
                          <option value="{{ $commision->id }}">{{ $commision->name }}</option>
                        @endforeach
                      </select>

                      @error('commission')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Default Currency</label>
                      <select name="currency" class="form-control select2single  @error('currency') is-invalid @enderror">
                        <option selected value="">Select Currency</option>
                        @foreach ($currencies as $currency)
                          <option value="{{ $currency->id }}" {{ old('currency') == $currency->id ? 'selected' : null }} data-image="data:image/png;base64, {{ $currency->flag }}"> &nbsp; {{ $currency->code }} - {{ $currency->name }} </option>
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
                          <input type="radio" name="rate_type" value="live" class="rate-type" checked>
                          <span>&nbsp;Live Rate</span>
                        </label>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="rate_type" value="manual" class="rate-type">
                          <span>&nbsp;Manual Rate</span>
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Markup Type</label>
                      <div>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="markup_type" value="itemised" class="rate-type">
                          <span>&nbsp;Itemised Markup </span>
                        </label>
                        <label class="radio-inline mr-1">
                          <input type="radio" name="markup_type" value="whole" class="rate-type">
                          <span>&nbsp;Whole Markup</span>
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Default Brands</label>
                      <select name="brand" class="form-control select2single getBrandtoHoliday @error('brand') is-invalid @enderror">
                        <option value="">Select Brands</option>
                        @foreach ($brands as $brand)
                          <option value="{{ $brand->id }}" {{ (old('brand') == $brand->id ? 'selected' : null) }} >{{ $brand->name }}</option>
                        @endforeach
                      </select>

                      @error('brand')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Holiday Type</label>
                      <select name="holiday_type" class="form-control select2single appendHolidayType">
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
