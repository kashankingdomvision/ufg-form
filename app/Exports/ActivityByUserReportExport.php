<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ActivityByUserReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
            'User' => 'User',
            'Total Quotes' => 'Total Quotes',
            'Quotes' => 'Quotes',
            'Cancelled Quotes' => 'Cancelled Quotes',
            'Total Booking' => 'Total Booking',
            'Confirmed Booking' => 'Confirmed Booking',
            'Cancelled Booking' => 'Cancelled Booking'
        ];

        foreach($data['users'] as $user) {
            $keyed[] = [
                'User' => $user->name,
                'Total Quotes' => $user->get_total_quote_count != 0 ? $user->get_total_quote_count : '0',
                'Quotes' => $user->get_quote_count != 0 ? $user->get_quote_count : '0',
                'Cancelled Quotes' => $user->get_cancelled_quote_count != 0 ? $user->get_cancelled_quote_count : '0',
                'Total Booking' => $user->get_total_booking_count != 0 ? $user->get_total_booking_count : '0',
                'Confirmed Booking' => $user->get_confirmed_booking_count != 0 ? $user->get_confirmed_booking_count : '0',
                'Cancelled Booking' => $user->get_cancelled_booking_count != 0 ? $user->get_cancelled_booking_count : '0'
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
                /* Columns -- A1 TO H1 -- BOLD & ALIGN CENTER  */
                $event->getSheet()->getDelegate()->getStyle('A1:H1')->applyFromArray($bold);
                $event->getSheet()->getDelegate()->getStyle('A1:H1')->applyFromArray($align_center);
            },
        ];
    }
}
