<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Quote;
use Carbon\Carbon;
class QuoteDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotation:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'After 30-days quote will be permanently deleted';

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
     * @return int
     */
    public function handle()
    {
        Quote::where('deleted_at','>=', Carbon::now()->subDays(30))->forceDelete();
        $this->info('quote is permanently deleted '. Carbon::now()->subDays(30) );
    }
}
