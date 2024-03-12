<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogsAd extends Model
{
    use SoftDeletes;
    use HasFactory;

    function blog(): BelongsTo{
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    function province(): BelongsTo{
        return $this->belongsTo(Provincy::class, 'province_id');
    }

    function invoice(): BelongsTo{
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
