<?php

namespace app\controller;

use support\Log;
use app\Request;
use Webman\RedisQueue\Redis;

class IndexController
{
    public function json(Request $request)
    {
        // 队列名
        $queue = 'send-mail';
        // 数据，可以直接传数组，无需序列化
        // 投递消息
        for ($i = 0; $i < 10000; $i++) {
            Redis::send($queue.random_int(0,10), $i);
        }
        // 投递延迟消息，消息会在60秒后处理

        return ok();
    }

}
