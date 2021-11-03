<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;

    public $timestamps  = false;
    protected $fillable = ['amount', 'description', 'date', 'is_recurring', 'category_id'];
    protected $dates    = ['date'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function pattern(): HasOne
    {
        return $this->hasOne(RecurringPattern::class, 'event_id');
    }

    public function getDateAttribute($value): string
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

}
