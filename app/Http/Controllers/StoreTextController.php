<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreText;
use App\Http\Requests\StoreTextRequest;

class StoreTextController extends Controller
{
    public $pagination = 10;

    public function index()
    {
        $data['storetexts'] = StoreText::paginate($this->pagination,['name', 'id', 'slug']);
        return view('storetext.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storetext.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTextRequest $request)
    {
        StoreText::create($request->all());

        return response()->json([ 'status' => true, 'success_message' => 'Store Text Created Successfully.' ]);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function show($slug)
    // // {
       
    // // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data['storeText'] = StoreText::where('slug', $slug)->firstOrFail();
        return view('storetext.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTextRequest $request, $slug)
    {
        $storeText = StoreText::where('slug', $slug)->firstOrFail();
        $storeText->update($request->all());

        return response()->json([ 'status' => true, 'success_message' => 'Store Text Updated Successfully.' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $storeText = StoreText::where('slug', $slug)->firstOrFail();
        $storeText->delete();
        return redirect()->route('store_texts.index')->with('success_message', 'Store Text deleted successfully');
    }
}
