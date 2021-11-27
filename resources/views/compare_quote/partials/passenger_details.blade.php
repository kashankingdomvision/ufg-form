
<div class="card">
    <div class="card-header">
        <h3 class="card-title card-title-style">Passenger Details</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-outline-dark compare-collapse-expand-btn" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>

    @php
      $quote_ref_one_pax_details   = isset($quote_ref_one) ? $quote_ref_one->getPaxDetail()->get() : '';
      $quote_ref_two_pax_details   = isset($quote_ref_two) ? $quote_ref_two->getPaxDetail()->get() : '';
      $quote_ref_three_pax_details = isset($quote_ref_three) ? $quote_ref_three->getPaxDetail()->get() : '';
      $quote_ref_four_pax_details  = isset($quote_ref_four) ? $quote_ref_four->getPaxDetail()->get() : '';

    @endphp

  

    <div class="card-body">
        @if(isset($quote_ref_one) || isset($quote_ref_two) || isset($quote_ref_three) || isset($quote_ref_four))
                    
            <div class="row">
                <div class="col-md-3 col-heading-style font-weight-bold"></div>

                @if(isset($quote_ref_one))
                    <div class="col col-style font-weight-bold">
                        {{ !empty($quote_ref_one->quote_ref) ? $quote_ref_one->quote_ref : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style font-weight-bold">
                        {{ !empty($quote_ref_two->quote_ref) ? $quote_ref_two->quote_ref : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style font-weight-bold">
                        {{ !empty($quote_ref_three->quote_ref) ? $quote_ref_three->quote_ref : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style font-weight-bold">
                        {{ !empty($quote_ref_four->quote_ref) ? $quote_ref_four->quote_ref : '-' }}
                    </div>
                @endif
            </div>

            <div class="row border">
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Full Name
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->full_name) ? $q_pax_detail->full_name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->full_name) ? $q_pax_detail->full_name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->full_name) ? $q_pax_detail->full_name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->full_name) ? $q_pax_detail->full_name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row border">
                <div class="col-md-3 col-heading-style font-weight-bold">
                   Email Address
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->email) ? $q_pax_detail->email : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->email) ? $q_pax_detail->email : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->email) ? $q_pax_detail->email : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->email) ? $q_pax_detail->email : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row border">
                <div class="col-md-3 col-heading-style font-weight-bold">
                   Contact Number
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->contact) ? $q_pax_detail->contact : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->contact) ? $q_pax_detail->contact : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->contact) ? $q_pax_detail->contact : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->contact) ? $q_pax_detail->contact : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row border">
                <div class="col-md-3 col-heading-style font-weight-bold">
                   Date of Birth
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !is_null($q_pax_detail->date_of_birth) ? Carbon\Carbon::parse($q_pax_detail->date_of_birth)->format('d/m/Y') : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !is_null($q_pax_detail->date_of_birth) ? Carbon\Carbon::parse($q_pax_detail->date_of_birth)->format('d/m/Y') : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !is_null($q_pax_detail->date_of_birth) ? Carbon\Carbon::parse($q_pax_detail->date_of_birth)->format('d/m/Y') : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !is_null($q_pax_detail->date_of_birth) ? Carbon\Carbon::parse($q_pax_detail->date_of_birth)->format('d/m/Y') : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>


            <div class="row  border">
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Nationality (Passport)
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->getPassengerNationality->name) ? $q_pax_detail->getPassengerNationality->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->getPassengerNationality->name) ? $q_pax_detail->getPassengerNationality->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->getPassengerNationality->name) ? $q_pax_detail->getPassengerNationality->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->getPassengerNationality->name) ? $q_pax_detail->getPassengerNationality->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row  border">
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Resident In
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->getPassengerResidentIn->name) ? $q_pax_detail->getPassengerResidentIn->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->getPassengerResidentIn->name) ? $q_pax_detail->getPassengerResidentIn->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->getPassengerResidentIn->name) ? $q_pax_detail->getPassengerResidentIn->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->getPassengerResidentIn->name) ? $q_pax_detail->getPassengerResidentIn->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row  border">
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Bedding Preferences
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->bedding_preference) ? $q_pax_detail->bedding_preference : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->bedding_preference) ? $q_pax_detail->bedding_preference : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->bedding_preference) ? $q_pax_detail->bedding_preference : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->bedding_preference) ? $q_pax_detail->bedding_preference : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row  border">
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Dinning Preferences
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->dinning_preference) ? $q_pax_detail->dinning_preference : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->dinning_preference) ? $q_pax_detail->dinning_preference : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->dinning_preference) ? $q_pax_detail->dinning_preference : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->dinning_preference) ? $q_pax_detail->dinning_preference : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row  border">
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Up To Date Covid Vaccination Status
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->covid_vaccinated) && ($q_pax_detail->covid_vaccinated == 1) ? 'Yes' : 'No' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->covid_vaccinated) && ($q_pax_detail->covid_vaccinated == 1) ? 'Yes' : 'No' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->covid_vaccinated) && ($q_pax_detail->covid_vaccinated == 1) ? 'Yes' : 'No' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_pax_details as $key => $q_pax_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_pax_detail->covid_vaccinated) && ($q_pax_detail->covid_vaccinated == 1) ? 'Yes' : 'No' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>


        @else
        <div class="row" align="center">
            <div class="col">
                No Record found.
            </div>
        </div>
    @endif
    </div>
</div>
