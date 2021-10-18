<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use \Carbon\Carbon;

class RefundByCreditNoteReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
            'Supplier Name' => 'Supplier Name',
            'Credit Note Amount' => 'Credit Note Amount',
            'Credit Note Date' => 'Credit Note Date',
            'Credit Note Received By' => 'Credit Note Received By',
        ];
        
        foreach($data['booking_credit_notes'] as $booking_credit_note) {
            $keyed[] = [
                'Booking Ref #' => $booking_credit_note->getBookingDetail->getBooking->quote_ref ? 
                    $booking_credit_note->getBookingDetail->getBooking->quote_ref : '---',
                'Supplier Name' => isset($booking_credit_note->getSupplier->name) && 
                    !empty ($booking_credit_note->getSupplier->name) ?
                    $booking_credit_note->getSupplier->name : '',
                'Credit Note Amount' => $booking_credit_note->getCurrency->code.' '.
                    $booking_credit_note->credit_note_amount,
                'Credit Note Date' => Carbon::parse($booking_credit_note->credit_note_recieved_date)
                    ->format('d/m/Y'),
                'Credit Note Received By' => isset($booking_credit_note->getUser->name) && 
                    !empty($booking_credit_note->getUser->name) ? $booking_credit_note->getUser->name : '',
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
