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

    function findBySlug($menus, $var, $val) 
    {
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
