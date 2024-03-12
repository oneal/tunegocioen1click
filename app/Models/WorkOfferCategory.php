<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOfferCategory extends Model
{
    use HasFactory;

    public function workoffers(){
        return $this->hasMany(Store::class);
    }

    protected static function booted()
    {
        $arrayPositions = ['a','b','c','d','e','f','1','2','3','4','5','6','7','8','9','10'
            ,'11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29'
            ,'30','31','32','33','34','35','36','37','38','39','40'];

        static::created(function ($workOfferCategory) use ($arrayPositions) {
            $workOfferCategory->name_slug = generateSlug($workOfferCategory->name);
            $workOfferCategory->save();

            $provinces = Provincy::all();
            foreach ($provinces as $provincy) {
                foreach ($arrayPositions as $position) {
                    $workOfferPosition = new WorkOfferPosition();
                    $workOfferPosition->category_id = $workOfferCategory->id;
                    $workOfferPosition->province_id = $provincy->id;
                    $workOfferPosition->name = $position;
                    $workOfferPosition->save();
                }
            }
        });

        static::deleted(function ($workOfferCategory) use ($arrayPositions) {
            storePosition::where('category_id', $workOfferCategory->id)->delete();
        });
    }
}
