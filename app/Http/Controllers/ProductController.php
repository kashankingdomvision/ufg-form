<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Helper;

use App\Product;
use App\Location;
use App\Currency;
use App\BookingType;
use App\Category;

class ProductController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::orderBy('id', 'ASC');
        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $product = $product->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('code', 'like', '%'.$request->search.'%');
            }
        }
        $data['products'] = $product->paginate($this->pagination);
        return view('products.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['locations']      = Location::get();
        $data['currencies']     = Currency::get();
        $data['booking_types']  = BookingType::all();
        $data['categories']     = Category::orderby('sort_order', 'ASC')->get();

        return view('products.create', $data);
    }

    public function productsArray($request)
    {
        $data = [
            'code'              => $request->code,
            'name'              => $request->name,
            'category_id'       => $request->category_id,
            'country_id'        => $request->country_id,
            'location_id'       => $request->location_id,
            'currency_id'       => $request->currency_id,
            'booking_type_id'   => $request->booking_type_id,
            'duration'          => $request->duration,
            'price'             => $request->price,
            'description'       => $request->description,
            'feilds'            => $request->feilds,
            // 'inclusions'        => $request->inclusions,
            // 'packing_list'      => $request->packing_list,
        ];
    
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // ProductRequest
    // Request
    public function store(ProductRequest $request)
    {
        // dd($request->all());

        Product::create($this->productsArray($request));

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Product Created Successfully.',
            'redirect_url'    => route('products.index') 
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
        $data['product']       = Product::findOrFail(decrypt($id));
        $data['locations']     = Location::get();
        $data['currencies']    = Currency::get();
        $data['booking_types'] = BookingType::all();
        $data['categories']    = Category::orderby('sort_order', 'ASC')->get();

        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  UpdateProductRequest
    // Request
    public function update(UpdateProductRequest $request)
    {
        Product::findOrFail(decrypt($request->id))->update($this->productsArray($request));

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Product Updated Successfully.',
            'redirect_url'    => route('products.index') 
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
        $Product = Product::findOrFail(decrypt($id));
        try
        {
            $Product->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Product Deleted Successfully.',
                'redirect_url'    => route('products.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Product can not be deleted beacuse it is associated one or more record.',
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
                DB::table("products")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Product Deleted Successfully.";
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
                    'message' => 'Product can not be deleted beacuse it is associated one or more record.',
                ]);
            }
        }
    }
}
