<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QueryDebugger
{
    /**
     * Start listening to all queries and log/dump them.
     *
     * @param bool $dumpToScreen
     * @param bool $logToFile
     */
    public static function enable(bool $dumpToScreen = true, bool $logToFile = false): void
    {
        DB::listen(function ($query) use ($dumpToScreen, $logToFile) {
            $sql = vsprintf(
                str_replace('?', "'%s'", $query->sql),
                collect($query->bindings)->map(function ($binding) {
                    return is_object($binding) && method_exists($binding, '__toString')
                        ? (string)$binding
                        : $binding;
                })->toArray()
            );

            $fullQuery = "[SQL] {$sql} [{$query->time} ms]";

            if ($dumpToScreen) {
                dump($fullQuery);
            }

            if ($logToFile) {
                Log::info($fullQuery);
            }
        });
    }
}
