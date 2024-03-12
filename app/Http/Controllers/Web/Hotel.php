<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Provincy;
use App\Models\HotelPosition;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Hotel extends Controller
{
    public function index(Request $request, $province=null)
    {
        $activeBuscar = true;
        $provinceSelect = null;
        if(isset($province)) {
            $provinceSelect = Provincy::where('name_slug', $province)->first();
        }

        $data = getSeo(4);
        $title = $data['title'];
        $description =  $data['description'];

        $provincies = Provincy::where('id','>',0)->get();

        if(isset($provinceSelect)) {
            $hotelPositions = HotelPosition::where('province_id', $provinceSelect->id)
                ->get();
        } else {
            $hotelPositions = HotelPosition::get();
        }

        $dateNow = Carbon::now()->format('Y-m-d');

        foreach($hotelPositions as $hotelPosition) {
            if(is_numeric($hotelPosition->name)){
                if($hotelPosition->name<=20){
                    $positions20[$hotelPosition->name] = null;
                    $view = false;
                    if($hotelPosition->in_used == 1 && $hotelPosition->hotel->visible) {
                        if(!isset($hotelPosition->hotel->invoice) && !isset($hotelPosition->hotel->date_start) && !isset($hotelPosition->hotel->date_end)) {
                            $view = true;
                        } else if (!isset($hotelPosition->hotel->invoice) && isset($hotelPosition->hotel->date_start) && isset($hotelPosition->hotel->date_end)
                            && ($hotelPosition->hotel->date_start<=$dateNow && $hotelPosition->hotel->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($hotelPosition->hotel->invoice) && isset($hotelPosition->hotel->date_start) && isset($hotelPosition->hotel->date_end)
                            && ($hotelPosition->hotel->date_start<=$dateNow && $hotelPosition->hotel->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positions20[$hotelPosition->name] = $hotelPosition->hotel;
                        }
                    }
                } else {
                    $positionsOther20[$hotelPosition->name] = null;
                    $view = false;
                    if($hotelPosition->in_used == 1 && $hotelPosition->hotel->visible) {
                        if(!isset($hotelPosition->hotel->invoice) && !isset($hotelPosition->hotel->date_start) && !isset($hotelPosition->hotel->date_end)) {
                            $view = true;
                        } else if (!isset($hotelPosition->hotel->invoice) && isset($hotelPosition->hotel->date_start) && isset($hotelPosition->hotel->date_end)
                            && ($hotelPosition->hotel->date_start<=$dateNow && $hotelPosition->hotel->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($hotelPosition->hotel->invoice) && isset($hotelPosition->hotel->date_start) && isset($hotelPosition->hotel->date_end)
                            && ($hotelPosition->hotel->date_start<=$dateNow && $hotelPosition->hotel->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positionsOther20[$hotelPosition->name] = $hotelPosition->hotel;
                        }
                    }
                }
            } else {
                $positionsLetter[$hotelPosition->name] = null;
                $view = false;
                if($hotelPosition->in_used == 1 && $hotelPosition->hotel->visible) {
                    if(!isset($hotelPosition->hotel->invoice) && !isset($hotelPosition->hotel->date_start) && !isset($hotelPosition->hotel->date_end)) {
                        $view = true;
                    } else if (!isset($hotelPosition->hotel->invoice) && isset($hotelPosition->hotel->date_start) && isset($hotelPosition->hotel->date_end)
                        && ($hotelPosition->hotel->date_start<=$dateNow && $hotelPosition->hotel->date_end >= $dateNow )) {
                        $view = true;
                    } else if (isset($hotelPosition->hotel->invoice) && isset($hotelPosition->hotel->date_start) && isset($hotelPosition->hotel->date_end)
                        && ($hotelPosition->hotel->date_start<=$dateNow && $hotelPosition->hotel->date_end>= $dateNow )) {
                        $view = true;
                    }

                    if($view) {
                        $positionsLetter[$hotelPosition->name] = $hotelPosition->hotel;
                    }
                }
            }
        }

        $categoryBlogHotel = BlogCategory::where('name_slug', 'hoteles')->first();
        $postsHotels = Blog::where('category_id', $categoryBlogHotel->id)
            ->orderBy('created_at', 'DESC')
            ->take(3)
            ->get();

        return view('web.hotels', compact(
                'positions20',
                'positionsOther20',
                'positionsLetter',
                'provincies',
                'provinceSelect',
                'activeBuscar',
                'postsHotels',
                'title',
                'description')
        );
    }
}
