<div class="modal fade " id="view_rates_modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">View Currency Rate </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="row mb-1">
            <div class="col-md-12">
              <div class="form-group">
                  <label>Booking Currency</label>
                  <select class="form-control select2-multiple view-rate-booking-currency-filter"  data-placeholder="Select Booking Currency" multiple name="booking_currency[]">
                    @foreach ($currencies as $curren)
                      <option value="{{ $curren->code }}" data-image="data:image/png;base64, {{$curren->flag}}" {{ (old('booking_currency') == $curren->code)? 'selected': ( (!empty(request()->get('booking_currency')))? (((in_array($curren->code, request()->get('booking_currency'))))? 'selected' : null) : '') }}> &nbsp; {{$curren->code}} - {{$curren->name}} </option>
                    @endforeach
                  </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body p-0">
                  <div class="table-responsive table-wrap">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th class="text-center" width="12">From </th>
                          <th class="text-center" width="12">To</th>
                          <th class="text-center" width="12">Live Rate</th>
                          <th class="text-center" width="12">Manual Rate</th>
                        </tr>
                      </thead>
                      <tbody id="currency_conversions">
                        @if($currency_conversions && $currency_conversions->count())
                          @foreach ($currency_conversions as $key => $value)
                            <tr class="tr-bottom-border-color">
                              <td class="text-center">{{ $value->from }}</td>
                              <td class="text-center">{{ $value->to }}</td>
                              <td class="text-center">{{ $value->live }}</td>
                              <td class="text-center">{{ $value->manual }}</td>
                            </tr>
                          @endforeach
                        @else
                          <tr align="center"><td colspan="100%">No record found.</td></tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- <div class="modal-footer justify-content-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> --}}

      </div>
    </div>


  </div>