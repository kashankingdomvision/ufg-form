<div class="row">
    <div class="table-responsive table-wrap" >
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th class="text-center" width="50%">SNo.</th>
                    <th class="text-center" width="50%">Batch Name</th>
                    <th class="text-center" width="50%">Com. Amount in Agent's Currency</th>
                    <th class="text-center" width="50%">Total Paid Amount Yet</th>
                    <th class="text-center" width="50%">Outstanding Amount Left</th>
                    <th class="text-center" width="50%">Pay Commission Amount</th>
                    <th class="text-center" width="50%">Total Paid Amount</th>
                    <th class="text-center" width="50%">Total Outstanding Amount</th>
                    <th class="text-center" width="50%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $key => $data)
                    <tr>
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                        <span class="badge badge-success">{{$data->name}}</span>
                        </td>
                        <td>
                            {{Helper::number_format($data->commission_amount_in_sale_person_currency)}}
                        </td>
                        <td>
                            {{Helper::number_format($data->total_paid_amount_yet)}}
                        </td>
                        <td>
                            {{Helper::number_format($data->outstanding_amount_left)}}
                        </td>
                        <td>
                            {{Helper::number_format($data->pay_commission_amount)}}
                        </td>
                        <td>
                            {{Helper::number_format($data->total_paid_amount)}}
                        </td>
                        <td>
                            {{Helper::number_format($data->total_outstanding_amount)}}
                        </td>
                        <td>
                        <span class="badge badge-success">{{$data->status}}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>