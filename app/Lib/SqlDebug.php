<?php

namespace app\Lib;


use Illuminate\Database\Connection;
use Illuminate\Database\MySqlConnection;
use Webman\Bootstrap;

class SqlDebug implements Bootstrap
{
    public static function start($worker)
    {
        Connection::resolverFor('mysql', function ($connection, $database, $prefix, $config) {
            return new MySqlConnection($connection, $database, $prefix, $config);
        });

    }
}