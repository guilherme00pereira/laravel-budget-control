<?php

namespace App\ViewModels;

use App\Models\Event;
use App\Services\FilterRecurringEvents;
use Illuminate\Database\Eloquent\Collection;

class DetailsViewModel extends ViewModel
{
    private Collection $events;
    private string $total;

    public function __construct(int $month, int $type, int $day = 0)
    {
        $this->events   = $this->notRecurringEvents($month, $type, $day);
        $this->addRecurringEvents($month, $type, $day);
        $this->total    = $this->events->sum('amount');
    }

    /**
     * @return mixed
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    /**
     * @return mixed
     */
    public function getTotal(): string
    {
        return $this->total;
    }

    /**
     * @param int $month
     * @param int $type
     * @param int $day
     * @return Collection
     */
    private function notRecurringEvents(int $month, int $type, int $day): Collection
    {
        $events = Event::whereMonth('date', $month)
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->where('is_recurring', '<>', '1')
            ->where('categories.category_type_id', '=', $type);
        if($day > 0) $events = $events->whereDay('date', $day);
        return $events->orderBy('date')->get('events.*');
    }

    private function addRecurringEvents(int $month, int $type, int $day)
    {
        $recurring      = FilterRecurringEvents::filterByCategoryType($month, $type);
        $recurring->map(function ($item){
            $this->events->push($item);
        });
    }

}
