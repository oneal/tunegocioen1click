<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($blogCategory) {
            $blogCategory->name_slug = generateSlug($blogCategory->name);
            $blogCategory->save();
        });
    }
}
