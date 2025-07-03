<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\PushLog;
use App\Models\Pegawai;
use DB;

class EmployeeController extends Controller
{
    use PushLog;
    // private $readable_name    = 'Satuan Kerja'; 
    // private $default_folder   = 'user-group/';
    // private $file_indexes     = array('img_main');
    
    public function index()
    {
      return view('pages.employee.index');
    }
    public function form_add()
    {
      return view('pages.employee.add');
    }
    public function form_edit($id)
    {
      $data['selected'] = Pegawai::find($id);
      if($data['selected']){
        return view('pages.employee.edit', $data);
      }else{
        return $this->show_error_404('Pegawai');
      }
    }

    // -------------------------------------- CALLED BY AJAX ---------------------------- start
    // -------------------------------------- CALLED BY AJAX ---------------------------- end
}
