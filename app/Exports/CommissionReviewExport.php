<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CommissionReviewExport implements FromView
{

    private $data;
    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {

        $data = $this->data;
    
        return view('exports.commission_review', $data);
    }
}
