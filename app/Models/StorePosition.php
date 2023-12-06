<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StorePosition extends Model
{
    use HasFactory;

    function store(): BelongsTo{
        return $this->belongsTo(Store::class, 'store_id');
    }
}
