<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class MetaActivity extends Model
{
    // Nama tabel
    protected $table = 'meta_activity';

    // Primary key bukan auto-increment, tipe string
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';

    // Gunakan timestamps (created_at & updated_at dari migration)
    public $timestamps = true;

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'name',
        'last_activity',
    ];

    // Cast kolom waktu
    protected $casts = [
        'last_activity' => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    /**
     * Update/insert pointer last_activity ke waktu sekarang.
     */
    public static function touchName(string $name): void
    {
        static::query()->upsert(
            [
                'name'          => $name,
                'last_activity' => now(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            ['name'],                 // unique key
            ['last_activity','updated_at'] // kolom di-update
        );
    }

    /**
     * Ambil last_activity untuk sebuah name; bisa null kalau belum ada.
     */
    public static function getLastActivity(string $name): ?Carbon
    {
        return optional(static::query()->find($name))->last_activity;
    }

    /**
     * Scope: filter sejak waktu tertentu.
     */
    public function scopeSince($query, Carbon|string $since)
    {
        return $query->where('last_activity', '>=', $since instanceof Carbon ? $since : Carbon::parse($since));
    }
}
