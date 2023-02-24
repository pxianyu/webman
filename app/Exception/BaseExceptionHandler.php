<?php

namespace app\Exception;


use app\Enum\CodeEnum;
use app\Enum\MessageEnum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use support\exception\Handler;
use Throwable;
use Webman\Http\Request;
use Webman\Http\Response;

class BaseExceptionHandler extends Handler
{

    public $dontReport = [
        BusinessException::class,
        ValidationException::class,
        ModelNotFoundException::class,
        QueryException::class,
    ];

    public function report(Throwable $exception)
    {
        if ($this->shouldntReport($exception)) {
            return;
        }
        $logs = '';
        if ($request = \request()) {
            $logs = $request->getRealIp() . ' ' . $request->method() . ' ' . trim($request->fullUrl(), '/');
        }
        $this->logger->error($logs . PHP_EOL . $exception);
    }
    public function render(Request $request, Throwable $exception): Response
    {
        // 数据验证异常
        if ($exception->getCode() === CodeEnum::VALIDATE_ERR) {
            return json(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
        if ($exception instanceof ValidationException) {
            return json(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
        // 模型异常
        if ($exception instanceof ModelNotFoundException) {
            return json(['message' => MessageEnum::NOT_FOUND_ERROR, 'code' => CodeEnum::NOT_FOUND]);
        }
        // 查询异常
        if ($exception instanceof QueryException) {
            return json(['message' => MessageEnum::QUERY_ERROR, 'code' => CodeEnum::QUERY_ERR]);
        }
        // 业务异常
        if ($exception instanceof BusinessException) {
            return json(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
        return json(['message' => MessageEnum::SYSTEM_ERROR, 'code' => CodeEnum::SYSTEM_ERR]);
    }
}