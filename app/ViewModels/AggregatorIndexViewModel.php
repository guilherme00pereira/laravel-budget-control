<?php


namespace App\ViewModels;


use App\Models\Aggregator;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AggregatorIndexViewModel extends ViewModel
{
    /**
     * @var Builder[]|Collection
     */
    private array|Collection $aggregators;
    /**
     * @var Category[]|Collection
     */
    private array|Collection $categories;

    public function __construct()
    {
        $this->aggregators  = Aggregator::query()->orderBy('name')->get();
        $this->categories   = Category::all()->sortBy('name');
    }

    public function listAggregators(): Collection|array
    {
        return $this->aggregators;
    }

    public function listCategories(): Collection|array
    {
        return $this->categories;
    }
}
