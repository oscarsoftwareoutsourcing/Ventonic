<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Input;

use App\User;
use App\Country;
use App\Contact;
use App\Group;
use App\ContactGroup;
use App\GroupUser;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $contacts=Contact::where('user_id', auth()->user()->id)->orderBy('created_at')->paginate(10);
        /*$contacts=array();
        $contactos_personales=Contact::where('user_id', auth()->user()->id)->get();
        $personales=array();
        foreach ($contactos_personales as $personal) {
            $personales[]=[
                'id'=>$personal->id,
                'user_id'=>$personal->user_id,
                'name'=>$personal->name,
                'last_name'=>$personal->last_name,
                'email'=>$personal->email,
                'phone'=>$personal->phone,
                'company'=>$personal->company,
                'private'=>$personal->private,
                'favorite'=>$personal->favorite,
                'type'=>$personal->type,
                'type_contact'=>$personal->type_contact,
                'initials' => $personal->IntialsName,
                'image' => $personal->image,
                'fullName' => $personal->FullName,
            ];
        }*/

        // Sacar los usuarios que le han compartido
        // Sacar todos los grupos a los que pertenece el usuario
        /*$groups=GroupUser::where('user_id', auth()->user()->id)->get();
        $contacts_compartidos=array();
        $compartidos=array();

        foreach ($groups as $group) {
            $comp=ContactGroup::where('group_id', $group->group_id)->value('contact_id');
            $true=array_search($comp, $compartidos);

            if (!array_search($comp, $compartidos)) {
                $compartidos[]=$comp;
            }
        }

        foreach ($compartidos as $i => $compartido) {
            if ($compartido) {
                    $contacts_compartidos[]=[
                        'id'=>$compartido,
                        'user_id'=>Contact::getUserId($compartido),
                        'name'=>Contact::getUserName($compartido),
                        'last_name'=>Contact::getUserLastName($compartido),
                        'email'=>Contact::getUserEmail($compartido),
                        'phone'=>Contact::getUserPhone($compartido),
                        'company'=>Contact::getUserCompany($compartido),
                        'private'=>Contact::getUserPrivate($compartido),
                        'favorite'=>Contact::getUserFavorite($compartido),
                        'type'=>Contact::getUserType($compartido),
                        'type_contact'=>Contact::getUserTypeContact($compartido),
                        'initials' => Contact::getIniNames($compartido),
                        'image' => Contact::getImage($compartido),
                        'fullName' => Contact::getUserName($compartido).' '.Contact::getUserLastName($compartido),
                    ];
            }
        }

        if (count($contacts_compartidos)>0) {
            $contacts=array_merge($personales, $contacts_compartidos);
        } else {
            $contacts=$personales;
        }*/
        //dd($contacts);
        //

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
        $contacts = $this->paginate($contacts, 5, null, ['path' => 'listado']);

        return view('contact.list-contact', ['contacts'=>$contacts]);
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
        return view('contact.form', ['contact'=>$contact, 'groups'=>$groups]);
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
             'type' =>  $request->etiquetas ?? null,
             'favorite' =>  $request->favorito ? 1 : 0,
             'cargo' =>  $request->cargo_empresa ?? null,
             'address_longitude' =>  $request->address_longitude ?? null,
             'address_latitude' =>  $request->address_latitude ?? null,
             'user_id' =>  auth()->user()->id,
             'type_contact'=> $request->type_contact
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
        $contact->type= $request->etiquetas ?? null;
        $contact->favorite= $favorito ?? null;
        $contact->cargo= $request->cargo ?? null;
        $contact->address_longitude= $request->address_longitude ?? null;
        $contact->address_latitude= $request->address_latitude ?? null;
        // $contact->user_id= $request->user_id ?? null;
        $contact->type_contact= $request->type_contact ?? null;
        $contact->update();

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
        return view('contact.form-edit', [
            'countrys'=>$countrys, 'contact'=>$contact, 'groups'=>$groups, 'users'=>$users
        ]);
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
}
