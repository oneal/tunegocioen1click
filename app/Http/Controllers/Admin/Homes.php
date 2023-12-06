<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home;
use App\Models\HomePosition;
use App\Models\Invoice;
use App\Models\InvoiceClient;
use App\Models\InvoiceLine;
use App\Models\PriceAnnouncement;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Facades\Voyager;

class Homes extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request, $id=null)
    {
        if(isset($id)) {
            $slug = 'homes';

            $dataType = Voyager::model('DataType')->where('slug', '=', 'homes')->first();

            if (strlen($dataType->model_name) != 0) {
                $model = app($dataType->model_name);
                $query = $model->query();

                // Use withTrashed() if model uses SoftDeletes and if toggle is selected
                if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                    $query = $query->withTrashed();
                }
                if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                    $query = $query->{$dataType->scope}();
                }
                $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
            } else {
                // If Model doest exist, get data from table name
                $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
            }

            foreach ($dataType->editRows as $key => $row) {
                $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'edit');

            // Check permission
            $this->authorize('edit', $dataTypeContent);

            // Check if BREAD is Translatable
            $isModelTranslatable = is_bread_translatable($dataTypeContent);

            // Eagerload Relations
            $this->eagerLoadRelations($dataTypeContent, $dataType, 'edit', $isModelTranslatable);

            $view = "voyager::$slug.clone";

            return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
        } else {
            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Check permission
            $this->authorize('add', app($dataType->model_name));

            $dataTypeContent = (strlen($dataType->model_name) != 0)
                ? new $dataType->model_name()
                : false;

            foreach ($dataType->addRows as $key => $row) {
                $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'add');

            // Check if BREAD is Translatable
            $isModelTranslatable = is_bread_translatable($dataTypeContent);

            // Eagerload Relations
            $this->eagerLoadRelations($dataTypeContent, $dataType, 'add', $isModelTranslatable);

            $view = 'voyager::bread.edit-add';

            if (view()->exists("voyager::$slug.edit-add")) {
                $view = "voyager::$slug.edit-add";
            }

            return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
        }
    }

    /**
     * POST BRE(A)D - store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();

        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        $data->name_slug = generateSlug($data->name);
        $data->code = "HOME" . substr(md5(time()), 0, 8);
        $visibleText = "no";
        if ($data->visible == 1) {
            $visibleText = "si";
        }
        $data->visible_text = $visibleText;
        $data->save();

        $homePosition = HomePosition::find($data->position_id);
        $homePosition->home_id = $data->id;
        $homePosition->in_used = 1;
        $homePosition->save();

        $data->position_name = $homePosition->name;
        $data->save();

        event(new BreadDataAdded($dataType, $data));

        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => __('voyager::generic.successfully_added_new')." {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        $query = $model->query();
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $query = $query->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $query = $query->withTrashed();
        }

        $data = $query->findOrFail($id);

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();

        // Get fields with images to remove before updating and make a copy of $data
        $to_remove = $dataType->editRows->where('type', 'image')
            ->filter(function ($item, $key) use ($request) {
                return $request->hasFile($item->field);
            });
        $original_data = clone($data);

        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        $visibleText = "no";
        if($data->visible == 1) {
            $visibleText = "si";
        }
        $data->visible_text = $visibleText;
        $data->save();

        $homePositionOld = HomePosition::where('home_id', $data->id)->first();
        if(isset($homePositionOld)) {
            $homePositionOld->home_id = 0;
            $homePositionOld->in_used = 0;
            $homePositionOld->save();
        }

        $homePosition = HomePosition::find($data->position_id);
        $homePosition->home_id = $data->id;
        $homePosition->in_used = 1;
        $homePosition->save();

        $data->position_name = $homePosition->name;
        $data->save();

        // Delete Images
        $this->deleteBreadImages($original_data, $to_remove);

        event(new BreadDataUpdated($dataType, $data));

        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
        }

        return $redirect->with([
            'message'    => __('voyager::generic.successfully_updated')." {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Init array of IDs
        $ids = [];
        if (empty($id)) {
            // Bulk delete, get IDs from POST
            $ids = explode(',', $request->ids);
        } else {
            // Single item delete, get ID from URL
            $ids[] = $id;
        }

        $affected = null;

        foreach ($ids as $id) {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

            if(!isset($data->invoice) || $data->invoice->paid) {
                // Check permission
                $this->authorize('delete', $data);

                $model = app($dataType->model_name);
                if (!($model && in_array(SoftDeletes::class, class_uses_recursive($model)))) {
                    $this->cleanup($dataType, $data);
                }

                $res = $data->delete();

                $homePosition = HomePosition::where('home_id', $id)->first();
                $homePosition->home_id = 0;
                $homePosition->in_used = 0;
                $homePosition->save();


                if ($res) {
                    $affected++;
                    event(new BreadDataDeleted($dataType, $data));
                }
            }
        }

        $displayName = $affected > 1 ? $dataType->getTranslatedAttribute('display_name_plural') : $dataType->getTranslatedAttribute('display_name_singular');

        $data = $affected
            ? [
                'message'    => __('voyager::generic.successfully_deleted')." {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => __('voyager::generic.error_deleting')." {$displayName}",
                'alert-type' => 'error',
            ];

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

    public function insertUpdateData($request, $slug, $rows, $data)
    {
        DB::transaction(function () use ($data, $rows, $slug, $request) {
            $data = parent::insertUpdateData($request, $slug, $rows, $data);
        });

        return $data;
    }

    public function getPositionNotUsed(Request $request)
    {
        $home_id = $request->get('home_id');

        $positionSelected = null;

        $elementsPosition = HomePosition::where('in_used', 0)->get();

        if($home_id > 0) {
            $elementsPositionsAll = HomePosition::get();
            $positionSelected = HomePosition::where('home_id',$home_id)->first();
            $elementsPosition = null;
            foreach ($elementsPositionsAll as $e){
                if($e->in_used == 0) {
                    $elementsPosition[] = $e;
                } else if($e->in_used == 1 && $e->home_id == $positionSelected->home_id){
                    $elementsPosition[] = $e;
                }
            }
        }

        return Voyager::view('voyager::partials.elements-position', compact('elementsPosition', 'positionSelected'));
    }

    public function listPositionHomes(Request $request) {
        $slug = $this->getSlug($request);

        $positionsLetter = null;
        $positions20 = null;
        $positionsOther20 = null;
        $homePositions = HomePosition::get();
        foreach($homePositions as $homePosition) {
            if(is_numeric($homePosition->name)){
                if($homePosition->name<=20){
                    $positions20[$homePosition->name] = null;
                    if($homePosition->in_used == 1) {
                        $positions20[$homePosition->name] = $homePosition->home;
                    }
                } else {
                    $positionsOther20[$homePosition->name] = null;
                    if($homePosition->in_used == 1) {
                        $positionsOther20[$homePosition->name] = $homePosition->home;
                    }
                }
            } else {
                $positionsLetter[$homePosition->name] = null;
                if($homePosition->in_used == 1) {
                    $positionsLetter[$homePosition->name] = $homePosition->home;
                }
            }
        }

        return Voyager::view('voyager::homes.list-position-homes', compact(
                'homePositions',
                'positionsLetter',
                'positions20',
                'positionsOther20')
        );
    }

    public function resumenInvoice(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $home = Home::where('id',$id)->first();

        if(isset($home) && !isset($home->invoice)) {

            $type = Invoice::HOME_TYPE;
            $priceAnnouncement = PriceAnnouncement::where('type',$type)->first();
            $price = $priceAnnouncement->price/100;

            $route = 'homes.generateInvoice';
            $id = $home->id;

            $infoClient['name'] = $home->name;
            $infoClient['address'] = $home->address;
            $infoClient['email'] = $home->email;
            $infoClient['phone'] = $home->phone;
            $infoClient['province'] = (isset($home->province)) ? $home->province->name : "";


            return Voyager::view('voyager::invoices.resumen-invoice-announce', compact(
                    'infoClient', 'price', 'route', 'id', 'type')
            );
        }

        return redirect()->route("voyager.homes.index");
    }

    public function generateInvoice(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $home = Home::find($id);

        if(isset($home)){

            $dateActual = date('Y-m-d');
            $dataFormat = date('d/m/Y');
            $dateInit = $dateActual;
            $dateEnd = date('Y-m-d', strtotime($dateActual.'+ 1 year'));

            $invoiceClient = new InvoiceClient();
            $invoiceClient->name = $home->name;
            $invoiceClient->address = $home->address;
            $invoiceClient->phone = $home->phone;
            $invoiceClient->email = $home->email;
            $invoiceClient->province_id = (isset($home->province_id)) ? $home->province_id : 0;
            $invoiceClient->save();

            $numDays = $request->get('num_days');

            $numFact = "home-".$home->position_name."-".$dataFormat;
            $invoice = new Invoice();
            $invoice->element_id = $home->id;
            $priceAnnouncement = PriceAnnouncement::where('type',Invoice::HOME_TYPE)->first();
            $price = $priceAnnouncement->price/100;
            $invoice->total = ($price*$numDays)*100;
            $invoice->num_fact = $numFact;
            $invoice->type = Invoice::HOME_TYPE;
            $invoice->save();

            $numFactActuales = Invoice::whereRaw('DATE_FORMAT(created_at, "%Y-%c-%d") >= ? and DATE_FORMAT(created_at, "%Y-%c-%d") <= ?',[$dateInit, $dateEnd])->count();
            $invoice->num_invoice = str_pad($numFactActuales,'10',"0",STR_PAD_LEFT).date('Y');
            $invoice->save();

            $invoice->invoice_client_id = $invoiceClient->id;
            $invoice->save();

            $invoiceClient->invoice_id = $invoice->id;
            $invoiceClient->save();

            $invoiceLine = new InvoiceLine();
            $invoiceLine->invoice_id = $invoice->id;
            $invoiceLine->concept = "Pago anuncio ".$numFact;
            $invoiceLine->num_element = $numDays;
            $invoiceLine->price = $price*100;
            $invoiceLine->save();

            $home->invoice_id = $invoice->id;
            $home->num_fact = $numFact;
            $home->date_start = date('Y-m-d', strtotime($request->get('date_start')));
            $home->date_end = date('Y-m-d', strtotime($request->get('date_end')));
            $home->save();

            Mail::to([$home->email, config('mail.from.address_info')])->send(new \App\Mail\NewAd($invoice, $invoiceLine));
        }

        return 1;
    }
}
