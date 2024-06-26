<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestaurantPosition extends Model
{
    use HasFactory;

    protected $fillable = ['in_used'];

    function restaurant(): BelongsTo{
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
