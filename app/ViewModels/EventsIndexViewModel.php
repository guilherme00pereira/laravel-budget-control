<?php

namespace App\ViewModels;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EventsIndexViewModel extends ViewModel
{
    private int $selected_month;
    public $events;

    public function __construct(int $month)
    {
        $this->selected_month   = $month;
        $this->events           = Event::whereMonth('date', $month)
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->where('categories.category_type_id', '=', '1')
            ->where('is_recurring', '<>', '1')
            ->orderBy('date')
            ->get();
    }
    public function spendingPerDay() : Collection
    {
        $days_in_month = collect(range(1, Carbon::createFromDate(null, $this->selected_month, null)->daysInMonth));
        $spends = DB::table('events')
            ->selectRaw("day(date) AS day, sum(amount) AS total")
            ->whereMonth('date', $this->selected_month)
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->where('categories.category_type_id', '=', '1')
            ->groupByRaw("day(date)")
            ->get()
            ->mapWithKeys(function ($row) {
                return [(int)$row->day => $row->total];
            });
        return $days_in_month->mapWithKeys(function($day) use ($spends) {
            if($spends->has($day)){
                return [$day => $spends[$day]];
            }
            return [$day => 0];
        });
    }

}
