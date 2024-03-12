<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;
    use HasFactory;

    function restaurantPosition(): HasOne{
        return $this->hasOne(RestaurantPosition::class, 'position_id');
    }

    function province(): belongsTo{
        return $this->belongsTo(Provincy::class, 'province_id');
    }

    function category(): belongsTo{
        return $this->belongsTo(RestaurantCategory::class, 'category_id');
    }

    function invoice(): BelongsTo{
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
