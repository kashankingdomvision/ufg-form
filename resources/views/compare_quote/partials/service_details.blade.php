
<div class="card">
    <div class="card-header">
        <h3 class="card-title card-title-style">Service Details</h3>
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
                {{-- @if(isset($quote_ref_four))
                    <div class="col col-style font-weight-bold">
                        {{ !empty($quote_ref_four->quote_ref) ? $quote_ref_four->quote_ref : '-' }}
                    </div>
                @endif --}}
            </div>

            <div class="row border">
                <div class="col-md-2 col-style">Start Date </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_two->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_three->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_four->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->date_of_service }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-2 col-style">End Date of Service </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_two->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_three->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_four->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->end_date_of_service }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-2 col-style">
                    Number of Nights
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_two->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_three->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_four->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ $q_detail->number_of_nights }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="row mt-1 border">
                <div class="col-md-2 col-style">
                    Time of Service
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_two->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_three->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_four->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->time_of_service) ? $q_detail->time_of_service : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-2 col-style">
                    Category
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_two->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_three->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_four->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getCategory->name) ? $q_detail->getCategory->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-2 col-style">
                    Supplier
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_two->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_three->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_four->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplier->name) ? $q_detail->getSupplier->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-2 col-style">
                    Product
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_two->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_three->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_four->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getProduct->name) ? $q_detail->getProduct->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-2 col-style">
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
                            @foreach ($quote_ref_two->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_three->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_four->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getBookingType->name) ? $q_detail->getBookingType->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-2 col-style">
                    Supplier Currency 
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_two->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_three->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_four->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplierCurrency->name) ? $q_detail->getSupplierCurrency->code.' - '.$q_detail->getSupplierCurrency->name : '-' }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-1 border">
                <div class="col-md-2 col-style">
                    Estimated Cost
                </div>
                @if(isset($quote_ref_one))
                    <div class="col">
                        <div class="row flex-column">
                            @foreach ($quote_ref_one->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_two->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_three->getQuoteDetails()->get() as $key  => $q_detail )
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
                            @foreach ($quote_ref_four->getQuoteDetails()->get() as $key  => $q_detail )
                                <div class="col border col-style">
                                    {{ !empty($q_detail->getSupplierCurrency->name) ? $q_detail->getSupplierCurrency->code.' - '.$q_detail->getSupplierCurrency->name : '-' }}
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
