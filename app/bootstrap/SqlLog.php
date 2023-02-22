<?php

namespace app\bootstrap;

use Illuminate\Database\Events\QueryExecuted;
use support\Db;
use support\Log;
use Webman\Bootstrap;

class SqlLog implements Bootstrap
{
    /** 记录sql到日志
     * @param $worker
     * @return void
     */
    public static function start($worker): void
    {
        Db::connection()->listen(function (QueryExecuted $event) {
            if (!config('log-ext.sql.enable', false)) {
                return;
            }
            $sql = $event->sql;
            if ($sql === 'select 1') {
                return;
            }
            if ($event->bindings) {
                foreach ($event->bindings as $v) {
                    $sql = preg_replace('/\\?/', "'" . (is_string($v) ? addslashes($v) : $v) . "'", $sql, 1);
                }
            }
            $sqlTime = $event->time;
            $sqlLevel = 'info';
            if ($sqlTime >= config('log-ext.sql.warning_time', 1500)) {
                $sqlLevel = 'warning';
            } elseif ($sqlTime >= config('log-ext.sql.error_time', 10000)) {
                $sqlLevel = 'error';
            }
            Log::channel('sql')->log($sqlLevel, '', [
                'time' => $event->time . 'ms',
                'url' => request()->url(),
                'sql' => $sql,
            ]);
        });

    }
}