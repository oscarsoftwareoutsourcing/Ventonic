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

        list($day, $month, $year) = explode("-", $request->called_at);

        $followTask = ($request->follow_task!==null) ? explode("-", $request->follow_task) : null;

        CallEvent::create([
            'called_at' => "$year-$month-$day",
            'called_time' => $request->called_time,
            'description' => $request->description,
            'follow_task' => ($followTask!==null) ? "$followTask[2]-$followTask[1]-$followTask[0]" : null,
            'contact_id' => $request->contact_id,
            'call_result_id' => $request->call_result_id ?? null,
            'calleventable_id' => $request->modelRelationId,
            'calleventable_type' => $model,
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['result' => true], 200);
    }

    /**
     * Obtiene un listado de llamadas registradas
     *
     * @method    getCalls
     *
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

        return response()->json([
            'result' => true,
            'calls' => $record->callEvents()->orderBy('called_at', 'desc')->orderBy('called_time', 'desc')->get()
        ], 200);
    }
}
