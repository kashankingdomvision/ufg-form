<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use App\Http\Helper;

class CustomerReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $data;
    public function __construct($data) {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = $this->data;
        if($data['selected_type'] == 'quote') {
            $keyed[] = [
                'Name' => 'Name',
                'Email' => 'Email',
                'Total Quotes' => 'Total Quotes',
                'Quote' => 'Quote',
                'Cancelled Quote' => 'Cancelled Quote'
            ];
            foreach($data['customers_quote'] as $customer_quote) {
                $keyed[] = [
                    'Name' => $customer_quote->lead_passenger_name,
                    'Email' => $customer_quote->lead_passenger_email,
                    'Total Quotes' => $customer_quote->total_quotes != 0 ? $customer_quote->total_quotes : '0',
                    'Quote' => Helper::getTotalQuote($customer_quote->lead_passenger_email) != 0 ? Helper::getTotalQuote($customer_quote->lead_passenger_email) : '0',
                    'Cancelled Quote' => Helper::getTotalCancelledQuote($customer_quote->lead_passenger_email) != 0 ? Helper::getTotalCancelledQuote($customer_quote->lead_passenger_email) : '0' 
                ];
            }
        } else if($data['selected_type'] == 'booking') {
            $keyed[] = [
                'Name' => 'Name',
                'Email' => 'Email',
                'Total Bookings' => 'Total Bookings',
                'Booking' => 'Bookings',
                'Cancelled Booking' => 'Cancelled Booking'
            ];
            foreach($data['customers_quote'] as $customer_quote) {
                $keyed[] = [
                    'Name' => $customer_quote->lead_passenger_name,
                    'Email' => $customer_quote->lead_passenger_email,
                    'Total Bookings' => Helper::getTotalBooking($customer_quote->lead_passenger_email) != 0 ? Helper::getTotalBooking($customer_quote->lead_passenger_email) : '0',
                    'Booking' => Helper::getTotalConfirmBooking($customer_quote->lead_passenger_email) != 0 ? Helper::getTotalConfirmBooking($customer_quote->lead_passenger_email) : '0',
                    'Cancelled Booking' => Helper::getTotalCancelledBooking($customer_quote->lead_passenger_email) != 0 ? Helper::getTotalCancelledBooking($customer_quote->lead_passenger_email) : '0' 
                ];
            }
        } else {
            $keyed[] = [
                'Name' => 'Name',
                'Email' => 'Email',
                'Total Quotes' => 'Total Quotes',
                'Quote' => 'Quote',
                'Cancelled Quote' => 'Cancelled Quote',
                'Total Bookings' => 'Total Bookings',
                'Confirmed Booking' => 'Confirmed Booking',
                'Cancelled Booking' => 'Cancelled Booking'
            ];
            foreach($data['customers_quote'] as $customer_quote) {
                $keyed[] = [
                    'Name' => $customer_quote->lead_passenger_name,
                    'Email' => $customer_quote->lead_passenger_email,
                    'Total Quotes' => $customer_quote->total_quotes != 0 ? $customer_quote->total_quotes : '0',
                    'Quote' => Helper::getTotalQuote($customer_quote->lead_passenger_email) != 0 ? Helper::getTotalQuote($customer_quote->lead_passenger_email) : '0',
                    'Cancelled Quote' => Helper::getTotalCancelledQuote($customer_quote->lead_passenger_email) != 0 ? Helper::getTotalCancelledQuote($customer_quote->lead_passenger_email) : '0',
                    'Total Bookings' => Helper::getTotalBooking($customer_quote->lead_passenger_email) != 0 ? Helper::getTotalBooking($customer_quote->lead_passenger_email) : '0',
                    'Booking' => Helper::getTotalConfirmBooking($customer_quote->lead_passenger_email) != 0 ? Helper::getTotalConfirmBooking($customer_quote->lead_passenger_email) : '0',
                    'Cancelled Booking' => Helper::getTotalCancelledBooking($customer_quote->lead_passenger_email) != 0 ? Helper::getTotalCancelledBooking($customer_quote->lead_passenger_email) : '0' 
                ];
            }
        }
        return new collection($keyed);
    }

    public function headings(): array
    {
        return [];
    }

    public function registerEvents(): array
    {
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

        return
        [
            AfterSheet::class => function(AfterSheet $event) use ($bold, $align_center)
            {
                /* Columns -- A1 TO H1 -- BOLD & ALIGN CENTER  */
                $event->getSheet()->getDelegate()->getStyle('A1:H1')->applyFromArray($bold);
                $event->getSheet()->getDelegate()->getStyle('A1:H1')->applyFromArray($align_center);
            },
        ];
    }
}
