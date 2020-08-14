<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CallResult;

class CallResultController extends Controller
{
    /**
     * Obtiene un listado de tipos de resultados de llamadas
     *
     * @method    getCallResults
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @return    JsonResponse  Objeto JSON con datos de respuesta a la petición
     */
    public function getCallResults()
    {
        return response()->json(['result' => true, 'callResults' => CallResult::all()], 200);
    }
}
