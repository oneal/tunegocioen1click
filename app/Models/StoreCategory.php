<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
{
    use HasFactory;

    public function stores(){
        return $this->hasMany(Store::class);
    }

    protected static function booted()
    {
        $arrayPositions = ['a','b','c','d','e','f','1','2','3','4','5','6','7','8','9','10'
            ,'11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29'
            ,'30','31','32','33','34','35','36','37','38','39','40'];

        static::created(function ($storeCategory) use ($arrayPositions) {
            $storeCategory->name_slug = generateSlug($storeCategory->name);
            $storeCategory->save();

            $provinces = Provincy::all();
            foreach ($provinces as $provincy) {
                foreach ($arrayPositions as $position) {
                    $storePosition = new StorePosition();
                    $storePosition->category_id = $storeCategory->id;
                    $storePosition->province_id = $provincy->id;
                    $storePosition->name = $position;
                    $storePosition->save();
                }
            }
        });

        static::deleted(function ($storeCategory) use ($arrayPositions) {
            storePosition::where('category_id', $storeCategory->id)->delete();
        });
    }
}
