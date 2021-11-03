<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public $timestamps  = false;
    protected $fillable = ['name', 'category_type_id'];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function aggregators(): BelongsToMany
    {
        return $this->belongsToMany(Aggregator::class);
    }

    public function categoryType(): BelongsTo
    {
        return $this->belongsTo(CategoryType::class);
    }

}
