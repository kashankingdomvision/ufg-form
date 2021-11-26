<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;
use App\Category;

class CategoryController extends Controller
{
    public $pagination = 100;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::orderBy('id', 'ASC');
        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $category = $category->where('name', 'like', '%'.$request->search.'%');
            }
        }
        $data['categories'] = $category->paginate($this->pagination);
        return view('categories.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            'name'       => $request->name,
            'slug'       => Str::slug($request->name),
            'feilds'     => $request->feilds,
            'quote'      => $request->quote,
            'booking'    => $request->booking,
            'sort_order' => $request->sort_order,
        ]);

        return \Response::json(['status' => true, 'success_message' => 'Category created successfully'], 200);

        return redirect()->route('categories.index')->with('success_message', 'Category created successfully'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = Category::findOrFail(decrypt($id));
        return view('categories.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request)
    {
        $category = Category::findOrFail(decrypt($request->id));
        
        $category->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'feilds'      => $request->feilds,
            'quote'       => $request->quote,
            'booking'     => $request->booking,
            'sort_order' =>  $request->sort_order,
        ]);

        return \Response::json(['status' => true, 'success_message' => 'Category updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy(decrypt($id));
        return redirect()->back()->with('success_message', 'Category deleted successfully'); 
    }
}
