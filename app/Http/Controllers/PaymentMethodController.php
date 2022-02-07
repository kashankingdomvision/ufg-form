<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\PaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;

use App\PaymentMethod;
class PaymentMethodController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $PaymentMethod = PaymentMethod::orderBy('id', 'ASC');
        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $PaymentMethod->where(function($q) use($request){
                    $q->where('name', 'like', '%'.$request->search.'%');
                });
            }
        }
        $data['payment_mehtods'] = $PaymentMethod->paginate($this->pagination);
        return view('payment_methods.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentMethodRequest $request)
    {
        PaymentMethod::create($request->all());

        return response()->json([ 'status' => true, 'success_message' => 'Payment Method Created Successfully.' ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['payment_method'] = PaymentMethod::findOrFail(decrypt($id));

        return view('payment_methods.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentMethodRequest $request, $id)
    {
        PaymentMethod::findOrFail(decrypt($id))->update($request->all());

        return response()->json([ 'status' => true, 'success_message' => 'Payment Method Updated Successfully.' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PaymentMethod::destroy(decrypt($id));
        return redirect()->route('payment_methods.index')->with('success_message', 'Payment method deleted successfully'); 
        
    }
}
