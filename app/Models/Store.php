<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;
    use HasFactory;

    function storePosition(): HasOne{
        return $this->hasOne(StorePosition::class, 'position_id');
    }

    function province(): belongsTo{
        return $this->belongsTo(Provincy::class, 'province_id');
    }

    function category(): belongsTo{
        return $this->belongsTo(StoreCategory::class, 'category_id');
    }

    function invoice(): BelongsTo{
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
