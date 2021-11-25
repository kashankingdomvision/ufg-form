@extends('layouts.app')
@section('title', 'Quote Version')
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
              <h4>Quote Version</h4>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item active">Quote Management</li>
              </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content versions" id="content" data-countries="{{ $countries }}">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title text-center lh-2">Quote Version #{{  $log['log_no'] }} {{ isset($log['version_no']) && !empty($log['version_no']) ? $log['version_no'] : '' }}</h3>
                @if(!isset($type))
                  <button id="reCall" type="button" data-recall="true" class="btn btn-light float-right">Recall Version</button>
                @endif
              </div>
              <form method="POST" class="update-quote" action="{{ route('quotes.update', encrypt($quote['id'])) }}">
                <div class="card-body">
                  @csrf @method('put')

                  <!-- For Commission Calculation -->
                  <div class="row d-none">
                    <div class="col-sm-6">
                      <label>User ID <span style="color:red">*</span></label>
                      <div class="form-group">
                        <input type="text" value="{{ isset(Auth::user()->id) && !empty(Auth::user()->id) ? Auth::user()->id : '' }}" name="user_id" id="user_id" class="form-control user-id">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <label>Commission <span style="color:red">*</span></label>
                      <div class="form-group">
                        <input type="text" value="{{ isset($quote['commission_id']) && !empty($quote['commission_id']) ? $quote['commission_id'] : '' }}" name="commission_id" id="commission_id" class="form-control commission-id">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <label>Commission Group <span style="color:red">*</span></label>
                      <div class="form-group">
                        <input type="text" value="{{ isset($quote['commission_group_id']) && !empty($quote['commission_group_id']) ? $quote['commission_group_id'] : '' }}" name="commission_group_id" id="commission_group_id" class="form-control commission-group-id">
                      </div>
                    </div>
                  </div>
                  <!-- For Commission Calculation -->

                  <div class="row d-none">
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Quote Detail Model Name</label>
                        <input type="text" value="QuoteDetail" name="model_name" id="model_name" class="form-control model-name">
                      </div>
                    </div>
                  </div>

                  {{-- <div class="col-sm-6">
                    <div class="form-group">
                      <label>Commission Type <span style="color:red">*</span></label>
                      <select name="commission_id" id="commission_id" class="form-control select2single commission-id">
                        <option selected value="" >Select Commission Type </option>
                        @foreach ($commission_types as $commission_type)
                          <option value="{{ $commission_type->id }}" {{  $commission_type->id == $quote['commission_id'] ? 'selected' : '' }}>{{ $commission_type->name }} </option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Commission Group <span style="color:red">*</span></label>
                      <select name="commission_group_id" id="commission_group_id" class="form-control select2single commission-group-id">
                        <option value="">Select Commission Group</option>
                        @foreach ($log->getQueryData($quote['commission_id'], 'Commission')->first()->getCommissionGroups as $commission_group)
                          <option value="{{ $commission_group->id }}" {{  (old('commission_group_id') == $commission_group->id)? "selected" : ($quote['commission_group_id'] == $commission_group->id ? 'selected' : '') }} >{{ $commission_group->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger" role="alert"></span>
                    </div>
                  </div> --}}

                  <div class="row">
                    <div class="col-sm-6">
                      <label>Quote Title <span style="color:red">*</span></label>
                      <div class="form-group">
                        <input type="text" name="quote_title" id="quote_title" class="form-control" value="{{ $quote['quote_title'] }}" placeholder="Enter Quote Title">
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Currency Rate Type <span style="color:red">*</span><a href="javascript:void(0);" class="ml-2 view-rates"> (View Rates)</a> </label>
                        <div>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="rate_type" class="rate-type" value="live" {{ ($quote['rate_type'] == 'live')? 'checked': NULL }}  >
                            <span>&nbsp;Live Rate</span>
                          </label>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="rate_type" class="rate-type" value="manual"  {{ ($quote['rate_type'] == 'manual')? 'checked': NULL }} >
                            <span>&nbsp;Manual Rate</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <label>Zoho Reference <span style="color:red">*</span></label>
                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" value="{{ old('ref_no')??$quote['ref_no'] }}" name="ref_no" id="ref_no" class="form-control reference-name" placeholder="Enter Reference Number">
                            <div class="input-group-append">
                              <button id="search-reference-btn" class="btn search-reference-btn search-reference" type="button"><span class="mr-2 " role="status" aria-hidden="true"></span>Search</button>
                          </div>
                        </div>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Quote Reference <span style="color:red">*</span></label>
                        <input type="text" value="{{ old('quote_no')??$quote['quote_ref'] }}" name="quote_no" class="form-control" placeholder="Quote Reference Number" readonly>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>TAS Reference <span class="text-secondary">(Optional)</span></label>
                        <input type="text" name="tas_ref" class="form-control" value="{{ isset($quote['tas_ref']) & !empty($quote['tas_ref']) ? $quote['tas_ref'] : '' }}"  placeholder="TAS Reference Number" >
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Markup Type <span style="color:red">*</span></label>
                        <div>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="markup_type" {{ ($quote['markup_type'] == 'itemised')? 'checked': NULL }} value="itemised" class="markup-type">
                            <span>&nbsp;Itemised Markup </span>
                          </label>
                          <label class="radio-inline mr-1">
                            <input type="radio" name="markup_type" {{ ($quote['markup_type'] == 'whole')? 'checked': NULL }} value="whole" class="markup-type">
                            <span>&nbsp;Whole Markup</span>
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Sales Person <span style="color:red">*</span></label>
                        <select name="sale_person_id" id="sale_person_id" class="form-control  select2single sales-person-id @error('sales_person_id') is-invalid @enderror">
                          <option value="">Select Sales Person</option>
                          @foreach ($sale_persons as $person)
                            <option  value="{{ $person->id }}" {{  (old('sale_person_id') == $person->id)? "selected" : ($quote['sale_person_id'] == $person->id ? 'selected' : '') }}>{{ $person->name }}</option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Brand <span style="color:red">*</span></label>
                        <select name="brand_id" id="brand_id" class="form-control select2single getBrandtoHoliday brand-id">
                          <option value="">Select Brand</option>
                          @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ (old('brand_id') == $brand->id)? "selected" : (($quote['brand_id'] == $brand->id)? 'selected':NULL) }}> {{ $brand->name }} </option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Type Of Holiday <span style="color:red">*</span></label>
                        <select name="holiday_type_id" id="holiday_type_id" class="form-control select2single appendHolidayType holiday-type-id">
                          <option value="">Select Type Of Holiday</option>
                          @foreach ($log->getQueryData($quote['brand_id'], 'Brand')->first()->getHolidayTypes as $holiday_type)
                            <option value="{{ $holiday_type->id }}" {{  (old('holiday_type_id') == $holiday_type->id)? "selected" : ($quote['holiday_type_id'] == $holiday_type->id ? 'selected' : '') }} >{{ $holiday_type->name }}</option>
                          @endforeach
                          <option value="">Select Type Of Holiday</option>
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>


                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Booking Season <span style="color:red">*</span></label>
                        <select name="season_id" id="season_id" class="form-control select2single season-id">
                          <option value="">Select Booking Season</option>
                          @foreach ($seasons as $season)
                            <option value="{{ $season->id }}" data-start="{{ $season->start_date }}" data-end="{{ $season->end_date }}" {{ old('season_id') == $season->id  ? "selected" : ($quote['season_id'] == $season->id ? 'selected' : '') }}> {{ $season->name }} </option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Booking Currency <span style="color:red">*</span></label>
                        <select name="currency_id" id="currency_id" class="form-control select2single booking-currency-id @error('currency_id') is-invalid @enderror">
                          <option value="">Select Booking Currency </option>
                          @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" data-code="{{$currency->code}}" data-image="data:image/png;base64, {{$currency->flag}}"
                              {{ $currency->id == $quote['currency_id'] ? 'selected' : '' }}
                            > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                          @endforeach
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Agency Booking <span style="color:red">*</span></label>
                        <div>
                          <label class="radio-inline">
                            <input class="select-agency" {{ ($quote['agency'] ==  1 ? 'checked' : '') }}  value="1" type="radio" name="agency" > Yes
                          </label>
                          <label class="radio-inline">
                            <input  class="select-agency" {{ ($quote['agency'] ==  0 ? 'checked' : '') }}  value="0" type="radio" name="agency" > No
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 agency-columns" >
                        <div class="row mt-1 agencyField {{ ($quote['agency'] == 0)? 'd-none': '' }}" >
                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Name</label> <span style="color:red"> *</span>
                            <input type="text" value="{{ $quote['agency_name'] }}" name="agency_name" id="agency_name" class="form-control">
                            <span class="text-danger" role="alert" > </span>
                          </div>
                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Contact Name </label> <span style="color:red"> *</span>
                            <input type="text" value="{{ $quote['agency_contact_name'] }}" name="agency_contact_name" id="agency_contact_name" class="form-control">
                            <span class="text-danger" role="alert" > </span>
                          </div>
                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Contact No.</label> <span style="color:red"> *</span>
                            <input type="tel" value="{{ $quote['agency_contact'] }}" name="agency_contact" id="agency_contact" class="form-control phone phonegc">
                            <span class="text-danger error_msg0 hide" role="alert"></span>
                          </div>

                          <div class="col form-group">
                            <label for="inputEmail3" class="">Agency Email </label> <span style="color:red"> *</span>
                            <input type="email" value="{{ $quote['agency_email'] }}" name="agency_email" id="agency_email" class="form-control">
                            <span class="text-danger" role="alert" > </span>
                          </div>
                        </div>
                        <div class="row mt-1 PassengerField {{ ($quote['agency'] == 1)? 'd-none': '' }}" >
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Lead Passenger Name <span style="color:red">*</span></label>
                              <input type="text" value="{{ $quote['lead_passenger_name'] }}" name="lead_passenger_name" id="lead_passenger_name" class="form-control" placeholder="Lead Passenger Name" >
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Email Address <span style="color:red">*</span></label>
                              <input type="email" value="{{ $quote['lead_passenger_email'] }}" name="lead_passenger_email" id="lead_passenger_email" class="form-control" placeholder="EMAIL ADDRESS" >
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Contact Number <span style="color:red">*</span></label>
                              <input type="tel" value="{{ $quote['lead_passenger_contact'] }}" name="lead_passenger_contact" id="lead_passenger_contact"  class="form-control phone phone0" >
                              <span class="text-danger error_msg0" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Date Of Birth </label>
                              <input type="date" value="{{ $quote['lead_passenger_dbo'] }}" max="{{ date('Y-m-d') }}" id="lead_passenger_dbo" name="lead_passenger_dbo" class="form-control" placeholder="Date Of Birth" >
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row PassengerField {{ ($quote['agency'] == 1)? 'd-none': '' }}">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Nationality (Passport) </label>
                              <select name="lead_passsenger_nationailty_id" id="lead_passsenger_nationailty_id" class="form-control select2single nationality-id">
                                <option selected value="" >Select Nationality</option>
                                @foreach ($countries as $country)
                                  <option value="{{ $country->id }}" {{ ($quote['lead_passsenger_nationailty_id'] == $country->id)? 'selected': null }}> {{ $country->name }} </option>
                                @endforeach
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Resident In</label>
                              <select name="lead_passenger_resident" id="lead_passsenger_resident" class="form-control select2single resident-id">
                                <option selected value="" >Select Resident</option>
                                @foreach ($countries as $country)
                                  <option value="{{ $country->id }}" {{ ($quote['lead_passenger_resident'] == $country->id)? 'selected': null }}> {{ $country->name }} </option>
                                @endforeach
                              </select>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Dinning Preferences </label>
                              <input type="text" value="{{ $quote['lead_passenger_dinning_preference'] }}" name="lead_passenger_dinning_preference" id="lead_passenger_dinning_preference" class="form-control" placeholder="Dinning Preferences" >
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Bedding Preferences</label>
                              <input type="text" value="{{ $quote['lead_passenger_bedding_preference'] }}" name="lead_passenger_bedding_preference" id="lead_passenger_bedding_preference" class="form-control " placeholder="Bedding Preferences" id="bedding_preference" >
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Uptodate Covid Vacination Status</label>
                              <div>
                                <label class="radio-inline">
                                  <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="1" {{ ( $quote['lead_passenger_covid_vaccinated']  ==  1) ? 'checked' : '' }}> Yes &nbsp;&nbsp;
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="0" {{ ( $quote['lead_passenger_covid_vaccinated']  ==  0 ||  $quote['lead_passenger_covid_vaccinated']  == null) ? 'checked' : '' }} > No &nbsp;&nbsp;
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="lead_passenger_covid_vaccinated" id="lead_passenger_covid_vaccinated" class="covid-vaccinated" value="2" {{ ( $quote['lead_passenger_covid_vaccinated']  ==  2 ||  $quote['lead_passenger_covid_vaccinated']  == null) ? 'checked' : '' }} > Not Sure &nbsp;&nbsp;
                                </label>
                              </div>
                              <span class="text-danger" role="alert"></span>
                            </div>
                          </div>

                        </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Pax No. <span style="color:red">*</span></label>
                        <select name="pax_no" id="pax_no" class="form-control select2single paxNumber pax-number @error('pax_no') is-invalid @enderror">
                          <option value="">Select Pax No</option>
                          @for($i=1;$i<=30;$i++)
                            <option value={{$i}} {{ (old('pax_no') == $i)? "selected" : (($quote['pax_no'] == $i)? 'selected': NULL) }}>{{$i}}</option>
                          @endfor
                        </select>
                        <span class="text-danger" role="alert"></span>
                      </div>
                    </div>
                    <div id="appendPaxName" class="col-md-12">
                        @if($quote['pax_no'] >= 1)
                            @foreach ($quote['pax'] as $paxKey => $pax )
                            @php $count = $paxKey + 1; @endphp
                                <div class="mb-2 appendCount" id="appendCount{{ $count }}">
                                    <div class="row" >
                                        <div class="col-md-3 mb-2">
                                            <label >Passenger #{{ ($quote['agency'] == 1)? $count : $count +1  }}  Full Name  {!! ($loop->first && $quote['agency'] == 1)? '<span class="text-danger">*</span>': '' !!}</label>
                                            <input type="text" name="pax[{{$count}}][full_name]" value="{{ $pax['full_name'] }}" class="form-control" placeholder="PASSENGER #2 FULL NAME" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label >Email Address  {!! ($loop->first && $quote['agency'] == 1)? '<span class="text-danger">*</span>': '' !!}</label>
                                            <input type="email" name="pax[{{$count}}][email_address]" value="{{ $pax['email'] }}" class="form-control" placeholder="EMAIL ADDRESS" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Date Of Birth  {!! ($loop->first && $quote['agency'] == 1)? '<span class="text-danger">*</span>': '' !!}</label>
                                            <input type="date" max="{{  date("Y-m-d") }}" name="pax[{{$count}}][date_of_birth]" value="{{ $pax['date_of_birth'] }}" class="form-control" placeholder="CONTACT NUMBER" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label >Contact Number  {!! ($loop->first && $quote['agency'] == 1)? '<span class="text-danger">*</span>': '' !!}</label>
                                            <input type="tel" name="pax[{{$count}}][contact_number]" value="{{ $pax['contact'] }}" class="form-control phone phone{{ $count }}" placeholder="CONTACT NUMBER" >
                                            <span class="text-danger error_msg{{ $count }}" role="alert"> </span>
                                            <span class="text-danger valid_msg{{ $count }}" role="alert"> </span>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-sm-3">
                                          <label>Nationality  {!! ($loop->first && $quote['agency'] == 1)? '<span class="text-danger">*</span>': '' !!}</label>
                                          <select name="pax[{{ $count }}][nationality_id]" class="form-control select2single nationality-id">
                                                  <option selected value="" >Select Nationality</option>
                                              @foreach ($countries as $country)
                                                  <option value="{{ $country->id }}" {{ (old('nationality_id') == $country->id)? 'selected':( ($pax['nationality_id'] == $country->id)? 'selected':null) }}> {{ $country->name }} </option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="col-sm-3">
                                          <label>Resident In {!! ($loop->first && $quote['agency'] == 1)? '<span class="text-danger">*</span>': '' !!}</label>
                                          <select name="pax[{{ $count }}][resident_in]" class="form-control select2single resident-in-id">
                                                  <option selected value="" >Select Resident In</option>
                                              @foreach ($countries as $country)
                                                  <option value="{{ $country->id }}" {{ ($pax['resident_in'] == $country->id)? 'selected':null }}> {{ $country->name }} </option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Bedding Preference  {!! ($loop->first && $quote['agency'] == 1)? '<span class="text-danger">*</span>': '' !!}</label>
                                            <input type="text" name="pax[{{$count}}][bedding_preference]" value="{{ $pax['bedding_preference'] }}" class="form-control" placeholder="BEDDING PREFERENCES" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label>Dinning Preference  {!! ($loop->first && $quote['agency'] == 1)? '<span class="text-danger">*</span>': '' !!}</label>
                                            <input type="text" name="pax[{{$count}}][dinning_preference]" value="{{ $pax['dinning_preference'] }}" class="form-control" placeholder="DINNING PREFERENCES" >
                                            <div class="alert-danger errorpax" style="text-align:center" id="error_pax_name_'+validatecount+'"></div>
                                        </div>

                                        <div class="col-md-3">
                                          <div class="form-group">
                                            <label>Uptodate Covid Vacination Status</label>
                                            <div>
                                              <label class="radio-inline">
                                                <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="1"
                                                @if($pax['covid_vaccinated'] == 1)
                                                checked
                                                @endif> Yes &nbsp;&nbsp;
                                              </label>
                                              <label class="radio-inline">
                                                <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="0"
                                                @if($pax['covid_vaccinated'] == 0)
                                                checked
                                                @endif > No &nbsp;&nbsp;
                                              </label>
                                              <label class="radio-inline">
                                                <input type="radio" name="pax[{{$count}}][covid_vaccinated]" class="covid-vaccinated" value="2"
                                                @if($pax['covid_vaccinated'] == 2)
                                                checked
                                                @endif > Not Sure
                                              </label>
                                            </div>
                                          </div>
                                        </div>


                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                  </div>
                  <div class="parent" id="parent">

                    <div class="row">
                      <div class="col-md-12 text-right mb-2 p-1">
                        <button type="button" class="btn btn-sm btn-outline-dark mr-2 expand-all-btn" >Expand All</button>
                        <button type="button" class="btn btn-sm btn-outline-dark mr-2 collapse-all-btn" >Collapse All</button>
                      </div>
                    </div>

                    <div class="sortable sortable-spacing">
                      @foreach ($quote['quote'] as $key => $q_detail )
                        <div class="quote card card-default quote-{{$key}}" data-key="{{ $key }}">

                          <div class="card-header">
                            <h3 class="card-title card-title-style quote-title">
                              <span class="badge badge-info badge-date-of-service">{{ isset($q_detail['date_of_service']) && !empty($q_detail['date_of_service']) ? $q_detail['date_of_service'] : '' }}</span>
                              <span class="badge badge-info badge-time-of-service">{{ isset($q_detail['time_of_service']) && !empty($q_detail['time_of_service']) ? $q_detail['time_of_service'] : '' }}</span>
                              <span class="badge badge-info badge-category-id">{{ isset($q_detail['category_id']) && ($log->getQueryData($q_detail['category_id'], 'Category')->count() > 0) ? $log->getQueryData($q_detail['category_id'], 'Category')->first()->name : '' }}</span>
                              <span class="badge badge-info badge-supplier-id">{{ (isset($q_detail['supplier_id']) && $log->getQueryData($q_detail['supplier_id'], 'Supplier')->count() > 0 ) ? $log->getQueryData($q_detail['supplier_id'], 'Supplier')->first()->name : '' }}</span>
                              <span class="badge badge-info badge-product-id">{{ (isset($q_detail['product_id']) && $log->getQueryData($q_detail['product_id'], 'Product')->count() > 0 ) ? $log->getQueryData($q_detail['product_id'], 'Product')->first()->name : ''  }}</span>
                              <span class="badge badge-info badge-supplier-currency-id">{{ (isset($q_detail['supplier_currency_id']) && $log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->count() > 0 ) ? $log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->first()->code.' - '.$log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->first()->name : '' }}</span>
                            </h3>
                            <div class="card-tools">
                              <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 add-new-service-below d-none" ><i class="fas fa-plus"></i> &nbsp; Add New Service</a>
                              <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 collapse-expand-btn" title="Minimize/Maximize" data-card-widget="collapse"><i class="fas fa-minus"></i></a>
                              <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark mr-2 remove d-none" title="Remove"><i class="fas fa-times"></i></a>
                            </div>
                          </div>

                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group ">
                                  <div class="modal fade calladdmediaModal" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    @include('partials.addmediaModal')
                                  </div>
                                </div>
                                <button type="button" class=" disablebutton float-right btn btn-dark addmodalforquote" data-toggle="modal" data-target=".exampleModalCenter"><i class="fa fa-upload" aria-hidden="true"></i></button>
                              </div>
                            </div>

                            <div class="row"> {{-- ?>>>rowStart --}}
                              <div class="col-sm-2">
                                <div class="form-group">
                                  <label>Start Date of Service <span style="color:red">*</span></label>
                                  <input type="text" value="{{ $q_detail['date_of_service'] }}" name="quote[{{ $key }}][date_of_service]" data-name="date_of_service" id="quote_{{ $key }}_date_of_service" class="form-control date-of-service datepicker checkDates bookingDateOfService"  placeholder="Date of Service" autocomplete="off">
                                </div>
                              </div>

                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>End Date of Service <span style="color:red">*</span></label>
                                    <input type="text" value="{{ $q_detail['end_date_of_service']}}" name="quote[{{ $key }}][end_date_of_service]" data-name="end_date_of_service" id="quote_{{ $key }}_end_date_of_service" class="form-control end-date-of-service bookingEndDateOfService datepicker"  placeholder="DD/MM/YYYY" autocomplete="off">
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Number of Nights</label>
                                    <input type="text" name="quote[{{ $key }}][number_of_nights]" value="{{ $q_detail['number_of_nights'] }}" id="quote_{{ $key }}_number_of_nights" class="form-control number-of-nights" readonly>
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Time of Service</label>
                                    <input type="time" value="{{ $q_detail['time_of_service'] }}" name="quote[{{ $key }}][time_of_service]" data-name="time_of_service" id="quote_{{ $key }}_time_of_service" class="form-control time-of-service" placeholder="Time of Service" autocomplete="off">
                                </div>
                                </div>

                                <div class="col-sm-2 d-none">
                                  <div class="form-group">
                                    <label>Quote Detail ID</label>
                                    <input type="text" value="{{ $q_detail['id'] }}" name="quote[{{ $key }}][detail_id]"  id="quote_{{ $key }}_detail_id"  class="form-control detail-id">
                                  </div>
                                </div>

                                <div class="col-sm-2 d-none">
                                  <div class="form-group">
                                    <label>Category Details</label>
                                    <input type="text" name="quote[{{ $key }}][category_details]" value="@if(isset($log->getQueryData($q_detail['category_id'], 'Category')->first()->quote) && isset($log->getQueryData($q_detail['category_id'], 'Category')->first()->quote) == 1)@if(empty($q_detail['category_details']) || is_null($q_detail['category_details'])){{$log->getQueryData($q_detail['category_id'], 'Category')->first()->feilds}}@else{{$q_detail['category_details']}}@endif @endif" id="quote_{{ $key }}_category_details" class="form-control category-details">
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="quote[{{ $key }}][category_id]" data-name="category_id" id="quote_{{ $key }}_category_id" class="form-control select2single category-id @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" data-slug="{{ $category->slug }}" data-name="{{ $category->name }}" {{ ($q_detail['category_id'] == $category->id)? 'selected' : NULL}} > {{ $category->name }} </option>
                                    @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                </div>

                                @php
                                  $supplier_url = \Helper::getSupplierRateSheetUrl($q_detail['supplier_id'], $quote['season_id']);
                                  $url          = !empty($supplier_url) ? $supplier_url : '';
                                  $text         = !empty($supplier_url) ? "(View Rate Sheet)" : '';
                                @endphp

                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>
                                      Supplier <span style="color:red">*</span>
                                      <a href="{{ $url }}" target="_blank" class="ml-1 view-supplier-rate">{{ $text }}</a>
                                    </label>
                                    <select name="quote[{{ $key }}][supplier_id]" data-name="supplier_id" id="quote_{{ $key }}_supplier_id" class="form-control select2single supplier-id @error('supplier_id') is-invalid @enderror">
                                        <option value="">Select Supplier</option>
                                        @if(isset($q_detail['category_id']))
                                            @foreach ($log->getQueryData($q_detail['category_id'], 'Category')->first()->getSupplier as $supplier )
                                            <option value="{{ $supplier->id }}" data-name="{{ $supplier->name }}" {{ ($q_detail['supplier_id'] == $supplier->id)? 'selected' : NULL}}  >{{ $supplier->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('supplier_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                </div>


                                {{-- <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Product</label>
                                    <input type="text" name="quote[0][product_id]" value="{{ $q_detail['product_id'] }}" data-name="product_id" id="quote_0_product_id" class="form-control product-id" placeholder="Enter Product">
                                  </div>
                                </div> --}}

                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Product <a href="javascript:void(0)" class="ml-1 add-new-product d-none"> ( Add New Product ) </a></label>
                                    <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-control select2single  product-id @error('product_id') is-invalid @enderror">
                                      <option value="">Select Product</option>
                                      @if(isset($q_detail['supplier_id']) && $log->getQueryData($q_detail['supplier_id'], 'Supplier')->first()->getProducts)
                                        @foreach ($log->getQueryData($q_detail['supplier_id'], 'Supplier')->first()->getProducts as  $product)
                                          <option value="{{ $product->id }}" data-name="{{ $product->name }}" {{ ($q_detail['product_id'] == $product->id)? 'selected' : NULL}}>{{ $product->name }}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>

                                <div class="col-sm-1 justify-content-center quote-category-detail-btn-parent {{ isset($log->getQueryData($q_detail['category_id'], 'Category')->first()->quote) && ($log->getQueryData($q_detail['category_id'], 'Category')->first()->quote == 0) ? 'd-none' : 'd-flex' }}">
                                  <div class="form-group ">
                                    <button type="button" data-id="{{ $q_detail['id'] }}" class="add-category-detail btn btn-dark float-right mt-1"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                  </div>
                                </div>


                                {{-- <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Product</label>
                                    <select name="quote[{{ $key }}][product_id]" data-name="product_id" id="quote_{{ $key }}_product_id" class="form-contro select2single product-id @error('product_id') is-invalid @enderror">
                                        <option value="">Select Product</option>
                                    @if(isset($q_detail['supplier_id']))
                                        @foreach ($log->getQueryData($q_detail['supplier_id'], 'Supplier')->first()->getProducts as  $product)
                                            <option value="{{ $product->id }}" {{ ($q_detail['product_id'] == $product->id)? 'selected' : NULL}}>{{ $product->name }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                    @error('product_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                </div> --}}
                                {{-- <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Supervisor</label>
                                    <select name="quote[{{ $key }}][supervisor_id]" data-name="supervisor_id" id="quote_{{ $key }}_supervisor_id" class="form-control select2single supervisor-id @error('supervisor_id') is-invalid @enderror">
                                    <option value="">Select Supervisor</option>
                                    @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}" {{ ($q_detail['supervisor_id'] == $supervisor->id)? 'selected' : NULL}}> {{ $supervisor->name }} </option>
                                    @endforeach
                                    </select>
                                    @error('supervisor_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                </div> --}}

                                {{-- <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Booking Date</label>
                                    <input type="text" value="{{ $q_detail['booking_date'] }}" name="quote[{{ $key }}][booking_date]" data-name="booking_date" id="quote_{{ $key }}_booking_date"  class="form-control booking-date datepicker bookingDate" placeholder="Booking Date" autocomplete="off">
                                </div>
                                </div> --}}

                                {{-- <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Booking Due Date</label>
                                    <input type="text" value="{{ $q_detail['booking_due_date'] }}" name="quote[{{ $key }}][booking_due_date]" data-name="booking_due_date" id="quote_{{ $key }}_booking_due_date" class="form-control booking-due-date datepicker checkDates bookingDueDate" placeholder="Booking Due Date" autocomplete="off">
                                    <span class="text-danger" role="alert"></span>
                                </div>
                                </div> --}}

                                {{-- <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Booking Reference</label>
                                    <input type="text" value="{{ $q_detail['booking_reference'] }}" name="quote[{{ $key }}][booking_reference]" data-name="booking_refrence" id="quote_{{ $key }}_booking_refrence" class="form-control booking-reference" placeholder="Enter Booking Reference">
                                </div>
                                </div> --}}
                                {{-- <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Booking Method</label>
                                    <select name="quote[{{ $key }}][booking_method_id]" data-name="booking_method_id" id="quote_{{ $key }}_booking_method_id" class="form-control select2single booking-method-id @error('booking_method_id') is-invalid @enderror">
                                    <option value="">Select Booking Method</option>
                                    @foreach ($booking_methods as $booking_method)
                                        <option value="{{ $booking_method->id }}" {{ $q_detail['booking_method_id'] == $booking_method->id  ? "selected" : "" }}> {{ $booking_method->name }} </option>
                                    @endforeach
                                    </select>
                                    @error('booking_method_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                </div> --}}
                                {{-- <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Booked By</label>
                                    <select name="quote[{{ $key }}][booked_by_id]" data-name="booked_by_id" id="quote_{{ $key }}_booked_by_id" class="form-control select2single booked-by-id @error('booked_by_id') is-invalid @enderror">
                                    <option value="">Select Booked By </option>
                                    @foreach ($booked_by as $book_id)
                                        <option value="{{ $book_id->id }}" {{ $q_detail['booked_by_id'] == $book_id->id  ? "selected" : "" }}> {{ $book_id->name }} </option>
                                    @endforeach
                                    </select>
                                    @error('booked_by_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                </div> --}}
                                <div class="col-sm-2">
                                  <div class="form-group">
                                    <label>Booking Types</label>
                                    <select name="quote[{{ $key }}][booking_type_id]" data-name="booking_type_id" id="quote_{{ $key }}_booking_type_id" class="form-control select2single booking-type-id @error('booking_type_id') is-invalid @enderror">
                                      <option value="">Select Booking Type</option>
                                      @foreach ($booking_types as $booking_type)
                                        <option value="{{ $booking_type->id }}" data-slug="{{ $booking_type->slug }}" {{ $q_detail['booking_type_id'] == $booking_type->id  ? "selected" : "" }}> {{ $booking_type->name }} </option>
                                      @endforeach
                                    </select>

                                    @error('booking_type_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                  </div>
                                </div>

                                <div class="col-sm-2 refundable-percentage-feild {{ isset($q_detail['booking_type_id']) && !empty($q_detail['booking_type_id']) && $q_detail['booking_type_id'] == 2 ? '' : 'd-none'  }}">
                                  <div class="form-group">
                                    <label>Refundable % <span style="color:red">*</span></label>
                                    <input type="number" name="quote[{{ $key }}][refundable_percentage]" value="{{ $q_detail['refundable_percentage'] }}" data-name="refundable_percentage" id="quote_{{ $key }}_refundable_percentage" class="form-control refundable-percentage" placeholder="Refundable %">
                                    <span class="text-danger" role="alert"></span>
                                  </div>
                                </div>


                                <div class="col-sm-2">
                                <div class="form-group">
                                  <label>Supplier Currency <span style="color:red">*</span></label>
                                  <select name="quote[{{ $key }}][supplier_currency_id]" data-name="supplier_currency_id" id="quote_{{ $key }}_supplier_currency_id" class="form-control select2single supplier-currency-id @error('currency_id') is-invalid @enderror">
                                    <option value="">Select Supplier Currency</option>
                                    @foreach ($currencies as $currency)
                                      <option value="{{ $currency->id }}" data-name="{{ $currency->code.' - '.$currency->name }}" data-code="{{ $currency->code }}" {{ $q_detail['supplier_currency_id'] == $currency->id  ? "selected" : "" }}  data-image="data:image/png;base64, {{$currency->flag}}"> &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                                    @endforeach
                                  </select>
                                  <span class="text-danger" role="alert"></span>
                                </div>
                                </div>
                                <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Estimated Cost <span style="color:red">*</span></label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text supplier-currency-code">{{ ($q_detail['supplier_currency_id'] && $log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->count()) ? $log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail['estimated_cost']) }}" name="quote[{{ $key }}][estimated_cost]" data-name="estimated_cost" id="quote_{{ $key }}_estimated_cost" class="form-control estimated-cost change-calculation remove-zero-values" value="0.00">
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2 whole-markup-feilds {{ $quote['markup_type'] == 'whole' ? 'd-none' : '' }}">
                                <div class="form-group">
                                    <label>Markup Amount <span style="color:red">*</span></label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text supplier-currency-code">{{ ($q_detail['supplier_currency_id'] && $log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->count()) ? $log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail['markup_amount']) }}" name="quote[{{ $key }}][markup_amount]" data-name="markup_amount" id="quote_{{ $key }}_markup_amount" class="form-control markup-amount change-calculation remove-zero-values" value="0.00">
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2 whole-markup-feilds {{ $quote['markup_type'] == 'whole' ? 'd-none' : '' }}">
                                <div class="form-group">
                                    <label>Markup % <span style="color:red">*</span></label>
                                    <div class="input-group">
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail['markup_percentage']) }}" name="quote[{{ $key }}][markup_percentage]" data-name="markup_percentage" id="quote_{{ $key }}_markup_percentage" class="form-control markup-percentage change-calculation remove-zero-values" value="0.00">
                                    <div class="input-group-append">
                                        <div class="input-group-text">%</div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2 whole-markup-feilds {{ $quote['markup_type'] == 'whole' ? 'd-none' : '' }}">
                                <div class="form-group">
                                    <label>Selling Price <span style="color:red">*</span></label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text supplier-currency-code">{{ ($q_detail['supplier_currency_id'] && $log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->count()) ? $log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail['selling_price']) }}" name="quote[{{ $key }}][selling_price]" data-name="selling_price" id="quote_{{ $key }}_selling_price" class="form-control selling-price hide-arrows" value="0.00" readonly>
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-2 whole-markup-feilds {{ $quote['markup_type'] == 'whole' ? 'd-none' : '' }}">
                                <div class="form-group">
                                    <label>Profit % <span style="color:red">*</span></label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text supplier-currency-code">{{ ($q_detail['supplier_currency_id'] && $log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->count()) ? $log->getQueryData($q_detail['supplier_currency_id'], 'Currency')->first()->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail['profit_percentage']) }}" name="quote[{{ $key }}][profit_percentage]" data-name="profit_percentage" id="quote_{{ $key }}_profit_percentage" class="form-control profit-percentage hide-arrows" value="0.00" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">%</div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-3">
                                  <div class="form-group">
                                    <label>Estimated Cost in Booking Currency <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text booking-currency-code">{{ ($quote['currency_id'] && $log->getQueryData($quote['currency_id'], 'Currency')->count()) ? $log->getQueryData($quote['currency_id'], 'Currency')->first()->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($q_detail['estimated_cost_bc']) }}" name="quote[{{ $key }}][estimated_cost_in_booking_currency]" data-name="estimated_cost_in_booking_currency" id="quote_{{ $key }}_estimated_cost_in_booking_currency" class="form-control estimated-cost-in-booking-currency" value="0.00" readonly>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-3 whole-markup-feilds {{ $quote['markup_type'] == 'whole' ? 'd-none' : '' }}">
                                <div class="form-group">
                                    <label>Markup Amount in Booking Currency <span style="color:red">*</span></label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text booking-currency-code">{{ ($quote['currency_id'] && $log->getQueryData($quote['currency_id'], 'Currency')->count()) ? $log->getQueryData($quote['currency_id'], 'Currency')->first()->code : '' }}</span>
                                    </div>
                                    <input type="number" step="any" value="{{ \Helper::number_format($q_detail['markup_amount_in_booking_currency']) }}" name="quote[{{ $key }}][markup_amount_in_booking_currency]" data-name="markup_amount_in_booking_currency" id="quote_{{ $key }}_markup_amount_in_booking_currency" class="form-control markup-amount-in-booking-currency" value="0.00" readonly>
                                    </div>
                                </div>
                                </div>

                                <div class="col-sm-3 whole-markup-feilds {{ $quote['markup_type'] == 'whole' ? 'd-none' : '' }}">
                                  <div class="form-group">
                                    <label>Selling Price in Booking Currency <span style="color:red">*</span></label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text booking-currency-code">{{ ($quote['currency_id'] && $log->getQueryData($quote['currency_id'], 'Currency')->count()) ? $log->getQueryData($quote['currency_id'], 'Currency')->first()->code : '' }}</span>
                                      </div>
                                      <input type="number" step="any" value="{{ \Helper::number_format($q_detail['selling_price_in_booking_currency']) }}" name="quote[{{ $key }}][selling_price_in_booking_currency]" data-name="selling_price_in_booking_currency" id="quote_{{ $key }}_selling_price_in_booking_currency" class="form-control selling-price-in-booking-currency" value="0.00" readonly>
                                    </div>
                                  </div>
                                </div>

                                {{-- @if(Auth::user()->getRole->slug == 'admin' || Auth::user()->getRole->slug == 'accountant')
                                <div class="col-sm-2 d-flex justify-content-center">
                                <div class="form-group">
                                    <label>Added in Sage</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="icheck-primary">
                                        <input type="hidden" name="quote[{{ $key }}][added_in_sage]"  value="{{ $q_detail['added_in_sage'] }}">
                                        <input data-name="added_in_sage" {{ ($q_detail['added_in_sage'] == 1)? 'checked': null }} id="quote_{{ $key }}_added_in_sage" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                @endif --}}

                                <!-- <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Service Details</label>
                                    <textarea name="quote[{{ $key }}][service_details]" data-name="service_details" id="quote_{{ $key }}_service_details" class="form-control service-details" rows="2" placeholder="Enter Service Details">{{ $q_detail['service_details'] }}</textarea>
                                </div>
                                </div> -->
                                <div class="col-sm-3">
                                <div class="form-group">
                                  <label>Internal Comments <a href="javascript:void(0)" class="ml-1 insert-quick-text d-none"> ( Insert Quick Text ) </a></label>
                                    <textarea name="quote[{{ $key }}][comments]" data-name="comments" id="quote_{{ $key }}_comments" class="form-control comments" rows="2" placeholder="Enter Comments">{{ $q_detail['comments'] }}</textarea>
                                </div>
                                </div>
                            </div>{{-- ?>>>rown end --}}
                          </div>

                        </div>
                      @endforeach
                    </div>

                    <div class="parent-spinner text-gray spinner-border-sm "></div>
                  </div>

                  <div class="row" id="addMoreButton">

                  </div>

                  <div class="row" id="storedText" @if(!$quote['stored_text']) style="display:none; @endif">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label " class="col-sm-3 col-form-label">Stored Text</label>
                        <select multiple="multiple" name="stored_text[]" class="form-control select2-multiple" id="selectstoretext" @if(!$quote['stored_text']) disabled @endif>
                          @foreach ($storetexts as $text )
                            <option  @if($quote['stored_text']) {{ (in_array($text->id , $quote['stored_text']))? 'selected': '' }} @endif value="{{$text->id}}" >{{ $text->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 agencyField {{ ($quote['agency'] == 0) ? 'd-none': '' }}">
                    <div class="form-group">
                      <label>Agency Commission Type <span style="color:red">*</span></label>
                      <div>
                        <label class="radio-inline">
                          <input type="radio" name="agency_commission_type" class="agency-commission-type" value="net-price" {{ $quote['agency'] == 1 && $quote['agency_commission_type'] == 'net-price' ? 'checked' : '' }}>&nbsp; Net Price &nbsp;&nbsp;
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="agency_commission_type" class="agency-commission-type" value="paid-net-of-commission" {{ $quote['agency'] == 1 && $quote['agency_commission_type'] == 'paid-net-of-commission' ? 'checked' : '' }}>&nbsp; Paid Net of Commission &nbsp;&nbsp;
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="agency_commission_type" class="agency-commission-type" value="we-pay-commission-on-departure" {{ $quote['agency'] == 1 && $quote['agency_commission_type'] == 'we-pay-commission-on-departure' ? 'checked' : '' }}>&nbsp; We pay Commission on Departure
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mt-2">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Total Net Price</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ isset(Auth::user()->getCurrency->code) && !empty(Auth::user()->getCurrency->code) ? Auth::user()->getCurrency->code : '' }}</span>
                          </div>
                          <input type="number" name="total_net_price" step="any" class="form-control total-net-price hide-arrows" step="any" min="0"  value="{{ \Helper::number_format($quote['net_price']) }}" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Total Markup Amount</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ ($quote['currency_id'] && $log->getQueryData($quote['currency_id'], 'Currency')->count()) ? $log->getQueryData($quote['currency_id'], 'Currency')->first()->code : '' }}</span>
                          </div>
                          <input type="number" value="{{ \Helper::number_format($quote['markup_amount']) }}"  step="any" class="form-control total-markup-amount total-markup-change remove-zero-values hide-arrows" step="any" min="0" name="total_markup_amount" data-name="total_markup_amount" value="0.00" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                        <input type="number" value="{{ \Helper::number_format($quote['markup_percentage']) }}"  step="any" class="form-control total-markup-percent total-markup-change remove-zero-values hide-arrows" min="0" name="total_markup_percent" data-name="total_markup_percent" value="0.00" readonly>
                          <div class="input-group-append">
                            <div class="input-group-text">%</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Total Selling Price</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ ($quote['currency_id'] && $log->getQueryData($quote['currency_id'], 'Currency')->count()) ? $log->getQueryData($quote['currency_id'], 'Currency')->first()->code : '' }}</span>
                          </div>
                          <input type="number" value="{{ \Helper::number_format($quote['selling_price']) }}" step="any" name="total_selling_price" class="form-control total-selling-price hide-arrows" min="0.00" step="any"  value="0.00" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Total Profit Percentage</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <input type="number" value="{{ \Helper::number_format($quote['profit_percentage']) }}" step="any" name="total_profit_percentage" class="form-control total-profit-percentage hide-arrows" min="0" step="any" value="0.00" readonly>
                          <div class="input-group-append">
                            <div class="input-group-text">%</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row {{ ($quote['user_id'] != $quote['sale_person_id']) ? 'd-none' : '' }}" id="potential_commission_feild">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Potential Commission</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ ($quote['currency_id'] && $log->getQueryData($quote['currency_id'], 'Currency')->count()) ? $log->getQueryData($quote['currency_id'], 'Currency')->first()->code : '' }}</span>
                          </div>
                          <input type="number" step="any" name="commission_amount" class="form-control commission-amount hide-arrows" min="0" step="any" value="{{ \Helper::number_format($quote['commission_amount']) }}" readonly>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Booking Amount Per Person</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text booking-currency-code">{{ ($quote['currency_id'] && $log->getQueryData($quote['currency_id'], 'Currency')->count()) ? $log->getQueryData($quote['currency_id'], 'Currency')->first()->code : '' }}</span>
                          </div>
                          <input type="number" value="{{ \Helper::number_format($quote['amount_per_person']) }}" step="any" class="form-control booking-amount-per-person hide-arrows" step="any" min="0" name="booking_amount_per_person" value="0.00" readonly>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="paid-net-commission-on-departure {{ $quote['agency'] == 1 && $quote['agency_commission_type'] == 'paid-net-of-commission' || $quote['agency'] == 1 && $quote['agency_commission_type'] == 'we-pay-commission-on-departure' ? '' : 'd-none' }} ">
                    <hr>
  
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Agency Commission</label>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text booking-currency-code">{{ ($quote['currency_id'] && $log->getQueryData($quote['currency_id'], 'Currency')->count()) ? $log->getQueryData($quote['currency_id'], 'Currency')->first()->code : '' }}</span>
                            </div>
                            <input type="number" step="any" class="form-control agency-commission remove-zero-values" step="any" min="0" name="agency_commission" value="{{ \Helper::number_format($quote['agency_commission']) }}" >
                          </div>
                        </div>
                      </div>
                    </div>
  
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Total Net Margin</label>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text booking-currency-code">{{ ($quote['currency_id'] && $log->getQueryData($quote['currency_id'], 'Currency')->count()) ? $log->getQueryData($quote['currency_id'], 'Currency')->first()->code : '' }}</span>
                            </div>
                            <input type="number" step="any" class="form-control total-net-margin remove-zero-values" step="any" min="0" name="total_net_margin" value="{{ \Helper::number_format($quote['total_net_margin']) }}" readonly>
                          </div>
                        </div>
                      </div>
                    </div>

                    <hr>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Selling Price in Other Currency</label>
                        <select  name="selling_price_other_currency" class="form-control selling-price-other-currency @error('selling_price_other_currency') is-invalid @enderror">
                          <option value="">Select Currency</option>
                          @foreach ($currencies as $currency)
                          <option value="{{ $currency->code }}" {{ ($quote['selling_currency_oc'] == $currency->code)? 'selected':NULL }} data-image="data:image/png;base64, {{$currency->flag}}" > &nbsp; {{$currency->code}} - {{$currency->name}} </option>
                          @endforeach
                        </select>
                        @error('selling_price_other_currency')
                          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text selling-price-other-currency-code">{{ isset($quote['selling_currency_oc']) && !empty($quote['selling_currency_oc']) ? $quote['selling_currency_oc'] : '' }}</span>
                          </div>
                          <input type="number" value="{{ \Helper::number_format($quote['selling_price_ocr']) }}" step="any" name="selling_price_other_currency_rate" min="0" step="any" class="form-control selling-price-other-currency-rate hide-arrows" value="0.00" readonly>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{--<div class="form-group">
                    <div class="row">
                      <div class="col-sm-3 ">
                        <label for="inputEmail3" class="col-form-label">Relevant Quotes</label>
                      </div>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-sm-3 relevant-quote">
                            <select  name="revelant_quote[]" multiple class="form-control select2-multiple">
                              @foreach ($quote_ref as $ref)
                                <option {{ (is_array($quote['revelant_quote']))? ((in_array($ref->quote_ref, $quote['revelant_quote']))? 'selected': NULL) : NULL }} value="{{$ref->quote_ref}}"> {{ $ref->quote_ref }} </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>--}}
                      <div class="form-group">
                          <div class="row">
                              <div class="col-sm-3 ">
                                  <label for="group_quote" class="col-form-label">Add into Group</label>
                              </div>
                              <div class="col-md-9">
                                  <div class="row">
                                      <div class="col-sm-3 relevant-quote">
                                          <select name="quote_group" class="form-control select2-single" id="group_quote">
                                            <option value="0">Select Group</option>
                                            @foreach ($groups as $group)
                                              <option value="{{ $group->id }}" {{ $group->quotes->contains('id', $quote['id']) ? 'selected' : null }}> {{ $group->name }} </option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                </div>
                <div class="card-footer" id="btnSubmitversion"></div>
              </form>
              <div id="overlay" class=""></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @include('partials.insert_quick_text',[ 'preset_comments' => $preset_comments ])
  @include('partials.new_service_modal',['categories' => $categories, 'module_class' => 'quotes-service-category-btn' ])
  @include('partials.new_service_modal_below',['categories' => $categories, 'module_class' => 'quotes-service-category-btn-below' ])
  @include('partials.view_rates_modal')
  @include('partials.add_new_product')
  @include('partials.category_detail_feilds')

@endsection

@push('js')

<script src="{{ asset('js/category/jquery-ui.js') }}"></script>
<script src="{{ asset('js/category/formRender.js') }}"></script>

<script>

  var quote  = '';
  var key  = '';
  var formRenderID  = "#build-wrap"; 
  
  $(document).on('click', '.category-detail-feilds-submit', function() {
    var data = JSON.stringify($(formRenderID).formRender("userData"));
    $(`#quote_${key}_category_details`).val(data);
  });

  $(document).on('click', '.add-category-detail', function() {

    quote                 = jQuery(this).closest('.quote');
    key                   = quote.data('key');
    var type              = $(`#quote_${key}_category_id`).find(':selected').data('slug');
    var category_name     = $(`#quote_${key}_category_id`).find(':selected').data('name');
    var category_id       = $(`#quote_${key}_category_id`).val();
    var booking_detail_id = $(this).attr('data-id');
    var url               = '{{route('bookings.category.detail.feilds')}}';
    var modal             = jQuery('.category-detail-feilds');
    var feilds_data       = $(`#quote_${key}_category_details`).val();

    if(typeof type === 'undefined') {
      alert("Please Select Category first");
      return;
    }

    jQuery(function($) {
      var formRenderOptions = {
        formData: feilds_data 
      }

      $(formRenderID).html("");
      $(formRenderID).formRender(formRenderOptions);

      if(feilds_data == ""){
        $(formRenderID).html("No Form Data.");
      }
    });

    modal.modal('show');
    modal.find('.modal-title').html(`${category_name} Details`);

    if(feilds_data == ""){
      modal.find('.modal-footer').addClass("d-none");
    }else{
      modal.find('.modal-footer').removeClass("d-none");
    }

  });


</script>

@endpush
