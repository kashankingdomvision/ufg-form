<div class="row">
    <div class="table-responsive table-wrap" >
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <!-- <th class="text-center">SNo.</th> -->
                    <th class="text-center">Batch Name</th>
                    <!-- <th class="text-center">Com. Amount in Agent's Currency</th> -->
                    <th class="text-center">Pay Commission Amount</th>
                    <th class="text-center">Total Paid Amount</th>
                    <th class="text-center">Total Outstanding Amount</th>
                    <th class="text-center">Deposit Date</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $key => $data)
                    <tr>
                        <!-- <td>
                            {{$key+1}}
                        </td> -->
                        <td>
                        <span class="badge badge-success">{{$data->name}}</span>
                        </td>
                        <!-- <td>
                            {{Helper::number_format($data->commission_amount_in_sale_person_currency)}}
                        </td> -->
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
                            {{$data->deposit_date}}
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