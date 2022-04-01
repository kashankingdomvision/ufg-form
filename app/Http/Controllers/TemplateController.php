<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TemplateRequest;
use App\Http\Requests\QuoteTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Helper;
use App\BookingType;
use App\BookingMethod;
use App\Category;
use App\Currency;
use App\Supplier;
use App\Season;
use App\Template;
use App\TemplateDetail;
use App\User;
use App\PresetComment;
use App\StoreText;

class TemplateController extends Controller
{
  public $pagination = 10;

  public function __Construct()
  {       
    $this->pagination = 10;
  }
  
  public function getTemplateDetailsArray($quoteD, $template)
  {
    return [
      'template_id'           => isset($template->id) && !empty($template->id) ? $template->id : NULL,
      'category_id'           => $quoteD['category_id'],
      'supplier_id'           => (isset($quoteD['supplier_id']))? $quoteD['supplier_id'] : NULL ,
      'product_id'            => (isset($quoteD['product_id']))? $quoteD['product_id'] : NULL,
      // 'booking_method_id'     => $quoteD['booking_method_id'],
      // 'booked_by_id'          => $quoteD['booked_by_id'],
      // 'supervisor_id'         => $quoteD['supervisor_id'],
      'date_of_service'       => $quoteD['date_of_service'],
      'end_date_of_service'   => $quoteD['end_date_of_service'],
      'number_of_nights'      => $quoteD['number_of_nights'],
      'time_of_service'       => $quoteD['time_of_service'],
      // 'booking_date'          => $quoteD['booking_date'],
      // 'booking_due_date'      => $quoteD['booking_due_date'],
      'service_details'       => $quoteD['service_details'],
      // 'booking_reference'     => $quoteD['booking_reference'],
      'booking_type_id'       => $quoteD['booking_type_id']??$quoteD['booking_type_id'],
      'refundable_percentage' => (!is_null($quoteD['booking_type_id']) && $quoteD['booking_type_id'] == 2) ? $quoteD['refundable_percentage'] : NULL,
      'supplier_currency_id'  => $quoteD['supplier_currency_id'],
      'comments'              => $quoteD['comments'],
      'image'                 => isset($quoteD['image']) ? $quoteD['image'] : '',
      'estimated_cost'        => $quoteD['estimated_cost'],
      'markup_amount'         => isset($template->markup_type) && $template->markup_type == 'itemised' ? $quoteD['markup_amount'] : NULL,
      'markup_percentage'     => isset($template->markup_type) && $template->markup_type == 'itemised' ? $quoteD['markup_percentage'] : NULL,
      'selling_price'         => isset($template->markup_type) && $template->markup_type == 'itemised' ? $quoteD['selling_price'] : NULL,
      'profit_percentage'     => isset($template->markup_type) && $template->markup_type == 'itemised' ? $quoteD['profit_percentage'] : NULL,
      'estimated_cost_bc'     => $quoteD['estimated_cost_in_booking_currency']??$quoteD['estimated_cost_bc'],
      'selling_price_in_booking_currency'      => isset($template->markup_type) && $template->markup_type == 'itemised' ? $quoteD['selling_price_in_booking_currency'] : NULL,
      'markup_amount_in_booking_currency'      => isset($template->markup_type) && $template->markup_type == 'itemised' ? $quoteD['markup_amount_in_booking_currency'] : NULL,
      'category_details'      => $quoteD['category_details']??$quoteD['category_details'],
      'stored_text'           => isset($quoteD['stored_text']['text']) ? $quoteD['stored_text']['text'] : '',
      'action_date'           => isset($quoteD['stored_text']['date']) ? $quoteD['stored_text']['date'] : '',
      // 'added_in_sage'           => isset($quoteD['added_in_sage']) && !empty($quoteD['added_in_sage']) ? : 0,
    ];
  }
  
  
  public function index(Request $request)
  {
    $template          = Template::public()->orderBy('id', 'DESC');
    $private_templates = Template::private()->orderBy('id', 'DESC');

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
      
      $template->when($request->dates, function ($query) use ($request) {

        $dates = Helper::dates($request->dates);

        $query->whereDate('created_at', '>=', $dates->start_date);
        $query->whereDate('created_at', '<=', $dates->end_date);
      });
    }

    if(count($request->all())> 0){
      if($request->has('search') && !empty($request->search)){
        $private_templates->where('title', 'like', '%'.$request->search.'%')
        ->orWhereHas('getSeason', function($query) use($request){
          $query->where('name', $request->search);
        });
      }
      
      if($request->has('season') && !empty($request->season)){
        $private_templates->whereHas('getSeason', function($query) use($request){
            $query->where('name', 'like', '%'.$request->season.'%' );
        });
      }
      
      if($request->has('created_by') && !empty($request->created_by)){
        $private_templates->whereHas('getUser', function($query) use($request)
        {
            $query->where('name', $request->created_by);
        });
      }
      
      $private_templates->when($request->dates, function ($query) use ($request) {

        $dates = Helper::dates($request->dates);

        $query->whereDate('created_at', '>=', $dates->start_date);
        $query->whereDate('created_at', '<=', $dates->end_date);
      });
    }

    $data['templates']         = $template->get();
    $data['private_templates'] = $private_templates->get();
    $data['seasons']           = Season::all();
    $data['users']             = User::all()->sortBy('name');
    
    return view('templates.listing', $data);
  }
    
  public function create()
  {
    $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
    $data['supervisors']      = User::where('role_id', 5)->get()->sortBy('name');
    $data['suppliers']        = Supplier::all()->sortBy('name');
    $data['booking_methods']  = BookingMethod::all()->sortBy('id');
    $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
    $data['users']            = User::all()->sortBy('name');
    $data['seasons']          = Season::all();
    $data['booked_by']        = User::all()->sortBy('name');
    $data['booking_types']    = BookingType::all();
    $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();
    $data['storetexts']       = StoreText::get();

    return view('templates.create', $data);
  }
    
  public function store(TemplateRequest $request)
  {

    // dd($request->all());

    $template = Template::create([
      'user_id'        => Auth::id(),
      'title'          => $request->template_name,
      'season_id'      => $request->season_id,
      'currency_id'    => $request->currency_id,
      'rate_type'      => $request->rate_type,
      'markup_type'    => $request->markup_type,
      'privacy_status' => $request->privacy_status
    ]);
    
    foreach ($request->quote as $quote) {
      $data = $this->getTemplateDetailsArray($quote, $template);
      TemplateDetail::create($data);
    }

    return response()->json([ 
      'status'          => true, 
      'success_message' => 'Template Created Successfully.',
      'redirect_url'    => route('templates.index') 
    ]);
  }

  public function store_for_quote(QuoteTemplateRequest $request)
  {

    $template = Template::create([
      'user_id'        => Auth::id(),
      'title'          => $request->template_name,
      'season_id'      => $request->season_id,
      'currency_id'    => $request->currency_id,
      'rate_type'      => $request->rate_type,
      'markup_type'    => $request->markup_type,
      'privacy_status' => $request->privacy_status
    ]);
    
    foreach ($request->quote as $quote) {
      $data = $this->getTemplateDetailsArray($quote, $template);
      TemplateDetail::create($data);
    }

    return response()->json([ 
      'status'          => true, 
      'success_message' => 'Template Created Successfully.',
      'redirect_url'    => route('templates.index') 
    ]);
  }
    
  public function detail($id)
  {
    $template = Template::findOrFail(decrypt($id));
    $data['template']   = $template;
    $data['currencies'] = Currency::active()->orderBy('id', 'ASC')->get();

    return view('templates.details',$data);
  }
    
  public function destroy($id)
  {
    Template::destroy(decrypt($id));
    return redirect()->back()->with('success_message', 'Template Deleted Successfully');
  }
    
  public function edit($id)
  {
    $data['template']         = Template::findOrFail(decrypt($id));
    $data['categories']       = Category::orderby('sort_order', 'ASC')->get();
    $data['supervisors']      = User::role(['supervisor'])->get()->sortBy('name');
    $data['suppliers']        = Supplier::all()->sortBy('name');
    $data['booking_methods']  = BookingMethod::all()->sortBy('id');
    $data['currencies']       = Currency::active()->orderBy('id', 'ASC')->get();
    $data['users']            = User::all()->sortBy('name');
    $data['seasons']          = Season::all();
    $data['booked_by']        = User::all()->sortBy('name');
    $data['booking_types']    = BookingType::all();
    $data['storetexts']       = StoreText::get();
    $data['preset_comments']  = PresetComment::orderBy('created_at','DESC')->get();

    return view('templates.edit', $data);
  }
    
  public function update(UpdateTemplateRequest $request, $id)
  {
    $template = Template::findOrFail(decrypt($id));

    $template->update([
      'user_id'        => Auth::id(),
      'title'          => $request->template_name,
      'season_id'      => $request->season_id,
      'currency_id'    => $request->currency_id,
      'rate_type'      => $request->rate_type,
      'markup_type'    => $request->markup_type,
      'privacy_status' => $request->privacy_status
    ]);

    $template->getDetails()->delete();

    foreach ($request->quote as $quote) {
      $data = $this->getTemplateDetailsArray($quote, $template);
      TemplateDetail::create($data);
    }
      
    return response()->json([ 
      'status'          => true, 
      'success_message' => 'Template Updated Successfully.',
      'redirect_url'    => route('templates.index') 
    ]);
  }
    
}
