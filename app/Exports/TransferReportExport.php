<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TransferReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    private $data;
    public function __construct($data) {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = $this->data;

        $keyed[] = [
            'Zoho Reference'            => 'Zoho Reference',
            'Quote Ref #'               => 'Quote Ref #',
            'Season'                    => 'Season',
            'Lead Passenger Name'       => 'Lead Passenger Name',
            'Pax No.'                   => 'Pax No.',
            'Start Date of Service'     => 'Start Date of Service',
            'End Date of Service'       => 'End Date of Service',
            'Number of Nights'          => 'Number of Nights',
            'Time of Service'           => 'Time of Service',
            'Category'                  => 'Category',
            'Supplier Location'         => 'Supplier Location',
            'Supplier'                  => 'Supplier',
            'Product'                   => 'Product', 
            'Payment Type'              => 'Payment Type', 
            'Supplier Currency'         => 'Supplier Currency', 
            'Estimated Cost'            => 'Estimated Cost', 
            'Actual Cost'               => 'Actual Cost', 
            'Markup Amount'             => 'Markup Amount', 
            'Markup %'                  => 'Markup %', 
            'Selling Price'             => 'Selling Price', 
            'Profit %'                  => 'Profit %', 
            'Service Details'           => 'Service Details', 
            'Internal Comments'         => 'Internal Comments', 
            'Status'                    => 'Status',
        ];

        // for skipping one line
        // $keyed[] = [' ' => ' '];

        foreach($data['booking_details'] as $booking_detail) {
            
            $keyed[] = [

                'Zoho Reference'            => isset($booking_detail->getBooking->ref_no) ? $booking_detail->getBooking->ref_no : '---',
                'Quote Ref #'               => isset($booking_detail->getBooking->quote_ref) ? $booking_detail->getBooking->quote_ref : '---',
                'Season'                    => $booking_detail->getBooking->getSeason->name,
                'Lead Passenger Name'       => isset($booking_detail->getBooking->lead_passenger_name) ? $booking_detail->getBooking->lead_passenger_name : '---',
                'Pax No.'                   => $booking_detail->getBooking->pax_no,
                'Start Date of Service'     => $booking_detail->date_of_service,
                'End Date of Service'       => $booking_detail->end_date_of_service,
                'Number of Nights'          => (string) $booking_detail->number_of_nights,
                'Time of Service'           => $booking_detail->time_of_service,
                'Category'                  => $booking_detail->getCategory->name,
                'Supplier Location'         => isset($booking_detail->getSupplierLocation->name) ? $booking_detail->getSupplierLocation->name : '---',
                'Supplier'                  => $booking_detail->getSupplier->name,
                'Product'                   => $booking_detail->getProduct->name, 
                'Payment Type'              => isset($booking_detail->getBookingType->name) ? $booking_detail->getBookingType->name : '---',
                'Supplier Currency'         => isset($booking_detail->getSupplierCurrency->name) ? $booking_detail->getSupplierCurrency->name : '---',
                'Estimated Cost'            => \Helper::number_format($booking_detail->estimated_cost).' '.$booking_detail->getSupplierCurrency->code,
                'Actual Cost'               => \Helper::number_format($booking_detail->actual_cost).' '.$booking_detail->getSupplierCurrency->code, 
                'Markup Amount'             => \Helper::number_format($booking_detail->markup_amount).' '.$booking_detail->getSupplierCurrency->code, 
                'Markup %'                  => \Helper::number_format($booking_detail->markup_percentage).' %', 
                'Selling Price'             => \Helper::number_format($booking_detail->selling_price).' '.$booking_detail->getSupplierCurrency->code, 
                'Profit %'                  => \Helper::number_format($booking_detail->profit_percentage).' %', 
                'Service Details'           => $booking_detail->service_details , 
                'Internal Comments'         => $booking_detail->comments , 
                'Status'                    => $booking_detail->status == 'active' ? 'Booked' : 'Cancelled',
            ];
        }

        return new collection($keyed);
    }

    public function headings(): array {
        return [];
    }

    public function registerEvents(): array {
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
                /* Columns -- A1 TO Z1 -- BOLD & ALIGN CENTER  */
                $event->getSheet()->getDelegate()->getStyle('A1:Z1')->applyFromArray($bold);
                // $event->getSheet()->getDelegate()->getStyle('A1:Z1')->applyFromArray($align_center);
            },
        ];
    }
}
