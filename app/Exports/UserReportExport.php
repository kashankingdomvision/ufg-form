<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UserReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
            'Name' => 'Name',
            'Email' => 'Email',
            'Role' => 'Role',
            'Default Currency' => 'Default Currency',
            'Default Brand' => 'Default Brand'
        ];
        foreach($data['users'] as $user) {
            $keyed[] = [
                'Name' => $user->name,
                'Email' => $user->email,
                'Role' => isset($user->getRole->name) && !empty($user->getRole->name) ? $user->getRole->name : '',
                'Default Currency' => !empty($user->getCurrency->code) && !empty($user->getCurrency->name) ? $user->getCurrency->code . ' - ' . $user->getCurrency->name : null,
                'Default Brand' => isset($user->getBrand->name) && !empty($user->getBrand->name) ? $user->getBrand->name : '',
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
