<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SupplierReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
            'Default Category' => 'Default Category',
            'Default Currency' => 'Default Currency'
        ];
        
        foreach($data['suppliers'] as $supplier) {
            
            $categories = '';
            if(count($supplier->getCategories) > 0) {
                $numItems = count($supplier->getCategories);
                $i = 0;
                foreach($supplier->getCategories as $key => $category) {
                    if(++$i !== $numItems) {
                        $categories .=  $category->name . ', ';
                    } else {
                        $categories .=  $category->name;
                    }
                }
            }

            $keyed[] = [
                'Name' => $supplier->name,
                'Email' => $supplier->email,
                'Default Category' => $categories,
                'Default Currency' => !empty($supplier->getCurrency->code) && 
                    !empty($supplier->getCurrency->name) ? $supplier->getCurrency->code . ' - ' . $supplier->getCurrency->name : null
            ];
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
