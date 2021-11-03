<?php

namespace App\Http\Middleware;

use App\Models\CostCenter;
use Closure;
use Illuminate\Http\Request;

class CostCenterSession
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session('cost_center')){
            $cc = CostCenter::where('id', 1)->get();
            session(['cost_center' => $cc]);
        }
        return $next($request);
    }
}
