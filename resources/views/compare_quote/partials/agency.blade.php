
<div class="card">
    <div class="card-header">
        <h3 class="card-title card-title-style">Agency Information</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-outline-dark  compare-collapse-expand-btn" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
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
                <div class="col-md-2 col-heading-style font-weight-bold">Agency Name</div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->agency_name) ? $quote_ref_one->agency_name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->agency_name) ? $quote_ref_two->agency_name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->agency_name) ? $quote_ref_three->agency_name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->agency_name) ? $quote_ref_four->agency_name : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">Agency Contact Name</div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->agency_contact_name) ? $quote_ref_one->agency_contact_name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->agency_contact_name) ? $quote_ref_two->agency_contact_name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->agency_contact_name) ? $quote_ref_three->agency_contact_name : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->agency_contact_name) ? $quote_ref_four->agency_contact_name : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Agency Contact No.
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->agency_contact) ? $quote_ref_one->agency_contact : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->agency_contact) ? $quote_ref_two->agency_contact : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->agency_contact) ? $quote_ref_three->agency_contact : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->agency_contact) ? $quote_ref_four->agency_contact : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-2 col-heading-style font-weight-bold">
                    Agency Email
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->agency_email) ? $quote_ref_one->agency_email : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->agency_email) ? $quote_ref_two->agency_email : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->agency_email) ? $quote_ref_three->agency_email : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->agency_email) ? $quote_ref_four->agency_email : '-' }}
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
