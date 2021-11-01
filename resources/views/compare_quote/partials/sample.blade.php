
<div class="card">
    <div class="card-header">
        <h3 class="card-title card-title-style">Booking Information</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-outline-dark" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
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
                    Booking Currency
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->name) ? $quote_ref_one->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->name) ? $quote_ref_two->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->name) ? $quote_ref_three->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->name) ? $quote_ref_four->name : '-' }}
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

<!-- Additional -->

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
    <div class="col-md-2 col-heading-style font-weight-bold">Currency Rate Type</div>
    @if(isset($quote_ref_one))
        <div class="col col-style">
            {{ !empty($quote_ref_one->rate_type) && $quote_ref_one->rate_type == 'live' ? 'Live Rate' : 'Manual Rate'}}
        </div>
    @endif
    @if(isset($quote_ref_two))
        <div class="col col-style">
            {{ !empty($quote_ref_two->rate_type) && $quote_ref_two->rate_type == 'live' ? 'Live Rate' : 'Manual Rate'}}
        </div>
    @endif
    @if(isset($quote_ref_three) )
        <div class="col col-style">
            {{ !empty($quote_ref_three->rate_type) && $quote_ref_three->rate_type == 'live' ? 'Live Rate' : 'Manual Rate'}}
        </div>
    @endif
    @if(isset($quote_ref_four))
        <div class="col col-style">
            {{ !empty($quote_ref_four->rate_type) && $quote_ref_four->rate_type == 'live' ? 'Live Rate' : 'Manual Rate'}} 
        </div>
    @endif
</div>