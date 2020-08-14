<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    /**
     * Registra una nota para una negociación
     *
     * @method    setNote
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request    $request    Objeto con la respuesta a la petición
     *
     * @return    JsonResponse Objeto con información de respuesta
     */
    public function setNote(Request $request)
    {
        $this->validate($request, [
            'description' => ['required'],
            'modelRelationId' => ['required']
        ], [
            'description.required' => 'Debe indicar una nota'
        ]);

        $model = "App\\" . ucfirst($request->modelRelationClass);

        Note::create([
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'noteable_id' => $request->modelRelationId,
            'noteable_type' => $model
        ]);
        return response()->json(['result' => true], 200);
    }

    /**
     * Listado de notas asociadas a una negociación
     *
     * @method    getNotes
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Negotiation      $negotiation    Objeto con datos de la negociación
     *
     * @return    JsonResponse Objeto con información de respuesta
     */
    public function getNotes($class, $id)
    {
        $model = "App\\" . ucfirst($class);
        $record = $model::find($id);

        if (!$record || !method_exists($record, 'notes')) {
            return response()->json(['result' => true, 'notes' => []]);
        }

        return response()->json([
            'result' => true, 'notes' => $record->notes()->orderBy('created_at', 'desc')->get()
        ], 200);
    }
}
