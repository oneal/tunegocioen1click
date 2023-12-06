<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\HomePosition;
use App\Models\SeoMeta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index(Request $request)
    {
        $activeHome = true;
        $homePositions = HomePosition::get();
        $dateNow = Carbon::now()->format('Y-m-d');

        $data = getSeo(1);
        $title = $data['title'];
        $description =  $data['description'];

        foreach($homePositions as $homePosition) {
            if(is_numeric($homePosition->name)){
                if($homePosition->name<=20){
                    $positions20[$homePosition->name] = null;
                    $view = false;
                    if($homePosition->in_used == 1 && $homePosition->home->visible) {
                        if(!isset($homePosition->home->invoice) && !isset($homePosition->home->date_start) && !isset($homePosition->home->date_end)) {
                            $view = true;
                        } else if (!isset($homePosition->home->invoice) && isset($homePosition->home->date_start) && isset($homePosition->home->date_end)
                            && ($homePosition->home->date_start<=$dateNow && $homePosition->home->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($homePosition->home->invoice) && isset($homePosition->home->date_start) && isset($homePosition->home->date_end)
                            && ($homePosition->home->date_start<=$dateNow && $homePosition->home->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positions20[$homePosition->name] = $homePosition->home;
                        }
                    }
                } else {
                    $positionsOther20[$homePosition->name] = null;
                    $view = false;
                    if($homePosition->in_used == 1 && $homePosition->home->visible) {
                        if(!isset($homePosition->home->invoice) && !isset($homePosition->home->date_start) && !isset($homePosition->home->date_end)) {
                            $view = true;
                        } else if (!isset($homePosition->home->invoice) && isset($homePosition->home->date_start) && isset($homePosition->home->date_end)
                            && ($homePosition->home->date_start<=$dateNow && $homePosition->home->date_end >= $dateNow )) {
                            $view = true;
                        } else if (isset($homePosition->home->invoice) && isset($homePosition->home->date_start) && isset($homePosition->home->date_end)
                            && ($homePosition->home->date_start<=$dateNow && $homePosition->home->date_end>= $dateNow )) {
                            $view = true;
                        }

                        if($view) {
                            $positionsOther20[$homePosition->name] = $homePosition->home;
                        }
                    }
                }
            } else {
                $positionsLetter[$homePosition->name] = null;
                $view = false;
                if($homePosition->in_used == 1 && $homePosition->home->visible) {
                    if(!isset($homePosition->home->invoice) && !isset($homePosition->home->date_start) && !isset($homePosition->home->date_end)) {
                        $view = true;
                    } else if (!isset($homePosition->home->invoice) && isset($homePosition->home->date_start) && isset($homePosition->home->date_end)
                        && ($homePosition->home->date_start<=$dateNow && $homePosition->home->date_end >= $dateNow )) {
                        $view = true;
                    } else if (isset($homePosition->home->invoice) && isset($homePosition->home->date_start) && isset($homePosition->home->date_end)
                        && ($homePosition->home->date_start<=$dateNow && $homePosition->home->date_end>= $dateNow )) {
                        $view = true;
                    }

                    if($view) {
                        $positionsLetter[$homePosition->name] = $homePosition->home;
                    }
                }
            }
        }

        return view('web.home', compact('positions20', 'positionsOther20', 'positionsLetter', 'activeHome', 'title', 'description'));
    }
}
