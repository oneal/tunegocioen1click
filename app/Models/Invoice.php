<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    const HOME_TYPE = 1;
    const HOTEL_TYPE = 2;
    const PROFESSIONAL_TYPE = 3;
    const RESTAURANT_TYPE = 4;
    const STORE_TYPE = 5;
    const WORK_OFFER_TYPE = 6;
    const BLOG_ADS_TYPE = 7;

    public function getTotalAttribute($value)
    {
        return number_format($value/100, 2, ',', '.');
    }

    public function invoiceLines():HasMany{
        return $this->hasMany(InvoiceLine::class, 'invoice_id');
    }
}
