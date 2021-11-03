<?php

namespace App\ViewModels;

use App\Models\Category;
use App\Models\Event;
use App\Services\Calculator;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\Pure;


class CategoryShowEventsViewModel extends ViewModel
{
    public $events;
    private Collection $spendingPerMonth;
    private float $currentMonthSumAmount;
    private float $previousMonthSumAmount;
    public Category $category;
    private float $projection;
    private float $variation;
    private int $selectedMonth;
    private int $previousMonth;
    private int $daysInMonth;


    public function __construct(Category $category, int $month)
    {
        $this->category         = $category;
        $this->selectedMonth    = $month;
        $this->previousMonth    = $month == 1 ? 12 : $month -1;
        $this->daysInMonth      = Carbon::createFromDate(null, $month, null)->daysInMonth;
        $this->events           = Event::whereMonth('date', $month)
            ->where('category_id', $category->id)
            ->orderBy('date')
            ->get();
        $this->spendingPerMonth = $this->spendingPerMonth();
        $this->projection       = $this->calculateProjection();
        $this->variation        = $this->calculateVariation();
    }

    private function calculateProjection(): float
    {
        return ($this->currentMonthSumAmount / Carbon::now()->day) * $this->daysInMonth;
    }

    #[Pure] private function calculateVariation(): float
    {
        return Calculator::variationFromTwoValues($this->previousMonthSumAmount, $this->currentMonthSumAmount);
    }

    /**
     * @return float
     */
    public function getProjection(): float
    {
        return $this->projection;
    }

    /**
     * @return float
     */
    public function getCurrentMonthSumAmount(): float
    {
        return $this->currentMonthSumAmount;
    }

    /**
     * @return float
     */
    public function getVariation(): float
    {
        return $this->variation;
    }


    public function isVariable(): bool
    {
        if('Variable' === $this->category->categoryType->name)
            return true;
        return false;
    }

    private function spendingPerMonth(): Collection
    {
        return DB::table('events')
            ->selectRaw("month(date) AS month, sum(amount) AS total")
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->where('categories.category_type_id', '=', '1')
            ->where('events.category_id', $this->category->id)
            ->groupByRaw("month(date)")
            ->take(10)
            ->get()
            ->mapWithKeys(function ($row) {
                if((int)$row->month == $this->selectedMonth) {
                    $this->currentMonthSumAmount = $row->total;
                }
                if((int)$row->month == $this->previousMonth) {
                    $this->previousMonthSumAmount = $row->total;
                }
                return [(int)$row->month => $row->total];
            });
    }

    /**
     * @return Collection
     */
    public function getSpendingPerMonth(): Collection
    {
        return $this->spendingPerMonth;
    }
}
