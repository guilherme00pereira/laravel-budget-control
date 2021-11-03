<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CommonEventsQueries
{
    public static function spendingPerCategoryPerMonth($month) : Collection
    {
        return DB::table('events')
            ->selectRaw("categories.name AS category, sum(events.amount) AS total")
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->whereMonth('date', $month)
            ->where('categories.category_type_id', '=', '1')
            ->groupBy("categories.name")
            ->orderByDesc("total")
            ->get()
            ->mapWithKeys(function ($row) {
                return [$row->category => $row->total];
            });
    }
}
