
<div class="card ">
    {{-- collapsed-card --}}
    <div class="card-header">
        <h3 class="card-title card-title-style">
            Total Calculations
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-outline-dark compare-collapse-expand-btn" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>

    <div class="card-body">
        @if(isset($quote_ref_one) || isset($quote_ref_two) || isset($quote_ref_three) || isset($quote_ref_four))
                    
            <div class="row">
                <div class="col-md-3 col-style"></div>

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
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Total Net Price
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->getCurrency->code) ? $quote_ref_one->getCurrency->code.' '.\Helper::number_format($quote_ref_one->net_price) : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->getCurrency->code) ? $quote_ref_two->getCurrency->code.' '.\Helper::number_format($quote_ref_two->net_price) : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->getCurrency->code) ? $quote_ref_three->getCurrency->code.' '.\Helper::number_format($quote_ref_three->net_price) : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->getCurrency->code) ? $quote_ref_four->getCurrency->code.' '.\Helper::number_format($quote_ref_four->net_price) : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Total Markup Amount (Gross Margin)
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->getCurrency->code) ? $quote_ref_one->getCurrency->code.' '.\Helper::number_format($quote_ref_one->markup_amount) : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->getCurrency->code) ? $quote_ref_two->getCurrency->code.' '.\Helper::number_format($quote_ref_two->markup_amount) : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->getCurrency->code) ? $quote_ref_three->getCurrency->code.' '.\Helper::number_format($quote_ref_three->markup_amount) : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->getCurrency->code) ? $quote_ref_four->getCurrency->code.' '.\Helper::number_format($quote_ref_four->markup_amount) : '-' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Total Markup Percentage (Gross Margin)
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ \Helper::number_format($quote_ref_one->markup_percentage).' %' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ \Helper::number_format($quote_ref_two->markup_percentage).' %' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ \Helper::number_format($quote_ref_three->markup_percentage).' %' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ \Helper::number_format($quote_ref_four->markup_percentage).' %' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Total Profit Percentage
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ \Helper::number_format($quote_ref_one->profit_percentage).' %' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ \Helper::number_format($quote_ref_two->profit_percentage).' %' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ \Helper::number_format($quote_ref_three->profit_percentage).' %' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ \Helper::number_format($quote_ref_four->profit_percentage).' %' }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-3 col-heading-style font-weight-bold">
                    Booking Amount Per Person
                </div>
                @if(isset($quote_ref_one))
                    <div class="col col-style">
                        {{ !empty($quote_ref_one->getCurrency->code) ? $quote_ref_one->getCurrency->code.' '.\Helper::number_format($quote_ref_one->amount_per_person) : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_two))
                    <div class="col col-style">
                        {{ !empty($quote_ref_two->getCurrency->code) ? $quote_ref_two->getCurrency->code.' '.\Helper::number_format($quote_ref_two->amount_per_person) : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_three))
                    <div class="col col-style">
                        {{ !empty($quote_ref_three->getCurrency->code) ? $quote_ref_three->getCurrency->code.' '.\Helper::number_format($quote_ref_three->amount_per_person) : '-' }}
                    </div>
                @endif
                @if(isset($quote_ref_four))
                    <div class="col col-style">
                        {{ !empty($quote_ref_four->getCurrency->code) ? $quote_ref_four->getCurrency->code.' '.\Helper::number_format($quote_ref_four->amount_per_person) : '-' }}
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
