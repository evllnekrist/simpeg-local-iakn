<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;
use App\Models\IndonesianProvince;
use App\Models\IndonesianDistrict;

/**
 * Class City.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="City model",
 *     title="City model",
 *     @OA\Xml(
 *         name="City"
 *     )
 * )
 */

class IndonesianCity extends Model
{
    public $timestamps = false;
    protected $table = 'indonesia_cities';
    protected $fillable = [];

    public function province(){
        return $this->belongsTo(indonesianprovince::class, 'province_code', 'code');
    } 

    public function district(){
        return $this->hasMany(IndonesianDistrict::class, 'city_code', 'code');
    }
}
