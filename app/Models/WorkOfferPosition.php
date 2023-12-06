<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkOfferPosition extends Model
{
    use HasFactory;

    function workoffer(): BelongsTo{
        return $this->belongsTo(WorkOffer::class, 'work_offer_id');
    }
}
