<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\CountryRequest;
use App\Http\Requests\UpdateCountryRequest;

use App\Country;

class CountryController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Country::orderBy('id', 'ASC');

        if(count($request->all()) > 0){

            if($request->has('search') && !empty($request->search)){
                $query->where('name', 'like', '%'.$request->search.'%');
                $query->orWhere('sortname', 'like', '%'.$request->search.'%');
                $query->orWhere('phonecode', 'like', '%'.$request->search.'%');
            }
        }

        $data['countries'] = $query->paginate($this->pagination);

        return view('countries.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(CountryRequest $request)
    {
        Country::create([
            'name'      => $request->name,
            'sortname'  => $request->sortname,
            'phonecode' => $request->phonecode,
        ]);
        
        return redirect()->route('setting.countries.index')->with('success_message', 'Country created successfully'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $data['country'] = Country::find(decrypt($id));

        return view('countries.edit', $data);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, $id)
    {
        Country::findOrFail(decrypt($id))->update([
            'name'      => $request->name,
            'sortname'  => $request->sortname,
            'phonecode' => $request->phonecode,
        ]);
        
        return redirect()->route('setting.countries.index')->with('success_message', 'Country updated successfully'); 
    }

}
