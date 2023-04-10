<?php

namespace app\queue\redis;

use support\Db;
use support\Log;
use Webman\RedisQueue\Consumer;

class MailSend8 implements Consumer
{
    // 要消费的队列名
    public string $queue = 'send-mail8';

    // 连接名，对应 plugin/webman/redis-queue/redis.php 里的连接`
    public string $connection = 'default';

    // 消费
    public function consume($data)
    {
        echo 'MailSend8';
        var_dump($data);
        // 无需反序列化
        $db=Db::table('tests')->inRandomOrder()->limit(1000)->get(['text','menu_id'])->toJson();
        $db=json_decode($db,true);
        Db::table('tests')->insert($db);
    }
}