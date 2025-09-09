<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;
use App\Models\IndonesianCity;

/**
 * Class IndonesianProvince.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="Province model",
 *     title="Province model",
 *     @OA\Xml(
 *         name="Province"
 *     )
 * )
 */

class IndonesianProvince extends Model
{
    public $timestamps = false;
    protected $table = 'indonesian_provinces';
    protected $fillable = [];

    public function indonesian_city(){
        return $this->hasMany(IndonesianCity::class, 'province_code', 'code');
    }
}
