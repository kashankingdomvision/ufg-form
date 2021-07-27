@extends('layouts.app')

@section('title','View Currency Rates')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>View Currency Rate</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Setting</a></li>
            <li class="breadcrumb-item active">View Currency Rate</li>
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
        <div class="card card-default {{ (request()->has('from'))? '' : 'collapsed-card' }}">
          <button type="button" class="btn btn-tool m-0 text-dark" data-card-widget="collapse">
            <div class="card-header">
              <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters</b></h3>
              <div class="card-tools">
                  <i class="fas fa-{{ (request()->has('search'))? 'minus' : 'plus' }}"></i>
              </div>
            </div>
          </button>
            <div class="card-body">
                <form method="get" action="{{ route('setting.currency_conversions.index') }}">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>From</label>
                            <input type="text" name="from" value="{{ old('from')??request()->get('from') }}" class="form-control" placeholder="from...">
                        </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                          <label>to</label>
                          <input type="text" name="to" value="{{ old('to')??request()->get('to') }}" class="form-control" placeholder="to...">
                      </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label>Live Rate</label>
                        <input type="number" name="live_rate" value="{{ old('live_rate')??request()->get('live_rate') }}" class="form-control" placeholder="live rate...">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label>Manual Rate</label>
                        <input type="number" name="manual_rate" value="{{ old('manual_rate')??request()->get('manual_rate') }}" class="form-control" placeholder="manual rate...">
                    </div>
                  </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-success btn-md mr-2" style="width: 10rem;">Search</button>
                        <a href="{{ route('setting.currency_conversions.index') }}" class="btn btn-outline-dark">Reset<span class="fa fa-repeats"></span></a>
                    </div>
                </div>

            </form>
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
              <h3 class="card-title">Currency Rate List</h3>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>From</th>
                      <th>To</th>
                      <th>Live Rate</th>
                      <th>Manual Rate</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($currency_conversions && $currency_conversions->count())
                    @foreach ($currency_conversions as $key => $value)
                      <tr>
                        <td>{{ $value->from }}   </td>
                        <td>{{ $value->to }}</td>
                        <td>{{ $value->live }}</td>
                        <td>{{ $value->manual }}</td>
                        <td>
                          <a href="{{ route('setting.currency_conversions.edit', encrypt($value->id)) }}" class=" mr-2 btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
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

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $currency_conversions->links() }}
              </ul>
            </div>
            
          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
