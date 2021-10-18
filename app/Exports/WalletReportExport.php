<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class WalletReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
            'Booking Reference' => 'Booking Reference',
            'Supplier Name' => 'Supplier Name',
            'Amount' => 'Amount',
            'Type' => 'Type'
        ];

        foreach($data['wallets'] as $wallet) {
            $keyed[] = [
                'Booking Reference' => isset($wallet->getBooking->ref_no) && 
                    !empty($wallet->getBooking->ref_no) ? ucfirst($wallet->getBooking->ref_no) : '---',
                'Supplier Name' => isset($wallet->getSupplier->name) && 
                    !empty($wallet->getSupplier->name) ? ucfirst($wallet->getSupplier->name) : '---',
                'Amount' => isset($wallet->amount) && !empty($wallet->amount) ? $wallet->amount : 
                    '---',
                'Type' => isset($wallet->type) && !empty($wallet->type) ? ucfirst($wallet->type) : 
                    '---'
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
