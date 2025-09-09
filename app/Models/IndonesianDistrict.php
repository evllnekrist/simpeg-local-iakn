<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;
use App\Models\IndonesianCity;
use App\Models\IndonesianVillage;

/**
 * Class District.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="District model",
 *     title="District model",
 *     @OA\Xml(
 *         name="District"
 *     )
 * )
 */

class IndonesianDistrict extends Model
{
    public $timestamps = false;
    protected $table = 'indonesia_districts';
    protected $fillable = [];

    public function city(){
        return $this->belongsTo(IndonesianCity::class, 'city_code', 'code');
    }

    public function village(){
        return $this->hasMany(IndonesianVillage::class, 'district_code', 'code');
    }
}
