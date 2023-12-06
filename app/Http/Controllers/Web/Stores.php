<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Provincy;
use App\Models\StorePosition;
use App\Models\StoreCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Stores extends Controller
{
    public function index(Request $request, $category=null, $province=null)
    {
        $activeBuscar = true;
        $categorySelect = null;
        $provinceSelect = null;
        if(isset($category) && isset($province)) {
            $categorySelect = StoreCategory::where('name_slug', $category)->first();
            $provinceSelect = Provincy::where('name_slug', $province)->first();
        } else if(isset($category) && !isset($province)) {
            $categorySelect = StoreCategory::where('name_slug', $category)->first();
            $provinceSelect = Provincy::where('name_slug', $category)->first();
        }

        $data = getSeo(3);
        $title = $data['title'];
        $description =  $data['description'];

        $provincies = Provincy::where('id','>',0)->get();
        $categories = StoreCategory::get();

        if(isset($provinceSelect) && isset($categorySelect)) {
            $storePositions = StorePosition::where('category_id', $categorySelect->id)
                ->where('province_id', $provinceSelect->id)
                ->get();
        }else if(isset($provinceSelect) && !isset($categorySelect)) {
                $storePositions = StorePosition::where('category_id', 0)
                    ->where('province_id', $provinceSelect->id)
                    ->get();
        }else if(!isset($provinceSelect) && isset($categorySelect)) {
            $storePositions = StorePosition::where('category_id', $categorySelect->id)
                ->where('province_id', 0)
                ->get();
        }else if(!isset($provinceSelect) && !isset($categorySelect)) {
            $storePositions = StorePosition::where('category_id', 0)
                ->where('province_id', 0)
                ->get();
        }

        $dateNow = Carbon::now()->format('Y-m-d');
        foreach($storePositions as $storePosition) {
            if(is_numeric($storePosition->name)){
                if($storePosition->name<=20){
                    $positions20[$storePosition->name] = null;
                    $view = false;
                    if($storePosition->in_used == 1 && $storePosition->store->visible) {
                        if(!isset($storePosition->store->invoice) && !isset($storePosition->store->date_start) && !isset($storePosition->store->date_end)) {
                            $view = true;
                        } else if (!isset($storePosition->store->invoice) && isset($storePosition->store->date_start) && isset($storePosition->store->date_end)
                            && ($storePosition->store->date_start<=$dateNow && $storePosition->store->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($storePosition->store->invoice) && isset($storePosition->store->date_start) && isset($storePosition->store->date_end)
                            && ($storePosition->store->date_start<=$dateNow && $storePosition->store->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positions20[$storePosition->name] = $storePosition->store;
                        }
                    }
                } else {
                    $positionsOther20[$storePosition->name] = null;
                    $view = false;
                    if($storePosition->in_used == 1 && $storePosition->store->visible) {
                        if(!isset($storePosition->store->invoice) && !isset($storePosition->store->date_start) && !isset($storePosition->store->date_end)) {
                            $view = true;
                        } else if (!isset($storePosition->store->invoice) && isset($storePosition->store->date_start) && isset($storePosition->store->date_end)
                            && ($storePosition->store->date_start<=$dateNow && $storePosition->store->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($storePosition->store->invoice) && isset($storePosition->store->date_start) && isset($storePosition->store->date_end)
                            && ($storePosition->store->date_start<=$dateNow && $storePosition->store->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positionsOther20[$storePosition->name] = $storePosition->store;
                        }
                    }
                }
            } else {
                $positionsLetter[$storePosition->name] = null;
                $view = false;
                if($storePosition->in_used == 1 && $storePosition->store->visible) {
                    if(!isset($storePosition->store->invoice) && !isset($storePosition->store->date_start) && !isset($storePosition->store->date_end)) {
                        $view = true;
                    } else if (!isset($storePosition->store->invoice) && isset($storePosition->store->date_start) && isset($storePosition->store->date_end)
                        && ($storePosition->store->date_start<=$dateNow && $storePosition->store->date_end >= $dateNow )) {
                        $view = true;
                    } else if (isset($storePosition->store->invoice) && isset($storePosition->store->date_start) && isset($storePosition->store->date_end)
                        && ($storePosition->store->date_start<=$dateNow && $storePosition->store->date_end>= $dateNow )) {
                        $view = true;
                    }

                    if($view) {
                        $positionsLetter[$storePosition->name] = $storePosition->store;
                    }
                }
            }
        }

        $categoryBlogStore = BlogCategory::where('name_slug', 'almacenes')->first();
        $postsStores = Blog::where('category_id', $categoryBlogStore->id)
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        return view('web.stores', compact(
                'positions20',
                'positionsOther20',
                'positionsLetter',
                'provincies',
                'categories',
                'categorySelect',
                'provinceSelect',
                'activeBuscar',
                'postsStores',
                'title',
                'description')
        );
    }
}
