<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\UpdateBrandRequest;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Brand;

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
        $Brand = Brand::orderBy('id', 'ASC');

        if(count($request->all()) > 0){
            if($request->has('search') && !empty($request->search)){
                $Brand->where(function($q) use($request){
                    $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%')
                    ->orWhere('address', 'like', '%'.$request->search.'%')
                    ->orWhere('phone', 'like', '%'.$request->search.'%');
                });
            }
        }

        $data['brands'] = $Brand->paginate($this->pagination);

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

        if($method == 'update'){

            if($request->hasFile('logo')) {
                $data['logo'] = $this->fileStore($request, $brand);
            }
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
        // $request->validate(['name' => 'required|string']);

        // $data = [ 
        //     'name'      => $request->name,
        //     'email'     => $request->email,
        //     'address'   => $request->address,
        //     'phone'     => $request->full_number,
        //     'about_us'  => $request->about_us,
        //     'user_id'   => Auth::id(),
        // ];

        // if($request->hasFile('logo')) {
        //     $data['logo'] = $this->fileStore($request);
        // }

        Brand::create($this->brandArray($request, 'store'));

        return response()->json([ 'status' => true, 'success_message' => 'Brand Created Successfully.' ]);
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
        $data['brand'] = Brand::findOrFail(decrypt($id));

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

        return response()->json([ 'status' => true, 'success_message' => 'Brand Updated Successfully.' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::findOrFail(decrypt($id))->delete();

        return redirect()->route('brands.index')->with('success_message', 'Brand deleted successfully');

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
            $file_path = url(Storage::url($path));
            //storage url
            return $path;
        }
        return;
    }
 
}
