<?php

namespace App\Http\Controllers\API;

use App\Helpers\QueryDebugger;
use App\Http\Controllers\Controller;
use App\Traits\PushLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
// use Symfony\Component\HttpKernel\Exception\HttpException;
use OpenApi\Annotations as OA;


 /**
 * @OA\Info(
 *     title="SIMPEG Local: API",
 *     version="1.0.0",
 *     description="This is the API documentation for SIMPEG Local application
 * > Footprint 0.0.0 (2025 June) `adapted from Mandatling, SIIPBANG, PWL Rest API project`
 * > Footprint 0.0.1 (2025 July) `initial development for Kepegawaian of IAKN Palangka Raya`
 * > Footprint x (20xx xx xx) `this-is-footnote-format-please-continue-on-next-dev`",
 *      x={
 *          "logo": {
 *              "url": "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/985px-Laravel.svg.png"
 *          }
 *      },
 *      contact=@OA\Contact(
 *          name="Evelline Krist.",
 *          email="ev.attoff@gmail.com"
 *     ),
 * )
 */
class APIController extends Controller
{
    use PushLog;
    
    public function get_org_model($str){
      return '<i>'.str_replace('App\Models\\','',$str).'</i>';
    }

    public function get_list_common(Request $request, $model, $filter, $with, $with_where = []){
      // return json_encode(\Auth::user());
      try {
      
        // Enable query debugger (dump to screen only)
        // QueryDebugger::enable(); // or QueryDebugger::enable(true, false)
        $data['filter']       = $request->all();
        $model                = 'App\Models\\'.$model;
        $page                 = $data['filter']['_page']  = (@$data['filter']['_page'] ? intval($data['filter']['_page']) : 1);
        $limit                = $data['filter']['_limit'] = (@$data['filter']['_limit'] ? intval($data['filter']['_limit']) : 1000);
        $offset               = ($page?($page-1)*$limit:0);
        $data['products']     = $model::query();
        
        // Apply dynamic with conditions
        foreach ($with as $relation) {
            if (isset($with_where[$relation])) {
                $conditions = $with_where[$relation];
                $data['products'] = $data['products']->whereHas($relation, function ($query) use ($conditions) {
                    foreach ($conditions as $condition => $value) {
                        $query->where(function ($query) use ($value) {
                            foreach ($value as $key) {
                                if (isset($key['like']) && $key['like'] === true) {
                                    $query->orWhereRaw('LOWER(' . $key['column'] . ') LIKE ?', ['%' . strtolower($key['condition']) . '%']);
                                } else {
                                    $query->orWhere($key['column'], $key['condition']);
                                }
                            }
                        });
                    }
                })->with($relation);
            } else {
                $data['products'] = $data['products']->with($relation);
            }
        }

        if(!empty($filter)){ // check if there is filter/s
          //Pencarian dengan equal
          if(isset($filter['equal'])){ // for the case of equal value
            foreach ($filter['equal'] as $key => $value) { // loop of the same case
              if(isset($data['filter']['_'.$value]) && $data['filter']['_'.$value]!="all"){ // check if filter have value
                  $data['products'] = $data['products']->where($value,'=',$data['filter']['_'.$value]);
              }
            }
          }
          //Pencarian dengan Like
          if(isset($filter['search'])){
            foreach ($filter['search'] as $key => $value) {
              if(isset($data['filter']['_'.$value])){ 
                if (isset($data['filter']['column_parent_'.$value])){
                  // Menambahkan kondisi with tambahan
                    $additionalWithConditions = [
                      $data['filter']['column_parent_'.$value] => [
                          'column' => $data['filter']['column_child_'.$value],
                          'condition' => $data['filter']['_'.$value]
                      ],
                  ];

                  foreach ($additionalWithConditions as $relation => $condition) {
                      $data['products'] = $data['products']->whereHas($relation, function ($query) use ($condition) {
                        $query->whereRaw('LOWER(' . $condition['column'] . ') LIKE ?', ['%' . strtolower($condition['condition']) . '%']);
                      })->with($relation);
                  }
                }else{
                  // Cek apakah data adalah tanggal
                  $dateValue = $data['filter']['_'.$value];
                  if ($timestamp = strtotime($dateValue)) {
                      $data['products'] = $data['products']->whereRaw("$value = '".$dateValue."'");
                  } else {
                    $data['products'] = $data['products']->whereRaw("LOWER(".$value.") LIKE '%".strtolower($data['filter']['_'.$value])."%'");
                  }
                }
              }
            }
          }
          //Pencarian dengan kolom berbeda dari nama kolom
          if(isset($filter['different_column'])){ // for the case of equal value
            foreach ($filter['different_column'] as $key => $value) { // loop of the same case
              $newValue = $value[0];
              $newColumn = $value[1];
              $operator = $value[2];
              if(isset($data['filter']['_'.$newValue])){ // check if filter have value
                if ($operator === 'equal') {
                  $data['products'] = $data['products']->where($newColumn,'=',$data['filter']['_'.$newValue]);
                }else{
                  $data['products'] = $data['products']->whereRaw("LOWER(".$newColumn.") LIKE '%".strtolower($data['filter']['_'.$newValue])."%'");
                }
              }
            }
          }
          //pencarian dengan kondisi 1 search beberapa kolom di db
          if(isset($filter['multi_search'])){ 
              foreach ($filter['multi_search'] as $key => $values) {
                $query = "(";
                foreach ($values as $value) {
                  if(isset($data['filter']['_'.$key])){ 
                    if($value == 'is_active'){
                      $query .= $value." = '".strtolower($data['filter']['_'.$key])."' OR ";
                    } else {
                      $query .= "LOWER(".$value.") LIKE '%".strtolower($data['filter']['_'.$key])."%' OR ";
                    }
                  }
                }
                $query = rtrim($query, ' OR ') . ')';
                if ($query !== '()') {
                  $data['products'] = $data['products']->whereRaw($query);
                }
              }
          }
          
          if(\Auth::check()){
            if(\Auth::user()->hasRole('admin')){ // show all

            }else{
              if(isset($filter['permission'])){
                $query = '';
                for ($i=0; $i < sizeof($filter['permission']); $i++) { 
                  $query .= $filter['permission'][$i]." = ".\Auth::user()->id;
                  if($i+1 < sizeof($filter['permission'])){
                      $query .= " or ";
                  }
                }
                $data['products'] = $data['products']->whereRaw("(".$query.")");
              }
              if(isset($filter['permission_role'])){
                $query = '';
                for ($i=0; $i < sizeof($filter['permission_role']); $i++) { 
                  $query .= $filter['permission_role'][$i]." = '".\Auth::user()->roles[0]->slug."'";
                  if($i+1 < sizeof($filter['permission'])){
                      $query .= " or ";
                  }
                }
                $data['products'] = $data['products']->orWhereRaw("(".$query.")");
              }
            }
          }
          
          
          if(!empty($data['filter']['_dir'])){
            foreach ($data['filter']['_dir'] as $key => $value) {
              if($value){
                $data['products'] = $data['products']->orderBy($key,$value);
              }
            }
          }else{ 
            $data['products'] = $data['products']->orderBy(app($model)->getKeyName(),'desc');
          }
        }
        $data['products_count_total']   = $data['products']->count();
        $data['products']               = ($limit==0 && $offset==0)?$data['products']:$data['products']->limit($limit)->offset($offset);
        // $data['products_raw_sql']       = $data['products']->toRawSql();
        // $data['products_binding']       = $data['products']->getBindings();
        // dd($data['products']->toSql(), $data['products']->getBindings());
        $data['products']               = $data['products']->get();    
        $data['products_count_start']   = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+1);
        $data['products_count_end']     = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+sizeof($data['products']));
        return json_encode(array('status'=>true, 'message'=>'Data berhasil diambil', 'data'=>$data));
      } catch (\Exception $e) {
        return json_encode(array('status'=>false, 'message'=>$e->getMessage(), 'data'=>null));
      }
    }

    public function post_common(Request $request, $model, $rules, $file_indexes){
        try {
            $validator = Validator::make($request->all(), $rules); 
            if ($validator->fails()) {
                // throw new HttpException(400, $validator->messages()->first());
                return response()->json(array('message'=>$validator->messages()->first()),400);
            }
            $default_folder     = strtolower($model);
            $model              = 'App\Models\\'.$model;
            $body               = $request->all();

            foreach (array_map('gettype', $body) as $key => $value) { // to find explodes value to be imploded before further action
              if($value == 'array'){
                $body[$key] = implode(',',$body[$key]);
              }
            }
            // dump($body);return;
            $body['created_by']   = \Auth::user()?\Auth::user()->id:'public';
            $body['created_at']   = new \DateTime();
            $item2                = null;
            $item                 = app($model)->create($body);

            // Log SQL query
            $query = app($model)->newQuery();

            $pk = app($model)->getKeyName();
            if($pk != 'id'){ 
                $id = $request->get($pk);
            }else{
                $id = $item->$pk;
            }
            
            if(!empty($file_indexes)){
                if($request->file($file_indexes[0])){
                  $body2          = array();
                }
                foreach($file_indexes as $index){ // https://laracasts.com/discuss/channels/laravel/how-direct-upload-file-in-storage-folder
                  if($request->file($index)){
                    $filename_with_ext = $request->file($index)->getClientOriginalName(); // Get filename with the extension
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME); // Get just filename
                    $extension = $request->file($index)->getClientOriginalExtension(); // Get just ext
                    $filename_to_store = $id.'-'.$index.'.'.$extension;
                    $path = $request->file($index)->storeAs('public/'.$default_folder,$filename_to_store); // Upload Image
                    $body2[$index] = '/storage/'.$default_folder.'/'.$filename_to_store;
                  }
                }
                if($request->file($file_indexes[0])){
                  $item2          = $model::where($pk,$id)->first();
                  $item2->fill($body2)->save();
                }
            }

            $this->LogStatement('Tambah '.$this->get_org_model($model).' Berhasil',json_encode($item2?$item2:$item));
            return response()->json(array('data'=>($item2?$item2:$item),'message'=>'Berhasil ditambahkan!'), 200);
        } catch(\Exception $exception) {
            // throw new HttpException(400, "Data tidak valid : {$exception->getMessage()}");
            $this->LogStatement('Tambah '.$this->get_org_model($model).' Gagal',$exception->getMessage());
            return response()->json(array('message'=>"Data tidak valid : {$exception->getMessage()}"),400);
        }
    }

    public function get_single_common($id, $model, $with){
        $model  = 'App\Models\\'.$model;
        $item   = $model::with($with)->where(app($model)->getKeyName(),$id)->first();
        if(!$item){
            // throw new HttpException(404, 'Item tidak ditemukan');
            return response()->json(array('message'=>'Item tidak ditemukan'),404);
        }
        return $item;
    }

    public function get_single_different($id, $column, $model, $with){
      $model  = 'App\Models\\'.$model;
      $query = $model::with($with)->where($column, $id);
      $item   = $query->get();      
      if(!$item){
          // throw new HttpException(404, 'Item tidak ditemukan');
          return response()->json(array('message'=>'Item tidak ditemukan'),404);
      }
      return $item;
    }

    public function put_common(Request $request, $id, $model, $rules, $file_indexes){
        $default_folder     = strtolower($model);
        $model              = 'App\Models\\'.$model;
        $key_column = isset($id_alias) ? $id_alias : app($model)->getKeyName();
        $item = $model::where($key_column, $id)->first();
        Log::info('SQL Query: ' . $model::where($key_column, $id)->toSql());
        
        if(!$item){
            return response()->json(array('message'=>'Item tidak ditemukan'),404);
        }
        try {
            $body               = $request->all();
            foreach (array_map('gettype', $body) as $key => $value) { // to find explodes value to be imploded before further action
              if($value == 'array'){
                $body[$key] = implode(',',$body[$key]);
              }
            }
            // dump($body);return;
            $validator = Validator::make($body, $rules); 
            if ($validator->fails()) {
                return response()->json(array('message'=>$validator->messages()->first()),400);
            }
            $body['updated_by'] = \Auth::user()->id;
            $body['updated_at'] = new \DateTime();

            if(!empty($file_indexes)){
                foreach($file_indexes as $index){ // https://laracasts.com/discuss/channels/laravel/how-direct-upload-file-in-storage-folder
                  if($request->file($index)){
                    $filename_with_ext = $request->file($index)->getClientOriginalName(); // Get filename with the extension
                    $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME); // Get just filename
                    $extension = $request->file($index)->getClientOriginalExtension(); // Get just ext
                    $filename_to_store = $id.'-'.$index.'.'.$extension;
                    $path = $request->file($index)->storeAs('public/'.$default_folder,$filename_to_store); // Upload Image
                    $body[$index] = '/storage/'.$default_folder.'/'.$filename_to_store;
                  }
                }
            }
           
            $item->fill($body)->save();
            $this->LogStatement('Edit '.$this->get_org_model($model).' Berhasil',json_encode($item));
            return response()->json(array('data'=>$item,'message'=>'Berhasil diubah!'), 200);
        } catch(\Exception $exception) {
          $this->LogStatement('Edit '.$this->get_org_model($model).' Gagal',$exception->getMessage());
          return response()->json(array('message'=>"Data tidak valid : {$exception->getMessage()}"),400);
        }
    }

    public function delete_common($id, $model, $checking_table = [])
    {
        $model  = 'App\Models\\'.$model;
        $item   = $model::where(app($model)->getKeyName(),$id)->first();

        if(!$item){
            return response()->json(array('message'=>'Item tidak ditemukan'),404);
        }

        if(!empty($checking_table)){
            foreach ($checking_table as $key => $value) {
                $relatedModel = 'App\Models\\'.$value['model'];
                $fixValue = isset($value['value']) ? $value['value'] : $id;
                $query = $relatedModel::where($value['column'], $fixValue);
                if($query->exists()){
                    return response()->json(array('message'=>'Data tersebut sudah terpakai di tabel '.$value['model']),404);
                }
            }
        }

        try {
            $item->deleted_by = \Auth::user()->id;
            $item->save();
            $item->delete();

            $this->LogStatement('Hapus'.$this->get_org_model($model).' Berhasil',json_encode($item));
            return response()->json(array('message'=>'Berhasil dihapus!'), 200);
        } catch(\Exception $exception) {
          $this->LogStatement('Hapus '.$this->get_org_model($model).' Gagal',$exception->getMessage());
          return response()->json(array('message'=>"Data tidak valid : {$exception->getMessage()}"),400);
        }
    }
}
