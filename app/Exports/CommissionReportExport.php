<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use App\Http\Helper;

class CommissionReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
            'Quote Ref #'  => 'Quote Ref #',
            'Commission'  => 'Commission',
            'Commission Group'  => 'Commission Group',
            'Commission Amount'  => 'Commission Amount',
            'Sales Person'  => 'Sales Person',
            'Booking Currency'  => 'Booking Currency',
            'Brand'  => 'Brand', 
            'Holiday Type'  => 'Holiday Type',
            'Seasons'  => 'Season',
        ];

        foreach($data['bookings'] as $booking) {
            $keyed[] = [
                'Booking Ref #' => $booking->ref_no,
                'Quote Ref #'  => $booking->quote_ref,
                'Commission'  => Helper::issetAndNotEmpty($booking->getCommission->name),
                'Commission Group'  => Helper::issetAndNotEmpty($booking->getCommissionGroup->name),
                'Commission Amount'  => Helper::issetAndNotEmpty($booking->getCurrency->code) . 
                    $booking->commission_amount,
                'Sales Person'  => Helper::issetAndNotEmpty($booking->getSalePerson->name),
                'Booking Currency'  => Helper::issetAndNotEmpty($booking->getCurrency->code).' - '.
                    Helper::issetAndNotEmpty($booking->getCurrency->name),
                'Brand'  => Helper::issetAndNotEmpty($booking->getBrand->name), 
                'Holiday Type'  => Helper::issetAndNotEmpty($booking->getHolidayType->name),
                'Seasons'  => Helper::issetAndNotEmpty($booking->getSeason->name),
            ];
        }

        return new collection($keyed);
    }

    public function headings():array {
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
                /* Columns -- A1 TO Z1 -- BOLD & ALIGN CENTER  */
                $event->getSheet()->getDelegate()->getStyle('A1:Z1')->applyFromArray($bold);
                $event->getSheet()->getDelegate()->getStyle('A1:Z1')->applyFromArray($align_center);
            },
        ];
    }
}
