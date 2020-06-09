<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Jenssegers\Agent\Agent;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Constructor base para todos los controladores que extiendan de éste.
     * Permite compartir datos (en variables) entre todas las vistas del sistema
     */
    public function __construct()
    {
        if (!app()->runningInConsole()) {

            /**
             * Detecta el dispositivo que accesa a la aplicacion (mobile, tableta, pc, etc)
             * @var Agent
             * Ejemplos de metodos a aplicar en https://github.com/jenssegers/agent o
             * https://github.com/serbanghita/Mobile-Detect/wiki/Code-examples
             */
            $device = new Agent();
        }
    }
}
