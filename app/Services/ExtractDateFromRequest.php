<?php


namespace App\Services;


use Carbon\Carbon;
use Illuminate\Http\Request;

class ExtractDateFromRequest
{
    public static function process(Request $request): array
    {
        $month          = Carbon::now()->month;
        $year           = Carbon::now()->year;
        if(!is_null($request->query('m'))){
            $month      = intval(substr($request->query('m'), 0, 2));
            $year       = intval(substr($request->query('m'), 3, 4));
        }
        $date           = Carbon::create($year, $month)->format('F Y');
        return [$month, $date];
    }
}
