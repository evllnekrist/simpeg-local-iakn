<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Validator;
// use Illuminate\Http\Request;
use App\Traits\PushLog;
use App\Models\Pegawai;
// use DB;

class StatisticController extends Controller
{
    use PushLog;
    
    public function index()
    {
      return view('pages.statistic.index');
    }
}
