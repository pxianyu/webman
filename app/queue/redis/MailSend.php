<?php

namespace app\queue\redis;
use support\Log;
use Webman\RedisQueue\Consumer;
class MailSend implements Consumer
{
    // 要消费的队列名
    public string $queue = 'send-mail';

    // 连接名，对应 plugin/webman/redis-queue/redis.php 里的连接`
    public string $connection = 'default';

    // 消费
    public function consume($data)
    {
        // 无需反序列化
        Log::error(print_r($data,true));
        var_export($data); // 输出 ['to' => 'tom@gmail.com', 'content' => 'hello']
    }
}