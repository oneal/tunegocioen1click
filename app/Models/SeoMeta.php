<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeoMeta extends Model
{
    use HasFactory;

    function seotype(): belongsTo{
        return $this->belongsTo(SeoType::class, 'seo_type_id');
    }
}
