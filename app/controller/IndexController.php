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
        $data = ['to' => 'tom@gmail.com', 'content' => 'hello'];
        // 投递消息
        Redis::send($queue, $data);
        // 投递延迟消息，消息会在60秒后处理
        $data['yanchi']=1;
        Redis::send($queue, $data, 60);

        return ok();
    }

}
