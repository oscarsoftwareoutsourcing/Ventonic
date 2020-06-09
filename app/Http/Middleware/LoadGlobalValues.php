<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;




class LoadGlobalValues
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $agent = new Agent();
      
        $browser = strtolower($agent->browser());
        $type_device = $agent->isDesktop() ? 'desktop' : 'mobile';
        $application = request()->is('*app*') ? 'app' : 'browser';

        $app_user_agent = $browser.'-'.$type_device.'-'.$application;

        View::share('app_user_agent', $app_user_agent);
        View::share('type_device', $type_device);
        
        return $next($request);
    }
}
