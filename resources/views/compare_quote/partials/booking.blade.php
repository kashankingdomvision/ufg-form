
<div class="card">
    <div class="card-header">
        <h3 class="card-title card-title-style">Booking Information</h3>
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
                <div class="col-md-2 col-heading-style font-weight-bold">Quote Title</div>

                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->booking_details) ? $quote_ref_one->booking_details : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->booking_details) ? $quote_ref_two->booking_details : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->booking_details) ? $quote_ref_three->booking_details : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->booking_details) ? $quote_ref_four->booking_details : '-' }}
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

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Zoho Reference</div>
                
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->ref_no) ? $quote_ref_one->ref_no : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->ref_no) ? $quote_ref_two->ref_no : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->ref_no) ? $quote_ref_three->ref_no : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->ref_no) ? $quote_ref_four->ref_no : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Quote Reference </div>

                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->quote_ref) ? $quote_ref_one->quote_ref : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->quote_ref) ? $quote_ref_two->quote_ref : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->quote_ref) ? $quote_ref_three->quote_ref : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->quote_ref) ? $quote_ref_four->quote_ref : '-' }}
                    </div>
                @endif
                
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">TAS Reference</div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->tas_ref) ? $quote_ref_one->tas_ref : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->tas_ref) ? $quote_ref_two->tas_ref : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->tas_ref) ? $quote_ref_three->tas_ref : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->tas_ref) ? $quote_ref_four->tas_ref : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Markup Type</div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->markup_type) && $quote_ref_one->markup_type == 'itemised' ? 'Itemised Markup' : 'Whole Markup' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->markup_type) && $quote_ref_two->markup_type == 'itemised' ? 'Itemised Markup' : 'Whole Markup' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->markup_type) && $quote_ref_three->markup_type == 'itemised' ? 'Itemised Markup' : 'Whole Markup' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->markup_type) && $quote_ref_four->markup_type == 'itemised' ? 'Itemised Markup' : 'Whole Markup' }} 
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Sales Person</div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->getSalePerson->name) ? $quote_ref_one->getSalePerson->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->getSalePerson->name) ? $quote_ref_two->getSalePerson->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->getSalePerson->name) ? $quote_ref_three->getSalePerson->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->getSalePerson->name) ? $quote_ref_four->getSalePerson->name : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Brand </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->getBrand->name) ? $quote_ref_one->getBrand->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->getBrand->name) ? $quote_ref_two->getBrand->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->getBrand->name) ? $quote_ref_three->getBrand->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->getBrand->name) ? $quote_ref_four->getBrand->name : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Type Of Holiday </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->getHolidayType->name) ? $quote_ref_one->getHolidayType->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->getHolidayType->name) ? $quote_ref_two->getHolidayType->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->getHolidayType->name) ? $quote_ref_three->getHolidayType->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->getHolidayType->name) ? $quote_ref_four->getHolidayType->name : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Booking Season </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->getSeason->name) ? $quote_ref_one->getSeason->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->getSeason->name) ? $quote_ref_two->getSeason->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->getSeason->name) ? $quote_ref_three->getSeason->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->getSeason->name) ? $quote_ref_four->getSeason->name : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Booking Currency </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->getCurrency->name) ? $quote_ref_one->getCurrency->code.' - '.$quote_ref_one->getCurrency->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->getCurrency->name) ? $quote_ref_two->getCurrency->code.' - '.$quote_ref_two->getCurrency->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->getCurrency->name) ? $quote_ref_three->getCurrency->code.' - '.$quote_ref_three->getCurrency->name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->getCurrency->name) ? $quote_ref_four->getCurrency->code.' - '.$quote_ref_four->getCurrency->name : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Agency Booking</div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->agency) && ($quote_ref_one->agency == 1) ? 'Yes' : 'No' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->agency) && ($quote_ref_two->agency == 1) ? 'Yes' : 'No' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->agency) && ($quote_ref_three->agency == 1) ? 'Yes' : 'No' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->agency) && ($quote_ref_four->agency == 1) ? 'Yes' : 'No' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Pax No.</div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->pax_no) ? $quote_ref_one->pax_no : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->pax_no) ? $quote_ref_two->pax_no  : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->pax_no) ? $quote_ref_three->pax_no : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->pax_no) ? $quote_ref_four->pax_no : '-' }}
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
