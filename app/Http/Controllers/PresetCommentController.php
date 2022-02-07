<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\PresetCommentRequest;
use App\Http\Requests\UpdatePresetCommentRequest;

use App\PresetComment;

class PresetCommentController extends Controller
{
    public $pagination = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query = PresetComment::orderBy('id', 'ASC');

        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $query->where('comment', 'like', '%'.$request->search.'%');
            }
        }

        $data['preset_comments'] = $query->paginate($this->pagination);

        return view('preset_comments.listing',$data);
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('preset_comments.create');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresetCommentRequest $request)
    {
        // $this->validate(
        //     $request, 
        //     [ 'comment' => 'required' ],
        //     [ 'comment.required' => 'The Preset Comment field is required.' ]
        // );

        PresetComment::create([
            'comment' => $request->comment
        ]);

        return response()->json([ 'status' => true, 'success_message' => 'Preset Comment Created Successfully.' ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $data['preset_comment'] = PresetComment::findOrFail(decrypt($id));

        return view('preset_comments.edit', $data);
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
        $this->validate(
            $request, 
            [ 'comment' => 'required' ],
            [ 'comment.required' => 'The Preset Comment field is required.' ]
        );

        PresetComment::findOrFail(decrypt($id))->update([
            'comment' => $request->comment
        ]);

        return response()->json([ 'status' => true, 'success_message' => 'Preset Comment Updated Successfully.' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        PresetComment::destroy(decrypt($id));

        return redirect()->route('preset_comments.index')->with('success_message', 'Preset Comment deleted successfully'); 
    }

}
