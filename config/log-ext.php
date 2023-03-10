<?php
return [
    'sql' => [
        'enable' => getenv('LOG_CHANNEL_SQL_ENABLE', true), // 是否开启 sql 日志
        'warning_time' => getenv('LOG_CHANNEL_SQL_WARNING_TIME', 1500), // sql 执行时间超过多少毫秒记录为 warning
        'error_time' => getenv('LOG_CHANNEL_SQL_ERROR_TIME', 10000), // sql 执行时间超过多少毫秒记录为 error
    ],
];