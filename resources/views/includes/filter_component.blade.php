<section class="content">
    <div class="container-fluid">
        <div class="card card-default {{ (request()->has('search'))? '' : 'collapsed-card' }}">
            <div class="row">
                <button type="button" class="btn btn-tool m-0 text-dark  col-md-10" data-card-widget="collapse">
                    <div class="card-header">
                      <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters &nbsp;<i class="fa fa-angle-down"></i></b></h3>
                    </div>
                </button>
  {{ $route }}
                <div class="float-right col-md-2">
                    <a href="{{ route('users.create') }}" class="btn btn-secondary btn-sm  m-12 float-right">
                        <span class="fa fa-plus"></span>
                        <span>Add New</span>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form method="get" action="{{ route('users.index') }}">
              
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Roles </label>
                                    <select class="form-control select2single" name="role">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ (old('search') == $role->id)? 'selected' :((request()->get('role') == $role->id)? 'selected' : null ) }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select class="form-control select2single" name="brand">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ (old('search') == $brand->id)? 'selected' :((request()->get('brand') == $brand->id)? 'selected' : null ) }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Currency</label>
                                    <select class="form-control select2single" name="currency">
                                        <option value="">Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}" data-image="data:image/png;base64, {{$currency->flag}}" {{ (old('search') == $currency->id)? 'selected' :((request()->get('currency') == $currency->id)? 'selected' : null ) }}> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Search</label>
                            <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Filter</button>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
                    </div>
                </div>

            </form>
            </div>
        </div>
    </div>
</section>