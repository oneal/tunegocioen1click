<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Provincy;
use App\Models\RestaurantPosition;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Restaurant extends Controller
{
    public function index(Request $request, $province=null)
    {
        $activeBuscar = true;
        $provinceSelect = null;
        if(isset($province)) {
            $provinceSelect = Provincy::where('name_slug', $province)->first();
        }

        $data = getSeo(5);
        $title = $data['title'];
        $description =  $data['description'];

        $provincies = Provincy::where('id','>',0)->get();

        if(isset($provinceSelect)) {
            $restaurantPositions = RestaurantPosition::where('province_id', $provinceSelect->id)
                ->get();
        } else {
            $restaurantPositions = RestaurantPosition::get();
        }

        $dateNow = Carbon::now()->format('Y-m-d');
        foreach($restaurantPositions as $restaurantPosition) {
            if(is_numeric($restaurantPosition->name)){
                if($restaurantPosition->name<=20){
                    $positions20[$restaurantPosition->name] = null;
                    $view = false;
                    if($restaurantPosition->in_used == 1 && $restaurantPosition->restaurant->visible) {
                        if(!isset($restaurantPosition->restaurant->invoice) && !isset($restaurantPosition->restaurant->date_start) && !isset($restaurantPosition->restaurant->date_end)) {
                            $view = true;
                        } else if (!isset($restaurantPosition->restaurant->invoice) && isset($restaurantPosition->restaurant->date_start) && isset($restaurantPosition->restaurant->date_end)
                            && ($restaurantPosition->restaurant->date_start<=$dateNow && $restaurantPosition->restaurant->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($restaurantPosition->restaurant->invoice) && isset($restaurantPosition->restaurant->date_start) && isset($restaurantPosition->restaurant->date_end)
                            && ($restaurantPosition->restaurant->date_start<=$dateNow && $restaurantPosition->restaurant->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positions20[$restaurantPosition->name] = $restaurantPosition->restaurant;
                        }
                    }
                } else {
                    $positionsOther20[$restaurantPosition->name] = null;
                    $view = false;
                    if($restaurantPosition->in_used == 1 && $restaurantPosition->restaurant->visible) {
                        if(!isset($restaurantPosition->restaurant->invoice) && !isset($restaurantPosition->restaurant->date_start) && !isset($restaurantPosition->restaurant->date_end)) {
                            $view = true;
                        } else if (!isset($restaurantPosition->restaurant->invoice) && isset($restaurantPosition->restaurant->date_start) && isset($restaurantPosition->restaurant->date_end)
                            && ($restaurantPosition->restaurant->date_start<=$dateNow && $restaurantPosition->restaurant->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($restaurantPosition->restaurant->invoice) && isset($restaurantPosition->restaurant->date_start) && isset($restaurantPosition->restaurant->date_end)
                            && ($restaurantPosition->restaurant->date_start<=$dateNow && $restaurantPosition->restaurant->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positionsOther20[$restaurantPosition->name] = $restaurantPosition->restaurant;
                        }
                    }
                }
            } else {
                $positionsLetter[$restaurantPosition->name] = null;
                $view = false;
                if($restaurantPosition->in_used == 1 && $restaurantPosition->restaurant->visible) {
                    if(!isset($restaurantPosition->restaurant->invoice) && !isset($restaurantPosition->restaurant->date_start) && !isset($restaurantPosition->restaurant->date_end)) {
                        $view = true;
                    } else if (!isset($restaurantPosition->restaurant->invoice) && isset($restaurantPosition->restaurant->date_start) && isset($restaurantPosition->restaurant->date_end)
                        && ($restaurantPosition->restaurant->date_start<=$dateNow && $restaurantPosition->restaurant->date_end >= $dateNow )) {
                        $view = true;
                    } else if (isset($restaurantPosition->restaurant->invoice) && isset($restaurantPosition->restaurant->date_start) && isset($restaurantPosition->restaurant->date_end)
                        && ($restaurantPosition->restaurant->date_start<=$dateNow && $restaurantPosition->restaurant->date_end>= $dateNow )) {
                        $view = true;
                    }

                    if($view) {
                        $positionsLetter[$restaurantPosition->name] = $restaurantPosition->restaurant;
                    }
                }
            }
        }

        $categoryBlogRestaurant = BlogCategory::where('name_slug', 'bares-restaurantes')->first();
        $postsRestaurants = Blog::where('category_id', $categoryBlogRestaurant->id)
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        return view('web.restaurants', compact(
                'positions20',
                'positionsOther20',
                'positionsLetter',
                'provincies',
                'provinceSelect',
                'activeBuscar',
                'postsRestaurants',
                'title',
                'description')
        );
    }
}
