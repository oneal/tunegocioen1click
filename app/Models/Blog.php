<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($blog) {
            $blog->name_slug = generateSlug($blog->name);
            $blog->save();
        });
    }

    function blogAd(): HasOne{
        return $this->hasOne(BlogsAd::class);
    }
}
