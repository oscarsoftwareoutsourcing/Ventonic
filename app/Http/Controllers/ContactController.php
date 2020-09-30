<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Repositories\UploadRepository;

use App\User;
use App\Country;
use App\Contact;
use App\ContactType;
use App\Group;
use App\ContactGroup;
use App\GroupUser;
use Carbon\Carbon;

use Google_Client;
use Google_Service_PeopleService;
use Google_Service_PeopleService_Person;
use Google_Service_PeopleService_Name;
use Google_Service_PeopleService_PhoneNumber;
use Google_Service_PeopleService_EmailAddress;
use GuzzleHttp\Client as GuzzleClient;
use App\CalendarSetting;

class ContactController extends Controller
{
    public function __construct()
    {
        $rurl = action('GoogleCalendarController@oauth');

        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google-calendar/client_id.json'));
        $client->addScope(Google_Service_PeopleService::CONTACTS);

        $guzzleClient = new GuzzleClient([
            'curl' => [CURLOPT_SSL_VERIFYPEER => false]
        ]);
        $client->setHttpClient($guzzleClient);

        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gContact = false;
        session()->put('returnUrl', 'contact.list');

        if (!CalendarSetting::where(['appType' => 'gContact', 'user_id' => auth()->user()->id])->get()->isEmpty()) {
            if (session()->has('access_token') && session('access_token')) {
                $this->client->setAccessToken(session()->get('access_token'));
                $service1 = new Google_Service_PeopleService($this->client);
                $optParams = [
                      'pageSize' => 2000,
                      'personFields' => 'names,emailAddresses,phoneNumbers,emailAddresses',
                    ];
                $resultsPeople = $service1->people_connections->listPeopleConnections('people/me', $optParams);
                foreach ($resultsPeople as $key => $gContact) {
                    if (property_exists($gContact, 'names') && $gContact->names[0]->givenName) {
                        Contact::updateOrCreate(
                            [
                                'external_key' => $gContact->resourceName,
                                'external_contact' => 'gContact',
                                'user_id' => auth()->user()->id
                            ],
                            [
                                'name' => $gContact->names[0]->givenName,
                                'last_name' => $gContact->names[0]->familyName ?? null,
                                'email' => (property_exists($gContact, 'emailAddresses') && count($gContact->emailAddresses) > 0)
                                           ? $gContact->emailAddresses[0]->value : null,
                                'phone' => (property_exists($gContact, 'phoneNumbers') && count($gContact->phoneNumbers) > 0)
                                           ? $gContact->phoneNumbers[0]->canonicalForm : null
                            ]
                        );
                    }
                }
            } else {
                return redirect('/google-calendar/oauth');
            }
            $gContact = true;
        }
        /** @var Object Objeto con información de los contactos propios del usuario */
        $contacts = Contact::where('user_id', auth()->user()->id)->get();
        /** @var Object Objeto con información de los grupos en los que se encuentra el usuario */
        $groupUsers=GroupUser::where('user_id', auth()->user()->id)->get();
        foreach ($groupUsers as $groupUser) {
            /** @var Object Objeto con información de los contactos compartidos en los grupos */
            $sharedContacts = Contact::whereHas('contactGroups', function ($query) use ($groupUser) {
                return $query->where('group_id', $groupUser->group_id);
            })->get();

            /** Combina los objetos de contactos propios con los contactos compartidos en grupos */
            $contacts->merge($sharedContacts);
        }

        $path = '';
        if ($request->_token) {
            $path = '?_token=' . $request->_token .
                    '&oportunitySearch=' . str_replace(" ", "+", $request->oportunitySearch) .
                    '&etiquetas=' . str_replace(" ", "+", $request->etiquetas);


            /** Filtro para tipo de contacto si es seleccionado */
            if ((int)$request->etiquetas !== 0) {
                //$contacts = $contacts->where('contact_type_id', (int)$request->etiquetas);
                $contacts = $contacts->filter(function ($contact) use ($request) {
                    return (int)$request->etiquetas === $contact->contact_type_id;
                });
            }

            /** Filtro para buscar contacto de acuerdo al texto suministrado */
            if ($request->oportunitySearch) {
                $contacts = $contacts->filter(function ($contact) use ($request) {
                    return strpos(strtoupper($contact->name), strtoupper($request->oportunitySearch)) !== false ||
                           strpos(strtoupper($contact->last_name), strtoupper($request->oportunitySearch)) !== false ||
                           strpos(strtoupper($contact->email), strtoupper($request->oportunitySearch)) !== false ||
                           strpos(strtoupper($contact->web), strtoupper($request->oportunitySearch)) !== false ||
                           strpos(strtoupper($contact->company), strtoupper($request->oportunitySearch)) !== false ||
                           strpos(strtoupper($contact->address), strtoupper($request->oportunitySearch)) !== false ||
                           strpos(strtoupper($contact->sector), strtoupper($request->oportunitySearch)) !== false ||
                           strpos(strtoupper($contact->cargo), strtoupper($request->oportunitySearch)) !== false;
                });
            }
        }

        $contacts = $this->paginate($contacts, 5, null, ['path' => 'listado' . $path]);
        $contactTypes = ContactType::all();

        return view('contact.list-contact', compact('contacts', 'contactTypes', 'gContact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contact = null)
    {
        if (isset($contact) && $contact == 'empresa' || $contact== 'persona') {
            $contact=$contact;
        } elseif (isset($contact)) {
            $contact=Contact::find((int)$contact);
        } else {
            $contact='';
        }

        //$countrys=Country::all();
        $groups=Group::where('user_id', auth()->user()->id)->get();
        //$users=User::orderBy('name', 'desc')->get();
        $contactTypes = ContactType::all();
        return view('contact.form', compact('contact', 'groups', 'contactTypes'));
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
        $validation= $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        if ($image) {
            $image_path_name = time().$image->getClientOriginalName();
            Storage::disk('public')->put($image_path_name, File::get($image));
        }

        // var_dump($request->address_longitude);
        // var_dump($request->address_latitude);
        // die();
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
             'favorite' =>  $request->favorito ? 1 : 0,
             'cargo' =>  $request->cargo_empresa ?? null,
             'address_longitude' =>  $request->address_longitude ?? null,
             'address_latitude' =>  $request->address_latitude ?? null,
             'user_id' =>  auth()->user()->id,
             'type_contact'=> $request->type_contact,
             'contact_type_id' => $request->etiquetas ?? null
            ]
        );
        // Compartir usuario
        if (isset($request['private']) && is_array($request['private'])) {
            $private = implode($request['private']);
        }


        if ($contact) {
            if (isset($private) && $private==='para mi') {
                $contact=Contact::find($contact->id);
                $contact->private=1;
                $contact->update();
            } elseif (isset($private) && $private==='todos') {
                // Sacar todos los grupos de usuarios del contacto
                $groups=Group::where('user_id', auth()->user()->id)->get();

                // Insertar el contacto en la tabla contact_group para hacerlo disponible en todos sus grupos
                foreach ($groups as $group) {
                    $contactGroup = ContactGroup::updateOrCreate([
                        'contact_id' =>$contact->id, 'group_id' => $group->id
                    ]);
                }
            } elseif (isset($private) && $private!=='para mi' && $private!=='todos') {
                // Sacar los id de los grupos de que selecciono el usuario
                $groups=$request->private;

                foreach ($groups as $group) {
                    $contactGroup = ContactGroup::updateOrCreate([
                        'contact_id' =>$contact->id, 'group_id' => (int)$group
                    ]);
                }
            }

            /** Si esta configurado con google Contact */
            $contactSetting = CalendarSetting::where(['appType' => 'gContact', 'user_id' => auth()->user()->id])->first();
            if ($contactSetting) {
                $service = new Google_Service_PeopleService($this->client);
                if (session()->has('access_token') && session('access_token')) {
                    $this->client->setAccessToken(session()->get('access_token'));
                    $gContact =new Google_Service_PeopleService_Person();
                    $name = new Google_Service_PeopleService_Name();
                    $name->setGivenName($request->nombre);
                    if ($request->apellido) {
                        $name->setFamilyName($request->apellido);
                    }
                    $gContact->setNames([$name]);
                    if ($request->telefono) {
                        $number = new  Google_Service_PeopleService_PhoneNumber();
                        $number->setValue($request->telefono);
                        $gContact->setPhoneNumbers($number);
                    }
                    if ($request->email) {
                        $email=new Google_Service_PeopleService_EmailAddress();
                        $email->setValue($request->email);
                        $gContact->setEmailAddresses($email);
                    }
                    $service->people->createContact($gContact);
                }
            } else {
                session()->put('returnUrl', 'contact.list');
                return redirect('/google-calendar/oauth');
            }
        }

        return redirect()->route('contact.list');
    }

    public function getImage($filename)
    {
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
        //return view('inicio-dashboard', ['contacts'=>$contacts]);
        return view('dashboard.index', ['contacts'=>$contacts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $contact_id=$request->input('contact_id');

        $contact=Contact::find((int)$contact_id);
        $image=$request->file('image');
        $validation= $request->validate([
            'nombre' => 'required|string|max:255'
        ]);
        // var_dump($contact); die();

        if ($image) {
            $image_path_name = time().$image->getClientOriginalName();
            Storage::disk('public')->put($image_path_name, File::get($image));
        }

        $favorito = 0;
        if ($request->favorite=='on') {
            $favorito = 1;
        }

        //dd($request);
        $contact->name=$request->nombre;
        $contact->last_name=$request->apellido ?? null;
        $contact->image=$request->image ? $image_path_name : null;
        $contact->email=$request->email ?? null;
        $contact->web=$request->web ?? null;
        $contact->phone=$request->telefono ?? null;
        $contact->company= $request->empresa ?? null;
        $contact->address=$request->direccion_empresa ?? null;
        $contact->postal_code=$request->codigo_postal ?? null;
        $contact->sector=$request->sector ?? null;
        $contact->notes= $request->anotaciones ?? null;
        $contact->share=null;
        $contact->contact_type_id = $request->etiquetas ?? null;
        $contact->favorite= $favorito ?? null;
        $contact->cargo= $request->cargo ?? null;
        $contact->address_longitude= $request->address_longitude ?? null;
        $contact->address_latitude= $request->address_latitude ?? null;
        // $contact->user_id= $request->user_id ?? null;
        $contact->type_contact= $request->type_contact ?? null;
        $contact->update();

        /** Si esta configurado con google Contact */
        $contactSetting = CalendarSetting::where(['appType' => 'gContact', 'user_id' => auth()->user()->id])->first();
        if ($contactSetting && !is_null($contact->external_key) && $contact->external_contact === 'gContact') {
            $service = new Google_Service_PeopleService($this->client);
            if (session()->has('access_token') && session('access_token')) {
                $this->client->setAccessToken(session()->get('access_token'));
                $gContact =new Google_Service_PeopleService_Person();
                $name = new Google_Service_PeopleService_Name();
                $name->setGivenName($request->nombre);
                if ($request->apellido) {
                    $name->setFamilyName($request->apellido);
                }
                $gContact->setNames([$name]);
                if ($request->telefono) {
                    $number = new  Google_Service_PeopleService_PhoneNumber();
                    $number->setValue($request->telefono);
                    $gContact->setPhoneNumbers($number);
                }
                if ($request->email) {
                    $email=new Google_Service_PeopleService_EmailAddress();
                    $email->setValue($request->email);
                    $gContact->setEmailAddresses($email);
                }
                $service->people->updateContact(
                    $contact->external_key,
                    $gContact,
                    ['updatePersonFields' => 'names,phoneNumbers,emailAddresses']
                );
            }
        } else {
            session()->put('returnUrl', 'contact.list');
            return redirect('/google-calendar/oauth');
        }

        // if(isset($request['private']) && is_array($request['private'])){
        //     $private = implode($request['private']);
        // }


        // if($contact){
        //     if($private==='para mi'){
        //         $contact_id=$contact->id;
        //         $contact=Contact::find($contact->id);
        //         $contact->private=1;
        //         $contact->update();
        //     }

        //     else if($private==='todos'){
        //         $contact_id=$contact->id;
        //         // Sacar todos los grupos de usuarios del contacto
        //         $groups=Group::where('user_id', auth()->user()->id)->get();
        //         $users=array();

        //         // Insertar el contacto en la tabla contact_group para hacerlo disponible en todos sus grupos
        //         foreach($groups as $group){
        //             $contactGroup = ContactGroup::updateOrCreate(
        //                 ['contact_id' =>$contact_id,
        //                  'group_id' => $group->id
        //                 ]
        //             );
        //         }

        //     }
        //     else if($private!=='para mi' && $private!=='todos'){
        //         $contact_id=$contact->id;

        //         // Sacar los id de los grupos de que selecciono el usuario
        //         $groups=$request->private;
        //         foreach($groups as $group){
        //             $contactGroup = ContactGroup::updateOrCreate(
        //                 ['contact_id' =>$contact_id,
        //                  'group_id' => (int)$group
        //                 ]
        //             );
        //         }

        //     }
        // }

        return redirect()->route('contact.list')
                            ->with(['message'=>'Contacto modificado exitosamente']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit($contact_id)
    {
        $contact=Contact::find($contact_id);
        $countrys=Country::all();
        $groups=Group::where('user_id', auth()->user()->id)->get();
        $users=User::orderBy('name', 'desc')->get();
        $contactTypes = ContactType::all();
        return view('contact.form-edit', compact('countrys', 'contact', 'groups', 'users', 'contactTypes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact_id, $user_id)
    {
        $result='';

        if ((int)$user_id == auth()->user()->id) {
            // Buscar el contacto para ver si esta compartido
            $search=ContactGroup::where('contact_id', (int)$contact_id)->get();
            if ($search) {
                ContactGroup::where('contact_id', (int)$contact_id)->delete();
            }
            $delete_contact=Contact::find((int)$contact_id);
            $borrado=$delete_contact->delete();
            if (isset($borrado)) {
                /** Si esta configurado con google Contact */
                $contactSetting = CalendarSetting::where(['appType' => 'gContact', 'user_id' => auth()->user()->id])->first();
                if ($contactSetting && !is_null($delete_contact->external_key) && $delete_contact->external_contact === 'gContact') {
                    $service = new Google_Service_PeopleService($this->client);
                    if (session()->has('access_token') && session('access_token')) {
                        $this->client->setAccessToken(session()->get('access_token'));
                        $service->people->deletecontact($delete_contact->external_key);
                    }
                }
                return redirect()->route('contact.list')->with(['message'=>'Contacto eliminado exitosamente']);
            } else {
                return redirect()->route('contact.list')->with(['error'=>'No se ha podido eliminar el contacto']);
            }
        } else {
            return redirect()->route('contact.list')->with(['error'=>'No esta autorizado para eliminar este contacto']);
        }
    }

    /**
     * Obtiene un listado de contactos
     *
     * @method    getContacts
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     integer|null         $contact_id    Identificador del contacto. Opcional
     *
     * @return    JsonResponse         Objeto JSON con los datos de respuesta a la petición
     */
    public function getContacts($contact_id = null)
    {
        if ($contact_id !== null) {
            return response()->json(['result' => true, 'contacts' => Contact::find($contact_id)], 200);
        }

        return response()->json([
            'result' => true, 'contacts' => auth()->user()->contact()->orderBy('name', 'asc')->get()
        ], 200);
    }

    /**
     * Ver detalles de contactos
     *
     * @method    detail
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Contact    $contact    Objeto con información del contacto
     *
     * @return    View       Vista con detalles del contacto
     */
    public function detail(Contact $contact)
    {
        return view('contact.detail', compact('contact'));
    }

    /**
     * Elimina el contacto desde la vista de detalles
     *
     * @method    destroyContact
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Contact           $contact    Objeto con datos del contacto
     *
     * @return    JsonResponse      Objeto con datos de respuesta a la petición
     */
    public function destroyContact(Contact $contact)
    {
        if ($contact->id !== auth()->user()->id) {
            $search=ContactGroup::where('contact_id', $contact->id)->get();

            if (!$search->isEmpty()) {
                $search->delete();
            }

            /** Elimina las notas asociadas al contacto */
            $contact->notes()->delete();
            /** Elimina los eventos asociados al contacto */
            $contact->events()->delete();
            /** Elimina los correos electrónicos asociados al contacto */
            $contact->emails()->delete();
            /** Elimina los documentos asociados al contacto */
            $contact->documents()->delete();
            /** Elimina las llamadas asociadas al contacto */
            $contact->callEvents()->delete();
            /** Elimina las tareas asociadas al contacto */
            $contact->tasks()->delete();
            /** Elimina el contacto en sí */
            $borrado = $contact->delete();

            if (isset($borrado)) {
                session()->flash('message', 'Contacto eliminado exitosamente');
            } else {
                session()->flash('error', 'No se ha podido eliminar el contacto');
            }

            return response()->json(['result' => true, 'route' => route('contact.list')], 200);
        }

        return response()->json([
            'result' => false, 'message' => 'No esta autorizado para eliminar este contacto'
        ], 200);
    }

    /**
     * Método que permite modificar la imagen de un contacto
     *
     * @method    changePicture
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request             $request    Objeto con datos de la petición
     * @param     UploadRepository    $up         Objeto con instrucciones para la carga de archivo en el servidor
     *
     * @return    JsonResponse        Objeto JSON con datos de respuesta a la petición
     */
    public function changePicture(Request $request, UploadRepository $up)
    {
        if ($request->file('picture')) {
            if ($up->upload($request->file('picture'), 'contacts', false, false, false, false)) {
                $picture = $up->getStored();
                $contact = Contact::find($request->contact_id);
                $contact->image = $picture;
                $contact->image_updated_at = Carbon::now();
                $contact->change_image_user_id = auth()->user()->id;
                $contact->save();
                return response()->json(['result' => true, 'picture' => $picture], 200);
            }
        }
        return response()->json(['result' => true, 'picture' => 'images/anonymous-user.png'], 200);
    }

    /**
     * Método que elimina la imagen del contacto
     *
     * @method    removePicture
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request          $request    Objeto con datos de la petición
     *
     * @return    JsonResponse     Objeto con datos de respuesta a la petición
     */
    public function removePicture(Request $request)
    {
        $contact = Contact::find($request->contact_id);
        $contact->image = null;
        $contact->image_updated_at = Carbon::now();
        $contact->change_image_user_id = auth()->user()->id;
        $contact->save();
        return response()->json(['result' => true, 'picture' => 'images/anonymous-user.png'], 200);
    }

    /**
     * Agrega un contacto solo con la información del nombre y el apellido
     *
     * @method    simpleStore
     *
     * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
     *
     * @param     Request        $request    Datos de la petición
     *
     * @return    JsonResponse   Devuelve un objeto con el resultado de la petición
     */
    public function simpleStore(Request $request)
    {
        $this->validate($request, [
            'type' => ['required'],
            'name' => ['required']
        ]);

        $contactType = ($request->type === 'P') ? 'persona' : 'empresa';
        $contact = Contact::create([
            'name' => $request->name,
            'last_name' => $request->lastName ?? null,
            'user_id' =>  auth()->user()->id,
            'type_contact'=> $contactType,
        ]);

        return response()->json(['result' => true, 'contact' => $contact], 200);
    }
}
