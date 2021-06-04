<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Listing;
use App\Settings;
use App\User;

use DateTime;
use Artisan;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRefreshere;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\RefreshList',
        //
    ];

    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\Administrator::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // $schedule->command('refresh:list')->everyMinute();
        
        $settings = Settings::first();
        $time = $settings->interval;
        $str = '*/'.$time.' * * * *\n';

        // $schedule->command('refresh:list')->cron($str);
        // $schedule->command('refresh:list')->everyMinute();
        
        $schedule->call(function(){
            $last = Listing::orderBy('list_order_at', 'ASC')->first();
    
            $modalType = $last['modelType'] ? $last['modelType'] : 'A';
            $link_url = "https://www.oldandyoungtimer.com/listings/".$last['type']."/".$last['listingID']."/".$last['make'].'-'.str_replace('/','',$last['model']).'-'.str_replace(' ','-',$modalType).'-'.$last['year'];
            
            // echo $link_url;
            $user_type = $last->user->type;
            $last->list_order_at = new DateTime();
            $last->save();
            echo $user_type.'   ';
            // echo "Changed {$last->listingID}\n";
            echo "italexx.ua@gmail.com\n";
            Mail::to("italexx.ua@gmail.com")->send(new SendRefreshere([
                'link_url' => $link_url,
                'user_type' => $user_type,
                'user_name' => $last->user->firstName.' '.$last->user->lastName
            ]));
            if ($user_type == 0) {
                Mail::to("contact@oldandyoungtimer.com")->send(new SendRefreshere([
                    'link_url' => $link_url,
                    'user_type' => $user_type,
                    'user_name' => $last->user->firstName.' '.$last->user->lastName
                ]));
                Mail::to($last->user->email)->send(new SendRefreshere([
                    'link_url' => $link_url,
                    'user_type' => $user_type,
                    'user_name' => $last->user->firstName.' '.$last->user->lastName
                ]));
                echo "Mail sent";
            }


            $settings = Settings::first();
            $time = $settings->interval;
            sleep($time * 60);
            Artisan::call('schedule:run');
        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}