<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Brand;
use App\Country;

class BrandController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Brand::orderBy('id', 'ASC');

        if($request->filled('search')){

            $query->where(function($query) use($request){
                $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%')
                ->orWhere('address', 'like', '%'.$request->search.'%')
                ->orWhere('phone', 'like', '%'.$request->search.'%');
            });
        }

        $data['brands'] = $query->paginate($this->pagination);

        return view('brands.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    public function brandArray($request, $method, $brand = null)
    {
        $data = [
            
            'name'     => $request->name,
            'email'    => $request->email,
            'address'  => $request->address,
            'phone'    => $request->full_number,
            'about_us' => $request->about_us,
            'user_id'  => Auth::id(),
        ];

        if($method == 'store'){

            if($request->hasFile('logo')) {

                $data['logo'] = $this->fileStore($request);
            }
        }

        if($method == 'update' && $request->delete_logo == null){

            if($request->hasFile('logo')) {
                $data['logo'] = $this->fileStore($request, $brand);
            }
        }

        if($method == 'update' && $request->delete_logo == 1){

            // if($request->hasFile('logo')) {
                File::delete($brand->logo);
                $data['logo'] = null;
                // $data['logo'] = $this->fileStore($request, $brand);
            // }
        }
    
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $brand = Brand::create($this->brandArray($request, 'store'));

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Brand Created Successfully.',
            'redirect_url'    => route('brands.index') 
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['brand']     = Brand::findOrFail(decrypt($id));

        return view('brands.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {

        $brand = Brand::find(decrypt($id));
        $brand->update($this->brandArray($request, 'update', $brand));

        return response()->json([ 
            'status'          => true, 
            'success_message' => 'Brand Updated Successfully.',
            'redirect_url'    => route('brands.index') 
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
        $brand = Brand::findOrFail(decrypt($id));
        try
        {
            $brand->delete(); 
            return response()->json([ 
                'status'          => true, 
                'message' => 'Brand Deleted Successfully.',
                'redirect_url'    => route('brands.index') 
            ]);
        }

        catch(\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return response()->json([ 
                    'status'          => false, 
                    'message' => 'Brand can not be deleted beacuse it is associated one or more record.',
                ]);
            }
        }
        Brand::findOrFail(decrypt($id))->delete();

        return redirect()->route('brands.index')->with('success_message', 'Brand deleted successfully');
    }


    public function bulkAction(Request $request)
    {
        try {

            $message = "";
            $bulk_action_ids  = $request->bulk_action_ids;
            $bulk_action_type = $request->bulk_action_type;
            $bulk_action_ids  = explode(",", $bulk_action_ids);
    
            if($bulk_action_type == 'delete'){
                DB::table("brands")->whereIn('id', $bulk_action_ids)->delete();
                $message = "Brand Deleted Successfully.";
            }
    
            return response()->json([ 
                'status'  => true, 
                'message' => $message,
            ]);
          
        } catch (\Exception $e) {

            // $e->getMessage(),
            return response()->json([ 
                'status'  => false, 
                'message' => "Something Went Wrong, Please Try Again."
            ]);
        }
    }
    
    public function fileStore(Request $request, $old = NULL)
    {
        if($request->hasFile('logo')){
            $url = 'public/brands';
            $path = $request->file('logo')->store($url);
            if($old != NULL){
                Storage::delete($old->getOriginal('logo'));
            }
            //storage url
            url(Storage::url($path));
            //storage url
            return $path;
        }
        return;
        // $request->validate([
        //     'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
    
        // $imageName = time().'.'.$request->logo->extension();  
     
        // $request->logo->move(public_path('brand_images'), $imageName);
  
        /* Store $imageName name in DATABASE from HERE */
        // dd($imageName);
        
    }
 
}
