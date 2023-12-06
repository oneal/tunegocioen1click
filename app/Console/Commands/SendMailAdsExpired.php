<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\BlogsAd;
use App\Models\Home;
use App\Models\Hotel;
use App\Models\Professional;
use App\Models\Restaurant;
use App\Models\Store;
use App\Models\WorkOffer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailAdsExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmailexpired:ads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$dateNow = Carbon::now();
        $dateNow = Carbon::createFromFormat('Y-m-d', '2023-03-26');
        $homes = Home::where('visible', 1)->where('invoice_id', '>=', 0)->get();
        if(isset($homes)){
            foreach ($homes as $home) {
                if(isset($home->invoice) && $home->invoice->paid == 1){
                    $this->sendMail($home, $dateNow, $home->date_end);
                }
            }
        }

        $hotels = Hotel::where('visible', 1)->where('invoice_id', '>=', 0)->get();
        if(isset($hotels)){
            foreach ($hotels as $hotel) {
                if(isset($hotel->invoice) && $hotel->invoice->paid == 1){
                    $this->sendMail($hotels, $dateNow, $hotel->date_end);
                }
            }
        }

        $professionals = Professional::where('visible', 1)->where('invoice_id', '>=', 0)->get();
        if(isset($professionals)){
            foreach ($professionals as $professional) {
                if(isset($professional->invoice) && $professional->invoice->paid == 1){
                    $this->sendMail($professional, $dateNow, $professional->date_end);
                }
            }
        }

        $restaurants = Restaurant::where('visible', 1)->where('invoice_id', '>=', 0)->get();
        if(isset($restaurants)){
            foreach ($restaurants as $restaurant) {
                if(isset($restaurant->invoice) && $restaurant->invoice->paid == 1){
                    $this->sendMail($restaurant, $dateNow, $restaurant->date_end);
                }
            }
        }

        $stores = Store::where('visible', 1)->where('invoice_id', '>=', 0)->get();
        if(isset($stores)){
            foreach ($stores as $store) {
                if(isset($store->invoice) && $store->invoice->paid == 1){
                    $this->sendMail($store, $dateNow, $store->date_end);
                }
            }
        }

        $workOffers = WorkOffer::where('visible', 1)->where('invoice_id', '>=', 0)->get();
        if(isset($workOffers)){
            foreach ($workOffers as $workOffer) {
                if(isset($workOffer->invoice) && $workOffer->invoice->paid == 1){
                    $this->sendMail($workOffer, $dateNow, $workOffer->date_end);
                }
            }
        }

        $blogAds = \App\Models\BlogsAd::where('visible', 1)->where('invoice_id', '>=', 0)->get();
        if(isset($blogAds)){
            foreach ($blogAds as $blogAd) {
                if(isset($blogAd->invoice) && $blogAd->invoice->paid == 1){
                    $this->sendMail($blogAd, $dateNow, $blogAd->date_end);
                }
            }
        }
    }

    private function sendMail($data,$dateNow, $dateEnd){
        if(!$data->send_email_expired_15_days){
            if ($dateNow->diff($dateEnd)->days == 15) {
                Mail::to([$data->email,  config('mail.from.address_info')])->send(new \App\Mail\ExpiredAd($data, 15));
                $data->send_email_expired_15_days = 1;
                $data->save();
            }
        }

        if(!$data->send_email_expired_10_days) {
            if ($dateNow->diff($dateEnd)->days == 10) {
                Mail::to([$data->email,  config('mail.from.address_info')])->send(new \App\Mail\ExpiredAd($data, 10));
                $data->send_email_expired_10_days = 1;
                $data->save();
            }
        }

        if(!$data->send_email_expired_5_days) {
            if ($dateNow->diff($dateEnd)->days == 5) {
                Mail::to([$data->email,  config('mail.from.address_info')])->send(new \App\Mail\ExpiredAd($data, 5));
                $data->send_email_expired_5_days = 1;
                $data->save();
            }
        }
    }
}
