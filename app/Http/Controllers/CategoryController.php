<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Category;
use App\QuoteDetail;

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

    public function categoryArray($request)
    {
        $data = [

            'name'                     => $request->name,
            'slug'                     => Str::slug($request->name),
            'feilds'                   => $request->feilds,
            // 'quote'                    => $request->quote,
            // 'booking'                  => $request->booking,
            'sort_order'               => $request->sort_order,
            'set_end_date_of_service'  => $request->boolean('set_end_date_of_service') ? $request->set_end_date_of_service : 0,
            'show_tf'                  => $request->show_tf,
            'label_of_time'            => ($request->show_tf == 1) ? $request->label_of_time : NULL,
            'second_tf'                => $request->second_tf,
            'second_label_of_time'     => ($request->second_tf == 1) ? $request->second_label_of_time : NULL,
        ];
    
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // CategoryRequest
    // Request
    public function store(CategoryRequest $request)
    {
        Category::create($this->categoryArray($request));

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Category Created Successfully.',
            'redirect_url'    => route('categories.index') 
        ]);
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

    // UpdateCategoryRequest
    // Request
    public function update(UpdateCategoryRequest $request)
    {
        // dd($request->all());
        $category    = Category::find(decrypt($request->id))->update($this->categoryArray($request));
        $json_quotes = QuoteDetail::where('category_id', $request->id)->whereNotNull('category_details')->get([ 'id', 'category_details']);

        if($json_quotes->count() > 0 && !is_null($category->feilds)){

            $final_json_quotes = array();

            foreach($json_quotes as $Qkey => $json_quote){
                
                $category_details = json_decode($json_quote->category_details);
                $feilds           = json_decode($category->feilds);
    
                foreach($feilds as $key => $feild){
    
                    if(isset($category_details[$key])){
                        if($feild->name == $category_details[$key]->name) {
                            $final_json_quotes[$key] = $category_details[$key];
                        }
                    }else{

                        if($feild->type == "autocomplete"){
                            if($feild->data != "none"){
                                $feild->values = Helper::get_autocomplete_type_records($feild->data); 
                            }
                        }
        
                        $final_json_quotes[$key] = $feild;
                    }
    
                    QuoteDetail::where('id', $json_quote->id)->update([ 'category_details' => $final_json_quotes ]);
                }
            }
        }

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Category Updated Successfully.',
            'redirect_url'    => route('categories.index') 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail(decrypt($id));
        try
        {
            $category->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Category Deleted Successfully.',
                'redirect_url'    => route('categories.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Category can not be deleted beacuse it is associated one or more record.',
                ]);
            }
        } 
    }

    public function bulkAction(Request $request)
    {
        try {

            $message = "";
            $bulk_action_ids  = $request->bulk_action_ids;
            $bulk_action_type = $request->bulk_action_type;
            $bulk_action_ids  = explode(",", $bulk_action_ids);
            if($bulk_action_type == 'delete'){
                DB::table("categories")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Categories Deleted Successfully.";
            }
    
            return response()->json([ 
                'status'  => true, 
                'message' => $message,
            ]);
          
        } catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Category can not be deleted beacuse it is associated one or more record.',
                ]);
            }
        } 
    }
}
