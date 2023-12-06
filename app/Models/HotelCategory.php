<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    use HasFactory;

    public function hotels(){
        return $this->hasMany(Hotel::class);
    }

    protected static function booted()
    {
        $arrayPositions = ['a','b','c','d','e','f','1','2','3','4','5','6','7','8','9','10'
        ,'11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29'
        ,'30','31','32','33','34','35','36','37','38','39','40'];

        static::created(function ($hotelCategory) use ($arrayPositions) {
            $hotelCategory->name_slug = generateSlug($hotelCategory->name);
            $hotelCategory->save();

            $provinces = Provincy::all();
            foreach ($provinces as $provincy) {
                foreach ($arrayPositions as $position) {
                    $hotelPosition = new HotelPosition();
                    $hotelPosition->category_id = $hotelCategory->id;
                    $hotelPosition->province_id = $provincy->id;
                    $hotelPosition->name = $position;
                    $hotelPosition->save();
                }
            }
        });

        static::deleted(function ($hotelCategory) use ($arrayPositions) {
            HotelPosition::where('category_id', $hotelCategory->id)->delete();
        });
    }
}
