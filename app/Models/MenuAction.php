<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Menu;

class MenuAction extends Model
{
    use SoftDeletes;
    protected $table = 'menu_actions';
    protected $fillable = [
      'menu_id',
      'name',
      'slug',
      'description',
      'is_enabled',
      'created_at',
      'created_by',
      'updated_at',
      'updated_by',
    ];

    public function menu_attr(){
      return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
