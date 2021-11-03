<?php

namespace App\Services;

use App\Models\Aggregator;

class AggregatorSets
{
    public static function getVariableCostCategories() : array
    {
        $ids = [];
        $aggregators = Aggregator::whereIn('id', [1,2,5])->get();
        foreach ($aggregators as $aggregator) {
            foreach ($aggregator->categories as $category)
            {
                $ids[] = $category->id;
            }
        }
        return $ids;
    }
}
