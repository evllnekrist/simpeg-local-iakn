<?php

namespace App\Http\Controllers\API;

use DB;
use App\Models\User;
use App\Traits\PushLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * Class RoleController.
 *
 * @author  Evelline <ev.attoff@gmail.com>
 */
class RoleController extends APIController
{
    use PushLog;
    protected $model                        = 'Role';
    protected $model_eloquent               = 'App\Models\Role';
    protected $role_permission_eloquent     = 'App\Models\RolePermission';
    protected $readable_name                = 'Peran'; 
    protected $file_indexes                 = array('');
    
    /**
     * @OA\Get(
     *     path="/api/role",
     *     tags={"Role - CRUD"},
     *     summary="Display a listing of items",
     *     operationId="roleIndex",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="_page",
     *         in="query",
     *         description="current page",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_limit",
     *         in="query",
     *         description="max item in a page",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=10
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_search",
     *         in="query",
     *         description="word to search",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_dir",
     *         in="query",
     *         description="order by direction",
     *         required=false,
     *         @OA\Schema(
     *             type="object",
     *         )
     *     ),
     * )
     */
    public function index(Request $request)
    {
        if(!$request->get('_dir')){
            $request->merge(['_dir' => array('id'=>'ASC')]); 
        }
        // $filter['equal']        = [];
        $filter['search']       = ['name'];
        return $this->get_list_common($request, $this->model, $filter, []); 
    }

    /**
     * @OA\Get(
     *     path="/api/role/{id}",
     *     tags={"Role - CRUD"},
     *     summary="Display the specified item",
     *     operationId="roleShow",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Identifier of item that needs to be displayed",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     */
    public function show($id)
    {
        return $this->get_single_common($id, $this->model, []);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
          'name'      => 'required|string|max:255|unique:roles',
          // 'menu_action'  => 'required',
        ]); 
        if ($validator->fails()) {
          // return redirect()->back()->withInput();
          return array('status'=>false, 'message'=>$validator->messages()->first(), 'data'=>null);
        }
  
        DB::beginTransaction();
        try {
          $data     = $request->all(); 
          $output   = $this->model_eloquent::create($data); 
          $output2  = $output3 = null;
          $menu_actions = [];
          if(isset($data['menu_action'])){
            $menu_actions = $data['menu_action']; unset($data['menu_action']);
          }
          if(!empty($this->file_indexes)){
            foreach($this->file_indexes as $index){ // https://laracasts.com/discuss/channels/laravel/how-direct-upload-file-in-storage-folder
              if($request->file($index)){
                $filename_with_ext = $request->file($index)->getClientOriginalName(); // Get filename with the extension
                $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME); // Get just filename
                $extension = $request->file($index)->getClientOriginalExtension(); // Get just ext
                $filename_to_store = str_replace('/','-',$this->model).$output->id.'.'.$extension;
                $path = $request->file($index)->storeAs('public/'.$this->model,$filename_to_store); // Upload Image
                $data[$index] = '/storage//'.$this->model.'/'.$filename_to_store;
              }else{
                unset($data[$index]);
              }
            }
            $data['created_by'] = \Auth::check()?\Auth::user()->id:null;
            $output2 = $this->model_eloquent::where('id',$output->id)->update($data);
          }
          foreach ($menu_actions as $menu_action_id) {
            $output3[$menu_action_id] = $this->role_permission_eloquent::create([
                'role_id' => $output->id,
                // 'menu_id' => ,
                'menu_action_id' => $menu_action_id,
                'is_enabled' => true,
            ]);
          }
          DB::commit();
          $output_final = array('status'=>true, 'message'=>'Berhasil menyimpan data', 'data'=>array('output'=>$output,'output_img'=>$output2, 'output_permission'=>$output3));
        } catch (Exception $e) {
          DB::rollback();
          $output_final = array('status'=>false, 'message'=>$e->getMessage(), 'data'=>null);
        }
        $this->LogRequest('Tambah '.$this->readable_name,$request,$output_final);
        return $output_final;
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
          'name'      => [
            'required',
            'string',
            'max:255',
            Rule::unique('roles', 'name')->ignore($id), // abaikan baris yang sedang diedit;
          ],
          // 'menu_action'  => 'required',
        ]);
        if ($validator->fails()) {
          return array('status'=>false, 'message'=>$validator->messages()->first(), 'data'=>null);
        }
        
        DB::beginTransaction();
        try {
          $output2  = $output3 = null;
          $menu_actions = [];
          if(isset($data['menu_action'])){
            $menu_actions = $data['menu_action']; unset($data['menu_action']);
          }
          if(!empty($this->file_indexes)){
            foreach($this->file_indexes as $index){ // https://laracasts.com/discuss/channels/laravel/how-direct-upload-file-in-storage-folder
              if($request->file($index)){
                $filename_with_ext = $request->file($index)->getClientOriginalName(); // Get filename with the extension
                $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME); // Get just filename
                $extension = $request->file($index)->getClientOriginalExtension(); // Get just ext
                $extension = $request->file($index)->getClientOriginalExtension();
                $filename_to_store = str_replace('/','-',$this->model).$id.'.'.$extension;
                $data[$index] = '/storage//'.$this->model.'/'.$filename_to_store;
                if (file_exists('public/'.$data[$index])){
                  @unlink('public/'.$data[$index]);
                }
                $path = $request->file($index)->storeAs('public/'.$this->model,$filename_to_store); // Upload Image
              }else{
                unset($data[$index]);
              }
            }
            if(isset($data['files'])){
              unset($data['files']);
            }
          }
          $data['updated_by'] = \Auth::check()?\Auth::user()->id:null;
          $output = $this->model_eloquent::where('id',$id)->update($data);
          $this->role_permission_eloquent::where('role_id',$id)->delete();
          foreach ($menu_actions as $menu_action_id) {
            $output3[$menu_action_id] = $this->role_permission_eloquent::create([
                'role_id' => $id,
                'menu_action_id' => $menu_action_id,
                'is_enabled' => true,
            ]);
          }
          DB::commit();
          $output_final = array('status'=>true, 'message'=>'Berhasil mengubah data', 'data'=>array('output'=>$output,'data'=>$data,'id'=>$id));
        } catch (Exception $e) {
          DB::rollback();
          $output_final = array('status'=>false, 'message'=>$e->getMessage(), 'data'=>null);
        }
        $this->LogRequest('Edit '.$this->readable_name,$request,$output_final);
        return json_encode($output_final);
    }
    
    public function destroy($id)
    {
        try {
          // check if there user related to the particular group
          $exist =  User::where('role_id',$id)->get()->toArray();
          if($exist){
            $output_final = array('status'=>false, 'message'=>'Ada user yang berhubungan dengan peran ini. 
            Ubah dahulu peran akun yang terkait ke peran lain untuk dapat menghapus, atau cukup nonaktifkan peran lewat menu edit', 'data'=>$exist);
          }else{
            $org          = $this->model_eloquent::where('id', $id)->first();
            $output2      = $this->model_eloquent::where('id', $id)->update(['deleted_by'    => \Auth::check()?\Auth::user()->id:null]);
            $output       = $this->model_eloquent::where('id', $id)->delete();
            $output_final = array('status'=>true, 'message'=>'Berhasil menghapus data', 'data'=>$org);
          }
        } catch (Exception $e) {
          $output_final = array('status'=>false, 'message'=>$e->getMessage(), 'data'=>null);
        }
        $this->LogRequest('Hapus '.$this->readable_name,$id,$output_final);
        return json_encode($output_final);
    }
}
