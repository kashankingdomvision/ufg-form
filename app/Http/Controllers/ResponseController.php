<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HolidayType;
use App\Supplier;
use App\Product;
use App\Quote;
use Illuminate\Support\Facades\View;


class ResponseController extends Controller
{
    public function getBrandToHoliday(Request $request)
    {    
        $holiday_types = HolidayType::where('brand_id',$request->brand_id)->get();
        return response()->json($holiday_types);
    }
    
    public function getCategoryToSupplier(Request $request)
    {
        $supplier = Supplier::whereHas('getCategories', function($query) use($request) {
                            $query->where('id', $request->category_id);
                    })->get();
        return response()->json($supplier);
    }
    
    public function getSupplierToProduct(Request $request)
    {
        $product  = Product::whereHas('getSuppliers', function($query) use($request){
                        $query->where('id', $request->id);
                    })->get();
        return response()->json($product);
    }
    
    public function getChildReference(Request $request)
    {
        $data['quotes'] = Quote::where('ref_no', $request->ref_no)->where('id', '!=' ,$request->id)->orderBy('created_at')->get();
        return response()->json(View::make('partials.quote_listing', $data)->render());
    }
}
