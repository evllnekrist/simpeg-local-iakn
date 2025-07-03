<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use OpenApi\Annotations as OA;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // Check if the current route is without the 'auth' middleware
        $route = Route::current();
        $routeMiddleware = Route::currentRouteAction();
        
        // If 'auth' middleware is not present, set the session
        if (!$this->routeHasAuthMiddleware($routeMiddleware)) {
          $this->setMinimalSession();
        }
    }

    public function setMinimalSession(){
      // Set session data with 'role_permission'
      Session::put('role_permission', [
          "1" => [
              "name" => "Aktivitas",
              "display_type" => "divider-text",
              "icon" => null,
              "children" => [
                  [
                      "name" => "Statistik",
                      "display_type" => null,
                      "icon" => "candlestick-chart",
                      "slug" => "/statistics",
                      "permit" => [
                          [
                              "id" => 1,
                              "menu_id" => 6,
                              "name" => "list",
                              "slug" => "/statistics",
                              "label" => "Daftar Data",
                              "is_enabled" => true,
                          ]
                      ],
                      "children" => []
                  ],
              ]
          ]
      ]);

    }

    // Helper function to check if a route has the 'auth' middleware
    protected function routeHasAuthMiddleware($routeMiddleware)
    {
        return strpos($routeMiddleware, 'auth') !== false;
    }
    public function show_error_404($object_name = 'Berkas')
    {
      $error_details = array(
        'title' => 'Yaah...',
        'desc' => $object_name . ' yang Anda cari tidak ditemukan.'
      );
      return view('errors.404', $error_details);
    }

    public function show_error_401($object_name = 'Berkas')
    {
      $error_details = array(
        'title' => 'Oops,',
        'desc' => $object_name . ' ini tidak termasuk hak akses Anda.'
      );
      return view('errors.401', $error_details);
    }


    public function get_list_common(Request $request, $model, $filter, $with){
        // return json_encode(\Auth::user());
        try {
          $data['filter']       = $request->all();
          $model                = 'App\Models\\'.$model;
          $page                 = $data['filter']['_page']  = (@$data['filter']['_page'] ? intval($data['filter']['_page']) : 1);
          $limit                = $data['filter']['_limit'] = (@$data['filter']['_limit'] ? intval($data['filter']['_limit']) : 1000);
          $offset               = ($page?($page-1)*$limit:0);
          $data['products']     = $model::with($with);
          
          if(!empty($filter)){ // check if there is filter/s
            if(isset($filter['equal'])){ // for the case of equal value
              foreach ($filter['equal'] as $key => $value) { // loop of the same case
                if(isset($data['filter']['_'.$value]) && $data['filter']['_'.$value]!="all"){ // check if filter have value
                    $data['products'] = $data['products']->where($value,'=',$data['filter']['_'.$value]);
                }
              }
            }
            if(isset($filter['equal_comma'])){ 
              foreach ($filter['equal_comma'] as $key => $value) {
                if(isset($data['filter']['_'.$value])){ 
                    $data['products'] = $data['products']->whereRaw($value." LIKE '%".$data['filter']['_'.$value]."%'");
                }
              }
            }
            if(isset($filter['search'])){
                if(isset($data['filter']['_search'])){
                    $query = "(";
                    for ($i=0; $i < sizeof($filter['search']); $i++) { 
                        $query .= "LOWER(".($filter['search'][$i]).") LIKE '%".strtolower($data['filter']['_search'])."%'";
                        if($i+1 < sizeof($filter['search'])){
                            $query .= " or ";
                        }
                    }
                    $query .= ')';
                    $data['products'] = $data['products']->whereRaw($query);
                }
            }
            if(isset($filter['search_jsonb'])){
                if(isset($data['filter']['_search'])){
                    $query = "("; $i = 0;
                    foreach ($filter['search_jsonb'] as $key => $value) {
                        $query .= "LOWER(".$key."->>'".$value."') LIKE '%".strtolower($data['filter']['_search'])."%'";
                        if($i+1 < sizeof($filter['search_jsonb'])){
                            $query .= " or ";
                        }$i++;
                    }
                    $query .= ')';
                    $data['products'] = $data['products']->orWhereRaw($query);
                }
            }
            if(isset($filter['permission'])) {
              if(\Auth::check()){
                if(\Auth::user()->role_id == 1){}
                else{
                  for ($i=0; $i < sizeof($filter['permission']); $i++) { 
                    $data['products'] = $data['products']->whereRaw("(".$filter['permission'][$i]." = 'public' OR (".$filter['permission'][$i]." = 'user_group' AND user_group_id = ".\Auth::user()->user_group_id."))");
                    if($i+1 < sizeof($filter['permission'])){
                        $query .= " or ";
                    }
                  }
                }
              }else{
                for ($i=0; $i < sizeof($filter['permission']); $i++) { 
                  $data['products'] = $data['products']->whereRaw("(".$filter['permission'][$i]." = 'public')");
                  if($i+1 < sizeof($filter['permission'])){
                    $query .= " or ";
                  }
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
              $data['products'] = $data['products']->orderBy('id','desc');
            }
          }
        
          $data['products_count_total']   = $data['products']->count();
          $data['products']               = ($limit==0 && $offset==0)?$data['products']:$data['products']->limit($limit)->offset($offset);
          $data['products_raw_sql']       = $data['products']->toSql();
          $data['products']               = $data['products']->get();
          $data['products_count_start']   = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+1);
          $data['products_count_end']     = ($data['products_count_total'] == 0 ? 0 : (($page-1)*$limit)+sizeof($data['products']));
          return json_encode(array('status'=>true, 'message'=>'Berhasil mengambil data', 'data'=>$data));
        } catch (Exception $e) {
          return json_encode(array('status'=>false, 'message'=>$e->getMessage(), 'data'=>null));
        }
    }

  function findBySlug($menus, $var, $val) {
    foreach ($menus as $menu) {
        // Check if the slug matches
        if (isset($menu[$var]) && $menu[$var] === $val) {
            return $menu; // Return the matching item
        }

        // Recursively search in children if they exist
        if (isset($menu['children']) && !empty($menu['children'])) {
            $result = $this->findBySlug($menu['children'], $var, $val);
            if ($result) {
                return $result;
            }
        }
    }

    return null; // Return null if not found
  }
}
