<?php

namespace app\Exception;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use support\exception\Handler;
use Throwable;
use Webman\Http\Request;
use Webman\Http\Response;

class BaseExceptionHandler extends  Handler
{

    public function render(Request $request, Throwable $exception) : Response
    {
        // 数据验证异常
        if ($exception->getCode() == 422) {
            return json(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
        // 模型异常
        if ($exception instanceof  ModelNotFoundException) {
            return json(['message' => Enum::NOT_FOUND_ERROR, 'code' => 404]);
        }
        // 查询异常
        if ($exception instanceof  QueryException) {
            return json(['message' => Enum::QUERY_ERROR, 'code' => 501]);
        }
        // 业务异常
        if ($exception instanceof BusinessException) {
            return json(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
        return json(['message' => Enum::SYSTEM_ERROR, 'code' => 500]);
    }
}