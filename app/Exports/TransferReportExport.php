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
            'Booking Ref #' => 'Booking Ref #',
            'Season' => 'Season',
            'Start Date of Service' => 'Start Date of Service',
            'End Date of Service' => 'End Date of Service',
            'Time of Service' => 'Time of Service',
            'Supplier' => 'Supplier',
            'Lead Passenger Name' => 'Lead Passenger Name',
            'Pax No.' => 'Pax No.',
            'Category' => 'Category',
            'Product' => 'Product', 
            'Status' => 'Status',
        ];

        foreach($data['booking_details'] as $booking_detail) {
            $keyed[] = [
                'Booking Ref #' => isset($booking_detail->getBooking->quote_ref) ? $booking_detail->getBooking->quote_ref : '---',
                'Season' => $booking_detail->getBooking->getSeason->name,
                'Start Date of Service' => $booking_detail->date_of_service,
                'End Date of Service' => $booking_detail->end_date_of_service,
                'Time of Service' => $booking_detail->time_of_service,
                'Supplier' => $booking_detail->getSupplier->name,
                'Lead Passenger Name' => $booking_detail->getBooking->lead_passenger_name,
                'Pax No.' => $booking_detail->getBooking->pax_no,
                'Category' => $booking_detail->getCategory->name,
                'Product' => $booking_detail->product_id, 
                'Status' => $booking_detail->status == 'active' ? 'Booked' : 'Cancelled',
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
                $event->getSheet()->getDelegate()->getStyle('A1:Z1')->applyFromArray($align_center);
            },
        ];
    }
}
