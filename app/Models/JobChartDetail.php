<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobChartDetail extends Model
{
    protected $table = 'job_chart_details';

    protected $fillable = ['job_chart_id','jabatan','kls','b','k','delta','type','condition','ref'];

    public function jobChart() { return $this->belongsTo(JobChart::class); }
}
