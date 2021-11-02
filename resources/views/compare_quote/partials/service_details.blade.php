
<div class="card">
    <div class="card-header">
        <h3 class="card-title card-title-style">Service Details</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-sm btn-outline-dark" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>

    @php
      $quote_ref_one_details   = isset($quote_ref_one) ? $quote_ref_one->getQuoteDetails()->get() : '';
      $quote_ref_two_details   = isset($quote_ref_two) ? $quote_ref_two->getQuoteDetails()->get() : '';
      $quote_ref_three_details = isset($quote_ref_three) ? $quote_ref_three->getQuoteDetails()->get() : '';
      $quote_ref_four_details  = isset($quote_ref_four) ? $quote_ref_four->getQuoteDetails()->get() : '';

    @endphp

    {{-- {{ dd($quote_ref_one_details) }} --}}

    <div class="card-body">
        @if(isset($quote_ref_one) || isset($quote_ref_two) || isset($quote_ref_three) || isset($quote_ref_four))
                    
            <div class="row">
                <div class="col-md-4 col-heading-style font-weight-bold"></div>

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
                <div class="col-md-4 col-heading-style font-weight-bold">Start Date </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->date_of_service }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->date_of_service }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->date_of_service }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->date_of_service }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">End Date of Service </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->end_date_of_service }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->end_date_of_service }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->end_date_of_service }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->end_date_of_service }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Number of Nights
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->number_of_nights }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->number_of_nights }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->number_of_nights }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->number_of_nights }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Time of Service
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->time_of_service) ? $q_detail->time_of_service : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->time_of_service) ? $q_detail->time_of_service : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->time_of_service) ? $q_detail->time_of_service : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->time_of_service) ? $q_detail->time_of_service : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Category
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getCategory->name) ? $q_detail->getCategory->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getCategory->name) ? $q_detail->getCategory->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getCategory->name) ? $q_detail->getCategory->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getCategory->name) ? $q_detail->getCategory->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Supplier
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplier->name) ? $q_detail->getSupplier->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplier->name) ? $q_detail->getSupplier->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplier->name) ? $q_detail->getSupplier->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplier->name) ? $q_detail->getSupplier->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Product
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getProduct->name) ? $q_detail->getProduct->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getProduct->name) ? $q_detail->getProduct->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getProduct->name) ? $q_detail->getProduct->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getProduct->name) ? $q_detail->getProduct->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Booking Types
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getBookingType->name) ? $q_detail->getBookingType->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getBookingType->name) ? $q_detail->getBookingType->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getBookingType->name) ? $q_detail->getBookingType->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getBookingType->name) ? $q_detail->getBookingType->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Supplier Currency 
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplierCurrency->name) ? $q_detail->getSupplierCurrency->code.' - '.$q_detail->getSupplierCurrency->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplierCurrency->name) ? $q_detail->getSupplierCurrency->code.' - '.$q_detail->getSupplierCurrency->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplierCurrency->name) ? $q_detail->getSupplierCurrency->code.' - '.$q_detail->getSupplierCurrency->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplierCurrency->name) ? $q_detail->getSupplierCurrency->code.' - '.$q_detail->getSupplierCurrency->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Estimated Cost
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->estimated_cost) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->estimated_cost) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->estimated_cost) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->estimated_cost) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Markup Amount
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_one->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->markup_amount) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_two->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->markup_amount) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_three->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->markup_amount) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_four->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->markup_amount) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Markup Percentage
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_one->markup_type == 'itemised') ? \Helper::number_format($q_detail->markup_percentage).' %' : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_two->markup_type == 'itemised') ? \Helper::number_format($q_detail->markup_percentage).' %' : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_three->markup_type == 'itemised') ? \Helper::number_format($q_detail->markup_percentage).' %' : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_four->markup_type == 'itemised') ? \Helper::number_format($q_detail->markup_percentage).' %' : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Selling Price
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_one->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->selling_price) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_two->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->selling_price) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_three->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->selling_price) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_four->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->selling_price) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Profit Percentage
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_one->markup_type == 'itemised') ? \Helper::number_format($q_detail->profit_percentage).' %' : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_two->markup_type == 'itemised') ? \Helper::number_format($q_detail->profit_percentage).' %' : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_three->markup_type == 'itemised') ? \Helper::number_format($q_detail->profit_percentage).' %' : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_four->markup_type == 'itemised') ? \Helper::number_format($q_detail->profit_percentage).' %' : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Estimated Cost in Booking Currency 
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->estimated_cost_bc) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->estimated_cost_bc) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->estimated_cost_bc) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->estimated_cost_bc) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Markup Amount in Booking Currency 
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_one->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->markup_amount_bc) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_two->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->markup_amount_bc) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_three->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->markup_amount_bc) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_four->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->markup_amount_bc) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Selling Price in Booking Currency
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_one->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->selling_price_bc) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_two->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->selling_price_bc) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_three->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->selling_price_bc) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ ($quote_ref_four->markup_type == 'itemised') ? $q_detail->getSupplierCurrency->code.' '.\Helper::number_format($q_detail->selling_price_bc) : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-4 col-heading-style font-weight-bold">
                    Comments
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->comments) ? $q_detail->comments : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_two))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_two_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->comments) ? $q_detail->comments : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_three))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_three_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->comments) ? $q_detail->comments : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($quote_ref_four))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_four_details as $key => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->comments) ? $q_detail->comments : '-' }}
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
