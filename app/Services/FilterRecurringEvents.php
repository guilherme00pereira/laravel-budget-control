<?php

namespace App\Services;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class FilterRecurringEvents
{
    public static function filterByCategoryType(int $month, int $category_type = 1) : Collection
    {
        $now = Carbon::createFromDate(null,$month);
        $recurringEvents = Event::query()
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->join('recurring_patterns', 'recurring_patterns.event_id', '=', 'events.id')
            ->where('categories.category_type_id', '=', $category_type)
            ->get();
        return $recurringEvents->filter(function ($item, $key) use ($month, $now) {
            $initialDate            = Carbon::createFromFormat('d/m/Y', $item->date);
            $beginAfterCurrentMonth = $initialDate->month < $month;
            $initialDate->addMonths($item->num_of_occurrences);
            return $initialDate->gte($now) && $beginAfterCurrentMonth;
        });
    }
}
