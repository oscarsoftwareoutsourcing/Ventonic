<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;
use App\Country;
use App\Contact;
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
        if(isset($contact) && $contact == 'empresa' || $contact== 'persona'){
            $contact=$contact;
        }
        elseif(isset($contact)){
            $contact=Contact::find((int)$contact);
        }else{
            $contact='';
        }
        // var_dump($contact); die();
        $countrys=Country::all();
        // var_dump($contact); die();
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
        $image=$request->file('image');
        // var_dump($image); die();
        $validation= $request->validate([
            'nombre' => 'required|string|max:255'
        ]);
        
        if($image){
            $image_path_name = time().$image->getClientOriginalName();
            Storage::disk('public')->put($image_path_name, File::get($image));
        }
        // var_dump($request->type_contact); die();
        $contact = Contact::updateOrCreate(
            ['name' =>  $request->nombre,
             'last_name' => $request->apellido ?? null,
             'image'=>$request->image ? $image_path_name : null,
             'email' =>  $request->email ?? null,
             'web' =>  $request->web ?? null,
             'phone' => $request->telefono ?? null,
             'company' => $request->empresa ?? null,
             'address' =>  $request->direccion_empresa ?? null,
             'postal_code' =>  $request->codigo_postal ?? null,
             'sector' =>  $request->sector ?? null,
             'notes' =>  $request->anotaciones ?? null,
             'share' =>  null,
             'type' =>  $request->etiquetas ?? null,
             'favorite' =>  $request->favorito ? 1 : 0,
             'cargo' =>  $request->cargo_empresa ?? null,
             'address_longitude' =>  $request->altitud ?? null,
             'address_latitude' =>  $request->latitud ?? null,
             'user_id' =>  auth()->user()->id,
             'type_contact'=> $request->type_contact
            ]
        );

        return redirect()->route('contact.list');
    }

    public function getImage($filename){
        $file=Storage::disk('public')->get($filename);
        return new Response($file, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $contacts=Contact::where('user_id', auth()->user()->id)->orderByDesc('favorite')->paginate(10);
        return view('inicio-dashboard', ['contacts'=>$contacts]);

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
