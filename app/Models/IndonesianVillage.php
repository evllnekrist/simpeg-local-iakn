<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;
use App\Models\IndonesianDistrict;

/**
 * Class Village.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="Village model",
 *     title="Village model",
 *     @OA\Xml(
 *         name="Village"
 *     )
 * )
 */

class IndonesianVillage extends Model
{
    public $timestamps = false;
    protected $table = 'indonesia_villages';
    protected $fillable = [];

    public function district(){
        return $this->belongsTo(IndonesianDistrict::class, 'district_code', 'code');
    }
}
