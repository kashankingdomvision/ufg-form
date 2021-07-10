<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Commission;
use App\Http\Requests\CommissionRequest;

class CommissionController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['commissions'] = Commission::paginate($this->pagination);
        return view('commissions.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('commissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommissionRequest $request)
    {
        Commission::create($request->all());
        return redirect()->route('setting.commissions.index')->with('success_message', 'Commission created successfully'); 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['commission'] = Commission::findOrFail(decrypt($id));
        return view('commissions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommissionRequest $request, $id)
    {
        Commission::findOrFail(decrypt($id))->update($request->all());
        return redirect()->route('setting.commissions.index')->with('success_message', 'Commission updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Commission::destroy(decrypt($id));
        return redirect()->route('setting.commissions.index')->with('success_message', 'Commission deleted successfully'); 
    }
}
