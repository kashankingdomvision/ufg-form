<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helper;
use App\ReferenceCredential;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        abort(403);
        // return view('home');
    }
    
    
    public function refresh_token()
    {
        $zoho_credentials = ReferenceCredential::find(1);
        $refresh_token    = $zoho_credentials->refresh_token;
        $url = "https://accounts.zoho.com/oauth/v2/token?refresh_token=" . $refresh_token . "&client_id=1000.0VJP33J6LLOQ63896U88RWYIVJRSFD&client_secret=81212149f53ee4039b280b420835d64b8443c96a83&grant_type=refresh_token";
        $args = array('ssl' => false, 'format' => 'ARRAY');
        $response = Helper::cf_remote_request($url, $args);

        if ($response && $response['status'] == 200) {
            $body = $response['body'];
            $zoho_credentials->update(['access_token' => $body['access_token']]);
        }
        
        return "Token updated Successfully.";
    }
    
}
