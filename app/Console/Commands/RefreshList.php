<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Listing;
use App\Mail\SendRefreshere;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HelpController;

class RefreshList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the List and eldest advert back on page 1';

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
        $last = Listing::orderBy('list_order_at', 'ASC')->first();
        $last->list_order_at = new DateTime();
        $last->save();

        echo "Changed {$last->listingID}\n";
        echo "waiting for {$time}!\n\n";

        Mail::to("italexx.ua@gmail.com")->send(new SendRefreshere());
    }
}