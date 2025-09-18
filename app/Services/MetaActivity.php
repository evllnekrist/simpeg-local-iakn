<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class MetaActivity
{
    /**
     * Update (atau buat) pointer last_activity untuk sebuah nama.
     */
    public static function touch(string $name): void
    {
        DB::table('meta_activity')->updateOrInsert(
            ['name' => $name],
            ['last_activity' => now(), 'updated_at' => now(), 'created_at' => now()]
        );
    }
}
