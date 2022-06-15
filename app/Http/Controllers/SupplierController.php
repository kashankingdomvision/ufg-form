<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Category;
use App\Currency;
use App\Product;
use App\Supplier;
use App\SupplierCategory;
use App\SupplierProduct;
use App\Country;
use App\GroupOwner;

use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $supplier = Supplier::orderBy('id', 'ASC');
        if (count($request->all()) > 0) {
            $user = $this->searchFilters($supplier, $request);
        }
        
        $data['currencies'] = Currency::active()->orderBy('id', 'ASC')->get();
        $data['suppliers'] = $supplier->paginate($this->pagination);       
        $data['categories'] = Category::orderby('sort_order', 'ASC')->get();
        
        return view('suppliers.listing', $data);
    }

    public function searchFilters($supplier, $request){

        if ($request->has('search') && !empty($request->search)) {
            $supplier = $supplier->where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%')
                ->orWhere('phone', 'like', '%'.$request->search.'%');
            });
        }
                         
        if ($request->has('currency') && !empty($request->currency)) {
            $supplier = $supplier->whereHas('getCurrency', function ($q) use($request) {
                $q->where('name', 'like', '%'.$request->currency.'%');
            });
        }
        if ($request->has('category') && !empty($request->category)) {
            $supplier = $supplier->whereHas('getCategories', function ($q) use($request) {
                $q->where('name', 'like', '%'.$request->category.'%');
            });
        }

        return $supplier;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories']   = Category::orderby('sort_order', 'ASC')->get();
        $data['products']     = Product::get();
        $data['currencies']   = Currency::get();
        $data['countries']    = Country::orderBy('sort_order', 'ASC')->get();
        $data['group_owners'] = GroupOwner::orderBy('name')->get();

        return view('suppliers.create', $data);
    }

    public function suppliersArray($request)
    {
        $data = [
            'currency_id'     => $request->currency, 
            'group_owner_id'  => $request->group_owner_id, 
            'name'            => $request->username, 
            'code'            => $request->code,
            'email'           => $request->email, 
            'phone'           => $request->full_number,
            'contact_person'  => $request->contact_person,
            'commission_rate' => $request->commission_rate,
            'description'     => $request->description,
            // 'town_id'      => $request->town_id, 
        ];
    
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // SupplierRequest
    public function store(SupplierRequest $request)
    {
        // dd($request->all());

        $supplier = Supplier::create($this->suppliersArray($request));

        if($request->has('categories') && count($request->categories) > 0){
            foreach ($request->categories as $category) {
                SupplierCategory::create([
                    'supplier_id' => $supplier->id,
                    'category_id' => $category
                ]);
            }
        }
    
        if($request->has('products') && count($request->products) > 0){
            foreach ($request->products as $product) {
                SupplierProduct::create([
                    'supplier_id' => $supplier->id,
                    'product_id' => $product
                ]);
            }
        }

        $supplier->getCountries()->sync($request->country_id);
        $supplier->getLocations()->sync($request->location_id);

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Supplier Created Successfully.',
            'redirect_url'    => route('suppliers.index') 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['supplier'] = Supplier::findOrFail(decrypt($id));
        return view('suppliers.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['supplier']     = Supplier::findOrFail(decrypt($id));
        $data['categories']   = Category::orderby('sort_order', 'ASC')->get();
        $data['products']     = Product::get();
        $data['currencies']   = Currency::get();
        $data['countries']    = Country::orderBy('sort_order', 'ASC')->get();
        $data['group_owners'] = GroupOwner::orderBy('name')->get();

        return view('suppliers.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, $id)
    {
        $supplier = Supplier::findOrFail(decrypt($id));

        SupplierCategory::where('supplier_id', $supplier->id)->delete();
        SupplierProduct::where('supplier_id', $supplier->id)->delete();

        $supplier->update($this->suppliersArray($request));

        if($request->has('categories') && count($request->categories) > 0){
            foreach ($request->categories as $category) {
                SupplierCategory::create([
                    'supplier_id' => $supplier->id,
                    'category_id' => $category
                ]);
            }
        }
    
        if($request->has('products') && count($request->products) > 0){
            foreach ($request->products as $product) {
                SupplierProduct::create([
                    'supplier_id' => $supplier->id,
                    'product_id' => $product
                ]);
            }
        }
        
        $supplier->getCountries()->sync($request->country_id);
        $supplier->getLocations()->sync($request->location_id);
        
        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Supplier Updated Successfully.',
            'redirect_url'    => route('suppliers.index') 
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
        $Supplier = Supplier::findOrFail(decrypt($id));
        try
        {
            $Supplier->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Supplier Deleted Successfully.',
                'redirect_url'    => route('suppliers.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Supplier can not be deleted beacuse it is associated one or more record.',
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
                DB::table("suppliers")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Supplier Deleted Successfully.";
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
                    'message' => 'Supplier can not be deleted beacuse it is associated one or more record.',
                ]);
            }
        }
    }
}
