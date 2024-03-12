<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Models\InvoiceClient;
use App\Models\InvoiceLine;
use App\Models\PriceAnnouncement;
use App\Models\Professional;
use App\Models\ProfessionalsCategory;
use App\Models\ProfessionalPosition;
use App\Models\Provincy;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Facades\Voyager;

class Professionals extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
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
            $slug = 'professionals';

            $dataType = Voyager::model('DataType')->where('slug', '=', 'professionals')->first();

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
        $data->code = "PROF" . substr(md5(time()), 0, 8);
        $visibleText = "no";
        if ($data->visible == 1) {
            $visibleText = "si";
        }
        $data->visible_text = $visibleText;
        $data->save();

        $professionalPosition = ProfessionalPosition::find($data->position_id);
        $professionalPosition->professional_id = $data->id;
        $professionalPosition->in_used = 1;
        $professionalPosition->save();

        $data->position_name = $professionalPosition->name;
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

        $professionalPositionOld = ProfessionalPosition::where('professional_id', $data->id)->first();
        if(isset($professionalPositionOld)){
            $professionalPositionOld->professional_id = 0;
            $professionalPositionOld->in_used = 0;
            $professionalPositionOld->save();
        }


        $professionalPosition = ProfessionalPosition::find($data->position_id);
        $professionalPosition->professional_id = $data->id;
        $professionalPosition->in_used = 1;
        $professionalPosition->save();

        $data->position_name = $professionalPosition->name;
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

                $professionalPosition = ProfessionalPosition::where('professional_id', $id)->first();
                $professionalPosition->professional_id = 0;
                $professionalPosition->in_used = 0;
                $professionalPosition->save();

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
        $category_id = $request->get('category_id');
        $province_id = $request->get('province_id');
        $professional_id = $request->get('professional_id');

        $positionSelected = null;

        $elementsPosition = ProfessionalPosition::where('in_used', 0)
            ->where('category_id', $category_id)
            ->where('province_id', $province_id)
            ->get();

        if($professional_id > 0) {
            $elementsPositionsAll = ProfessionalPosition::where('category_id', $category_id)
                ->where('province_id', $province_id)
                ->get();
            $positionSelected = ProfessionalPosition::where('professional_id',$professional_id)->first();

            $elementsPosition = null;
            foreach ($elementsPositionsAll as $e){
                if($e->in_used == 0) {
                    $elementsPosition[] = $e;
                } else if($e->in_used == 1 && $e->professional_id == $positionSelected->professional_id){
                    $elementsPosition[] = $e;
                }
            }
        }

        return Voyager::view('voyager::partials.elements-position', compact('elementsPosition', 'positionSelected'));
    }

    public function listPositionProfessionals(Request $request) {
        $slug = $this->getSlug($request);

        $professionalCategories = ProfessionalsCategory::all();

        $provincies = Provincy::all();

        $positionsLetter = null;
        $positions20 = null;
        $positionsOther20 = null;
        $category_id = 0;
        $province_id = 0;

        $professionalPositions = ProfessionalPosition::where('category_id', $request->get('category_id'))
            ->where('province_id', $request->get('province_id'))
            ->get();

        if(isset($professionalPositions) && count($professionalPositions) > 0) {
            foreach ($professionalPositions as $professionalPosition) {
                if (is_numeric($professionalPosition->name)) {
                    if ($professionalPosition->name <= 20) {
                        $positions20[$professionalPosition->name] = null;
                        if ($professionalPosition->in_used == 1) {
                            $positions20[$professionalPosition->name] = $professionalPosition->professional;
                        }
                    } else {
                        $positionsOther20[$professionalPosition->name] = null;
                        if ($professionalPosition->in_used == 1) {
                            $positionsOther20[$professionalPosition->name] = $professionalPosition->professional;
                        }
                    }
                } else {
                    $positionsLetter[$professionalPosition->name] = null;
                    if ($professionalPosition->in_used == 1) {
                        $positionsLetter[$professionalPosition->name] = $professionalPosition->professional;
                    }
                }
            }
        } else {
            $professionalPositions = null;
        }

        return Voyager::view('voyager::professionals.list-position-professionals', compact(
                'professionalCategories',
                'provincies',
                'professionalPositions',
                'positionsLetter',
                'positions20',
                'positionsOther20',
                'category_id',
                'province_id')
        );
    }

    public function resumenInvoice(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $professional = Professional::where('id',$id)->first();

        if(isset($professional) && !isset($professional->invoice)) {

            $type = Invoice::PROFESSIONAL_TYPE;
            $priceAnnouncement = PriceAnnouncement::where('type',$type)->first();
            $price = $priceAnnouncement->price/100;

            $route = 'professionals.generateInvoice';
            $id = $professional->id;

            $infoClient['name'] = $professional->name;
            $infoClient['address'] = $professional->address;
            $infoClient['email'] = $professional->email;
            $infoClient['phone'] = $professional->phone;
            $infoClient['province'] = (isset($professional->province)) ? $professional->province->name : "";


            return Voyager::view('voyager::invoices.resumen-invoice-announce', compact(
                    'infoClient', 'price', 'route', 'id', 'type')
            );
        }

        return redirect()->route("voyager.professionals.index");
    }

    public function generateInvoice(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $professional = Professional::find($id);

        if(isset($professional)){
            $dateActual = date('Y-m-d');
            $dataFormat = date('d/m/Y');
            $dateInit = $dateActual;
            $dateEnd = date('Y-m-d', strtotime($dateActual.'+ 1 year'));

            $invoiceClient = new InvoiceClient();
            $invoiceClient->name = $professional->name;
            $invoiceClient->address = $professional->address;
            $invoiceClient->phone = $professional->phone;
            $invoiceClient->email = $professional->email;
            $invoiceClient->province_id = (isset($professional->province_id)) ? $professional->province_id : 0;
            $invoiceClient->save();

            $numDays = $request->get('num_days');

            $categoryName = ($professional->category) ? $professional->category->name."-" : "";
            $provinceName = ($professional->province) ? $professional->province->name."-" : "";

            $numFact = "pro-".$categoryName.$provinceName.$professional->position_name."-".$dataFormat;
            $invoice = new Invoice();
            $invoice->element_id = $professional->id;
            $priceAnnouncement = PriceAnnouncement::where('type',Invoice::PROFESSIONAL_TYPE)->first();
            $price = $priceAnnouncement->price/100;
            $invoice->total = ($price*$numDays)*100;
            $invoice->num_fact = $numFact;
            $invoice->type = Invoice::PROFESSIONAL_TYPE;
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

            $professional->invoice_id = $invoice->id;
            $professional->num_fact = $numFact;
            $professional->date_start = date('Y-m-d', strtotime($request->get('date_start')));
            $professional->date_end = date('Y-m-d', strtotime($request->get('date_end')));
            $professional->save();

            Mail::to([$professional->email, config('mail.from.address_info')])->send(new \App\Mail\NewAd($invoice, $invoiceLine));
        }

        return 1;
    }
}
