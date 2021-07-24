<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\HolidayType;
use App\Http\Requests\HolidayTypeRequest;

class HolidayTypeController extends Controller
{
    public $pagination = 10;
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $HolidayType = HolidayType::orderBy('id', 'ASC');
        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $HolidayType->where(function($q) use($request){
                    $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhereHas('getBrand', function($query) use($request){
                        $query->where('name', 'like', '%'.$request->search.'%');
                    });
                });
            }
        }
        $data['holiday_types'] = $HolidayType->paginate($this->pagination);
        return view('holiday_types.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['brands'] = Brand::get();
        return view('holiday_types.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HolidayTypeRequest $request)
    {
        HolidayType::create($request->all());
        return redirect()->route('setting.holidaytypes.index')->with('success_message', 'Holiday type created successfully'); 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['holiday_type'] = HolidayType::findOrFail(decrypt($id));
        $data['brands'] = Brand::get();
        return view('holiday_types.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HolidayTypeRequest $request, $id)
    {
        HolidayType::findOrFail(decrypt($id))->update($request->all());
        return redirect()->route('setting.holidaytypes.index')->with('success_message', 'Holiday type updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HolidayType::destroy(decrypt($id));
        return redirect()->route('setting.holidaytypes.index')->with('success_message', 'Holiday type deleted successfully'); 
    }
    
}
