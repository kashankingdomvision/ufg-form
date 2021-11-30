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
        }
        
        $data['currencies'] = Currency::where('status', 1)->orderBy('name', 'ASC')->get();
        $data['suppliers'] = $supplier->paginate($this->pagination);       
        $data['categories'] = Category::orderby('sort_order', 'ASC')->get();
        
        return view('suppliers.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::orderby('sort_order', 'ASC')->get();
        $data['products']   = Product::get();
        $data['currencies'] = Currency::get();
        $data['countries']  = Country::orderBy('sort_order', 'ASC')->get();

        return view('suppliers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create([
            'currency_id' => $request->currency, 
            'country_id'  => $request->country_id, 
            // 'town_id'     => $request->town_id, 
            'location_id' => $request->location_id, 
            'name'        => $request->username, 
            'email'       => $request->email, 
            'phone'       => $request->full_number,
            'description' => $request->description,
        ]);
        
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
        
        return redirect()->route('suppliers.index')->with('success_message', 'Supplier created successfully');
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
        $data['supplier']   = Supplier::findOrFail(decrypt($id));
        $data['categories'] = Category::orderby('sort_order', 'ASC')->get();
        $data['products']   = Product::get();
        $data['currencies'] = Currency::get();
        $data['countries']  = Country::orderBy('sort_order', 'ASC')->get();
        
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

        $supplier->update([
            'currency_id' => $request->currency, 
            'country_id'  => $request->country_id, 
            // 'town_id'     => $request->town_id,
            'location_id' => $request->location_id,
            'name'        => $request->username, 
            'email'       => $request->email, 
            'phone'       => $request->full_number,
            'description' => $request->description,
        ]);
        
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
        
        return redirect()->route('suppliers.index')->with('success_message', 'Supplier Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bcn_count = DB::table('booking_credit_notes')->where('supplier_id', decrypt($id))->count();
        $bt_count  = DB::table('booking_transactions')->where('supplier_id', decrypt($id))->count();
        $w_count   = DB::table('wallets')->where('supplier_id', decrypt($id))->count();
        $srs_count = DB::table('supplier_rate_sheets')->where('supplier_id', decrypt($id))->count();
        $tw_count  = DB::table('total_wallets')->where('supplier_id', decrypt($id))->count();
        $sbp_count = DB::table('supplier_bulk_payments')->where('supplier_id', decrypt($id))->count();

        if($bcn_count == 0 && $bt_count == 0 && $w_count == 0 && $srs_count == 0 && $tw_count == 0 && $sbp_count == 0){
            Supplier::destroy(decrypt($id));
            return redirect()->route('suppliers.index')->with('success_message', 'Supplier deleted successfully');
        }

        return redirect()->route('suppliers.index')->with('error_message', "Supplier can not deleted beacuse it is associated one or more record.");
    }
}
