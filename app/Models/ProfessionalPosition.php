<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfessionalPosition extends Model
{
    use HasFactory;

    protected $fillable = ['in_used'];

    function professional(): BelongsTo{
        return $this->belongsTo(Professional::class, 'professional_id');
    }
}
