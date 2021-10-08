@extends('layouts.app')

@section('title','View Group Quotes')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <div class="d-flex">
            <h4>View Group Quotes</h4>
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item"><a>Quote</a></li>
            <li class="breadcrumb-item active">Group Quote</li>
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

  <x-page-filters :route="route('commissions.group.index')">
    <div class="row">
      <div class="col-md-12">
          <div class="form-group">
              <label>Search</label>
              <input type="text" name="search" value="{{ old('search')??request()->get('search') }}" class="form-control" placeholder="what are you looking for .....">
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
                Group List
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
                      <th></th>
                      <th>Name</th>
                      <th>Total net price</th>
                      <th>Total markup amount</th>
                      <th>Total markup percentage</th>
                      <th>Total selling price</th>
                      <th>Total profit percentage</th>
                      <th>Total commission amount</th>
                      <th>Currency</th>
                      <th>Action</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($groups && $groups->count())
                    @foreach ($groups as $group)
                      <tr>
                        <td>
                          <div class="icheck-primary">
                            <input type="checkbox" class="child" value="{{$group->id}}" >
                          </div>
                        </td>
                        <td>
                            <a id="collapse-anchor-{{$group->id}}" data-toggle="collapse" href="#collapse{{$group->id}}">
                                <span class="text-secondary fa fa-eye"></span>
                            </a>
                        </td>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->total_net_price }}</td>
                        <td>{{ $group->total_markup_amount }}</td>
                        <td>{{ $group->total_markup_percentage }}</td>
                        <td>{{ $group->total_selling_price }}</td>
                        <td>{{ $group->total_profit_percentage }}</td>
                        <td>{{ $group->total_commission_amount }}</td>
                        <td>{{ $group->getBookingCurrency->name }}</td>
                        <td colspan="2">
                          <form method="post" action="{{ route('group-quote.destroy', encrypt($group->id)) }}">
                            <a href="{{ route('group-quote.edit', encrypt($group->id)) }}" class="btn btn-outline-success btn-xs" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger btn-xs" title="Delete" onclick="return confirm('Are you sure want to Delete this record?');">
                              <span class="fa fa-trash"></span>
                            </button>
                          </form>
                        </td>
                      </tr>
                      <tr id="collapse{{$group->id}}" class="panel-collapse collapse" style="background-color:transparent">
                          <th></th>
                          <th></th>
                          <th>Quote Ref#</th>
                          <th>Net price</th>
                          <th>Markup amount</th>
                          <th>Markup percentage</th>
                          <th>Selling price</th>
                          <th>Profit percentage</th>
                          <th>Commission amount</th>
                          <th colspan="2">Currency</th>
                      </tr>
                    @foreach($group->quotes as $q)
                    <tr id="collapse{{$group->id}}" class="panel-collapse collapse" style="background-color:transparent">
                        <td colspan="2"></td>
                        @if($q->booking_status != 'booked')
                            <td> <a href="{{ route('quotes.final', encrypt($q->id)) }}">{{ $q->quote_ref }}</a> </td>
                        @endif

                        @if($q->booking_status == 'booked')
                            <td> <a href="{{ route('bookings.show', encrypt($q->getBooking->id)) }}">{{ $q->quote_ref }}</a> </td>
                        @endif
                        <td>{{ $q->net_price }}</td>
                        <td>{{ $q->markup_amount }}</td>
                        <td>{{ $q->markup_percentage }}</td>
                        <td>{{ $q->selling_price }}</td>
                        <td>{{ $q->profit_percentage }}</td>
                        <td>{{ $q->commission_amount }}</td>
                        <td colspan="2">{{ $q->getBookingCurrency->name }}</td>
                    </tr>
                    @endforeach
                    @endforeach
                  @else
                    <tr align="center"><td colspan="100%">No record found.</td></tr>
                  @endif

                  </tbody>
                </table>
              </div>
            </div>

            @include('includes.multiple_delete',['table_name' => 'groups'])

            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $groups->links() }}
              </ul>
            </div>

          </div>

        </div>

      </div>
    </div>
  </section>

</div>
@endsection
