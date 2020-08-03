<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CallEvent;

class CallController extends Controller
{
    /**
     * Registra una nueva llamada
     *
     * @method    setCall
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request    $request    Datos de respuesta a la petición
     */
    public function setCall(Request $request)
    {
        $this->validate($request, [
            'called_at' => ['required', 'date'],
            'called_time' => ['required'],
            'description' => ['required'],
            'contact_id' => ['required']
        ], [
            'called_at.required' => 'Debe indicar la fecha de la llamada',
            'called_at.date' => 'El formato de fecha es incorrecto',
            'description.required' => 'Debe indicar una descripción',
            'contact_id.required' => 'Debe indicar un contacto'
        ]);

        $model = "App\\" . ucfirst($request->modelRelationClass);

        CallEvent::create([
            'called_at' => $request->called_at,
            'called_time' => $request->called_time,
            'description' => $request->description,
            'follow_task' => $request->follow_task ?? null,
            'contact_id' => $request->contact_id,
            'call_result_id' => $request->call_result_id ?? null,
            'calleventable_id' => $request->modelRelationId,
            'calleventable_type' => $model
        ]);

        return response()->json(['result' => true], 200);
    }

    /**
     * Obtiene un listado de llamadas registradas
     *
     * @method    getCalls
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     string      $class    Nombre de la clase a la cual relacionar el registro
     * @param     integer     $id       Identificadregistro a relacionar
     *
     * @return    JsonResponse          Objeto JSON con datos de respuesta a la petición
     */
    public function getCalls($class, $id)
    {
        $model = "App\\" . ucfirst($class);
        $record = $model::find($id);

        if (!$record || !method_exists($record, 'callEvents')) {
            return response()->json(['result' => true, 'calls' => []]);
        }

        return response()->json(['result' => true, 'calls' => $record->callEvents], 200);
    }
}
