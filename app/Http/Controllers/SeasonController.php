<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeasonRequest;
use App\Http\Requests\UpdateSeasonRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

use App\Season;
use App\Supplier;

class SeasonController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $season  = Season::orderBy('id', 'ASC');
        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search))
            {
                $season->where('name', 'like', '%'.$request->search.'%');
            }
        }
        $data['seasons'] =  $season->paginate($this->pagination);
        return view('seasons.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seasons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // SeasonRequest
    // Request
    public function store(SeasonRequest $request)
    {
        // $start_date = "2022-01-02";
        // $end_date = "2022-01-30";

        $start_date = $request->start_date;
        $end_date   = $request->end_date;

        $season = Season::whereDate('start_date', '<=', $start_date)->whereDate('end_date', '>=', $end_date);

        if($season->exists()){
            throw ValidationException::withMessages([ 
                'start_date' => 'The Season date range already been taken.'
            ]);
        }

        if($request->default == 1){
            Season::query()->update([ 'default' => '0' ]);
        }
  
        Season::create([
            'name'        => $request->name,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'default'     => $request->default
        ]);

        return redirect()->route('seasons.index')->with('success_message', 'Season created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['season'] = Season::findOrFail(decrypt($id));
        return view('seasons.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeasonRequest $request, $id)
    {

        $start_date = $request->start_date;
        $end_date   = $request->end_date;

        $season = Season::whereDate('start_date', '<=', $start_date)->whereDate('end_date', '>=', $end_date)->where('id' , '!=' , decrypt($id));

        if($season->exists()){
            throw ValidationException::withMessages([ 
                'start_date' => 'The Season date range already been taken.'
            ]);
        }

        if($request->default == 1){
            Season::query()->update([ 'default' => '0' ]);
        }

        Season::find(decrypt($id))->update([
            'name'        => $request->name,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'default'     => $request->default
        ]);

        return redirect()->route('seasons.index')->with('success_message', 'Season updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Season::destroy(decrypt($id));
        return redirect()->route('seasons.index')->with('success_message', 'Season deleted successfully');
    }
}
