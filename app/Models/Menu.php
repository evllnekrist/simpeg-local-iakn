<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MenuAction;

class Menu extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = 'menus';
    protected $fillable = [
      'parent_id',
      'name',
      'slug',
      'icon',
      'is_menu_with_action',
      'sort_order',
      'is_enabled',
      'display_type',
      'created_at',
      'created_by',
      'updated_at',
      'updated_by',
    ];

    public function menu_action_list(){
      return $this->hasMany(MenuAction::class, 'menu_id', 'id');
    }
}
