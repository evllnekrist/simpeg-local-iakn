<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Menu;

class RoleController extends Controller
{ 
  public function index()
  {
    // dump(session('role_permission'));
    $data['is_deletable'] = $this->findBySlug($this->findBySlug(session('role_permission'), 'slug','/role')['permit'], 'name','delete'); 
    return view('pages.role.index', $data);
  }
  public function form_add()
  {
    $data['menus'] = Menu::with('menu_action_list')->where('is_menu_with_action', '1')->get();
    return view('pages.role.add', $data);
  }
  public function form_edit($id)
  {
    $data['menus'] = Menu::with('menu_action_list')->where('is_menu_with_action', '1')->get();
    $data['selected'] = Role::find($id);
    $data['selected_menu_actions'] = RolePermission::where('role_id',$id)->pluck('menu_action_id')->toArray();
    if($data['selected']){
      return view('pages.role.edit', $data);
    }else{
      return $this->show_error_404('Peran');
    }
  }
}
