<?php

namespace plugin\webman\gateway;

use GatewayWorker\Lib\Gateway;
use support\Log;

class Events
{
    public static function onWorkerStart($worker)
    {
        Log::error('GatewayWorker started');
    }

    public static function onConnect($client_id)
    {
        Log::error('GatewayWorker onConnect');
    }

    public static function onWebSocketConnect($client_id, $data)
    {
        Log::error('GatewayWorker onWebSocketConnect');
    }

    public static function onMessage($client_id, $message)
    {
        Gateway::sendToClient($client_id, "receive message $message");
    }

    public static function onClose($client_id)
    {
        Log::error('GatewayWorker onClose');
    }

}
