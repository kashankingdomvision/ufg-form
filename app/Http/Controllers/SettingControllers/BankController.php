<?php

namespace App\Http\Controllers\SettingControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bank;

class BankController extends Controller
{
    public $pagination = 10;
        
    public function __CONSTRUCT()
    {
        # code...
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['banks'] = Bank::paginate($this->pagination);
        return view('banks.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Bank::create([
            'name'  =>  $request->name
        ]);
        
        return redirect()->route('setting.banks.index')->with('success_message', 'Bank created successfully'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['bank'] = Bank::findOrFail(decrypt($id));
        return view('banks.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bank = Bank::findOrFail(decrypt($id))->update([
            'name' => $request->name,
        ]);
        
        return redirect()->route('setting.banks.index')->with('success_message', 'Bank updated successfully'); 
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::findOrFail(decrypt($id))->delete();
        return redirect()->route('setting.banks.index')->with('success_message', 'Bank deleted successfully'); 
        
    }
}
