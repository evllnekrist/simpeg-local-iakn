<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class UserGroup extends Model
{
    use SoftDeletes;

    protected $table = 'user_groups';

    protected $fillable = [
        'parent_group_id',
        'nickname',
        'fullname',
        'email',
        'phone',
        'img_main',
        'is_enabled',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    // Relasi ke users
    public function user_list()
    {
        return $this->hasMany(User::class, 'user_group_id', 'id');
    }

    // Relasi ke parent group
    public function parent()
    {
        return $this->belongsTo(UserGroup::class, 'parent_group_id');
    }

    // Relasi ke child groups
    public function children()
    {
        return $this->hasMany(UserGroup::class, 'parent_group_id');
    }
}
