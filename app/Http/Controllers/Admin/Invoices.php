<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home;
use App\Models\Hotel;
use App\Models\Invoice;
use App\Models\InvoiceClient;
use App\Models\InvoiceLine;
use App\Models\Professional;
use App\Models\Provincy;
use App\Models\Restaurant;
use App\Models\Store;
use App\Models\WorkOffer;
use Illuminate\Http\Request;

class Invoices extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    function generateInvoicePdf(Request $request, $id)
    {
        $invoice = Invoice::find($id);

        if(isset($invoice)) {
            $invoiceClient = InvoiceClient::find($invoice->invoice_client_id);
            $invoiceLines = InvoiceLine::where('invoice_id', $invoice->id)->get();
            $province = Provincy::where('id', $invoiceClient->province_id)->first();

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('voyager::invoices.download-invoice-pdf', ['invoice' => $invoice, "invoiceClient" => $invoiceClient, "invoiceLines" => $invoiceLines, "province" => $province]);
            $pdf->setOption('defaultFont', 'Helvetica');
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download($invoice->num_invoice.'.pdf');
        }

        return redirect()->back();
    }

    function paidInvoice(Request $request, $id)
    {
        $invoice = Invoice::find($id);

        if(isset($invoice)) {
            if($invoice->type == Invoice::HOME_TYPE){
                $home = Home::find($invoice->element_id);

                $home->visible = 1;
                $home->visible_text = "si";
                $home->save();

                $invoice->paid = 1;
                $invoice->paid_text = 'si';
                $invoice->save();
            } else if($invoice->type == Invoice::HOTEL_TYPE) {
                $hotel = Hotel::find($invoice->element_id);

                $hotel->visible = 1;
                $hotel->visible_text = "si";
                $hotel->save();

                $invoice->paid = 1;
                $invoice->paid_text = 'si';
                $invoice->save();

            } else if($invoice->type == Invoice::PROFESSIONAL_TYPE) {
                $professional = Professional::find($invoice->element_id);

                $professional->visible = 1;
                $professional->visible_text = "si";
                $professional->save();

                $invoice->paid = 1;
                $invoice->paid_text = 'si';
                $invoice->save();

            } else if($invoice->type == Invoice::RESTAURANT_TYPE) {
                $restaurant = Restaurant::find($invoice->element_id);

                $restaurant->visible = 1;
                $restaurant->visible_text = "si";
                $restaurant->save();

                $invoice->paid = 1;
                $invoice->paid_text = 'si';
                $invoice->save();
            } else if($invoice->type == Invoice::STORE_TYPE) {
                $store = Store::find($invoice->element_id);

                $store->visible = 1;
                $store->visible_text = "si";
                $store->save();

                $invoice->paid = 1;
                $invoice->paid_text = 'si';
                $invoice->save();
            } else if($invoice->type == Invoice::WORK_OFFER_TYPE) {
                $workOffer = WorkOffer::find($invoice->element_id);

                $workOffer->visible = 1;
                $workOffer->visible_text = "si";
                $workOffer->save();

                $invoice->paid = 1;
                $invoice->paid_text = 'si';
                $invoice->save();
            }
        }

        return redirect()->back();
    }
}
