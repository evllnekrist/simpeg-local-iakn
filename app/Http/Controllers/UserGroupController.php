<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\PushLog;
use App\Models\User;
use App\Models\UserGroup;
use DB;

class UserGroupController extends Controller
{
    use PushLog;
    private $readable_name    = 'Satuan Kerja'; 
    private $default_folder   = 'user-group/';
    private $file_indexes     = array('img_main');
    
    public function index()
    {
      $data['is_deletable'] = $this->findBySlug($this->findBySlug(session('role_permission'), 'slug','/user-group')['permit'], 'name','delete'); 
      return view('pages.user-group.index', $data);
    }
    public function form_add()
    {
      return view('pages.user-group.add');
    }
    public function form_edit($id)
    {
      $data['selected'] = UserGroup::find($id);
      if($data['selected']){
        return view('pages.user-group.edit', $data);
      }else{
        return $this->show_error_404('Satuan Kerja');
      }
    }

    // -------------------------------------- CALLED BY AJAX ---------------------------- start
      public function get_list(Request $request)
      {
        // $filter['equal']  = [];
        $filter['search'] = ['nickname','fullname'];
        return $this->get_list_common($request, 'UserGroup', $filter, []);
      }
      public function post_delete($id)
      {
          // $items =  User::where('user_group_id',$id)->get()->toArray();
          // dump(empty($items));
          // dd($items);
          try {
            // check if there user related to the particular group
            $items =  User::where('user_group_id',$id)->get()->toArray();
            if(!empty($items)){
              $output_final = array('status'=>false, 'message'=>'Ada user yang berhubungan dengan satuan kerja ini. 
              Hapus dahulu akun yang terkait jika ingin menghilangkan group pengguna, atau cukup nonaktifkan group pengguna lewat menu edit', 'data'=>$items);
            }else{
              $output2 = UserGroup::where('id', $id)->update(['deleted_by'    => \Auth::check()?\Auth::user()->id:null]);
              $output = UserGroup::where('id', $id)->delete();
              $output_final = array('status'=>true, 'message'=>'Berhasil menghapus data', 'data'=>$output);
            }
          } catch (Exception $e) {
            $output_final = array('status'=>false, 'message'=>$e->getMessage(), 'data'=>null);
          }
          $this->LogRequest('Hapus '.$this->readable_name,$id,$output_final);
          return json_encode($output_final);
      }
      public function post_add(Request $request)
      {
          $validator = Validator::make($request->all(), [
            'fullname'  => 'required',
            'nickname'  => 'required',
            'email'     => 'required',
            'phone'     => 'required',
          ]); 
          if ($validator->fails()) {
            // return redirect()->back()->withInput();
            $output_final = array('status'=>false, 'message'=>$validator->messages()->first(), 'data'=>null);
          }
    
          DB::beginTransaction();
          try {
            $data = $request->all(); 
            $output = UserGroup::create($data); $output2 = null;
            if(!empty($this->file_indexes)){
              foreach($this->file_indexes as $index){ // https://laracasts.com/discuss/channels/laravel/how-direct-upload-file-in-storage-folder
                if($request->file($index)){
                  $filename_with_ext = $request->file($index)->getClientOriginalName(); // Get filename with the extension
                  $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME); // Get just filename
                  $extension = $request->file($index)->getClientOriginalExtension(); // Get just ext
                  // $filename_to_store = $index.'_'.time().'.'.$extension; // V1
                  // $filename_to_store = $this->format_filename($request); // V2
                  $filename_to_store = str_replace('/','-',$this->default_folder).$output->id.'.'.$extension;
                  $path = $request->file($index)->storeAs('public/'.$this->default_folder,$filename_to_store); // Upload Image
                  $data[$index] = '/storage//'.$this->default_folder.'/'.$filename_to_store;
                }else{
                  unset($data[$index]);
                }
              }
              $data['created_by'] = \Auth::check()?\Auth::user()->id:null;
              $output2 = UserGroup::where('id',$output->id)->update($data);
            }
            DB::commit();
            $output_final = array('status'=>true, 'message'=>'Berhasil menyimpan data', 'data'=>array('output'=>$output,'output_img'=>$output2));
          } catch (Exception $e) {
            DB::rollback();
            $output_final = array('status'=>false, 'message'=>$e->getMessage(), 'data'=>null);
          }
          $this->LogRequest('Tambah '.$this->readable_name,$request,$output_final);
          return $output_final;
      }
      public function post_edit(Request $request)
      {
          // dd($request->all());
          $validator = Validator::make($request->all(), [
            'fullname'  => 'required',
            'nickname'  => 'required',
            'email'     => 'required',
            'phone'     => 'required',
          ]); 
          if ($validator->fails()) {
            $output_final = array('status'=>false, 'message'=>$validator->messages()->first(), 'data'=>null);
          }else{
            DB::beginTransaction();
            try {
              $data = $request->all();
              $id = $data['id']; unset($data['id']);
              if(!empty($this->file_indexes)){
                foreach($this->file_indexes as $index){ // https://laracasts.com/discuss/channels/laravel/how-direct-upload-file-in-storage-folder
                  if($request->file($index)){
                    $filename_with_ext = $request->file($index)->getClientOriginalName(); // Get filename with the extension
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME); // Get just filename
                    $extension = $request->file($index)->getClientOriginalExtension(); // Get just ext
                    $extension = $request->file($index)->getClientOriginalExtension();
                    // $filename_to_store = $index.'_'.time().'.'.$extension; // V1
                    // $filename_to_store = $this->format_filename($request); // V2
                    $filename_to_store = str_replace('/','-',$this->default_folder).$id.'.'.$extension;
                    $data[$index] = '/storage//'.$this->default_folder.'/'.$filename_to_store;
                    if (file_exists('public/'.$data[$index])){
                      @unlink('public/'.$data[$index]);
                    }
                    $path = $request->file($index)->storeAs('public/'.$this->default_folder,$filename_to_store); // Upload Image
                  }else{
                    unset($data[$index]);
                  }
                }
                if(isset($data['files'])){
                  unset($data['files']);
                }
              }
              $data['updated_by'] = \Auth::check()?\Auth::user()->id:null;
              $output = UserGroup::where('id',$id)->update($data);
              DB::commit();
              $output_final = array('status'=>true, 'message'=>'Berhasil mengubah data', 'data'=>array('output'=>$output,'data'=>$data,'id'=>$id));
            } catch (Exception $e) {
              DB::rollback();
              $output_final = array('status'=>false, 'message'=>$e->getMessage(), 'data'=>null);
            }
          }
          $this->LogRequest('Edit '.$this->readable_name,$request,$output_final);
          return json_encode($output_final);
      }
    // -------------------------------------- CALLED BY AJAX ---------------------------- end
}
