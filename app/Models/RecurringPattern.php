<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecurringPattern extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['day_of_week', 'week_of_month', 'day_of_month', 'month_of_year', 'num_of_occurrences', 'event_id', 'recurring_type_id'];
    protected $attributes = [
        'num_of_occurrences' => 0,
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function recurring_type(): BelongsTo
    {
        return $this->belongsTo(RecurringType::class);
    }
}
