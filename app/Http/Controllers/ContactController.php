<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
        $contacts=array();
        $contactos_personales=Contact::where('user_id', auth()->user()->id)->get();
        $personales=array();
        foreach($contactos_personales as $personal){
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
                'type_contact'=>$personal->type_contact
            ];
            
        }

        // Sacar los usuarios que le han compartido
        // Sacar todos los grupos a los que pertenece el usuario
        $groups=GroupUser::where('user_id', auth()->user()->id)->get();
        $contacts_compartidos=array();
        foreach($groups as $group){
            $compartidos=ContactGroup::where('group_id', $group->group_id)->value('contact_id');
            foreach($compartidos as $compartido){
                if (!array_key_exists($compartido->id, $contacts_compartidos)){
                    $contacts_compartidos[]=[
                        'id'=>$compartido->contact_id,
                        'user_id'=>Contact::getUserId($compartido->contact_id),
                        'name'=>Contact::getUserName($compartido->contact_id),
                        'last_name'=>Contact::getUserLastName($compartido->contact_id),
                        'email'=>Contact::getUserEmail($compartido->contact_id),
                        'phone'=>Contact::getUserPhone($compartido->contact_id),
                        'company'=>Contact::getUserCompany($compartido->contact_id),
                        'private'=>Contact::getUserPrivate($compartido->contact_id),
                        'favorite'=>Contact::getUserFavorite($compartido->contact_id),
                        'type'=>Contact::getUserType($compartido->contact_id),
                        'type_contact'=>Contact::getUserTypeContact($compartido->contact_id),
                    ];
                }
            }
        }

        if(count($contacts_compartidos)>0){
            $contacts=array_merge($personales,$contacts_compartidos);
        }else{
            $contacts=$personales;
        }


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
        $countrys=Country::all();
        $groups=Group::where('user_id', auth()->user()->id)->get();
        $users=User::orderBy('name', 'desc')->get();
        return view('contact.form', ['countrys'=>$countrys, 'contact'=>$contact, 'groups'=>$groups, 'users'=>$users]);
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
        
        if($image){
            $image_path_name = time().$image->getClientOriginalName();
            Storage::disk('public')->put($image_path_name, File::get($image));
        }
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
        // Compartir usuario
        if(isset($request['private']) && is_array($request['private'])){
            $private = implode($request['private']);
        }


        if($contact){
            if(isset($private) && $private==='para mi'){
                $contact_id=$contact->id;
                $contact=Contact::find($contact->id);
                $contact->private=1;
                $contact->update();
            }

            else if(isset($private) && $private==='todos'){
                $contact_id=$contact->id;
                // Sacar todos los grupos de usuarios del contacto
                $groups=Group::where('user_id', auth()->user()->id)->get();
                $users=array();

                // Insertar el contacto en la tabla contact_group para hacerlo disponible en todos sus grupos
                foreach($groups as $group){
                    $contactGroup = ContactGroup::updateOrCreate(
                        ['contact_id' =>$contact_id,
                         'group_id' => $group->id
                        ]
                    );
                }

            }
            else if(isset($private) && $private!=='para mi' && $private!=='todos'){
                $contact_id=$contact->id;

                // Sacar los id de los grupos de que selecciono el usuario
                $groups=$request->private;
                foreach($groups as $group){
                    $contactGroup = ContactGroup::updateOrCreate(
                        ['contact_id' =>$contact_id,
                         'group_id' => (int)$group
                        ]
                    );
                }

            }          
        }

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
    public function update(Request $request)
    {
        $contact_id=$request->input('contact_id');

        $contact=Contact::find((int)$contact_id);
        $image=$request->file('image');
        $validation= $request->validate([
            'nombre' => 'required|string|max:255'
        ]);
        // var_dump($contact); die();

        if($image){
            $image_path_name = time().$image->getClientOriginalName();
            Storage::disk('public')->put($image_path_name, File::get($image));
        }

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
        $contact->favorite= $request->favorite ?? null;
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
        return view('contact.form-edit', ['countrys'=>$countrys, 'contact'=>$contact, 'groups'=>$groups, 'users'=>$users]);
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
        // var_dump($user_id); die();
        if((int)$user_id == auth()->user()->id){

            // Buscar el contacto para ver si esta compartido
            $search=ContactGroup::where('contact_id',(int)$contact_id)->get();
            if($search){
                ContactGroup::where('contact_id', (int)$contact_id)->delete();
            }
            $delete_contact=Contact::find((int)$contact_id);
            $borrado=$delete_contact->delete();
            var_dump($borrado);
                if(isset($borrado)){
                            
                    return redirect()->route('contact.list')
                                    ->with(['message'=>'Contacto eliminado exitosamente']);
                }else{
                    return redirect()->route('contact.list')
                                    ->with(['error'=>'No se ha podido eliminar el contacto']);
                }   
                
        }else{
            return redirect()->route('contact.list')
                            ->with(['error'=>'No esta autorizado para eliminar este contacto']);
        }
    }
}
