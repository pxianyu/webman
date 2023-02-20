<?php

namespace app\Exception;


use app\Enum\Code;
use app\Enum\Message;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use support\exception\BusinessException;
use support\exception\Handler;
use Throwable;
use Webman\Http\Request;
use Webman\Http\Response;

class BaseExceptionHandler extends  Handler
{

    public $dontReport = [
        BusinessException::class,
        BusinessException::class,
        ValidationException::class,
        ModelNotFoundException::class,
        QueryException::class,
    ];
    public function render(Request $request, Throwable $exception) : Response
    {
        // 数据验证异常
        if ($exception->getCode() === Code::VALIDATE_ERR) {
            return json(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
        if ($exception instanceof ValidationException){
            return json(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
        // 模型异常
        if ($exception instanceof  ModelNotFoundException) {
            return json(['message' => Message::NOT_FOUND_ERROR, 'code' => Code::NOT_FOUND]);
        }
        // 查询异常
        if ($exception instanceof  QueryException) {
            return json(['message' => Message::QUERY_ERROR, 'code' => Code::QUERY_ERR]);
        }
        // 业务异常
        if ($exception instanceof BusinessException) {
            return json(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
        return json(['message' => Message::SYSTEM_ERROR, 'code' => Code::SYSTEM_ERR]);
    }
}