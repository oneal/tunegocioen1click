<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Sitemap\SiteMap;
use App\Http\Controllers\Web\Sitemap\Url;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\ProfessionalsCategory;
use App\Models\Provincy;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Models\Professional;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\WorkOffer;
use Carbon\Carbon;

class SiteMapController extends Controller
{
    private $siteMap;

    public function index()
    {
        $this->siteMap = new SiteMap();

        $this->addHomes();
        $this->addProfessionals();
        $this->addStores();
        $this->addHotels();
        $this->addRestaurants();
        $this->addWorkOffers();
        $this->addArticles();

        return response($this->siteMap->build(), 200)
            ->header('Content-Type', 'text/xml');
    }

    private function addHomes()
    {
        $home = \App\Models\Home::latest()
            ->first();

        $this->siteMap->add(
            Url::create("/")
                ->lastUpdate((isset($home->updated_at)) ? $home->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                ->frequency('monthly')
                ->priority('0.9')
        );
    }

    private function addProfessionals()
    {
        $professionals = Professional::whereNull('category_id')
            ->whereNull('province_id')->latest()
            ->first();

        $this->siteMap->add(
            Url::create("/profesionales")
                ->lastUpdate((isset($professionals->updated_at)) ? $professionals->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                ->frequency('monthly')
                ->priority('0.9')
        );

        $professionalCategories = ProfessionalsCategory::get();

        if($professionalCategories->count() > 0){
            $provincies = Provincy::where('id', '>', 0)->get();
            foreach ($professionalCategories as $professionalCategory) {
                foreach ($provincies as $provincy){
                    $professional = Professional::where('category_id', $professionalCategory->id)
                        ->where('province_id', $provincy->id)->latest()
                        ->first();
                    $this->siteMap->add(
                        Url::create("/profesionales/$professionalCategory->name_slug/$provincy->name_slug")
                            ->lastUpdate((isset($professional->updated_at)) ? $professional->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                            ->frequency('monthly')
                            ->priority('0.8')
                    );
                }
            }
        }
    }

    private function addStores()
    {
        $stores = Store::whereNull('category_id')
            ->whereNull('province_id')->latest()
            ->first();

        $this->siteMap->add(
            Url::create("/almacenes")
                ->lastUpdate((isset($stores->updated_at)) ? $stores->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                ->frequency('monthly')
                ->priority('0.9')
        );

        $storeCategories = StoreCategory::get();

        if($storeCategories->count() > 0){
            $provincies = Provincy::where('id', '>', 0)->get();
            foreach ($storeCategories as $storeCategory) {
                foreach ($provincies as $provincy){
                    $store = Store::where('category_id', $storeCategory->id)
                        ->where('province_id', $provincy->id)->latest()
                        ->first();

                    $this->siteMap->add(
                        Url::create("/almacenes/$storeCategory->name_slug/$provincy->name_slug")
                            ->lastUpdate((isset($store->updated_at)) ? $store->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                            ->frequency('monthly')
                            ->priority('0.8')
                    );
                }
            }
        }
    }

    private function addHotels()
    {
        $hotels = Hotel::whereNull('province_id')->latest()
            ->first();

        $this->siteMap->add(
            Url::create("/hoteles")
                ->lastUpdate((isset($hotels->updated_at)) ? $hotels->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                ->frequency('monthly')
                ->priority('0.9')
        );

        $provincies = Provincy::where('id', '>', 0)->get();
        foreach ($provincies as $provincy){
            $hotel = Hotel::where('province_id', $provincy->id)->latest()
                ->first();

            $this->siteMap->add(
                Url::create("/hoteles/$provincy->name_slug")
                    ->lastUpdate((isset($hotel->updated_at)) ? $hotel->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                    ->frequency('monthly')
                    ->priority('0.8')
            );
        }
    }

    private function addRestaurants()
    {
        $restaurants = Restaurant::whereNull('province_id')->latest()
            ->first();

        $this->siteMap->add(
            Url::create("/bares-restaurantes")
                ->lastUpdate((isset($restaurants->updated_at)) ? $restaurants->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                ->frequency('monthly')
                ->priority('0.9')
        );

        $provincies = Provincy::where('id', '>', 0)->get();
        foreach ($provincies as $provincy){
            $restaurant = Restaurant::where('province_id', $provincy->id)->latest()
                ->first();

            $this->siteMap->add(
                Url::create("/bares-restaurantes/$provincy->name_slug")
                    ->lastUpdate((isset($restaurant->updated_at)) ? $restaurant->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                    ->frequency('monthly')
                    ->priority('0.8')
            );
        }
    }

    private function addWorkOffers()
    {
        $workOffers = WorkOffer::whereNull('province_id')->latest()
            ->first();

        $this->siteMap->add(
            Url::create("/ofertas-trabajo")
                ->lastUpdate((isset($workOffers->updated_at)) ? $workOffers->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                ->frequency('monthly')
                ->priority('0.9')
        );

        $provincies = Provincy::where('id', '>', 0)->get();
        foreach ($provincies as $provincy){
            $workOffer = WorkOffer::where('province_id', $provincy->id)->latest()
                ->first();

            $this->siteMap->add(
                Url::create("/ofertas-trabajo/$provincy->name_slug")
                    ->lastUpdate((isset($workOffer->updated_at)) ? $workOffer->updated_at->startOfMonth()->format('c') : Carbon::now()->startOfMonth()->format('c'))
                    ->frequency('monthly')
                    ->priority('0.8')
            );
        }
    }

    private function addArticles()
    {
        $categoryBlogs = BlogCategory::get();

        $this->siteMap->add(
            Url::create("/blog")
                ->lastUpdate($categoryBlogs[0]->updated_at->startOfMonth()->format('c'))
                ->frequency('monthly')
                ->priority('0.9')
        );

        foreach ($categoryBlogs as $categoryBlog) {
            $this->siteMap->add(
                Url::create("/blog/$categoryBlog->name_slug")
                    ->lastUpdate($categoryBlog->updated_at->startOfMonth()->format('c'))
                    ->frequency('monthly')
                    ->priority('0.9')
            );
        }

        $articles = Blog::whereNotNull('name_slug')->get([
            'name_slug', 'updated_at'
        ]);

        foreach ($articles as $article) {
            $this->siteMap->add(
                Url::create("/blog/$article->name_slug")
                    ->lastUpdate($article->updated_at->startOfMonth()->format('c'))
                    ->frequency('monthly')
                    ->priority('0.9')
            );
        }
    }
}
