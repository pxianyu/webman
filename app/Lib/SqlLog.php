<?php

namespace app\Lib;
use Illuminate\Database\Events\QueryExecuted;
use support\Db;
use Webman\Bootstrap;
use support\Log;
class SqlLog implements Bootstrap
{
    /** 记录sql到日志
     * @param $worker
     * @return mixed|void
     */
    public static function start($worker)
    {
        Db::connection()->listen(function (QueryExecuted $queryExecuted){
            $sql=json_encode($queryExecuted->bindings);
            Log::channel('sql')->debug("[{$queryExecuted->time} ms] {$queryExecuted->sql} {$sql}");
        });

    }
}