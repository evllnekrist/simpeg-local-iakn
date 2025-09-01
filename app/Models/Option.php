<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = 'options';
    protected $fillable = [
      'type',
      'value',
      'value2',
      'label',
      'description',
      'img_main',
      'created_at',
      'created_by',
      'updated_at',
      'updated_by',
    ];
}
