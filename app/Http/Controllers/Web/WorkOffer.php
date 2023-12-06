<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Provincy;
use App\Models\WorkOfferPosition;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkOffer extends Controller
{
    public function index(Request $request, $province=null)
    {
        $activeBuscar = true;
        $provinceSelect = null;
        if(isset($province)) {
            $provinceSelect = Provincy::where('name_slug', $province)->first();
        }

        $data = getSeo(6);
        $title = $data['title'];
        $description =  $data['description'];

        $provincies = Provincy::where('id','>',0)->get();

        if(isset($provinceSelect)) {
            $workOfferPositions = WorkOfferPosition::where('province_id', $provinceSelect->id)
                ->get();
        } else {
            $workOfferPositions = WorkOfferPosition::get();
        }

        $dateNow = Carbon::now()->format('Y-m-d');
        foreach($workOfferPositions as $workOfferPosition) {
            if(is_numeric($workOfferPosition->name)){
                if($workOfferPosition->name<=20){
                    $positions20[$workOfferPosition->name] = null;
                    $view = false;
                    if($workOfferPosition->in_used == 1 && $workOfferPosition->workoffer->visible) {
                        if(!isset($workOfferPosition->workoffer->invoice) && !isset($workOfferPosition->workoffer->date_start) && !isset($workOfferPosition->workoffer->date_end)) {
                            $view = true;
                        } else if (!isset($workOfferPosition->workoffer->invoice) && isset($workOfferPosition->workoffer->date_start) && isset($workOfferPosition->workoffer->date_end)
                            && ($workOfferPosition->workoffer->date_start<=$dateNow && $workOfferPosition->workoffer->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($workOfferPosition->workoffer->invoice) && isset($workOfferPosition->workoffer->date_start) && isset($workOfferPosition->workoffer->date_end)
                            && ($workOfferPosition->workoffer->date_start<=$dateNow && $workOfferPosition->workoffer->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positions20[$workOfferPosition->name] = $workOfferPosition->workoffer;
                        }
                    }
                } else {
                    $positionsOther20[$workOfferPosition->name] = null;
                    $view = false;
                    if($workOfferPosition->in_used == 1 && $workOfferPosition->workoffer->visible) {
                        if(!isset($workOfferPosition->workoffer->invoice) && !isset($workOfferPosition->workoffer->date_start) && !isset($workOfferPosition->workoffer->date_end)) {
                            $view = true;
                        } else if (!isset($workOfferPosition->workoffer->invoice) && isset($workOfferPosition->workoffer->date_start) && isset($workOfferPosition->workoffer->date_end)
                            && ($workOfferPosition->workoffer->date_start<=$dateNow && $workOfferPosition->workoffer->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($workOfferPosition->workoffer->invoice) && isset($workOfferPosition->workoffer->date_start) && isset($workOfferPosition->workoffer->date_end)
                            && ($workOfferPosition->workoffer->date_start<=$dateNow && $workOfferPosition->workoffer->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positionsOther20[$workOfferPosition->name] = $workOfferPosition->workoffer;
                        }
                    }
                }
            } else {
                $positionsLetter[$workOfferPosition->name] = null;
                $view = false;
                if($workOfferPosition->in_used == 1 && $workOfferPosition->workoffer->visible) {
                    if(!isset($workOfferPosition->workoffer->invoice) && !isset($workOfferPosition->workoffer->date_start) && !isset($workOfferPosition->workoffer->date_end)) {
                        $view = true;
                    } else if (!isset($workOfferPosition->workoffer->invoice) && isset($workOfferPosition->workoffer->date_start) && isset($workOfferPosition->workoffer->date_end)
                        && ($workOfferPosition->workoffer->date_start<=$dateNow && $workOfferPosition->workoffer->date_end >= $dateNow )) {
                        $view = true;
                    } else if (isset($workOfferPosition->workoffer->invoice) && isset($workOfferPosition->workoffer->date_start) && isset($workOfferPosition->workoffer->date_end)
                        && ($workOfferPosition->workoffer->date_start<=$dateNow && $workOfferPosition->workoffer->date_end>= $dateNow )) {
                        $view = true;
                    }

                    if($view) {
                        $positionsLetter[$workOfferPosition->name] = $workOfferPosition->workoffer;
                    }
                }
            }

        }

        $categoryBlogWorkOffer = BlogCategory::where('name_slug', 'ofertas-de-empleo')->first();
        $postsWorkOffer = Blog::where('category_id', $categoryBlogWorkOffer->id)
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        return view('web.work_offers', compact(
                'positions20',
                'positionsOther20',
                'positionsLetter',
                'provincies',
                'provinceSelect',
                'activeBuscar',
                'postsWorkOffer',
                'title',
                'description')
        );
    }
}
