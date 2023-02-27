<?php

use app\Exception\BusinessException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

return [
    'enable' => false,
    'exception' => [
        // 是否记录异常到日志
        'enable' => true,
        // 不会记录到日志的异常类
        'dontReport' => [
            support\exception\BusinessException::class,
            BusinessException::class,
            ValidationException::class,
            ModelNotFoundException::class,
            QueryException::class,
        ]
    ]
];
