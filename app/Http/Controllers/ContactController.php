<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\User;
use App\Country;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts=Contact::where('user_id', auth()->user()->id)->orderByDesc('favorite')->paginate(10);
        return view('contact.list-contact', ['contacts'=>$contacts]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contact  = null)
    {
        
        $countrys=Country::all();
        $contact=isset($contact) ? Contact::find((int)$contact) : '';
        return view('contact.form', ['countrys'=>$countrys, 'contact'=>$contact]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation= $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'string|max:255',
            'email' => 'email',
            'web' => 'string',
            'empresa' => 'string',
            'direccion_empresa' => 'string',
            'cargo_empresa'=>'string',
            'ciudad-empresa' => 'string',
            'provincia' => 'string',
            'empresa' => 'string',
            'direccion_empresa' => 'string',
            'ciudad_empresa' => 'string',
            'provincia' => 'string',
            'codigo-postal' => 'numeric',
            'pais' => 'numeric',
            'sector' => 'string',
            'etiquetas' => 'string',

        ]);

        $contact = Contact::updateOrCreate(
            ['name' =>  $request->nombre,
             'last_name' => $request->apellido ?? null,
             'email' =>  $request->email ?? null,
             'web' =>  $request->web ?? null,
             'phone' => $request->telefono ?? null,
             'company' => $request->empresa ?? null,
             'address' =>  $request->direccion_empresa ?? null,
             'city' => $request->ciudad_empresa ?? null,
             'province' => $request->provincia ?? null,
             'postal_code' =>  $request->codigo_postal ?? null,
             'sector' =>  $request->sector ?? null,
             'notes' =>  $request->anotaciones ?? null,
             'share' =>  null,
             'type' =>  $request->etiquetas ?? null,
             'country_id' =>  $request->pais ?? null,
             'favorite' =>  $request->favorito ? 1 : 0,
             'cargo' =>  $request->cargo_empresa ?? null,
             'user_id' =>  auth()->user()->id
             
            ]
        );

        return redirect()->route('contact.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(contact $contact)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(contact $contact)
    {
        //
    }
}
