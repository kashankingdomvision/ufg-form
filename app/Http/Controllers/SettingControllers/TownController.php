<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TownRequest;
use App\Http\Requests\UpdateTownRequest;

use App\Country;
use App\Town;

class TownController extends Controller
{
    public $pagination = 10;
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index(Request $request)
    {
        $query = Town::orderBy('id', 'ASC');
        if(count($request->all()) > 0){

            if($request->has('search') && !empty($request->search)){
                $query->where('name', 'like', '%'.$request->search.'%');
            }
            
            if($request->has('country_id') && !empty($request->country_id)){
                $query->where('country_id', $request->country_id);
            }
        }

        $data['countries'] = Country::orderBy('sort_order', 'ASC')->get();
        $data['towns']     = $query->paginate($this->pagination);

        return view('towns.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $data['countries'] = Country::orderBy('sort_order', 'ASC')->get();

        return view('towns.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(TownRequest $request)
    {
        Town::create([
            'country_id' => $request->country_id,
            'name'       => $request->name,
        ]);

        return redirect()->route('setting.towns.index')->with('success_message', 'Town created successfully'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['town']      = Town::findOrFail(decrypt($id));
        $data['countries'] = Country::orderBy('sort_order', 'ASC')->get();

        return view('towns.edit', $data);
    }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateTownRequest $request, $id)
    {
        Town::find(decrypt($id))->update([
            'country_id' => $request->country_id,
            'name'       => $request->name,
        ]);

        return redirect()->route('setting.towns.index')->with('success_message', 'Town updated successfully'); 
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Town::destroy(decrypt($id));
        return redirect()->route('setting.towns.index')->with('success_message', 'Town deleted successfully'); 
    }
}
