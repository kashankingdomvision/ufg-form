<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class QuoteExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $data = $this->data;
        $quote = $data['quote'];

        if($data['quote']->agency > 0) {
            $keyed[] = [
                'Agency Name' => 'Agency Name',
                'Agency Contact Name' => 'Agency Contact Name',
                'Agency Contact No' => 'Agency Contact No#',
                'Agency Email' => 'Agency Email'
            ];
            $keyed[] = [
                'Agency Name' => isset($quote->agency_name) && !empty($quote->agency_name) ? $quote->agency_name : '---',
                'Agency Contact Name' => isset($quote->agency_contact_name) && !empty($quote->agency_contact_name) ? $quote->agency_contact_name : '---',
                'Agency Contact No' => isset($quote->agency_contact) && !empty($quote->agency_contact) ? ' '.$quote->agency_contact.' ' : '---' ,
                'Agency Email' => isset($quote->agency_email) && !empty($quote->agency_email) ? $quote->agency_email : '---'
            ];

            // for skipping two lines
            $keyed[] = [' ' => ' '];
            $keyed[] = [' ' => ' '];
        }

        // pax details header
        $keyed[] = [
            'PASSENGER NAME' => 'PASSENGER NAME',
            'EMAIL ADDRESS' => 'EMAIL ADDRESS',
            'CONTACT NUMBER' => 'CONTACT NUMBER',
            'DATE OF BIRTH' => 'DATE OF BIRTH',
            'NATIONALITY' => 'NATIONALITY',
            'BEDDING PREFERENCES' => 'BEDDING PREFERENCES',
            'DINNING PREFERENCES' => 'DINNING PREFERENCES',
            'COVID VACCINATED' => 'COVID VACCINATED',
        ];

        if($data['quote']->agency == 0) {
            $keyed[] = [
                'PASSENGER NAME'      => isset($quote->lead_passenger_name) && !empty($quote->lead_passenger_name) ? $quote->lead_passenger_name. ' (Lead)' : '---',
                'EMAIL ADDRESS'       => isset($quote->lead_passenger_email) && !empty($quote->lead_passenger_email) ? $quote->lead_passenger_email : '---',
                'CONTACT NUMBER'      => isset($quote->lead_passenger_contact) && !empty($quote->lead_passenger_contact) ? ' '.$quote->lead_passenger_contact.' ' : '---' ,
                'DATE OF BIRTH'       => isset($quote->lead_passenger_dbo) && !empty($quote->lead_passenger_dbo) ? $quote->lead_passenger_dbo : '---',
                'NATIONALITY'         => isset($quote->getNationality->name) && !empty($quote->getNationality->name) ? $quote->getNationality->name : '---',
                'BEDDING PREFERENCES' => isset($quote->lead_passenger_bedding_preference) && !empty($quote->lead_passenger_bedding_preference) ? $quote->lead_passenger_bedding_preference : '---',
                'DINNING PREFERENCES' => isset($quote->lead_passenger_dinning_preference) && !empty($quote->lead_passenger_dinning_preference) ? $quote->lead_passenger_dinning_preference : '---',
                'COVID VACCINATED'    => $quote->lead_passenger_covid_vaccinated == 1 ? 'Yes' : 'No',
            ];
        }

        if(count($data['quote']->getPaxDetail) > 0) {
            foreach($data['quote']->getPaxDetail as $paxDetails) {
                $keyed[] = [
                    'PASSENGER NAME'      => isset($paxDetails->full_name) && !empty($paxDetails->full_name) ? $paxDetails->full_name : '---',
                    'EMAIL ADDRESS'       => isset($paxDetails->email) && !empty($paxDetails->email) ? $paxDetails->email : '---',
                    'CONTACT NUMBER'      => isset($paxDetails->contact) && !empty($paxDetails->contact) ? ' '.$paxDetails->contact.' ' : '---',
                    'DATE OF BIRTH'       => isset($paxDetails->date_of_birth) && ($paxDetails->date_of_birth) ? $paxDetails->date_of_birth : '---',
                    'NATIONALITY'         => isset($paxDetails->getPassengerNationality->name) && !empty($paxDetails->getPassengerNationality->name) ? $paxDetails->getPassengerNationality->name : '---' ,
                    'BEDDING PREFERENCES' => isset($paxDetails->bedding_preference) && !empty($paxDetails->bedding_preference) ? $paxDetails->bedding_preference : '---',
                    'DINNING PREFERENCES' => isset($paxDetails->dinning_preference) && !empty($paxDetails->dinning_preference) ? $paxDetails->dinning_preference : '---',
                    'COVID VACCINATED'    => $paxDetails->covid_vaccinated == 1 ? 'Yes' : 'No',
                ];
            }
        }

        if(count($data['quote']->getQuoteDetails) > 0) {
            // for skipping two lines
            $keyed[] = [' ' => ' '];
            $keyed[] = [' ' => ' '];

            // for creating header of services form
            $keyed[] = [
                'Start Date of Service' => 'START DATE OF SERVICE',
                'End Date of Service' => 'END DATE OF SERVICE',
                'Time of Service' => 'TIME OF SERVICE',
                'Category' => 'CATEGORY',
                'Supplier' => 'SUPPLIER',
                'Product' => 'PRODUCT',
                'Supervisor' => 'SUPERVISOR',
                'Booking Date' => 'BOOKING DATE',
                'Booking Due Date' => 'BOOKING DUE DATE',
                'Booking Reference' => 'BOOKING REFERENCE',
                'Booking Method' => 'BOOKING METHOD',
                'Booked By' => 'BOOKING BY',
                'Booking Type' => 'BOOKING TYPES',
                'Supplier Currency' => 'SUPPLIER CURRENCY',
                'Estimated Cost' => 'ESTIMATED COST',
                'Markup Amount' => 'MARKUP AMOUNT',
                'Markup %' => 'MARKUP %',
                'Selling Price' => 'SELLING PRICE',
                'Profit %' => 'PROFIT %',
                'Estimated Cost in Booking Currency' => 'ESTIMATED COST IN BOOKING CURRENCY',
                'Markup Amount in Booking Currency' => 'MARKUP AMOUNT IN BOOKING CURRENCY',
                'Selling Price in Booking Currency' => 'SELLING PRICE IN BOOKING CURRENCY',
                'Added in Sage' => 'ADDED IN SAGE',
            ];

            foreach($data['quote']->getQuoteDetails as $quoteDetails) {
                $keyed[] = [
                    'Start Date of Service'              => $quoteDetails->date_of_service ? $quoteDetails->date_of_service : '---',
                    'End Date of Service'                => $quoteDetails->end_date_of_service ? $quoteDetails->end_date_of_service : '---',
                    'Time of Service'                    => $quoteDetails->time_of_service ? $quoteDetails->time_of_service : '---',
                    'Category'                           => isset($quoteDetails->getCategory->name) && !empty($quoteDetails->getCategory->name) ? $quoteDetails->getCategory->name : '---',
                    'Supplier'                           => isset($quoteDetails->getSupplier->name) && !empty($quoteDetails->getSupplier->name) ? $quoteDetails->getSupplier->name : '---' ,
                    'Product'                            => $quoteDetails->product_id ? $quoteDetails->product_id : '---',
                    'Supervisor'                         => isset($quoteDetails->getSupervisor->name) && !empty($quoteDetails->getSupervisor->name) ? $quoteDetails->getSupervisor->name : '---' ,
                    'Booking Date'                       => $quoteDetails->booking_date ? $quoteDetails->booking_date : '---',
                    'Booking Due Date'                   => $quoteDetails->booking_due_date ? $quoteDetails->booking_due_date : '---',
                    'Booking Reference'                  => $quoteDetails->booking_reference ? $quoteDetails->booking_reference : '---',
                    'Booking Method'                     => isset($quoteDetails->getBookingMethod->name) && !empty($quoteDetails->getBookingMethod->name) ? $quoteDetails->getBookingMethod->name : '---',
                    'Booked By'                          => isset($quoteDetails->getBookingBy->name) && !empty($quoteDetails->getBookingBy->name) ? $quoteDetails->getBookingBy->name : '---',
                    'Booking Type'                       => isset($quoteDetails->getBookingType->name) && !empty($quoteDetails->getBookingType->name) ? $quoteDetails->getBookingType->name : '---',
                    'Supplier Currency'                  => isset($quoteDetails->getSupplierCurrency->code) && !empty($quoteDetails->getSupplierCurrency->code) ? $quoteDetails->getSupplierCurrency->code.' - '.$quoteDetails->getSupplierCurrency->name : '---',
                    'Estimated Cost'                     => isset($quoteDetails->getSupplierCurrency->code) && isset($quoteDetails->estimated_cost) && !empty($quoteDetails->getSupplierCurrency->code) && !empty($quoteDetails->estimated_cost) ? $quoteDetails->getSupplierCurrency->code.' '.$quoteDetails->estimated_cost : '---',
                    'Markup Amount'                      => isset($quoteDetails->getSupplierCurrency->code) && isset($quoteDetails->estimated_cost) && !empty($quoteDetails->getSupplierCurrency->code) && !empty($quoteDetails->markup_amount) ? $quoteDetails->getSupplierCurrency->code.' '.$quoteDetails->markup_amount : '---',
                    'Markup %'                           => $quoteDetails->markup_percentage.' %' ? $quoteDetails->markup_percentage.' %' : '---',
                    'Selling Price'                      => isset($quoteDetails->getSupplierCurrency->code) && isset($quoteDetails->selling_price) && !empty($quoteDetails->getSupplierCurrency->code) && !empty($quoteDetails->selling_price) ? $quoteDetails->getSupplierCurrency->code.' '.$quoteDetails->selling_price : '---',
                    'Profit %'                           => $quoteDetails->profit_percentage.' %' ? $quoteDetails->profit_percentage.' %' : '---',
                    'Estimated Cost in Booking Currency' => isset($data['quote']->getCurrency->code) && isset($quoteDetails->estimated_cost_bc) && !empty($data['quote']->getCurrency->code) && !empty($quoteDetails->estimated_cost_bc) ? $data['quote']->getCurrency->code.' '.$quoteDetails->estimated_cost_bc : '---',
                    'Markup Amount in Booking Currency ' => isset($data['quote']->getCurrency->code) && isset($quoteDetails->selling_price_in_booking_currency) && !empty($data['quote']->getCurrency->code) && !empty($quoteDetails->selling_price_in_booking_currency) ? $data['quote']->getCurrency->code.' '.$quoteDetails->selling_price_in_booking_currency : '---',
                    'Selling Price in Booking Currency'  => isset($data['quote']->getCurrency->code) && isset($quoteDetails->markup_amount_in_booking_currency) && !empty($data['quote']->getCurrency->code) && !empty($quoteDetails->markup_amount_in_booking_currency) ? $data['quote']->getCurrency->code.' '.$quoteDetails->markup_amount_in_booking_currency : '---',
                    'Added in Sage'                      => $quoteDetails->added_in_sage == 1 ? 'Yes' : 'NO',
                ];
            }
        }

        // for skipping two lines
        $keyed[] = [' ' => ' '];
        $keyed[] = [' ' => ' '];

        // for total calculation
        $keyed[] = [
            'Total Net Price' => 'TOTAL NET PRICE:',
            'Total Net Price Value' => $data['quote']->getCurrency->code.' '.$data['quote']->net_price ? $data['quote']->getCurrency->code.' '.$data['quote']->net_price : '---',
        ];
        $keyed[] = [
            'Total Markup Amount' => 'TOTAL MARKUP AMOUNT:',
            'Total Markup Amount Value' => $data['quote']->getCurrency->code.' '.$data['quote']->markup_amount ? $data['quote']->getCurrency->code.' '.$data['quote']->markup_amount : '---',
        ];
        $keyed[] = [
            'Total Markup Amount Percent' => 'TOTAL MARKUP AMOUNT PERCENT:',
            'Total Markup Amount Percent Value' => $data['quote']->getCurrency->code.' '.$data['quote']->markup_percentage. ' %' ? $data['quote']->getCurrency->code.' '.$data['quote']->markup_percentage. ' %' : '---',
        ];
        $keyed[] = [
            'Total Selling Price' => 'TOTAL SELLING PRICE:',
            'Total Selling Price Value' => $data['quote']->getCurrency->code.' '.$data['quote']->selling_price ? $data['quote']->getCurrency->code.' '.$data['quote']->selling_price : '---',
        ];
        $keyed[] = [
            'Total Profit Percentage' => 'TOTAL PROFIT PERCENTAGE:',
            'Total Profit Percentage Value' => $data['quote']->getCurrency->code.' '.$data['quote']->profit_percentage. ' %' ? $data['quote']->getCurrency->code.' '.$data['quote']->profit_percentage. ' %' : '---',
        ];
        $keyed[] = [
            'Staff Commission' => 'STAFF COMMISSION:',
            'Staff Commission Value' => $data['quote']->getCurrency->code.' '.$data['quote']->commission_amount ? $data['quote']->getCurrency->code.' '.$data['quote']->commission_amount : '---',
        ];
        $keyed[] = [
            'Booking Amount Per Person' => 'BOOKING AMOUNT PER PERSON:',
            'Booking Amount Per Person Value' => $data['quote']->getCurrency->code.' '.$data['quote']->amount_per_person ? $data['quote']->getCurrency->code.' '.$data['quote']->amount_per_person : '---',
        ];
        $keyed[] = [
            'Selling Price in Other Currency' => 'SELLING PRICE IN OTHER CURRENCY:',
            'Selling Price in Other Currency Value' => isset($data['quote']->selling_price_ocr) && !empty($data['quote']->selling_price_ocr) ? $data['quote']->selling_currency_oc. ' '. $data['quote']->selling_price_ocr : '---',
        ];

        return new Collection($keyed);
    }

    public function headings(): array
    {
        $data = $this->data;
        $quote = $data['quote'];

        return [
                    [
                        'ZOHO REFERENCE:',''.$quote->ref_no ? $quote->ref_no : '---',
                        '', // blank array for skip one column
                        'QUOTE REFERENCE:',''.$quote->quote_ref ? $quote->quote_ref : '---'
                    ],
                    [
                        'TAS REFERENCE:',''.$quote->tas_ref ? $quote->tas_ref : '---',
                        '', // blank array for skip one column
                        'CURRENCY RATE TYPE:', isset($quote->rate_type) && ($quote->rate_type == 'live') ? 'Live Rate' : 'Manual Rate'
                    ],
                    [
                        'SALES PERSON:',''.$data['quote']->getSalePerson->name ? $data['quote']->getSalePerson->name : '---',
                        '', // blank array for skip one column
                        'COMMISSION TYPE:',''.$data['quote']->getCommission->name ? $data['quote']->getCommission->name.' ('.$data['quote']->getCommission->percentage.' %)' : '---'
                    ],
                    [
                        'BRAND:',''.$data['quote']->getBrand->name ? $data['quote']->getBrand->name : '---',
                        '', // blank array for skip one column
                        'TYPE OF HOLIDAY:',''.$data['quote']->getHolidayType->name ? $data['quote']->getHolidayType->name : '---'
                    ],
                    [
                        'BOOKING SEASON:',''.$data['quote']->getSeason->name ? $data['quote']->getSeason->name : '---',
                        '', // blank array for skip one column
                        'BOOKING CURRENCY:', ''.$data['quote']->getCurrency->name ? $data['quote']->getCurrency->code.' - '.$data['quote']->getCurrency->name : '---'
                    ],
                    [
                        'AGENCY BOOKING:',''.$quote->agency == 0 ? 'No' : 'Yes',
                        '', // blank array for skip one column
                        'TOTAL PAX NO#:',''.$data['quote']->pax_no ? $data['quote']->pax_no : '---'
                    ],

                    [' '], // blank array for skip one line
                    [' '], // blank array for skip one line

                    /*[
                        'PASSENGER NAME',
                        'EMAIL ADDRESS',
                        'CONTACT NUMBER',
                        'DATE OF BIRTH',
                        'NATIONALITY',
                        'BEDDING PREFERENCES',
                        'DINNING PREFERENCES',
                        'COVID VACCINATED',
                    ],*/
                ];
    }

    public function registerEvents(): array
    {

        $bold_align_left = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
            'font' => [
                 'bold' => true,
            ]

        ];

        $align_center = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $bold = [
            'font' => [
                 'bold' => true,
            ]
        ];

        $data = $this->data;
        $totalPax = count($data['quote']->getPaxDetail);
        $totalService = count($data['quote']->getQuoteDetails);

        $forAgency = 0;
        $forService = null;
        $forFinalTotal = null;
        if($data['quote']->agency != 0) {
            $forAgency = 1;
            if($totalPax > 0) {
                $forService = 16 + $totalPax;
                if($totalService > 1) {
                    $forFinalTotal = $forService + $totalService + 2;
                } else {
                    $forFinalTotal = $forService + 2;
                }
            }
        } else {
            if($totalPax > 0) {
                $forService = 13 + $totalPax;
                if($totalService > 1) {
                    $forFinalTotal = $forService + $totalService + 2;
                } else {
                    $forFinalTotal = $forService + 2;
                }
            } else {
                $forService = 13;
                if($totalService > 1) {
                    $forFinalTotal = $forService + $totalService + 2;
                } else {
                    $forFinalTotal = $forService + 2;
                }
            }
        }



        return
        [
            AfterSheet::class => function(AfterSheet $event) use ($bold_align_left, $align_center, $bold, $forAgency, $forService, $forFinalTotal)
            {
                /* Columns -- A1 TO A6 & D1 TO D6 -- BOLD AND ALIGN LEFT */
                $event->getSheet()->getDelegate()->getStyle('A1:A6')->applyFromArray($bold_align_left);
                $event->getSheet()->getDelegate()->getStyle('D1:D6')->applyFromArray($bold_align_left);

                /* Columns -- B1 TO B40 & E1 TO E40 -- ALIGN CENTER  */
                $event->getSheet()->getDelegate()->getStyle('B1:B40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('C2:C40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('D9:D40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('E1:E40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('F2:F40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('G2:G40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('H1:H40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('I1:I40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('J1:J40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('K1:K40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('L1:L40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('M1:M40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('N1:N40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('O1:O40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('P1:P40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('Q1:Q40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('R1:R40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('S1:S40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('T1:T40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('U1:U40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('V1:V40')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('W1:W40')->applyFromArray($align_center);

                /* Columns -- A9 TO A16, W9 TO W16 -- ALIGN CENTER  */
                $event->getSheet()->getDelegate()->getStyle('A9:W9')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('A10:W10')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('A11:W11')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('A12:W12')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('A13:W13')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('A14:W14')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('A15:W15')->applyFromArray($align_center);
                $event->getSheet()->getDelegate()->getStyle('A16:W16')->applyFromArray($align_center);

                /* Columns -- For Agency And Pax -- BOLD  */
                if($forAgency != 0) {
                    $event->getSheet()->getDelegate()->getStyle('A9:H9')->applyFromArray($bold);
                    $event->getSheet()->getDelegate()->getStyle('A13:H13')->applyFromArray($bold);
                }
                else {
                    $event->getSheet()->getDelegate()->getStyle('A9:H9')->applyFromArray($bold);
                }

                $event->getSheet()->getDelegate()->getStyle('A'.$forService.':W'.$forService)->applyFromArray($bold);
                $event->getSheet()->getDelegate()->getStyle('A'.$forFinalTotal.':A100')->applyFromArray($bold);

                /* FOR ALIGN CENTER */
                $max = $forFinalTotal - 1;
                $event->getSheet()->getDelegate()->getStyle('A9:A'.$max)->applyFromArray($align_center);
            },
        ];
    }
}
