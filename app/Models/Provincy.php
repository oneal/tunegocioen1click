<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincy extends Model
{
    use HasFactory;

    public function scopeProvincies($query)
    {
        return $query->where('id', '>', 0);
    }

    protected static function booted()
    {
        static::created(function ($provincy) {
            $provincy->name_slug = generateSlug($provincy->name);
            $provincy->save();
        });
    }
}
