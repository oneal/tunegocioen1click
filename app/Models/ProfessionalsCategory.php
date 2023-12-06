<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalsCategory extends Model
{
    use HasFactory;

    public function professionals(){
        return $this->hasMany(Professional::class);
    }

    protected static function booted()
    {
        $arrayPositions = ['a','b','c','d','e','f','1','2','3','4','5','6','7','8','9','10'
        ,'11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29'
        ,'30','31','32','33','34','35','36','37','38','39','40'];

        static::created(function ($professionalCategory) use ($arrayPositions) {
            $professionalCategory->name_slug = generateSlug($professionalCategory->name);
            $professionalCategory->save();

            $provinces = Provincy::all();
            foreach ($provinces as $provincy) {
                foreach ($arrayPositions as $position) {
                    $professionalPosition = new ProfessionalPosition();
                    $professionalPosition->category_id = $professionalCategory->id;
                    $professionalPosition->province_id = $provincy->id;
                    $professionalPosition->name = $position;
                    $professionalPosition->save();
                }
            }
        });

        static::deleted(function ($professionalCategory) use ($arrayPositions) {
            ProfessionalPosition::where('category_id', $professionalCategory->id)->delete();
        });
    }
}
