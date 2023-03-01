<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Closure;
use App\Setting;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = ['admin/*', 'admin'];

    public function handle($request, Closure $next)
    {
        $data = Setting::where('setting_slug','=','under_maintenance_mode')->where('setting_value','=',1)->first();
        if(!empty($data) && !$request->is('admin/*') && !$request->is('admin') ){
            return response()->view('errors.503',[],500);
        }
        return $next($request);
    }
}
