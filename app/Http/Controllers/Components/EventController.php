<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    /**
     * Registra un evento asociado a una negociación
     *
     * @method    setEvent
     *
     *
     * @param     Request     $request    Objeto con información de la petición
     *
     * @return  JsonResponse  Objeto con los datos de respuesta a la petición
     */
    public function setEvent(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'start_at' => ['required', 'date'],
            'start_time' => ['required'],
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
            'end_time' => ['required', 'after_or_equal:start_time']
        ], [
            'title.required' => 'Dato requerido',
            'start_at.required' => 'Dato requerido',
            'start_at.date' => 'Debe tener un formato válido',
            'start_time.required' => 'Dato requerido',
            'end_at.required' => 'Dato requerido',
            'end_at.date' => 'Debe tener un formato válido',
            'end_at.after_or_equal' => 'Debe ser posterior a Fecha de Inicio',
            'end_time.required' => 'Dato requerido',
            'end_time.after_or_equal' => 'Debe ser posterior a Hora de Inicio'
        ]);

        $start = strtotime($request->start_at. ' '.$request->start_time);
        $end = strtotime($request->end_at. ' '.$request->end_time);

        $startDate = date("Y-m-d H:i:s", $start);
        $endDate = date("Y-m-d H:i:s", $end);

        $model = "App\\" . ucfirst($request->modelRelationClass);

        Event::create([
            "category" => $request->category ?? 'O',
            'title' => $request->title,
            'start_at' => $startDate,
            'end_at' => $endDate,
            'notes' => $request->description,
            'place' => $request->place ?? null,
            'user_id' => auth()->user()->id,
            'eventable_id' => $request->modelRelationId,
            'eventable_type' => $model
        ]);

        return response()->json(['result' => true], 200);
    }

    /**
     * Obtiene el listado de eventos asociados a una negociación
     *
     * @method    getEvents
     *
     *
     * @param     Negotiation    $negotiation    Objeto con datos de la negociación
     *
     * @return    JsonResponse   Objeto con datos de respuesta a la petición
     */
    public function getEvents($class, $id)
    {
        $model = "App\\" . ucfirst($class);
        $record = $model::find($id);

        if (!$record || !method_exists($record, 'events')) {
            return response()->json(['result' => true, 'events' => []]);
        }

        return response()->json([
            'result' => true, 'events' => $record->events()->orderBy('created_at', 'desc')->get()
        ], 200);
    }
}
