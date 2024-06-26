<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelPosition extends Model
{
    use HasFactory;

    protected $fillable = ['in_used'];

    function hotel(): BelongsTo{
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
