<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Str;
use App\Product;
use App\Http\Helper;

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
        $data['product_code'] = Helper::getProductCode();

        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->all());
        return redirect()->route('products.index')->with('success_message', 'Product created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = Product::findOrFail(decrypt($id));
        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail(decrypt($id));
        
        $product->update($request->all());
        return redirect()->route('products.index')->with('success_message', 'Product update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy(decrypt($id));
        return redirect()->route('products.index')->with('success_message', 'Product deleted successfully');
    }
}
