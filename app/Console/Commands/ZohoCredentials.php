<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Helper;
use App\ReferenceCredential;

class ZohoCredentials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zoho:credentials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

		$zoho_credentials = ReferenceCredential::findOrFail(1);
        $refresh_token    = $zoho_credentials->refresh_token;
        $url = "https://accounts.zoho.com/oauth/v2/token?refresh_token=" . $refresh_token . "&client_id=1000.0VJP33J6LLOQ63896U88RWYIVJRSFD&client_secret=81212149f53ee4039b280b420835d64b8443c96a83&grant_type=refresh_token";
        $args = array('ssl' => false, 'format' => 'ARRAY');
   
		$response = Helper::cf_remote_request($url, $args);
        if ($response && $response['status'] == 200) {
            $body = $response['body'];
            $zoho_credentials->update(['access_token' => $body['access_token']]);
        }

		\Log::info("start new  ZohoCredentials Cron is working fine !");
    }
}
