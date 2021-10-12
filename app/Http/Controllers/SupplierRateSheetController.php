<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SupplierRateSheetRequest;
use App\Http\Requests\UpdateSupplierRateSheetRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

use App\SupplierRateSheet;
use App\Supplier;
use App\Season;

class SupplierRateSheetController extends Controller
{
    public $pagination = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = SupplierRateSheet::orderBy('id', 'ASC');
        // if (count($request->all()) > 0) {
        //     if ($request->has('search') && !empty($request->search)) {
        //         $supplier = $supplier->where(function ($query) use ($request) {
        //             $query->where('name', 'like', '%'.$request->search.'%')
        //             ->orWhere('email', 'like', '%'.$request->search.'%')
        //             ->orWhere('phone', 'like', '%'.$request->search.'%');
        //         });
        //     }
                             
        //     if ($request->has('currency') && !empty($request->currency)) {
        //         $supplier = $supplier->whereHas('getCurrency', function ($q) use($request) {
        //             $q->where('name', 'like', '%'.$request->currency.'%');
        //         });
        //     }
        //     if ($request->has('category') && !empty($request->category)) {
        //         $supplier = $supplier->whereHas('getCategories', function ($q) use($request) {
        //             $q->where('name', 'like', '%'.$request->category.'%');
        //         });
        //     }
        // }
   
        $data['supplier_rate_sheets'] = $query->paginate($this->pagination);       
        
        return view('supplier_rate_sheets.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['suppliers']       = Supplier::orderBy('id', 'ASC')->get();
        $data['booking_seasons'] = Season::all();

        return view('supplier_rate_sheets.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // SupplierRateSheetRequest
    // Request
    public function store(SupplierRateSheetRequest $request)
    {
        $supplier_rate_sheet = SupplierRateSheet::where([
            'supplier_id' => $request->supplier_id,
            'season_id'   => $request->season_id
        ]);

        if($supplier_rate_sheet->exists()){
            throw ValidationException::withMessages([ 'file' => 'The Rate Sheet has already been taken.']);
        }

        SupplierRateSheet::create([
            'supplier_id' => $request->supplier_id,
            'season_id'   => $request->season_id,
            'file'        => $this->fileStore($request)
        ]);

        return \Response::json(['status' => 200, 'success_message' => 'Supplier Rate Sheet Added Successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['suppliers']           = Supplier::orderBy('id', 'ASC')->get();
        $data['booking_seasons']     = Season::all();
        $data['supplier_rate_sheet'] = SupplierRateSheet::find(decrypt($id));

        return view('supplier_rate_sheets.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRateSheetRequest $request, $id)
    {
        $supplier_rate_sheet = SupplierRateSheet::find(decrypt($id));

        $supplier_rate_sheet = SupplierRateSheet::where([
            'supplier_id' => $request->supplier_id,
            'season_id'   => $request->season_id
        ])
        ->where('id', '!=' , decrypt($id));

        if($supplier_rate_sheet->exists()){
            throw ValidationException::withMessages([ 'file' => 'The Rate Sheet has already been taken.']);
        }

        $data = [
            'supplier_id' => $request->supplier_id,
            'season_id'   => $request->season_id,
        ];

        if($request->hasFile('file')) {
            $data['file'] = $this->fileStore($request, $supplier_rate_sheet);
        }
      
        $supplier_rate_sheet->update($data);

        return \Response::json(['status' => 200, 'success_message' => 'Supplier Rate Sheet Updated Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SupplierRateSheet::destroy(decrypt($id));
        return redirect()->route('supplier-rate-sheet.index')->with('success_message', 'Supplier Rate Sheet Deleted Successfully');
    }

    public function fileStore(Request $request, $old = NULL)
    {
        if($request->hasFile('file')){

            $season_name = Season::find($request->season_id)->name;
            $url         = 'public/supplier_rate_sheet/'.$season_name;

            $path = $request->file('file')->store($url);
            if($old != NULL){
                Storage::delete($old->getOriginal('file'));
            }
            //storage url
            $file_path = url(Storage::url($path));
            //storage url
            return $path;
        }
        return;
    }
}
