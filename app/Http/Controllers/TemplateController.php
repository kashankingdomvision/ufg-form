<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TemplateRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\BookingType;
use App\BookingMethod;
use App\Category;
use App\Currency;
use App\Supplier;
use App\Season;
use App\Template;
use App\TemplateDetail;
use App\User;

class TemplateController extends Controller
{
    public $pagination = 10;

    public function __Construct()
    {       
      $this->pagination = 10;
    }
    
    public function getQuoteDetailsArray($quoteD, $id)
    {
        return [
            'template_id'           => $id,
            'category_id'           => $quoteD['category_id'],
            'supplier_id'           => (isset($quoteD['supplier_id']))? $quoteD['supplier_id'] : NULL ,
            'product_id'            => (isset($quoteD['product_id']))? $quoteD['product_id'] : NULL,
            'booking_method_id'     => $quoteD['booking_method_id'],
            'booked_by_id'          => $quoteD['booked_by_id'],
            'supervisor_id'         => $quoteD['supervisor_id'],
            'date_of_service'       => $quoteD['date_of_service'],
            'time_of_service'       => $quoteD['time_of_service'],
            'booking_date'          => $quoteD['booking_date'],
            'booking_due_date'      => $quoteD['booking_due_date'],
            'service_details'       => $quoteD['service_details'],
            'booking_reference'     => $quoteD['booking_reference'],
            'booking_type_id'       => $quoteD['booking_type'],
            'supplier_currency_id'  => $quoteD['supplier_currency_id'],
            'comments'              => $quoteD['comments'],
            'estimated_cost'        => $quoteD['estimated_cost'],
            'markup_amount'         => $quoteD['markup_amount'],
            'markup_percentage'     => $quoteD['markup_percentage'],
            'selling_price'         => $quoteD['selling_price'],
            'profit_percentage'     => $quoteD['profit_percentage'],
            'estimated_cost_bc'     => $quoteD['estimated_cost_in_booking_currency'],
            'selling_price_bc'      => $quoteD['selling_price_in_booking_currency'],
            'markup_amount_bc'      => $quoteD['markup_amount_in_booking_currency'],
            'added_in_sage'         => (isset($quoteD['added_in_sage']))? (($quoteD['added_in_sage'] == "0")? '0' : '1') : '',
        ];
    }
    
    
    public function index(Request $request)
    {
      $template = Template::orderBy('id', 'DESC');
      if(count($request->all())> 0){
        if($request->has('search') && !empty($request->search)){
          $template->where('title', 'like', '%'.$request->search.'%')
          ->orWhereHas('getSeason', function($query) use($request){
            $query->where('name', $request->search);
          });
        }
        
        if($request->has('season') && !empty($request->season)){
          $template->whereHas('getSeason', function($query) use($request){
              $query->where('name', 'like', '%'.$request->season.'%' );
          });
        }
        
        if($request->has('created_by') && !empty($request->created_by)){
          $template->whereHas('getUser', function($query) use($request)
          {
              $query->where('name', $request->created_by);
          });
        }
        
        if($request->has('date') && !empty($request->date['from']) || !empty($request->date['to'])){
          $template = $template->where(function($query) use($request){
              $query->where('created_at', '>=', Carbon::createFromFormat('d/m/Y', $request->date['from'])->format('Y-m-d'))
              ->where('created_at', '<=', Carbon::createFromFormat('d/m/Y', $request->date['to'])->format('Y-m-d'));
          });
        }
      }
      $data['templates'] = $template->paginate($this->pagination);
      $data['seasons']   = Season::all();
      $data['users']     = User::all()->sortBy('name');
      
      return view('templates.listing', $data);
    }
    
    public function create()
    {
        $data['categories']       = Category::all()->sortBy('name');
        $data['supervisors']      = User::where('role_id', 5)->get()->sortBy('name');
        $data['suppliers']        = Supplier::all()->sortBy('name');
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['users']            = User::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['booking_types']    = BookingType::all();

      return view('templates.create', $data);
    }
    
    public function store(TemplateRequest $request)
    {
      $template = Template::create([
        'user_id'     => Auth::id(),
        'title'       => $request->template_name,
        'season_id'   => $request->season_id,
        'currency_id' => $request->currency_id,
        'rate_type'   => $request->rate_type,
      ]);

      foreach ($request->quote as $quote) {
        $data = $this->getQuoteDetailsArray($quote, $template->id);
        TemplateDetail::create($data);
      }

      return redirect()->route('templates.index')->with('success_message', 'Template Created Successfully');
    }
    
    public function detail($id)
    {
        $template = Template::findOrFail(decrypt($id));
        $data['template']   = $template;
        $data['currencies'] = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        return view('templates.details',$data);
    }
    
    public function destroy($id)
    {
      $template = Template::findOrFail(decrypt($id));
      $template->delete();
      return redirect()->back()->with('success_message', 'Deleted Successfully');
    }
    
    public function edit($id)
    {
        $data['template']         = Template::findOrFail(decrypt($id));
        $data['categories']       = Category::all()->sortBy('name');
        $data['supervisors']      = User::where('role_id', 5)->get()->sortBy('name');
        $data['suppliers']        = Supplier::all()->sortBy('name');
        $data['booking_methods']  = BookingMethod::all()->sortBy('id');
        $data['currencies']       = Currency::where('status', 1)->orderBy('id', 'ASC')->get();
        $data['users']            = User::all()->sortBy('name');
        $data['seasons']          = Season::all();
        $data['booked_by']        = User::all()->sortBy('name');
        $data['booking_types']    = BookingType::all();

       return view('templates.edit', $data);
    }
    
    public function update(TemplateRequest $request, $id)
    {
      $template = Template::findOrFail(decrypt($id));
      $template->update([
        'user_id'     => Auth::id(),
        'title'       => $request->template_name,
        'season_id'   => $request->season_id,
        'currency_id' => $request->currency_id,
        'rate_type'   => $request->rate_type,
      ]);
      $template->getDetails()->delete();
  
      foreach ($request->quote as $quote) {
        $data = $this->getQuoteDetailsArray($quote, $template->id);
        TemplateDetail::create($data);
      }
        
      return redirect()->route('templates.index')->with('success_message', 'Template Successfully Updated');
        
    }
    
  
    
}
