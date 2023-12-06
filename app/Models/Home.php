<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Home extends Model
{
    use SoftDeletes;
    use HasFactory;

    function homePosition(): HasOne{
        return $this->hasOne(HomePosition::class, 'position_id');
    }

    function province(): BelongsTo{
        return $this->belongsTo(Provincy::class, 'province_id');
    }

    function invoice(): BelongsTo{
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
