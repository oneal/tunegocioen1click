<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomePosition extends Model
{
    use HasFactory;

    protected $fillable = ['in_used'];

    function home(): BelongsTo{
        return $this->belongsTo(Home::class, 'home_id');
    }
}
