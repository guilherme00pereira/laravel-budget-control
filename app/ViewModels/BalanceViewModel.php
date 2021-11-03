<?php

namespace App\ViewModels;

use App\Models\Event;
use App\ViewModels\ViewModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BalanceViewModel extends ViewModel
{
    private $events;
    public $incomes;
    public $fixed;

    public function __construct(int $month)
    {
        $this->events              = Event::whereMonth('date', $month)->orderBy('date')->get();
        $this->incomes             = $this->events->where('is_income', true);
        $this->events->fresh();
        $this->fixed               = $this->events->where('is_fixed', true);
    }

    public function totalIncomes()
    {
        return $this->incomes->sum(function($e){
            return $e->amount;
        });
    }

    public function totalFixed()
    {
        return $this->fixed->sum(function($e){
            return $e->amount;
        });
    }

    public function balance()
    {
        return $this->totalIncomes() - $this->totalFixed();
    }


}
