
<div class="card">
    <div class="card-header">
        <h3 class="card-title card-title-style">Lead Passenger Information</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-outline-dark compare-collapse-expand-btn" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>

    <div class="card-body">
        @if(isset($quote_ref_one) || isset($quote_ref_two) || isset($quote_ref_three) || isset($quote_ref_four))
                    
            <div class="row">
                <div class="col-md-2 col-style"></div>

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

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Lead Passenger Name
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->lead_passenger_name) ?  $quote_ref_one->lead_passenger_name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->lead_passenger_name) ? $quote_ref_two->lead_passenger_name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->lead_passenger_name) ? $quote_ref_three->lead_passenger_name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->lead_passenger_name) ? $quote_ref_four->lead_passenger_name : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Email Address
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->lead_passenger_email) ?  $quote_ref_one->lead_passenger_email : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->lead_passenger_email) ? $quote_ref_two->lead_passenger_email : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->lead_passenger_email) ? $quote_ref_three->lead_passenger_email : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->lead_passenger_email) ? $quote_ref_four->lead_passenger_email : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Contact Number
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->lead_passenger_contact) ?  $quote_ref_one->lead_passenger_contact : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->lead_passenger_contact) ? $quote_ref_two->lead_passenger_contact : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->lead_passenger_contact) ? $quote_ref_three->lead_passenger_contact : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->lead_passenger_contact) ? $quote_ref_four->lead_passenger_contact : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Date Of Birth
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !is_null($quote_ref_one->lead_passenger_dbo) ?  Carbon\Carbon::parse($quote_ref_one->lead_passenger_dbo)->format('d/m/Y') : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !is_null($quote_ref_two->lead_passenger_dbo) ?  Carbon\Carbon::parse($quote_ref_two->lead_passenger_dbo)->format('d/m/Y') : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !is_null($quote_ref_three->lead_passenger_dbo) ?  Carbon\Carbon::parse($quote_ref_three->lead_passenger_dbo)->format('d/m/Y') : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !is_null($quote_ref_four->lead_passenger_dbo) ?  Carbon\Carbon::parse($quote_ref_four->lead_passenger_dbo)->format('d/m/Y') : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Nationality (Passport)
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->getLeadPassengerNationality->name) ? $quote_ref_one->getLeadPassengerNationality->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->getLeadPassengerNationality->name) ? $quote_ref_two->getLeadPassengerNationality->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->getLeadPassengerNationality->name) ? $quote_ref_three->getLeadPassengerNationality->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->getLeadPassengerNationality->name) ? $quote_ref_four->getLeadPassengerNationality->name : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Resident In
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->getLeadPassengerResidentIn->name) ? $quote_ref_one->getLeadPassengerResidentIn->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->getLeadPassengerResidentIn->name) ? $quote_ref_two->getLeadPassengerResidentIn->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->getLeadPassengerResidentIn->name) ? $quote_ref_three->getLeadPassengerResidentIn->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->getLeadPassengerResidentIn->name) ? $quote_ref_four->getLeadPassengerResidentIn->name : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Bedding Preferences
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->lead_passenger_bedding_preference) ?  $quote_ref_one->lead_passenger_bedding_preference : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->lead_passenger_bedding_preference) ? $quote_ref_two->lead_passenger_bedding_preference : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->lead_passenger_bedding_preference) ? $quote_ref_three->lead_passenger_bedding_preference : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->lead_passenger_bedding_preference) ? $quote_ref_four->lead_passenger_bedding_preference : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Dinning Preferences
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->lead_passenger_dinning_preference) ?  $quote_ref_one->lead_passenger_dinning_preference : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->lead_passenger_dinning_preference) ? $quote_ref_two->lead_passenger_dinning_preference : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->lead_passenger_dinning_preference) ? $quote_ref_three->lead_passenger_dinning_preference : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->lead_passenger_dinning_preference) ? $quote_ref_four->lead_passenger_dinning_preference : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Uptodate Covid Vaccination Status
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->lead_passenger_covid_vaccinated) && $quote_ref_one->lead_passenger_covid_vaccinated == 1 ? 'Yes' : 'No'}}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->lead_passenger_covid_vaccinated) && $quote_ref_two->lead_passenger_covid_vaccinated == 1 ? 'Yes' : 'No'}}
                    </div>
                @endif
                @if(isset($quote_ref_three) )
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->lead_passenger_covid_vaccinated) && $quote_ref_three->lead_passenger_covid_vaccinated == 1 ? 'Yes' : 'No'}}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->lead_passenger_covid_vaccinated) && $quote_ref_four->lead_passenger_covid_vaccinated == 1 ? 'Yes' : 'No'}} 
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
