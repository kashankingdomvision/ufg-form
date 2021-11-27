<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HarboursRequest;
use App\Http\Requests\UpdateHarboursRequest;
use App\Harbour;

class HarbourController extends Controller
{
    public $pagination = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Harbour::orderBy('id', 'ASC');

        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $query->where('name', 'like', '%'.$request->search.'%');
                $query->orWhere('port_id', 'like', '%'.$request->search.'%');
            }
        }

        $data['harbours'] = $query->paginate($this->pagination);

        return view('harbours.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('harbours.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HarboursRequest $request)
    {
        Harbour::create([
            'port_id' =>  $request->port_id,
            'name'    =>  $request->name
        ]);

        return redirect()->route('setting.harbours.index')->with('success_message', 'Harbours, Train and Points of Interest created successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['harbour'] = Harbour::find(decrypt($id));
        return view('harbours.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHarboursRequest $request, $id)
    {
        Harbour::find(decrypt($id))->update([
            'port_id' =>  $request->port_id,
            'name'    =>  $request->name
        ]);

        return redirect()->route('setting.harbours.index')->with('success_message', 'Harbours, Train and Points of Interest updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Harbour::destroy(decrypt($id));
        return redirect()->route('setting.harbours.index')->with('success_message', 'Harbours, Train and Points of Interest deleted successfully');
    }
}
