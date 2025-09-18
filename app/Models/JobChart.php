<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobChart extends Model
{
    protected $table = 'job_chart';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['position', 'id','parent_id','title','subtitle'];

    public function children() { return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('position'); }
    public function parent()   { return $this->belongsTo(self::class, 'parent_id', 'id'); }
    public function details()  { return $this->hasMany(JobChartDetail::class); }
}
