<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
// use App\Models\Log;
// use DB;

class LogController extends Controller
{   
    public function index()
    {
      return view('pages.log.index');
    }
}
