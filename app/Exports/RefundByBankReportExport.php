<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use \Carbon\Carbon;

class RefundByBankReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
            'Refund Amount' => 'Refund Amount',
            'Refund Date' => 'Refund Date',
            'Bank' => 'Bank',
            'Refund Confirmed By' => 'Refund Confirmed By',
            'Refund Recieved' => 'Refund Recieved',
            'Refund Recieved Date' => 'Refund Recieved Date',
        ];

        foreach($data['booking_refund_payments'] as $booking_refund_payment) {
            $keyed[] = [
                'Booking Ref #' => isset($booking_refund_payment->getBookingDetail->getBooking->quote_ref) ? 
                    $booking_refund_payment->getBookingDetail->getBooking->quote_ref : '---',
                'Refund Amount' => $booking_refund_payment->getCurrency->code.' '.$booking_refund_payment->refund_amount,
                'Refund Date' => !is_null($booking_refund_payment->refund_date) ? 
                    Carbon::parse($booking_refund_payment->refund_date)->format('d/m/Y') : '---',
                'Bank' => isset($booking_refund_payment->getBank->name) && !empty($booking_refund_payment->getBank->name) ? 
                    $booking_refund_payment->getBank->name : '---',
                'Refund Confirmed By' => isset($booking_refund_payment->getUser->name) && !empty($booking_refund_payment->getUser->name) ? 
                    $booking_refund_payment->getUser->name : '---',
                'Refund Recieved' => ($booking_refund_payment->refund_recieved == 0 || $booking_refund_payment->refund_recieved == null) ? 
                    'No' : 'Yes',
                'Refund Recieved Date' => !is_null($booking_refund_payment->refund_recieved_date) ? 
                    Carbon::parse($booking_refund_payment->refund_recieved_date)->format('d/m/Y') : '---',
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
