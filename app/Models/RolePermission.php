<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Role;
use App\Models\MenuAction;

class RolePermission extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = 'role_permissions';
    protected $fillable = [
      'role_id',
      'menu_action_id',
      'is_enabled',
      'created_at',
      'created_by',
      'updated_at',
      'updated_by',
    ];

    public function role_attr(){
      return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function menu_action_attr(){
      return $this->belongsTo(MenuAction::class, 'menu_action_id', 'id');
    }
}
