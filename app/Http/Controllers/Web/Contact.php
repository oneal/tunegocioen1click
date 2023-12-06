<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Facades\Voyager;

class Contact extends Controller
{
    public function index(Request $request)
    {
        $activeContacto = true;

        $data = getSeo(8);
        $title = $data['title'];
        $description =  $data['description'];

        return view('web.contact', compact('activeContacto', 'title', 'description'));
    }

    public function sendContact(Request $request)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'message-c' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $message = [
            'required' => 'Campo obligatorio',
            'email' => 'Email Invalido',
        ]);

        if($validator->fails()) {
            return redirect()->route('contact.index')
                ->withErrors($validator)
                ->withInput();
        }

        $messageC = $request->get('message-c');
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'messageC' => $messageC
        ];

        if(Mail::to('info@tunegocioen1click.online')->send(new \App\Mail\Contact($data))){
            $request->session()->flash('success', 'Enviado correctamente. Resolveremos su duda lo antes posible');
        } else {
            $request->session()->flash('error', 'Se ha producido un error, intentelo más tarde.');
        }

        return redirect()->back();
    }
}
