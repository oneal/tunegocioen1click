<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\ProfessionalPosition;
use App\Models\ProfessionalsCategory;
use App\Models\Provincy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Professional extends Controller
{
    public function index(Request $request, $category=null, $province=null)
    {
        $activeBuscar = true;
        $categorySelect = null;
        $provinceSelect = null;

        if(isset($category) && isset($province)) {
            $categorySelect = ProfessionalsCategory::where('name_slug', $category)->first();
            $provinceSelect = Provincy::where('name_slug', $province)->first();
        } else if(isset($category) && !isset($province)) {
            $categorySelect = ProfessionalsCategory::where('name_slug', $category)->first();
            $provinceSelect = Provincy::where('name_slug', $category)->first();
        }

        $data = getSeo(3);
        $title = $data['title'];
        $description =  $data['description'];

        $provincies = Provincy::where('id','>',0)->get();
        $categories = ProfessionalsCategory::get();

        if(isset($provinceSelect) && isset($categorySelect)) {
            $professionalPositions = ProfessionalPosition::where('category_id', $categorySelect->id)
                ->where('province_id', $provinceSelect->id)
                ->get();
        } else if(isset($provinceSelect) && !isset($categorySelect)) {
            $professionalPositions = ProfessionalPosition::where('category_id', 0)
                ->where('province_id', $provinceSelect->id)
                ->get();
        } else if(!isset($provinceSelect) && isset($categorySelect)) {
            $professionalPositions = ProfessionalPosition::where('category_id', $categorySelect->id)
                ->where('province_id', 0)
                ->get();
        } else if(!isset($provinceSelect) && !isset($categorySelect)) {
            $professionalPositions = ProfessionalPosition::where('category_id', 0)
                ->where('province_id', 0)
                ->get();
        }

        $dateNow = Carbon::now()->format('Y-m-d');
        foreach($professionalPositions as $professionalPosition) {
            if(is_numeric($professionalPosition->name)){
                if($professionalPosition->name<=20){
                    $positions20[$professionalPosition->name] = null;
                    $view = false;
                    if($professionalPosition->in_used == 1 && $professionalPosition->professional->visible) {
                        if(!isset($professionalPosition->professional->invoice) && !isset($professionalPosition->professional->date_start) && !isset($professionalPosition->professional->date_end)) {
                            $view = true;
                        } else if (!isset($professionalPosition->professional->invoice) && isset($professionalPosition->professional->date_start) && isset($professionalPosition->professional->date_end)
                            && ($professionalPosition->professional->date_start<=$dateNow && $professionalPosition->professional->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($professionalPosition->professional->invoice) && isset($professionalPosition->professional->date_start) && isset($professionalPosition->professional->date_end)
                            && ($professionalPosition->professional->date_start<=$dateNow && $professionalPosition->professional->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positions20[$professionalPosition->name] = $professionalPosition->professional;
                        }
                    }
                } else {
                    $positionsOther20[$professionalPosition->name] = null;
                    $view = false;
                    if($professionalPosition->in_used == 1 && $professionalPosition->professional->visible) {
                        if(!isset($professionalPosition->professional->invoice) && !isset($professionalPosition->professional->date_start) && !isset($professionalPosition->professional->date_end)) {
                            $view = true;
                        } else if (!isset($professionalPosition->professional->invoice) && isset($professionalPosition->professional->date_start) && isset($professionalPosition->professional->date_end)
                            && ($professionalPosition->professional->date_start<=$dateNow && $professionalPosition->professional->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($professionalPosition->professional->invoice) && isset($professionalPosition->professional->date_start) && isset($professionalPosition->professional->date_end)
                            && ($professionalPosition->professional->date_start<=$dateNow && $professionalPosition->professional->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positionsOther20[$professionalPosition->name] = $professionalPosition->professional;
                        }
                    }
                }
            } else {
                $positionsLetter[$professionalPosition->name] = null;
                $view = false;
                if($professionalPosition->in_used == 1 && $professionalPosition->professional->visible) {
                    if(!isset($professionalPosition->professional->invoice) && !isset($professionalPosition->professional->date_start) && !isset($professionalPosition->professional->date_end)) {
                        $view = true;
                    } else if (!isset($professionalPosition->professional->invoice) && isset($professionalPosition->professional->date_start) && isset($professionalPosition->professional->date_end)
                        && ($professionalPosition->professional->date_start<=$dateNow && $professionalPosition->professional->date_end >= $dateNow )) {
                        $view = true;
                    } else if (isset($professionalPosition->professional->invoice) && isset($professionalPosition->professional->date_start) && isset($professionalPosition->professional->date_end)
                        && ($professionalPosition->professional->date_start<=$dateNow && $professionalPosition->professional->date_end>= $dateNow )) {
                        $view = true;
                    }

                    if($view) {
                        $positionsLetter[$professionalPosition->name] = $professionalPosition->professional;
                    }
                }
            }
        }

        $categoryBlogProfessional = BlogCategory::where('name_slug', 'profesionales')->first();
        $postsProfessionals = Blog::where('category_id', $categoryBlogProfessional->id)
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();


        return view('web.professionals', compact(
            'positions20',
            'positionsOther20',
            'positionsLetter',
            'provincies',
            'categories',
            'categorySelect',
            'provinceSelect',
            'activeBuscar',
            'postsProfessionals',
            'title',
            'description')
        );
    }
}
