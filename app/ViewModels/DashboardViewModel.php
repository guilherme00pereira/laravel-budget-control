<?php

namespace App\ViewModels;

use App\Services\AggregatorSets;
use App\Services\Calculator;
use App\Services\CommonEventsQueries;
use App\Services\FilterRecurringEvents;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardViewModel extends ViewModel
{
    //private string $lastMonthTotal;
    //private string $variation;
    private Collection $events;
    private int $currentMonth;
    private array $currentIncomes;

    public int $variableCosts;
    public float $currentMonthCostAverage;
    public int $daysInMonth;
    public float $currentMonthProjection;
    public float $currentMonthVariableCost;

    public function __construct()
    {
        //$this->lastMonthTotal   = 0;
        //$this->variation        = 0;
        $this->currentMonth                 = Carbon::today()->month;
        $this->events                       = $this->getEventsFromDB();

        $this->daysInMonth                  = Carbon::createFromDate(null, $this->currentMonth, null)->daysInMonth;
        $this->currentMonthVariableCost     = $this->sumExpenseByType($this->currentMonth, 1);
        $this->currentMonthCostAverage      = $this->calculateCostAverage();
        $this->currentMonthProjection       = $this->calculateCostProjection();
    }

    /**
     * @return Collection
     */
    private function getEventsFromDB(): Collection
    {
        return DB::table('events')
            ->selectRaw("month(events.date) AS month, events.amount, events.date, events.category_id, categories.category_type_id AS type")
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->whereMonth('events.date', '>', $this->currentMonth - 5)
            ->orderByDesc('month')
            ->get();
    }

    private function appendRecurringEvents($month, $type)
    {
        $mapped      = FilterRecurringEvents::filterByCategoryType($month, $type)
            ->map(function ($item) use ($month, $type) {
               return [
                   'month'          => $month,
                   'amount'         => $item->amount,
                   'type'           => $type,
                   'category_id'    => $item->category_id
               ] ;
            });

        foreach ($mapped as $item) {
            $this->events->push($item);
        }
    }

    private function getMonths(): array
    {
        return $this->events->keyBy(function ($row){
            return $row->month;
        })->keys()->toArray();
    }

    public function getEvents(): array
    {
        $events     = [];
        $months     = $this->getMonths();
        foreach ($months as $month) {

            $income        = $this->sumExpenseByType($month, 3);
            $fixed         = $this->sumExpenseByType($month, 2);
            $occasionally  = $this->sumExpenseByType($month, 4);
            $variable      = $month == $this->currentMonth ? $this->calculateCostProjection() :  $this->sumExpenseByType($month, 1);


            $events[$month] =
                [
                    'month'         => $month,
                    'income'        => $income,
                    'fixed'         => $fixed,
                    'occasionally'  => $occasionally,
                    'variable'      => $variable,
                    'total'         => ($fixed + $occasionally + $variable),
                    'diff'          => $income - ($fixed + $occasionally + $variable)
                ];
        }
        return $events;
    }

    private function sumExpenseByType($month, $type)
    {
        $this->appendRecurringEvents($month, $type);
        return $this->events
            ->where('type', '=', $type)
            ->where('month', '=', $month)
            ->sum('amount');
    }

    private function calculateCostAverage() : float
    {
        $divider = Carbon::now()->day;
        $maxDay = $this->events
            ->where('month', '=', $this->currentMonth)
            ->where('type', '=', '1')
            ->max('date');
        if(!is_null($maxDay))
            $divider = Carbon::createFromFormat("Y-m-d", $maxDay)->day;
        return $this->currentMonthVariableCost / $divider;
    }

    private function calculateCostProjection() : float
    {
        return $this->currentMonthCostAverage * $this->daysInMonth;
    }

    public function spendingPerCategory() : Collection
    {
        return CommonEventsQueries::spendingPerCategoryPerMonth($this->currentMonth);
    }

}
