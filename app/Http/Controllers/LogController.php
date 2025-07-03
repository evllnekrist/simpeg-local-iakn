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

    // -------------------------------------- CALLED BY AJAX ---------------------------- start
      public function get_list(Request $request)
      {
        // $filter['equal']        = [];
        $filter['search']       = ['subject'];
        $filter['search_jsonb'] = ['request'=>'message','response'=>'message'];
        return $this->get_list_common($request, 'Log', $filter, ['creator.user_group_attr']);
      }
    // -------------------------------------- CALLED BY AJAX ---------------------------- end
}
