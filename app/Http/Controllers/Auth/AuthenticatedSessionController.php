<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Menu;
use App\Models\MenuAction;
use App\Models\RolePermission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        /* berdasarkan role dari user yang login, ambil permissionnya */
        $user                   = User::where('email',$request->get('email'))->with(['role_attr','user_group_attr'])->first();
        $permit_role_permission = RolePermission::where('role_id',$user->role_id)->pluck('menu_action_id')->toArray();
        $permit_menu_action     = MenuAction::whereIn('id',$permit_role_permission)->get()->toArray();
        $permit_menu            = array();
        for ($i=0; $i < sizeof($permit_menu_action); $i++) {
            if(!array_key_exists($permit_menu_action[$i]['menu_id'],$permit_menu)){
                $permit_menu[$permit_menu_action[$i]['menu_id']] = array();
            }
            array_push($permit_menu[$permit_menu_action[$i]['menu_id']], $permit_menu_action[$i]);
        }
        ksort($permit_menu);
        $permit_menu_keys = (array_keys($permit_menu));
        // dump($permit_menu);
        /* susun berdasarkan master menu yang rapi, filter (dan isi) dari permission yang sudah diambil sebelumnya */
        $role_permission_ready = array();
        $role_permission = Menu::with('menu_action_list')->get();
        for ($i=0; $i < sizeof($role_permission); $i++) {
          if($role_permission[$i]['parent_id'] == null){ /* untuk menu dengan tipe divider - super parent */
            if(!array_key_exists($role_permission[$i]['id'],$role_permission_ready)){
                $role_permission_ready[$role_permission[$i]['id']] = array(
                    'name'            => $role_permission[$i]['name'],
                    'display_type'    => $role_permission[$i]['display_type'],
                    'icon'            => $role_permission[$i]['icon'],
                    'children'        => array()
                );
            }
          }else{ /* untuk menu di bawah super parent */
              if($role_permission[$i]['is_menu_with_action'] && in_array($role_permission[$i]['id'],$permit_menu_keys)){
                    $permit_current_menu_action_read = array_search('read-list', array_column($permit_menu[$role_permission[$i]['id']],'name')); 
                    // var_dump($permit_menu);
                    // var_dump($permit_menu[$role_permission[$i]['id']]);
                    // var_dump($permit_menu[$role_permission[$i]['id']][$permit_current_menu_action_read]);
                    // die();
                    array_push($role_permission_ready[$role_permission[$i]['parent_id']]['children'], array(
                        'name'            => $role_permission[$i]['name'],
                        'display_type'    => $role_permission[$i]['display_type'],
                        'icon'            => $role_permission[$i]['icon'],
                        'slug'            => $permit_menu[$role_permission[$i]['id']][$permit_current_menu_action_read]?
                                                $permit_menu[$role_permission[$i]['id']][$permit_current_menu_action_read]['slug']:
                                                '#',
                        'permit'          => $permit_menu[$role_permission[$i]['id']], 
                        'children'        => array()
                    ));
              }
          }
        }
        // dd($role_permission_ready);

        $request->session()->regenerate();
        $request->session()->put('role_permission', $role_permission_ready);
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
