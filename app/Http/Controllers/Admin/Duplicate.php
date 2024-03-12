<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home;
use App\Models\HomePosition;
use App\Models\Professional;
use App\Models\ProfessionalPosition;
use App\Models\ProfessionalsCategory;
use App\Models\Provincy;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\RestaurantPosition;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Models\StorePosition;
use App\Models\WorkOffer;
use App\Models\WorkOfferCategory;
use App\Models\WorkOfferPosition;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class Duplicate extends Controller
{
    private $types;
    private $typesCategories;
    private $typesPositions;
    private $typesCodes;

    public function __construct()
    {
        $this->types = [
            1 => Home::class,
            2 => Professional::class,
            3 => Store::class,
            4 => WorkOffer::class,
            5 => Restaurant::class
        ];

        $this->typesCategories = [
            2 => ProfessionalsCategory::class,
            3 => StoreCategory::class,
            4 => WorkOfferCategory::class,
            5 => RestaurantCategory::class
        ];

        $this->typesPositions = [
            1 => HomePosition::class,
            2 => ProfessionalPosition::class,
            3 => StorePosition::class,
            4 => WorkOfferPosition::class,
            5 => RestaurantPosition::class
        ];
        $this->typesCodes = [
            1 => 'HOME',
            2 => 'PROF',
            3 => 'STORE',
            4 => 'WO',
            5 => 'REST'
        ];
    }

    public function index(Request $request)
    {
        $types = [
            1 => 'Home',
            2 => 'Profesionales',
            3 => 'Almacenes',
            4 => 'Ofertas de empleo',
            5 => 'Restaurantes'
        ];

        $provincies = Provincy::where('name', '!=', 'none')->get();

        return view('voyager::duplicate.add', compact('types', 'provincies'));
    }

    public function searchDataByType(Request $request)
    {
        $model = $this->types[$request->type];

        $data = $model::select('id', 'name')->get();

        return view('voyager::duplicate.data-origen', compact('data'))->render();
    }

    public function searchCategoryByType(Request $request)
    {
        $dataCategories = null;
        if(isset($this->typesCategories[$request->dtype])) {
            $model = $this->typesCategories[$request->dtype];
            if($request->dtype != 1) {
                $dataCategories = $model::select('id', 'name')->get();
            }
        }

        return view('voyager::duplicate.data-destino-category', compact('dataCategories'))->render();
    }

    public function searchPositions(Request $request)
    {
        $dataPositions = null;
        if(isset($this->typesPositions[$request->dtype])) {
            $model = $this->typesPositions[$request->dtype];
            $categoryId = $request->get('dcategory');
            $provinceId = $request->get('dprovince');
            if($request->dtype == 1) {
                $dataPositions = $model::select('id', 'name')
                    ->where('in_used', 0)
                    ->get();
            } else {
                $dataPositions = $model::select('id', 'name')
                    ->where('category_id', $categoryId)
                    ->where('province_id', $provinceId)
                    ->where('in_used', 0)
                    ->get();
            }

        }

        return view('voyager::duplicate.data-destino-position', compact('dataPositions'))->render();
    }

    public function addDuplicate(Request $request)
    {
        \Log::info('~#~#~#~#~#~#~~1111111', [$request->all()]);
        $modelOrigen = $this->types[$request->get('types')];
        $dataOrigen = $modelOrigen::where('id', $request->data)->first();
        \Log::info('~#~#~#~#~#~#~~2222222', [$dataOrigen]);

        $categoryId = $request->get('d-category');
        $provinceId = $request->get('d-province');
        $positionId = $request->get('d-position');

        $modelDestino = $this->types[$request->get('d-types')];

        $modelDestinoPosition = $this->typesPositions[$request->get('d-types')];
        $position = $modelDestinoPosition::where('id', $positionId)->first();
        $position->update(['in_used' => 1]);

        $dataDestino = new $modelDestino;
        if($request->get('d-types') !== 1) {
            $dataDestino->category_id = $categoryId;
        }
        $dataDestino->province_id = $provinceId;
        $dataDestino->name = $dataOrigen->name;
        $dataDestino->name_slug = $dataOrigen->name_slug;
        $dataDestino->position_id = $position->id;
        $dataDestino->position_name = $position->name;
        $dataDestino->code = $this->typesCodes[$request->get('d-types')].substr(md5(time()), 0, 8);;
        $dataDestino->phone = $dataOrigen->phone;
        $dataDestino->email = $dataOrigen->email;
        $dataDestino->website = $dataOrigen->website;
        $dataDestino->description = $dataOrigen->description;
        $dataDestino->address = $dataOrigen->address;
        $dataDestino->image = $dataOrigen->image;
        $dataDestino->icon = $dataOrigen->icon;
        $dataDestino->visible = $dataOrigen->visible;
        $dataDestino->save();

        $position->update(['in_used' => $dataDestino->id]);

        return redirect()->back();
    }
}
