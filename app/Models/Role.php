<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\RolePermission;

class Role extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = 'roles';
    protected $fillable = [
      'name',
      'description',
      'created_at',
      'created_by',
      'updated_at',
      'updated_by',
    ];

    public function user_list(){
      return $this->hasMany(User::class, 'id', 'role_id');
    }

    public function role_permission_list(){
      return $this->hasMany(RolePermission::class, 'id', 'role_id');
    }
}
