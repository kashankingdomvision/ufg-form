<?php

namespace App\Http\Controllers\SettingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Auth;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $data = [ 
            'name'      => $request->name,
            'email'     => $request->email,
            'address'   => $request->address,
            'phone'     => $request->full_number,
            'about_us'  => $request->about_us,
            'user_id'   => Auth::id(),
        ];
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->fileStore($request);
        }

        // dd($data);

        Brand::create($data);
        return redirect()->route('setting.brands.index')->with('success_message', 'Brand created successfully'); 
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
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string']);
        $brand = Brand::findOrFail(decrypt($id));
        
        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'address'   => $request->address,
            'phone'     => $request->full_number,
            'about_us'  => $request->about_us
        ];
        
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->fileStore($request, $brand);
        }
        $brand->update($data);
        return redirect()->route('setting.brands.index')->with('success_message', 'Brand updated successfully');
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
        return redirect()->route('setting.brands.index')->with('success_message', 'Brand deleted successfully');

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
