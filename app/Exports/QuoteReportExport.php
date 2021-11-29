<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class QuoteReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        $total_profit_percentage = 0;
        
        $keyed[] = [
            'User' => 'User',
            'Behalf' => 'Behalf',
            'Zoho Ref #' => 'Zoho Ref #',
            'Quote Ref #' => 'Quote Ref #',
            'Season' => 'Season',
            'Brand' => 'Brand',
            'Booking Currency' => 'Booking Currency',
            'Currency Type' => 'Currency Type',
            'Commission Type' => 'Commission Type',
            'Pax No.' => 'Pax No.',
            'Total Net Price' => 'Total Net Price',
            'Total Markup Amount' => 'Total Markup Amount',
            'Total Selling Price' => 'Total Selling Price',
            'Total Profit Percentage' => 'Total Profit Percentage',
            'Staff Commission' => 'Staff Commission',
            'Amount Per Person' => 'Amount Per Person',
            'Total Profit Percentage' => 'Total Profit Percentage',
            'Booking Date' => 'Booking Date',
            'Status' => 'Status',
            'Created At' => 'Created At',
        ];

        foreach($data['quotes'] as $quote) {
            $total_profit_percentage += $quote->profit_percentage;
            $keyed[] = [
                'User' => $quote->getUser->name,
                'Behalf' => $quote->getSalePerson->name,
                'Zoho Ref #' => $quote->ref_no,
                'Quote Ref #' => $quote->quote_ref,
                'Season' => $quote->getSeason->name,
                'Brand' => (isset($quote->getBrand->name))? $quote->getBrand->name: NULL,
                'Booking Currency' => $quote->getBookingCurrency->code.' - '.$quote->getBookingCurrency->name,
                'Currency Type' => $quote->rate_type == 'live' ? 'Live Rate' : 'Manual Rate',
                'Commission Type' => $quote->getCommission->name . $quote->getCommission->percentage . ' %',
                'Pax No.' => $quote->pax_no,
                'Total Net Price' => $quote->getBookingCurrency->code.' '.$quote->net_price,
                'Total Markup Amount' => $quote->getBookingCurrency->code.' '.$quote->markup_amount . ' (' . $quote->markup_percentage.' %)',
                'Total Selling Price' => $quote->getBookingCurrency->code.' '.$quote->selling_price,
                'Total Profit Percentage' => $quote->profit_percentage .' %',
                'Staff Commission' => $quote->getBookingCurrency->code.' '.$quote->commission_amount,
                'Amount Per Person' => $quote->getBookingCurrency->code.' '.$quote->amount_per_person,
                'Total Profit Percentage' => $total_profit_percentage.' %',
                'Booking Date' => $quote->formated_booking_date,
                'Status' => ucfirst($quote->booking_status),
                'Created At' => $quote->formated_created_at,
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
