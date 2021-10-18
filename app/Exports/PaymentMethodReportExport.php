<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PaymentMethodReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
            'Supplier' => 'Supplier',
            'Staff' => 'Staff',
            'Payment Method' => 'Payment Method',
            'Deposit Amount' => 'Deposit Amount',
            'Paid Date' => 'Paid Date',
            'Outstanding Amount' => 'Outstanding Amount',
            'Payment Status' => 'Payment Status',
        ];

        foreach($data['booking_finance_details'] as $booking_finance_detail) {
            $keyed[] = [
                'Booking Ref #' => $booking_finance_detail->getBookingDetail->getBooking->quote_ref ? 
                    $booking_finance_detail->getBookingDetail->getBooking->quote_ref : '---',
                'Supplier' => isset($booking_finance_detail->getBookingDetail->getSupplier->name) ? 
                    $booking_finance_detail->getBookingDetail->getSupplier->name : '',
                'Staff' => isset($booking_finance_detail->getStaffPerson->name) ? $booking_finance_detail->getStaffPerson->name : '',
                'Payment Method' => isset($booking_finance_detail->getPaymentMethod->name) ?
                    $booking_finance_detail->getPaymentMethod->name : '',
                'Deposit Amount' => $booking_finance_detail->getCurrency->code.' '.$booking_finance_detail->deposit_amount,
                'Paid Date' => $booking_finance_detail->paid_date,
                'Outstanding Amount' => $booking_finance_detail->getCurrency->code.' '.$booking_finance_detail->outstanding_amount,
                'Payment Status' => ucfirst($booking_finance_detail->status),
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
